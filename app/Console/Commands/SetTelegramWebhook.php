<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Api;

class SetTelegramWebhook extends Command
{
    protected $signature = 'telegram:set-webhook';
    protected $description = 'Set the webhook URL for the Telegram bot';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $telegram = new Api(env('7424416504:AAFBsucOUhWLVOaLXOWCvrr2AaC6_ZlaHrk'));
        $webhookUrl = 'http://127.0.0.1:8000/telegram/webhook';

        try {
            $response = $telegram->setWebhook(['url' => $webhookUrl]);
            if ($response->isOk()) {
                $this->info('Webhook set successfully.');
            } else {
                $this->error('Failed to set webhook.');
            }
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
