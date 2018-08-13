<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Services\ChatService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ChatService $chatService)
    {
        $comments = $chatService->getComments();
        return view('chat', [
            'comments' => $comments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComment $request, ChatService $chatService)
    {
        if (\Auth::guest()) {
            \Auth::attempt(['name' => $request->get('owner')]);
        }

        $owner = \Auth::user()->name;
        $comment = $request->input('content');

        $chatService->storeComment($owner, $comment);
        return back();
    }

}
