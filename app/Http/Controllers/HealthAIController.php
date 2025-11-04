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
            // System prompt untuk health assistant - berkualitas, informatif, dan ringkas
            $systemPrompt = "Anda adalah asisten kesehatan AI profesional. Berikan jawaban dalam Bahasa Indonesia yang:\n\n"
                . "**FORMAT JAWABAN:**\n"
                . "1. **Judul singkat** yang menjawab pertanyaan\n"
                . "2. **Penjelasan singkat** (1-2 kalimat context jika diperlukan)\n"
                . "3. **Poin-poin utama** dengan penjelasan mini:\n"
                . "   • **Poin utama** - penjelasan singkat yang jelas dan actionable\n"
                . "4. **Tips tambahan** atau catatan penting jika relevan\n"
                . "5. **SELALU akhiri dengan:** ⚠️ **PENTING: Konsultasikan dengan dokter untuk diagnosis yang akurat.**\n\n"
                . "**GAYA PENULISAN:**\n"
                . "- Gunakan **bold** untuk kata kunci, istilah medis, atau informasi penting\n"
                . "- Bullet points (•) untuk list\n"
                . "- Ringkas tapi informatif (5-8 poin maksimal)\n"
                . "- Bahasa mudah dipahami, hindari jargon medis berlebihan\n"
                . "- Berikan angka/ukuran spesifik jika relevan (contoh: 30 menit/hari, 7-8 jam)\n"
                . "- Fokus pada saran praktis yang bisa langsung diterapkan\n\n"
                . "**CONTOH FORMAT:**\n"
                . "**[Judul Jawaban]:**\n\n"
                . "[Penjelasan singkat jika perlu]\n\n"
                . "• **Poin 1** - penjelasan detail yang actionable\n"
                . "• **Poin 2** - penjelasan dengan contoh konkret\n"
                . "• **Poin 3** - tips praktis yang mudah diikuti\n\n"
                . "**[Tips/Catatan jika ada]:** informasi tambahan yang berguna\n\n"
                . "⚠️ **PENTING: Konsultasikan dengan dokter untuk diagnosis yang akurat.**";

            $fullPrompt = $systemPrompt . "\n\n**Pertanyaan:** " . $userMessage;

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
