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

        $userMessage = trim($request->message);

        // Lightweight topic guard before calling the model
        $healthKeywords = [
            'kesehatan','dokter','gejala','penyakit','diagnosa','diagnosis','obat','resep','terapi',
            'nutrisi','gizi','diet','olahraga','kebugaran','fitness','mental','psikolog','stres','stress',
            'depresi','cemas','anxiety','tidur','insomnia','vaksin','imunisasi','batuk','demam','flu',
            'covid','diabetes','hipertensi','jantung','kolesterol','kulit','gigi','pediatri','kehamilan',
            'kandungan','ginekologi','asma','alergi','nyeri','sakit','BMI','tekanan darah','gula darah',
            'konsultasi','janji temu','appointment','dokter gigi','psikiater','dermatologi','ortopedi'
        ];
        $offTopicHints = [
            // Tech / finance / general
            'laptop','pc','komputer','smartphone','hp','gadget','game','gaming','vga','gpu','cpu','ram','ssd','monitor',
            'programming','koding','coding','framework','react','laravel','python','javascript','java','c++','c#',
            'crypto','bitcoin','saham','investasi','trading','forex','keuangan','rekening',
            'travel','wisata','hotel','tiket',
            'film','movie','music','musik','lagu','artis','seleb',
            'otomotif','motor','mobil'
        ];

        $isHealth = false;
        $lower = mb_strtolower($userMessage, 'UTF-8');
        foreach ($healthKeywords as $kw) {
            if (str_contains($lower, mb_strtolower($kw, 'UTF-8'))) {
                $isHealth = true; break;
            }
        }
        $containsOffTopic = false;
        foreach ($offTopicHints as $kw) {
            if (str_contains($lower, mb_strtolower($kw, 'UTF-8'))) {
                $containsOffTopic = true; break;
            }
        }

        if (!$isHealth && $containsOffTopic) {
            // Early refusal without calling the model
            return response()->json([
                'success' => true,
                'message' => "Maaf, saya adalah asisten AI khusus kesehatan. Saya hanya bisa membantu pertanyaan seputar kesehatan, gejala dini, gaya hidup sehat, nutrisi, olahraga, dan konsultasi janji temu. Coba ajukan pertanyaan yang berkaitan dengan kesehatan, ya."
            ]);
        }
        
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
            // System prompt khusus kesehatan, sertakan aturan penolakan di luar domain
            $systemPrompt = "Anda adalah asisten kesehatan AI profesional untuk aplikasi klinik. Jawab HANYA pertanyaan terkait kesehatan/medis, gaya hidup sehat, nutrisi, olahraga, kesehatan mental, atau alur janji temu. Jika pertanyaan di luar itu (misal topik komputer, keuangan, hiburan, politik, pemrograman, dsb), TOLAK dengan sopan dan jelaskan bahwa Anda khusus kesehatan. Jangan memberikan jawaban untuk topik di luar domain. Berikan jawaban dalam Bahasa Indonesia yang:\n\n"
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
                . "Jika pertanyaan DI LUAR kesehatan, balas DENGAN format singkat:\n\n"
                . "**Maaf, saya AI khusus kesehatan.**\n"
                . "• Saya hanya bisa membantu topik kesehatan, gejala, gaya hidup sehat, nutrisi, olahraga, mental health, dan janji temu.\n"
                . "• Silakan ajukan pertanyaan terkait kesehatan.\n\n"
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
