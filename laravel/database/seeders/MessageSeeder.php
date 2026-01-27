<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();
        $sql = "TRUNCATE TABLE `messages`;
";
        $messages = [
            'Hi, is this available?',
            'Can you share more details?',
            'Thanks!',
            'Order placed 👍',
            'When will it ship?',
            'Please update me',
        ];
        for ($i = 1; $i <= 10000; $i++) {
            $sql .= sprintf(
                "INSERT INTO `messages` (`conversation_id`, `sender_id`, `body`, `created_at`) VALUES (%d, %d, '%s', '%s');\n",
                rand(1, 10000),
                rand(1, 200000),
                addslashes($messages[array_rand($messages)]),
                now()
            );
        }
        file_put_contents(database_path('seed.sql'), $sql, FILE_APPEND);
    }
}
