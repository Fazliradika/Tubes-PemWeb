<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\AiChat;
use App\Models\AiMessage;

class HealthAIController extends Controller
{
    /**
     * Chat with Groq AI for health questions
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'chat_id' => 'nullable|integer',
        ]);

        $userMessage = trim($request->message);
        $chatId = $request->input('chat_id');

        // Resolve or create chat
        $chat = null;
        if ($chatId) {
            $chat = AiChat::where('id', $chatId)->where('user_id', Auth::id())->first();
        }
        if (!$chat) {
            $chat = new AiChat([
                'user_id' => Auth::id(),
                'title' => Str::limit(preg_replace('/\s+/', ' ', $userMessage), 60),
            ]);
            $chat->save();
        }

        // Persist user message
        AiMessage::create([
            'chat_id' => $chat->id,
            'role' => 'user',
            'content' => $userMessage,
        ]);

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
            // Early refusal without calling the model; save assistant reply
            $refusal = "Maaf, saya adalah asisten AI khusus kesehatan. Saya hanya bisa membantu pertanyaan seputar kesehatan, gejala dini, gaya hidup sehat, nutrisi, olahraga, dan konsultasi janji temu. Coba ajukan pertanyaan yang berkaitan dengan kesehatan, ya.";
            AiMessage::create([
                'chat_id' => $chat->id,
                'role' => 'assistant',
                'content' => $refusal,
            ]);

            return response()->json([
                'success' => true,
                'chat_id' => $chat->id,
                'title' => $chat->title,
                'message' => $refusal,
            ]);
        }
        
        // Get Groq API key from env
        $apiKey = config('services.groq.api_key', env('GROQ_API_KEY'));
        
        if (!$apiKey) {
            Log::error('Groq API key not configured');
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

            Log::info('Sending request to Groq API', [
                'message_length' => strlen($userMessage),
                'api_key_present' => !empty($apiKey),
                'api_key_length' => strlen($apiKey)
            ]);

            // Call Groq API (OpenAI-compatible format)
            $response = Http::timeout(30)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $apiKey,
                ])
                ->post(
                    'https://api.groq.com/openai/v1/chat/completions',
                    [
                        'model' => 'llama-3.3-70b-versatile',
                        'messages' => [
                            [
                                'role' => 'system',
                                'content' => $systemPrompt
                            ],
                            [
                                'role' => 'user',
                                'content' => $userMessage
                            ]
                        ],
                        'temperature' => 0.7,
                        'max_tokens' => 2048,
                    ]
                );

            Log::info('Groq API Response', [
                'status' => $response->status(),
                'successful' => $response->successful()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('Groq API Response Data', ['has_choices' => isset($data['choices'])]);
                
                if (isset($data['choices'][0]['message']['content'])) {
                    $aiResponse = $data['choices'][0]['message']['content'];

                    // Save assistant reply
                    AiMessage::create([
                        'chat_id' => $chat->id,
                        'role' => 'assistant',
                        'content' => $aiResponse,
                    ]);
                    $chat->touch();
                    
                    return response()->json([
                        'success' => true,
                        'chat_id' => $chat->id,
                        'title' => $chat->title,
                        'message' => $aiResponse,
                    ]);
                } else {
                    Log::warning('Groq API returned unexpected format', ['data' => $data]);
                    return response()->json([
                        'success' => false,
                        'message' => 'Maaf, saya tidak dapat memproses pertanyaan Anda saat ini. Silakan coba lagi.'
                    ], 500);
                }
            } else {
                Log::error('Groq API Error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'headers' => $response->headers()
                ]);
                
                $errorMessage = 'Terjadi kesalahan saat menghubungi AI.';
                
                if ($response->status() === 400) {
                    $errorMessage = 'Permintaan tidak valid. API key mungkin salah.';
                } elseif ($response->status() === 401) {
                    $errorMessage = 'API key tidak valid. Periksa konfigurasi API key.';
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
            Log::error('Groq API Connection Error: ' . $e->getMessage());
            
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

    /**
     * Return chat list for current user
     */
    public function chats(Request $request)
    {
        $chats = AiChat::where('user_id', Auth::id())
            ->orderByDesc('updated_at')
            ->limit(50)
            ->get(['id','title','updated_at']);

        return response()->json([
            'success' => true,
            'data' => $chats,
        ]);
    }

    /**
     * Return messages for a chat
     */
    public function messages(Request $request, AiChat $chat)
    {
        if ($chat->user_id !== Auth::id()) abort(403);
        $messages = $chat->messages()->orderBy('created_at')->get(['role','content','created_at']);
        return response()->json([
            'success' => true,
            'chat_id' => $chat->id,
            'title' => $chat->title,
            'messages' => $messages,
        ]);
    }

    /**
     * Delete a chat and its messages
     */
    public function destroy(Request $request, AiChat $chat)
    {
        if ($chat->user_id !== Auth::id()) abort(403);
        $chat->delete();
        return response()->json(['success' => true]);
    }
}
