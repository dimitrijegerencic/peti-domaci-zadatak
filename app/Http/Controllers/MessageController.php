<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(User $user){
        return view('messages', ['messages' => $this->getMessagesByUser($user),
                            'user' => $user]);
    }

    public function getMessagesByUser(User $user){
        return Message::query()->where(function ($query) use ($user){
            $query->where('user1_id', auth()->user()->id)
            ->where('user2_id', $user->id);
        })
            ->orWhere(function ($query) use ($user){
                $query->where('user2_id', auth()->user()->id)
                    ->where('user1_id', $user->id);
            })->get();

        return redirect()->route('home');
    }

    public function store(StoreMessageRequest $request, User $user){

        Message::query()->create([
           'message' => $request['message'],
           'user2_id' => auth()->user()->id,
           'user1_id' => $user->id
        ]);

        return redirect()->back();
    }

}
