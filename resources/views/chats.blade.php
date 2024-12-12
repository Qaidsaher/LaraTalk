<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Chats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- User's Information -->
            <div class="p-6 mb-6 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-2xl font-bold">Welcome, {{ $user->name }}</h2>
                <p>Status: {{ $user->status }}</p>
                <p>Email: {{ $user->email }}</p>
                <p><img src="{{ $user->avatarUrl() }}" alt="User Avatar" class="w-24 h-24 rounded-full"></p>
            </div>
            <!-- User's Information -->


            <!-- Conversations Section -->
            <div class="p-6 mb-6 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-2xl font-bold">Conversations</h2>
                @foreach ($conversations as $conversation)
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">{{ $conversation->name ?? 'Unnamed Conversation' }}</h3>
                        <p class="text-gray-600">Users: {{ $conversation->users->count() }} | Messages:
                            {{ $conversation->messages->count() }}</p>

                        <!-- Send message form -->
                        <form
                            action="{{ route('sendMessage', ['type' => 'conversation', 'id' => $conversation->id]) }}"
                            method="POST">
                            @csrf
                            <textarea name="message" rows="3" class="w-full p-2 border rounded" placeholder="Type your message..."></textarea>
                            <button type="submit" class="p-2 mt-2 text-white bg-blue-500 rounded">Send Message</button>
                        </form>

                        <div class="mt-2 space-y-2">
                            @foreach ($conversation->messages as $message)
                                <p class="text-gray-500"><strong>{{ $message->user->name }}:</strong>
                                    {{ $message->message }}</p>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Groups Section -->
            <div class="p-6 mb-6 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-2xl font-bold">Groups</h2>
                @foreach ($groups as $group)
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">{{ $group->name ?? 'Unnamed Group' }}</h3>
                        <p class="text-gray-600">Users: {{ $group->users->count() }} | Messages:
                            {{ $group->messages->count() }}</p>

                        <!-- Send message form -->
                        <form action="{{ route('sendMessage', ['type' => 'group', 'id' => $group->id]) }}"
                            method="POST">
                            @csrf
                            <textarea name="message" rows="3" class="w-full p-2 border rounded" placeholder="Type your message..."></textarea>
                            <button type="submit" class="p-2 mt-2 text-white bg-blue-500 rounded">Send Message</button>
                        </form>

                        <div class="mt-2 space-y-2">
                            @foreach ($group->messages as $message)
                                <p class="text-gray-500"><strong>{{ $message->user->name }}:</strong>
                                    {{ $message->message }}</p>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Channels Section -->
            <div class="p-6 mb-6 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-2xl font-bold">Channels</h2>
                @foreach ($channels as $channel)
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">{{ $channel->name ?? 'Unnamed Channel' }}</h3>
                        <p class="text-gray-600">Users: {{ $channel->users->count() }} | Messages:
                            {{ $channel->messages->count() }}</p>

                        <!-- Send message form -->
                        <form action="{{ route('sendMessage', ['type' => 'channel', 'id' => $channel->id]) }}"
                            method="POST">
                            @csrf
                            <textarea name="message" rows="3" class="w-full p-2 border rounded" placeholder="Type your message..."></textarea>
                            <button type="submit" class="p-2 mt-2 text-white bg-blue-500 rounded">Send Message</button>
                        </form>

                        <div class="mt-2 space-y-2">
                            @foreach ($channel->messages as $message)
                                <p class="text-gray-500"><strong>{{ $message->user->name }}:</strong>
                                    {{ $message->message }}</p>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Status Section -->
            <div class="p-6 mt-8 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-2xl font-bold">Your Status</h2>
                <ul class="space-y-4">
                    @foreach ($statuses as $status)
                        <li class="p-4 border rounded-lg hover:bg-gray-100">
                            <h3 class="text-lg font-semibold">{{ $status->status_text }}</h3>
                            <p class="text-gray-600">Viewed by: {{ $status->viewers->count() }} users</p>
                            <p class="text-gray-500">Posted by: {{ $status->user->name }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Settings Section -->
            <div class="p-6 mt-8 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-2xl font-bold">Your Settings</h2>
                @isset($settings)
                <p>Language: {{ $settings->language }}</p>
                <p>Dark Mode: {{ $settings->dark_mode ? 'Enabled' : 'Disabled' }}</p>
                <p>Notifications: {{ $settings->notifications_enabled ? 'Enabled' : 'Disabled' }}</p>
                @endisset

            </div>

            <!-- Devices Section -->
            <div class="p-6 mt-8 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-2xl font-bold">Your Devices</h2>
                <ul class="space-y-4">
                    @foreach ($devices as $device)
                        <li class="p-4 border rounded-lg hover:bg-gray-100">
                            <p><strong>Device Type:</strong> {{ $device->device_type }}</p>
                            <p><strong>Device Info:</strong> {{ $device->device_info }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Saved Messages Section -->
            <div class="p-6 mt-8 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-2xl font-bold">Saved Messages</h2>
                <ul class="space-y-4">
                    @foreach ($savedMessages as $savedMessage)
                        <li class="p-4 border rounded-lg hover:bg-gray-100">
                            <p><strong>Message:</strong> {{ $savedMessage->message }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="p-6 mt-8 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-2xl font-bold">Blocked Users</h2>
                <ul class="space-y-4">
                    @foreach ($blocks as $block)
                        <li class="p-4 border rounded-lg hover:bg-gray-100">
                            @if ($block->blocked)
                                <p><strong>Blocked User:</strong> {{ $block->blocked->name }}</p>
                            @else
                                <p><strong>Blocked User:</strong> No user found</p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</x-app-layout>
