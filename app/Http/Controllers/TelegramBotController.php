<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Objects\Update;

class TelegramBotController extends Controller
{
    public function handle(Request $request)
    {
        $update = Telegram::commandsHandler(true);
        $message = $update->getMessage();
        $chatId = $message->getChat()->getId();
        $text = $message->getText();

        if ($message->getText() === '/start') {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'Hello! What is your name?'
            ]);
            // Save state to manage conversation
            // You may use database or cache to track conversation state
            return;
        }

        // Handle user response based on conversation state
        $this->handleUserResponse($chatId, $text);

        return 'ok';
    }

    private function handleUserResponse($chatId, $text)
    {
        // Retrieve and update conversation state from database or cache
        // Example: Save user responses in the session or database
        // Then ask for the next piece of information
        // Implement logic based on conversation state

        // Example:
        $state = $this->getUserState($chatId); // Implement this function
        if ($state === 'name') {
            // Save name and ask for state
            $this->setUserName($chatId, $text); // Implement this function
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'Which state are you from?'
            ]);
            $this->setUserState($chatId, 'state'); // Implement this function
        } elseif ($state === 'state') {
            // Save state and ask for area
            $this->setUserState($chatId, $text); // Implement this function
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'Which area are you from?'
            ]);
            $this->setUserState($chatId, 'area'); // Implement this function
        } elseif ($state === 'area') {
            // Save area and conclude
            $this->setUserArea($chatId, $text); // Implement this function
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'Thank you! You are from ' . $text . '. Have a great day!'
            ]);
            $this->resetUserState($chatId); // Implement this function
        }
    }
}
