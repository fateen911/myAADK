<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class SetTelegramWebhook extends Command
{
    protected $signature = 'telegram:set-webhook';
    protected $description = 'Set the webhook for the Telegram bot';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $url = 'https://your-domain.com/telegram-webhook'; // Replace with your actual URL

        try {
            $response = Telegram::setWebhook(['url' => $url]);
            if ($response->getOk()) {
                $this->info('Webhook successfully set.');
            } else {
                $this->error('Failed to set webhook.');
            }
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
