<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HealthAIController extends Controller
{
    /**
     * Chat with Gemini AI for health questions
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userMessage = $request->message;
        
        // Get Gemini API key from env
        $apiKey = config('services.gemini.api_key', env('GEMINI_API_KEY'));
        
        if (!$apiKey) {
            Log::error('Gemini API key not configured');
            return response()->json([
                'success' => false,
                'message' => 'Konfigurasi AI belum lengkap. Silakan hubungi administrator.'
            ], 500);
        }

        try {
            // System prompt untuk health assistant - ringkas dan to the point
            $systemPrompt = "Anda adalah asisten kesehatan AI. Berikan jawaban dalam Bahasa Indonesia yang:\n"
                . "1. RINGKAS dan TO THE POINT (maksimal 3-4 kalimat atau 3-5 poin)\n"
                . "2. Gunakan format Markdown untuk penekanan:\n"
                . "   - **teks tebal** untuk kata kunci penting\n"
                . "   - Gunakan bullet points (•) untuk list\n"
                . "3. SELALU akhiri dengan: '⚠️ **PENTING: Konsultasikan dengan dokter untuk diagnosis yang akurat.**'\n"
                . "4. Fokus pada informasi praktis dan actionable\n"
                . "5. Hindari penjelasan yang bertele-tele\n\n"
                . "Contoh format jawaban yang baik:\n"
                . "**Tips Hidup Sehat:**\n"
                . "• **Pola makan seimbang** - konsumsi sayur & buah\n"
                . "• **Olahraga rutin** - minimal 30 menit/hari\n"
                . "• **Tidur cukup** - 7-8 jam per malam\n\n"
                . "⚠️ **PENTING: Konsultasikan dengan dokter untuk diagnosis yang akurat.**";

            $fullPrompt = $systemPrompt . "\n\nPertanyaan: " . $userMessage;

            Log::info('Sending request to Gemini API', [
                'message_length' => strlen($userMessage),
                'api_key_present' => !empty($apiKey),
                'api_key_length' => strlen($apiKey)
            ]);

            // Call Gemini API with correct authentication header
            $response = Http::timeout(30)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'x-goog-api-key' => $apiKey,
                ])
                ->post(
                    'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-exp:generateContent',
                    [
                        'contents' => [
                            [
                                'parts' => [
                                    ['text' => $fullPrompt]
                                ]
                            ]
                        ]
                    ]
                );

            Log::info('Gemini API Response', [
                'status' => $response->status(),
                'successful' => $response->successful()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Gemini API Response Data', ['has_candidates' => isset($data['candidates'])]);
                
                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    $aiResponse = $data['candidates'][0]['content']['parts'][0]['text'];
                    
                    return response()->json([
                        'success' => true,
                        'message' => $aiResponse
                    ]);
                } else {
                    Log::warning('Gemini API returned unexpected format', ['data' => $data]);
                    return response()->json([
                        'success' => false,
                        'message' => 'Maaf, saya tidak dapat memproses pertanyaan Anda saat ini. Silakan coba lagi.'
                    ], 500);
                }
            } else {
                Log::error('Gemini API Error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'headers' => $response->headers()
                ]);
                
                $errorMessage = 'Terjadi kesalahan saat menghubungi AI.';
                
                if ($response->status() === 400) {
                    $errorMessage = 'Permintaan tidak valid. API key mungkin salah.';
                } elseif ($response->status() === 403) {
                    $errorMessage = 'API key tidak memiliki akses. Periksa konfigurasi API key.';
                } elseif ($response->status() === 429) {
                    $errorMessage = 'Terlalu banyak permintaan. Silakan coba lagi nanti.';
                }
                
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                    'debug' => app()->environment('local') ? $response->body() : null
                ], 500);
            }
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Gemini API Connection Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat terhubung ke server AI. Periksa koneksi internet Anda.'
            ], 500);
        } catch (\Exception $e) {
            Log::error('Health AI Chat Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }
}
