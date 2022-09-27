<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\SlackNotif;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class PostCommentController extends Controller
{
    public function store(Post $post){

        $attributes = request()->validate([
            'body'=>'required',
        ]);
        $attributes['user_id'] = auth()->id();
        $comment= $post->comments()->create($attributes);

        \App\Events\CommentPosted::dispatch($comment);
        \Illuminate\Support\Facades\Notification::route('slack','https://hooks.slack.com/services/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')
            ->notify(new SlackNotif($comment));

        return back()->with('success','comment has been published');

    }
}
