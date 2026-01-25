<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            'Hi, is this available?',
            'Can you share more details?',
            'Thanks!',
            'Order placed 👍',
            'When will it ship?',
            'Please update me',
        ];

        DB::table('conversation_participants')
            ->select('conversation_id', 'user_id')
            ->chunk(1000, function ($rows) use ($messages) {
                $batch = [];

                foreach ($rows as $row) {
                    $batch[] = [
                        'conversation_id' => $row->conversation_id,
                        'sender_id' => $row->user_id,
                        'body' => $messages[array_rand($messages)],
                        'created_at' => now(),
                    ];
                }

                DB::table('messages')->insert($batch);
            });
    }
}
