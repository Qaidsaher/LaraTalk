<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Conversation;
use App\Models\Group;
use App\Models\Message;
use App\Models\Attachment;
use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use App\Models\Reaction;
use App\Models\ReadReceipt;
use App\Models\SavedMessage;
use App\Models\Status;
use App\Models\StatusViewer;
use App\Models\UserSetting;
use App\Models\UserVerification;
use App\Models\Device;
use App\Models\Channel;
use App\Models\Block;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user1 =  User::factory()->create([
            'name' => 'saherqaid',
            'email' => 'saher@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'offline'

        ]);
        $user2 = User::factory()->create([
            'name' => 'wafa',
            'email' => 'wafa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'offline'

        ]);


        Conversation::factory()->create()->each(function ($conversation) use ($user1, $user2) {
            // Attach both users to the conversation
            // Attach both users to the conversation with roles
            \App\Models\ConversationUser::factory()->create([
                'conversation_id' => $conversation->id,
                'user_id' => $user1->id,
                'role' => 'admin', // Assign appropriate role
            ]);

            \App\Models\ConversationUser::factory()->create([
                'conversation_id' => $conversation->id,
                'user_id' => $user2->id,
                'role' => 'member', // Assign appropriate role
            ]);

            // Create messages alternately from user1 and user2
            Message::factory(count: 3)->create(['conversation_id' => $conversation->id])->each(function ($message, $index) use ($user1, $user2) {
                // Alternate users for each message
                $message->user_id = $index % 2 === 0 ? $user1->id : $user2->id;
                $message->save();

                // Attach files to each message
                Attachment::factory(2)->create(['message_id' => $message->id]);

                // Add reactions to the message
                Reaction::factory(2)->create(['message_id' => $message->id]);

                // Create read receipts for the message for both users
                ReadReceipt::factory()->create([
                    'message_id' => $message->id,
                    'user_id' => $user1->id,
                ]);

                ReadReceipt::factory()->create([
                    'message_id' => $message->id,
                    'user_id' => $user2->id,
                ]);
            });
        });
        $this->generating($user1);
        User::factory(10)->create()->each(function ($user) {
            $this->generating($user);
        });
    }


    public function generating($user)
    {
        // Create devices for each user
        Device::factory(3)->create(['user_id' => $user->id]);

        // Create related user settings
        UserSetting::factory()->create(['user_id' => $user->id]);

        // Create related user verifications
        UserVerification::factory()->create(['user_id' => $user->id]);

        // Create related groups
        Group::factory(2)->create(['owner_id' => $user->id])->each(function ($group) use ($user) {
            // Add members to the group
            \App\Models\GroupUser::factory(2)->create(['group_id' => $group->id, 'user_id' => $user->id]);

            // Create messages in the group
            Message::factory(5)->create(['group_id' => $group->id, 'user_id' => $user->id])->each(function ($message) {
                // Attach files to each message
                Attachment::factory(2)->create(['message_id' => $message->id]);

                // Add reactions to the message
                Reaction::factory(2)->create(['message_id' => $message->id]);

                // Create read receipts for the message
                ReadReceipt::factory(2)->create(['message_id' => $message->id]);
            });
        });

        // Create conversations for each user
        Conversation::factory(3)->create()->each(function ($conversation) use ($user) {
            // Add users to the conversation
            \App\Models\ConversationUser::factory(2)->create(['conversation_id' => $conversation->id, 'user_id' => $user->id]);

            // Create messages in the conversation
            Message::factory(5)->create(['conversation_id' => $conversation->id, 'user_id' => $user->id])->each(function ($message) {
                // Attach files to each message
                Attachment::factory(2)->create(['message_id' => $message->id]);

                // Add reactions to the message
                Reaction::factory(2)->create(['message_id' => $message->id]);

                // Create read receipts for the message
                ReadReceipt::factory(2)->create(['message_id' => $message->id]);
            });
        });

        // Create channels and add users
        Channel::factory(2)->create(['creator_id' => $user->id])->each(function ($channel) use ($user) {
            \App\Models\ChannelUser::factory(2)->create(['channel_id' => $channel->id, 'user_id' => $user->id]);

            // Create messages in the channel
            Message::factory(5)->create(['channel_id' => $channel->id, 'user_id' => $user->id])->each(function ($message) {
                // Attach files to each message
                Attachment::factory(2)->create(['message_id' => $message->id]);

                // Add reactions to the message
                Reaction::factory(2)->create(['message_id' => $message->id]);

                // Create read receipts for the message
                ReadReceipt::factory(2)->create(['message_id' => $message->id]);
            });
        });

        // Create polls for each user
        Poll::factory(2)->create()->each(function ($poll) {
            // Create options for the poll
            PollOption::factory(3)->create(['poll_id' => $poll->id]);

            // Add votes to each poll option
            PollVote::factory(2)->create(['poll_option_id' => \App\Models\PollOption::factory()->create()->id]);
        });

        // Create statuses for each user
        Status::factory(2)->create(['user_id' => $user->id])->each(function ($status) use ($user) {
            // Create status viewers
            StatusViewer::factory(3)->create(['status_id' => $status->id, 'viewer_user_id' => $user->id]);
        });

        // Create saved messages for each user
        SavedMessage::factory(3)->create(['user_id' => $user->id]);

        // Create blocks (for blocking functionality)
        Block::factory(2)->create([
            'blocker_id' => $user->id,
            'blocked_id' => \App\Models\User::factory()->create()->id
        ]);
    }
}
