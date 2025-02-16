<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PostObserver
{
    public function creating(Post $post)
    {
        Log::channel('app')->info('Creating post', ['post' => $post]);
    }

    public function updated(Post $post)
    {
        Log::channel('app')->info('Updating post', ['post' => $post]);
    }
}
