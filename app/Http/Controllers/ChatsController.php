<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Events\UserEvent;
use App\Models\User;
use App\Models\Group;
use App\Models\Channel;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = auth()->user();
        $currentUser = $user;
        // Fetch conversations, groups, channels, statuses with related data
        $conversations = $user->conversations()->with(['users', 'messages.user'])->get();
        $groups = $user->groups()->with(['users', 'messages.user'])->get();
        $channels = $user->channels()->with(['users', 'messages.user'])->get();
        $statuses = $user->statuses()->with(['viewers', 'user'])->get();
        $settings = $user->settings;  // Single related setting
        $devices = $user->devices;    // Devices associated with the user
        $savedMessages = $user->savedMessages; // Saved messages by the user
        $blocks = $user->blocks;  // Users blocked by the user
        $blockedUsers = $user->blockedUsers;  // Users who have blocked the user

        // Pass the data to the view
        return view('chats', compact('user', 'conversations', 'groups', 'channels', 'statuses', 'settings', 'devices', 'savedMessages', 'blocks', 'blockedUsers','currentUser'));
    }
    public function sendMessage(Request $request, $type, $id)
    {
        $request->validate([
            'message' => 'required|string|max:255',  // Validate message content
        ]);

        $user = auth()->user();  // Get the authenticated user
        $messageContent = $request->input('message');  // Get the message content

        // Find the group, conversation, or channel
        switch ($type) {
            case 'group':
                $model = Group::findOrFail($id);
                broadcast(new UserEvent(message: 'public message', sender: $user))->toOthers();

                break;
            case 'conversation':
                $model = Conversation::findOrFail($id);
                broadcast(new UserEvent('specific message', $user, recipientId: $model->users->where('id', '!=',$user->id)->first()->id))->toOthers();

                break;
            case 'channel':
                $model = Channel::findOrFail($id);  // Find the channel by ID
                break;
            default:
                return response()->json(['error' => 'Invalid type'], 400);
        }

        // Create a message and associate it with the group, conversation, or channel
        $message = $model->messages()->create([
            'user_id' => $user->id,
            'message' => $messageContent,
        ]);

        // Return a response
        return redirect()->back()->with('success', 'Message sent successfully!');
    }

}

