<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $apiKey = config('services.openrouter.key');

        if (empty($apiKey)) {
            return response()->json([
                'message' => 'Layanan AI belum dikonfigurasi.',
            ], 503);
        }

        $systemPrompt = 'Kamu adalah asisten virtual UpSize Coffee. Jawab pertanyaan pelanggan dalam bahasa Indonesia yang ramah, singkat, jelas, dan langsung ke inti. Untuk booking ruangan, pelanggan dapat membuka halaman Booking atau Ruangan, login, lalu mengisi formulir booking yang tersedia. Untuk melihat produk, arahkan ke halaman Menu. Untuk memesan produk, pelanggan dapat memilih produk, memasukkannya ke keranjang, lalu checkout. Jangan mengarang harga, stok, promo, fasilitas, ketersediaan ruangan, metode pembayaran booking, atau konfirmasi email. Jika informasi tidak tersedia, arahkan pelanggan ke halaman yang sesuai. Jangan meminta password atau data pembayaran sensitif.';

        $models = array_unique([
            config('services.openrouter.model', 'openrouter/free'),
            'openrouter/free',
        ]);

        foreach ($models as $model) {
            try {
                $response = Http::withToken($apiKey)
                    ->acceptJson()
                    ->timeout(60)
                    ->post('https://openrouter.ai/api/v1/chat/completions', [
                        'model' => $model,
                        'messages' => [
                            [
                                'role' => 'system',
                                'content' => $systemPrompt,
                            ],
                            [
                                'role' => 'user',
                                'content' => $validated['message'],
                            ],
                        ],
                        'max_completion_tokens' => 3000,
                    ]);

                if ($response->failed()) {
                    Log::warning('OpenRouter request failed', [
                        'model' => $model,
                        'status' => $response->status(),
                        'error_code' => $response->json('error.code'),
                    ]);

                    continue;
                }

                $reply = $response->json('choices.0.message.content');

                if (is_array($reply)) {
                    $reply = collect($reply)
                        ->pluck('text')
                        ->filter()
                        ->implode("\n");
                }

                if (is_string($reply) && trim($reply) !== '') {
                    return response()->json([
                        'reply' => trim($reply),
                    ]);
                }

                Log::warning('OpenRouter returned empty content', [
                    'model' => $response->json('model', $model),
                    'finish_reason' => $response->json('choices.0.finish_reason'),
                    'reasoning_tokens' => $response->json('usage.completion_tokens_details.reasoning_tokens'),
                ]);
            } catch (\Throwable $e) {
                Log::warning('OpenRouter connection failed', [
                    'model' => $model,
                    'error_type' => get_class($e),
                ]);
            }
        }

        $message = mb_strtolower($validated['message']);

        if (str_contains($message, 'booking') || str_contains($message, 'ruangan')) {
            return response()->json([
                'reply' => 'Untuk booking ruangan di UpSize Coffee, buka halaman Booking atau Ruangan, login menggunakan akun kamu, lalu isi formulir booking yang tersedia. Kamu bisa melihat informasi ruangan melalui halaman tersebut.',
            ]);
        }

        if (str_contains($message, 'menu') || str_contains($message, 'kopi')) {
            return response()->json([
                'reply' => 'Kamu bisa melihat pilihan kopi dan produk UpSize Coffee di halaman Menu. Pilih produk yang diinginkan untuk melihat informasi dan melakukan pemesanan.',
            ]);
        }

        return response()->json([
            'message' => 'Layanan AI sedang sibuk. Silakan coba lagi.',
        ], 503);
    }
}
