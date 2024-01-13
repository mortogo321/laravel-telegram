<?php

namespace App\Http\Controllers;

use NotificationChannels\Telegram\TelegramMessage;

class HomeController extends Controller
{
    public function index(string $message = '')
    {
        $token = config('services.telegram-bot-api.token');

        // delete webhook
        // $url = "https://api.telegram.org/bot{$token}/deleteWebhook";
        // $response = Http::dump()->get($url)->json();
        // dump($response);

        $bot = TelegramMessage::create();
        $bot->telegram->setToken(config('services.telegram-bot-api.token'));
        $response = $bot->telegram->getUpdates([
            'offset' => -1,
            'timeout' => 0,
        ]);

        $updates = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        $chatId = $updates['result'][0]['message']['chat']['id'] ?? null;

        $message = '
        <b>DEPOSIT</b>
        <em>TxnId:</em> <b>1234</b>
        <em>Name:</em> <b>test</b>
        <em>Amount:</em> <b>123.00 THB</b>
        ';

        if ($chatId) {
            $bot->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => $message ?: 'test message',
                'parse_mode' => 'HTML',
            ]);
        }
    }
}
