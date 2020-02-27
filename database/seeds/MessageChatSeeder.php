<?php

use Illuminate\Database\Seeder;
use App\MessageChat;

class MessageChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(MessageChat::class, 50) -> create();
    }
}
