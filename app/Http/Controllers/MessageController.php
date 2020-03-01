<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Apartment;
use App\Message;

class MessageController extends Controller
{
    // User messages show
    public function messagesShow($id) {
        if($id == Auth::user()->id) {
            $userAps = Apartment::all()->where('user_id', $id);

            $msgs = [];
            $sortedMsgs = [];
            $unread_msgs = 0;

            foreach ($userAps as $apartment) {
                foreach ($apartment->messages as $message) {
                    if($message->is_read == 0) {
                        $unread_msgs ++;
                    }
                    $msgs [] = $apartment->messages;
                }
            }            

            foreach ($msgs as $messages) {
                foreach ($messages as $message) {
                    $sortedMsgs [] = $message;
                }
            }

            $userMsgs = collect($sortedMsgs) -> sortByDesc('created_at');

            // dd($userMsgs->sortByDesc('created_at'));

            return view('pages.users.messages.show', compact('userMsgs', 'unread_msgs'));
        } else {
            return back()->withErrors("You don't have permission to visit this page");
        }
    }

    // user single message show
    public function messageShow($id, $idm) {
        if($id == Auth::user()->id) {

            $msg = Message::findOrFail($idm);
            $msg->is_read = 1;
            $msg->update();

            return view('pages.users.messages.details', compact('msg'));
        } else {
            return back()->withErrors("You don't have permission to visit this page");
        }    
    }

    // user message chage state
    public function changeState($id, $idm) {
        if($id == Auth::user()->id) {

            $msg = Message::findOrFail($idm);
            $msg->is_read = 0;
            $msg->update();
            
            return $this->messagesShow($id);
        } else {
            return back()->withErrors("You don't have permission to visit this page");
        } 
    }
}
