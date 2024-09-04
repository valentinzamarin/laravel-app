<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller {
    public function create_post( Request $request ) {
        $postFields = $request->validate([
            'post_title'   => [ 'required' ],
            'post_content' => [ 'required' ],
            'tags'         => [],
        ]);

        $postFields['post_title']       = strip_tags( $postFields['post_title'] );
        $postFields['post_content'] = strip_tags( $postFields['post_content'] );
        $postFields['user_id']     = auth()->id();

        $post = Post::create( $postFields );

        if ($request->has('tags')) {
            $tags = explode(',', $postFields['tags']);
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $post->tags()->attach($tag);
            }
        }

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
            'post_content' => [ 'required' ],
        ]);

        $editFields['post_title']   = strip_tags( $editFields['post_title'] );
        $editFields['post_content'] = strip_tags( $editFields['post_content'] );

        $post->update( $editFields );

        return redirect("/post/{$post->id}");
    }

    public function delete_post( $id ) {
        $post = Post::findOrFail($id);

        if (auth()->check() && auth()->user()->id === $post->user_id) {
            $post->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 403);
    }



    public function post_tag_screen( $tag ) {
        $tag = Tag::where('name', $tag)->firstOrFail();
        $posts = $tag->posts;
        return view('Taxonomy', [ 'posts' => $posts, 'tag' => $tag ] );
    }
}
