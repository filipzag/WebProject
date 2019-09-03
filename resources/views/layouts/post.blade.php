@extends('layouts.app')

@section('content')


<div class="fluid-container">


   <div class="row justify-content-center">
<div class = "col-md-3"> 
	
</div>

<div class = "col-md-6"> 

<?php

$posts = App\Post::where('id','=', $details[0]->id)->orderBy('updated_at', 'desc')->get();

foreach($posts as $post){




	echo   '<div class="card mb-3">
  
  <div class="card-body">
 <h4 class="card-title">'.$post->updated_at.'</h4>
    <p class="card-text">'.$post->content.'</p>
   <img src="'.$post->picture_url.'" class="card-img-top" alt="...">
  </div>
</div>';

}



?>
</div>
<div class = "col-md-3"> 
	
</div>
</div>




@endsection