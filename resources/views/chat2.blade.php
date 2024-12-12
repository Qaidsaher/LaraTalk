<x-app-layout>

    <style>
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }


        ::-webkit-scrollbar-track {
            background: #1a1a1a;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #4b5563, #374151);
            border-radius: 4px;
            border: 2px solid #1a1a1a;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #6b7280, #4b5563);
            /* Change color on hover */
        }


        scrollbar-width: thin;
        scrollbar-color: #4b5563 #1a1a1a;
        /* Handle and track colors */
    </style>

    <div class="py-12" dir="rtl">
        {{-- <div class="container p-4 mx-auto" x-data="{ showMobile: false, showDesktop: true }">
            <!-- Toggle for Mobile View -->
            <div class="mb-4">
                <button @click="showMobile = !showMobile"
                    class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                    Toggle Mobile View Element
                </button>
            </div>

            <!-- Mobile Element -->
            <div class="p-4 text-white bg-green-500 rounded-lg md:hidden" x-show="showMobile" x-transition>
                <p>This element is visible only on mobile screens (md:hidden).</p>
            </div>

            <!-- Desktop Toggle -->
            <div class="mb-4">
                <button @click="showDesktop = !showDesktop"
                    class="px-4 py-2 text-white bg-purple-500 rounded hover:bg-purple-600">
                    Toggle Desktop View Element
                </button>
            </div>

            <!-- Desktop Element -->
            <div class="hidden p-4 text-white bg-purple-500 rounded-lg md:block" x-show="showDesktop" x-transition>
                <p>This element is visible only on desktop screens (hidden md:block).</p>
            </div>

            <!-- Always Visible Element -->
            <div class="p-4 mt-4 text-white bg-gray-700 rounded-lg">
                <p>This element is always visible on all screen sizes.</p>
            </div>
        </div> --}}
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex h-screen " x-data="chatApp()" :class="{ 'dark': isDarkMode }">
                <!-- Sidebar -->
                <div
                    class="hidden w-1/4 overflow-y-auto bg-white border-r rounded-sm dark:bg-gray-800 dark:border-gray-700 md:block">
                    <div class="p-4 border-b dark:border-gray-700">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 dark:text-gray-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 20a8 8 0 100-16 8 8 0 000 16zM21 21l-4.35-4.35" />
                                </svg>
                            </span>
                            <input type="text" placeholder="Search..."
                                class="w-full py-2 pl-10 pr-4 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-400 dark:focus:ring-blue-300 dark:focus:border-blue-300 focus:ring-1">
                        </div>
                    </div>

                    <div class="p-4 ">
                        <h2 class="mb-2 text-sm text-gray-500 uppercase dark:text-gray-400">Conversations</h2>
                        <template x-for="conversation in conversations" :key="conversation.id">
                            <div @click="selectConversation(conversation)"
                                :class="{
                                    'bg-gray-200 dark:bg-gray-600': selectedConversation && selectedConversation.id ===
                                        conversation.id
                                }"
                                class="flex items-center p-2 rounded cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                                <img :src="conversation.avatar" alt="Avatar" class="w-10 h-10 mr-3 rounded-full">
                                <div class="flex-1">
                                    <div class="flex justify-between">
                                        <span x-text="conversation.name"
                                            class="font-semibold dark:text-gray-200"></span>
                                        <span x-text="conversation.time"
                                            class="text-xs text-gray-500 dark:text-gray-400"></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-300"
                                            x-text="conversation.lastMessage"></span>
                                        <span x-show="conversation.unread"
                                            class="flex items-center justify-center w-5 h-5 p-1 text-xs text-white bg-blue-500 rounded-full">1</span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Main Chat Area -->
                <div class="flex flex-col flex-1">
                    <!-- Header -->
                    <div class="flex items-center p-2 bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <img :src="selectedConversation.avatar" alt="Avatar" class="w-10 h-10 mr-3 rounded-full">
                        <div class="flex-1">
                            <h2 class="font-semibold dark:text-gray-200" x-text="selectedConversation.name"></h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Online</p>
                        </div>
                        <div class="flex space-x-4">
                            <button @click="toggleDarkMode" class="text-gray-600 dark:text-gray-300">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                </svg>

                            </button>
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600 dark:text-gray-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div class="flex-1 p-4 overflow-y-auto dark:bg-gray-900 dark:text-gray-200">
                        <template x-if="selectedConversation">
                            <div>
                                <template x-for="message in selectedConversation.messages" :key="message.id">
                                    <div class="flex mb-4" :class="{ 'justify-end': message.sentBy === 'you' }">
                                        <div class="max-w-xs">
                                            <div class="flex items-center mb-1">
                                                <img :src="message.avatar" alt="Avatar"
                                                    class="w-6 h-6 mr-2 rounded-full" x-show="message.sentBy !== 'you'">
                                                <span class="text-sm text-gray-700 dark:text-gray-300"
                                                    x-text="message.text"></span>
                                            </div>
                                            <div class="flex justify-end text-xs text-gray-500 dark:text-gray-400">
                                                <span x-text="message.time"></span>
                                                <svg x-show="message.read" xmlns="http://www.w3.org/2000/svg"
                                                    class="w-4 h-4 ml-1 text-blue-500" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>


                                </template>
                            </div>
                        </template>
                    </div>

                    <!-- Input Area -->
                    <div class="flex items-center p-4 bg-white border-t dark:bg-gray-800 dark:border-gray-700">
                        <!-- Attach File Button -->


                        <label class="mr-3 text-gray-600 cursor-pointer dark:text-gray-300">
                            <input type="file" class="hidden" @change="attachFile">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16.5 11.5V5.75a3.25 3.25 0 10-6.5 0v7a4.25 4.25 0 008.5 0V6a1.25 1.25 0 10-2.5 0v7a1.75 1.75 0 11-3.5 0v-7" />
                            </svg>
                        </label>

                        <!-- Message Input -->
                        <input type="text" placeholder="Type a message"
                            class="flex-1 px-3 py-2 mr-3 border rounded dark:bg-gray-700 dark:text-gray-300"
                            x-model="newMessage" @keydown.enter="sendMessage">



                        <!-- Send Message Button -->
                        <button class="ml-3 text-blue-500 dark:text-blue-300" @click="sendMessage">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                            </svg>

                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        const conversations = Array.from({
            length: 20
        }, (_, conversationIndex) => ({
            id: conversationIndex + 1,
            name: `Conversation ${conversationIndex + 1}`,
            avatar: `https://i.pravatar.cc/150?img=${(conversationIndex % 10) + 1}`,
            lastMessage: `Message ${conversationIndex + 1} content...`,
            time: `${conversationIndex + 1}:00 PM`,
            unread: conversationIndex % 2 === 0,
            type: conversationIndex % 3 === 0 ? 'channel' : conversationIndex % 3 === 1 ? 'group' :
                'conversation',
            messages: Array.from({
                length: 20
            }, (_, messageIndex) => ({
                id: messageIndex + 1,
                text: messageIndex % 2 === 0 ?
                    `Message ${messageIndex + 1} from sender.` :
                    `Reply ${messageIndex + 1} from you.`,
                time: `${messageIndex + 1}:15 ${messageIndex % 2 === 0 ? 'AM' : 'PM'}`,
                sentBy: messageIndex % 2 === 0 ? 'Admin' : 'you',
                avatar: messageIndex % 2 === 0 ?
                    `https://i.pravatar.cc/150?img=${(conversationIndex % 10) + 1}` :
                    'https://i.pravatar.cc/150?img=5',
                read: messageIndex < 10, // First 10 messages are read
            })),
        }));



        function chatApp() {
            return {
                conversations: [{
                        id: 1,
                        name: 'John Doe',
                        avatar: 'https://i.pravatar.cc/150?img=1',
                        lastMessage: 'Hey, how are you?',
                        time: '2:45 PM',
                        unread: true,
                        type: 'conversation',
                        messages: [{
                                id: 1,
                                text: 'Hey, how are you?',
                                time: '2:45 PM',
                                sentBy: 'John',
                                avatar: 'https://i.pravatar.cc/150?img=1',
                                read: true
                            },
                            {
                                id: 2,
                                text: 'I am good, thanks!',
                                time: '2:46 PM',
                                sentBy: 'you',
                                avatar: 'https://i.pravatar.cc/150?img=5',
                                read: true
                            },
                            {
                                id: 3,
                                text: 'What about you?',
                                time: '2:47 PM',
                                sentBy: 'you',
                                avatar: 'https://i.pravatar.cc/150?img=5',
                                read: true
                            },
                            {
                                id: 4,
                                text: 'I am great, just been busy.',
                                time: '2:48 PM',
                                sentBy: 'John',
                                avatar: 'https://i.pravatar.cc/150?img=1',
                                read: true
                            },
                            {
                                id: 5,
                                text: 'Anything new happening?',
                                time: '2:49 PM',
                                sentBy: 'you',
                                avatar: 'https://i.pravatar.cc/150?img=5',
                                read: true
                            },
                            {
                                id: 6,
                                text: 'Not much, just the usual work.',
                                time: '2:50 PM',
                                sentBy: 'John',
                                avatar: 'https://i.pravatar.cc/150?img=1',
                                read: true
                            },
                            {
                                id: 7,
                                text: 'How about you?',
                                time: '2:51 PM',
                                sentBy: 'John',
                                avatar: 'https://i.pravatar.cc/150?img=1',
                                read: true
                            },
                            {
                                id: 8,
                                text: 'Preparing for a new project.',
                                time: '2:52 PM',
                                sentBy: 'you',
                                avatar: 'https://i.pravatar.cc/150?img=5',
                                read: true
                            },
                            {
                                id: 9,
                                text: 'That sounds exciting!',
                                time: '2:53 PM',
                                sentBy: 'John',
                                avatar: 'https://i.pravatar.cc/150?img=1',
                                read: true
                            },
                            {
                                id: 10,
                                text: 'It is, lots to do though.',
                                time: '2:54 PM',
                                sentBy: 'you',
                                avatar: 'https://i.pravatar.cc/150?img=5',
                                read: true
                            },
                            {
                                id: 11,
                                text: 'Well, good luck with it!',
                                time: '2:55 PM',
                                sentBy: 'John',
                                avatar: 'https://i.pravatar.cc/150?img=1',
                                read: true
                            },
                            {
                                id: 12,
                                text: 'Thanks! Let’s catch up later.',
                                time: '2:56 PM',
                                sentBy: 'you',
                                avatar: 'https://i.pravatar.cc/150?img=5',
                                read: true
                            },
                            {
                                id: 13,
                                text: 'Sure thing, take care!',
                                time: '2:57 PM',
                                sentBy: 'John',
                                avatar: 'https://i.pravatar.cc/150?img=1',
                                read: true
                            },
                            {
                                id: 14,
                                text: 'Bye!',
                                time: '2:58 PM',
                                sentBy: 'you',
                                avatar: 'https://i.pravatar.cc/150?img=5',
                                read: true
                            },
                        ],
                    },
                    {
                        id: 2,
                        name: 'Family Group',
                        avatar: 'https://i.pravatar.cc/150?img=2',
                        lastMessage: 'Dinner at 8?',
                        time: '1:30 PM',
                        unread: false,
                        type: 'group',
                        messages: [{
                                id: 1,
                                text: 'Dinner at 8?',
                                time: '1:30 PM',
                                sentBy: 'Alice',
                                avatar: 'https://i.pravatar.cc/150?img=3',
                                read: true
                            },
                            {
                                id: 2,
                                text: 'Sounds good!',
                                time: '1:32 PM',
                                sentBy: 'you',
                                avatar: 'https://i.pravatar.cc/150?img=5',
                                read: true
                            },
                        ],
                    },
                    {
                        id: 3,
                        name: 'Tech News',
                        avatar: 'https://i.pravatar.cc/150?img=3',
                        lastMessage: 'New JavaScript framework released.',
                        time: 'Yesterday',
                        unread: true,
                        type: 'channel',
                        messages: Array.from({
                            length: 20
                        }, (_, i) => ({
                            id: i + 1,
                            text: i % 2 === 0 ? 'New JavaScript framework released.' : 'What’s it called?',
                            time: i % 2 === 0 ? `Yesterday` : `Today, 10:${15 + i % 45} AM`,
                            sentBy: i % 2 === 0 ? 'Admin' : 'you',
                            avatar: i % 2 === 0 ? 'https://i.pravatar.cc/150?img=4' :
                                'https://i.pravatar.cc/150?img=5',
                            read: i % 2 === 0,
                        })),
                    },
                    {
                        id: 4,
                        name: 'Fitness Group',
                        avatar: 'https://i.pravatar.cc/150?img=10',
                        lastMessage: 'Ready for the run tomorrow!',
                        time: '7:00 PM',
                        unread: true,
                        type: 'group',
                        messages: Array.from({
                            length: 20
                        }, (_, i) => ({
                            id: i + 1,
                            text: i % 2 === 0 ?
                                'Are we meeting at the park or the gym?' :
                                'Let’s meet at the park. It’s more scenic.',
                            time: `7:${i + 15} PM`,
                            sentBy: i % 2 === 0 ? 'Alex' : 'Chris',
                            avatar: i % 2 === 0 ? 'https://i.pravatar.cc/150?img=11' :
                                'https://i.pravatar.cc/150?img=12',
                            read: i < 10,
                        })),
                    },
                    {
                        id: 5,
                        name: 'Work Chat',
                        avatar: 'https://i.pravatar.cc/150?img=13',
                        lastMessage: 'I’ll send over the files shortly.',
                        time: '3:45 PM',
                        unread: false,
                        type: 'conversation',
                        messages: Array.from({
                            length: 20
                        }, (_, i) => ({
                            id: i + 1,
                            text: i % 2 === 0 ? 'Did you get the report I sent?' :
                                'Yes, I’ll review it today.',
                            time: `3:${i + 20} PM`,
                            sentBy: i % 2 === 0 ? 'Manager' : 'you',
                            avatar: i % 2 === 0 ? 'https://i.pravatar.cc/150?img=14' :
                                'https://i.pravatar.cc/150?img=15',
                            read: i < 15,
                        })),
                    },
                    {
                        id: 6,
                        name: 'Gaming Squad',
                        avatar: 'https://i.pravatar.cc/150?img=16',
                        lastMessage: 'Let’s play at 9 PM tonight!',
                        time: '6:00 PM',
                        unread: true,
                        type: 'group',
                        messages: Array.from({
                            length: 20
                        }, (_, i) => ({
                            id: i + 1,
                            text: i % 2 === 0 ?
                                'Who’s joining the game tonight?' : 'I’m in! Let’s win this time.',
                            time: `6:${i + 5} PM`,
                            sentBy: i % 2 === 0 ? 'Player1' : 'Player2',
                            avatar: i % 2 === 0 ? 'https://i.pravatar.cc/150?img=17' :
                                'https://i.pravatar.cc/150?img=18',
                            read: i < 10,
                        })),
                    },
                    {
                        id: 7,
                        name: 'Cooking Enthusiasts',
                        avatar: 'https://i.pravatar.cc/150?img=19',
                        lastMessage: 'Try the new pasta recipe I shared.',
                        time: '8:00 PM',
                        unread: false,
                        type: 'channel',
                        messages: Array.from({
                            length: 20
                        }, (_, i) => ({
                            id: i + 1,
                            text: i % 2 === 0 ?
                                'Check out my new recipe!' : 'Looks delicious. I’ll try it this weekend.',
                            time: `8:${i + 5} PM`,
                            sentBy: i % 2 === 0 ? 'Chef' : 'User',
                            avatar: i % 2 === 0 ? 'https://i.pravatar.cc/150?img=20' :
                                'https://i.pravatar.cc/150?img=21',
                            read: i < 15,
                        })),
                    },
                    {
                        id: 8,
                        name: 'Music Lovers',
                        avatar: 'https://i.pravatar.cc/150?img=22',
                        lastMessage: 'New album dropping tonight!',
                        time: '9:30 PM',
                        unread: true,
                        type: 'group',
                        messages: Array.from({
                            length: 20
                        }, (_, i) => ({
                            id: i + 1,
                            text: i % 2 === 0 ?
                                'What’s everyone listening to this week?' :
                                'I’m loving the new album by XYZ.',
                            time: `9:${i + 10} PM`,
                            sentBy: i % 2 === 0 ? 'DJ' : 'Fan',
                            avatar: i % 2 === 0 ? 'https://i.pravatar.cc/150?img=23' :
                                'https://i.pravatar.cc/150?img=24',
                            read: i < 5,
                        })),
                    },
                    {
                        id: 9,
                        name: 'Travel Buddies',
                        avatar: 'https://i.pravatar.cc/150?img=25',
                        lastMessage: 'Tickets booked for next month!',
                        time: '10:15 PM',
                        unread: false,
                        type: 'conversation',
                        messages: Array.from({
                            length: 20
                        }, (_, i) => ({
                            id: i + 1,
                            text: i % 2 === 0 ?
                                'Where are we heading next?' : 'Let’s decide in the meeting tomorrow.',
                            time: `10:${i < 10 ? `0${i}` : i} PM`,
                            sentBy: i % 2 === 0 ? 'Guide' : 'you',
                            avatar: i % 2 === 0 ? 'https://i.pravatar.cc/150?img=26' :
                                'https://i.pravatar.cc/150?img=27',
                            read: i < 15,
                        })),
                    },
                    {
                        id: 10,
                        name: 'Book Club',
                        avatar: 'https://i.pravatar.cc/150?img=28',
                        lastMessage: 'Next meeting on Sunday at 4 PM.',
                        time: '11:00 AM',
                        unread: true,
                        type: 'group',
                        messages: Array.from({
                            length: 20
                        }, (_, i) => ({
                            id: i + 1,
                            text: i % 2 === 0 ?
                                'What book are we discussing this week?' :
                                'The new thriller by ABC is fantastic!',
                            time: `11:${i + 10} AM`,
                            sentBy: i % 2 === 0 ? 'Reader1' : 'Reader2',
                            avatar: i % 2 === 0 ? 'https://i.pravatar.cc/150?img=29' :
                                'https://i.pravatar.cc/150?img=30',
                            read: i < 10,
                        })),
                    },
                ],
                selectedConversation: null,
                newMessage: '',
                init() {
                    // Select the first conversation by default
                    if (this.conversations.length > 0) {
                        this.selectConversation(this.conversations[0]);
                    }
                },
                selectConversation(conversation) {
                    this.selectedConversation = conversation;
                    // Reset unread status
                    conversation.unread = false;
                },
                sendMessage() {
                    if (this.newMessage.trim() === '' || !this.selectedConversation) return;
                    const message = {
                        id: this.selectedConversation.messages.length + 1,
                        text: this.newMessage,
                        time: new Date().toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        }),
                        sentBy: 'you',
                        avatar: 'https://i.pravatar.cc/150?img=5',
                        read: false,
                    };
                    this.selectedConversation.messages.push(message);
                    this.newMessage = '';
                    // Scroll to bottom could be implemented here
                },
                attachFile(event) {
                    const file = event.target.files[0];
                    if (file && this.selectedConversation) {
                        const message = {
                            id: this.selectedConversation.messages.length + 1,
                            text: `[File: ${file.name}]`,
                            time: new Date().toLocaleTimeString([], {
                                hour: '2-digit',
                                minute: '2-digit'
                            }),
                            sentBy: 'you',
                            avatar: 'https://i.pravatar.cc/150?img=5',
                            read: false,
                        };
                        this.selectedConversation.messages.push(message);
                        // Handle file upload logic here
                    }
                },
            }
        }
    </script>

</x-app-layout>
