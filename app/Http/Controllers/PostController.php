<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller {
    public function create_post( Request $request ) {
        $postFields = $request->validate([
            'post_title'   => [ 'required' ],
            'post_content' => [ 'required' ]
        ]);

        $postFields['post_title']       = strip_tags( $postFields['post_title'] );
        $postFields['post_content'] = strip_tags( $postFields['post_content'] );
        $postFields['user_id']     = auth()->id();

        Post::create( $postFields );

        return redirect( '/' );
    }

    public function post_screen( Post $post ) {
        return view( 'PostPage', [ 'post' => $post ] );
    }

    public function edit_post_screen( Post $post ) {
        if( !auth()->check() || auth()->user()->id !== $post['user_id'] ) {
            return redirect( '/' );
        }

        return view( 'EditPage', [ 'post' => $post ] );
    }

    public function save_post( Post $post, Request $request ) {
        if( !auth()->check() || auth()->user()->id !== $post['user_id'] ) {
            return redirect( '/' );
        }

        $editFields = $request->validate([
            'post_title'   => [ 'required' ],
            'post_content' => [ 'required' ]
        ]);

        $editFields['post_title']   = strip_tags( $editFields['post_title'] );
        $editFields['post_content'] = strip_tags( $editFields['post_content'] );

        $post->update( $editFields );

        return redirect("/post/{$post->id}");
    }
}
