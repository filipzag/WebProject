<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use App\Comment;


class PostController extends Controller
{
    //
    use UploadTrait;



     public function updatePost(Request $request)
    {
        // Form validation
 
        	$post = New Post;
        // Get current user
        $post->user_id = Auth::user()->id;
        // Set user name
        $post->content = $request->input('post_text');

        // Check if a profile image has been uploaded
        if ($request->has('post_image')) {
            // Get image file
            $image = $request->file('post_image');
          
            $name = str_slug($post->user_id).'_'.time();
           
            $folder = '/uploads/images/';
            
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
          
            $this->uploadOne($image, $folder, 'public', $name);
           
            $post->picture_url = $filePath;
        }else{  $request->validate([
            'text'              =>  'required',
        
        ]);
}
        
        $post->save();

        // Return user back and show a flash message
         return redirect()->route('home');
    }




        public function AddComment(Request $request)
    {


        $comment = New Comment;

        $comment->post_id= $request->input('post_id');
        $comment->text=$request->input('comment_text');
        $comment->commentator_id= $request->input('commentator_id');
        $comment->save();
          return view ('post')->withDetails($request->input('post_id'));





    }
}
