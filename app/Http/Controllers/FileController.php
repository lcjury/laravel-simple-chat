<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreFile;
use App\Services\ChatService;

class FileController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFile $request, ChatService $chatService)
    {
        $file = $request->file('file');
        $path = $file->store('public/files');
        $url = Storage::url($path);

        $owner = \Auth::user()->name;

        $chatService->storeMedia($owner, $url, $file->getMimeType());
        return back();
    }

}
