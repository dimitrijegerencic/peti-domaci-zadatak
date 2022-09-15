<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;

class FriendController extends Controller
{
    public function noFriendshipUsers(){

        return view('home', [
                'unconnectedUsers' => $this->getUnconnectedUsers(),
                'arrivedRequestUsers' => $this->getArrivedRequestUsers(),
                'sentRequestUsers' => $this->getSentRequestUsers(),
                'myFriends' => $this->showMyFriends()
            ]
        );
    }

    public function showAmigos(){

        return view('friends', [
                'myFriends' => $this->showMyFriends()
            ]
        );
    }

    public function sendFriendshipRequest(User $user){

        Friendship::query()->create([
            'user1_id' => auth()->user()->id,
            'user2_id' => $user->id
        ]);

        return redirect()->route('home');
    }

    public function acceptFriendshipRequest(User $user){

        Friendship::query()->where('user1_id', $user->id)
            ->where('user2_id', auth()->user()->id)
            ->update(['accepted' => true]);

        return redirect()->route('home');
    }

    public function declineFriendshipRequest(User $user){

        Friendship::query()->where('user1_id', $user->id)
            ->where('user2_id', auth()->user()->id)
            ->delete();

        return redirect()->route('home');
    }

    public function getUnconnectedUsers(){

        $authUser = auth()->user();

        $friends1 = Friendship::query()->where('user1_id', $authUser->id)
            ->pluck('user2_id')->toArray();

        $friends2 = Friendship::query()->where('user2_id', $authUser->id)
            ->pluck('user1_id')->toArray();

        return User::query()->where('id', '!=', $authUser->id)
            ->whereNotIn('id', $friends1)
            ->whereNotIn('id', $friends2)->get();

    }

    public function showMyFriends(){

        $authUser = auth()->user();

        $friends1 = Friendship::query()->where('user1_id', $authUser->id)
            ->where('accepted', true)
            ->pluck('user2_id')->toArray();

        $friends2 = Friendship::query()->where('user2_id', $authUser->id)
            ->where('accepted', true)
            ->pluck('user1_id')->toArray();

        return User::query()
            ->orWhereIn('id', $friends1)
            ->orWhereIn('id', $friends2)->get();

    }

    public function getSentRequestUsers(){

        $requestIds = Friendship::query()->where('user1_id', auth()->user()->id)
            ->where('accepted', false)->pluck('user2_id')->toArray();

        return User::query()->whereIn('id', $requestIds)->get();
    }

    public function getArrivedRequestUsers(){

        $requestIds = Friendship::query()->where('user2_id', auth()->user()->id)
            ->where('accepted', false)->pluck('user1_id')->toArray();

        return User::query()->whereIn('id', $requestIds)->get();
    }



}
