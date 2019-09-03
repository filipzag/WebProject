@extends('layouts.app')

@section('content')


   <div class="row justify-content-center">
<div class = "col-md-3"> 
	
</div>

<div class = "col-md-6"> 

<?php
use Illuminate\Support\Facades\Auth;
$post = App\Post::where('id','=', $details[0])->orderBy('updated_at', 'desc')->first();





	echo   '<div class="card mb-3">
  
  <div class="card-body">
 <h4 class="card-title">'.$post->updated_at.'</h4>
    <p class="card-text">'.$post->content.'</p>
   <img src="'.$post->picture_url.'" class="card-img-top" alt="...">';
   
$comments = App\Comment::where('post_id','=',$details[0])->get();
echo '
   <div class="list-group">';

   foreach($comments as $comment){

    
echo '
  <a href="#" class="list-group-item list-group-item-action ">
    <div class="d-flex  justify-content-between">
      <h5 class="mb-1">'.App\User::where('id','=',$comment->commentator_id)->orderBy('updated_at')->pluck('name')[0].'</h5>
      <small>'.$comment->created_at . '</small>
    </div>
    <p class="mb-1">'.$comment->text.'</p>
   
  </a>
 


';

}
?>

<form action="{{ route('add.comment') }}" method="POST" role="form"  enctype="multipart/form-data">
    @csrf

 <div class="form-group">
    <label for="exampleInputEmail1">Comment</label>

    
 <input type="hidden" class="form-control" id="post_id" value="{{$details[0]}}" name="post_id">
 <input type="hidden" class="form-control" id="commentator_id" value="{{Auth::id()}}" name="commentator_id">




    <input type="text" class="form-control" id="comment_text" aria-describedby="Help" placeholder="Type something" name="comment_text">

  
</div>

  
  <button type="submit" class="btn btn-primary">Publish</button>
</form>

</div>
</div></div>
</div>
<div class = "col-md-3"> 
	
</div>
</div>




@endsection