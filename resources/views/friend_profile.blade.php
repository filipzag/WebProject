@extends('layouts.app')

@section('content')


<div class="fluid-container">


<div class="jumbotron jumbotron-fluid" style="padding-top:10 px;">
	        <?php
echo '<img src='.$details[0]->profile_image.' alt="..." class="img-thumbnail  d-inline float-right align-top" style="width:150px; height: 150 px;" >';

  ?>

  <div class="container-fluid ">
    <h1 class="display-4 d-inline"  >{{$details[0]->name}}</h1>
 
    <p class="lead ">  {{$details[0]->email}} </p>


  </div>
 
  


<?php 

 use Illuminate\Support\Facades\Auth;
 use App\Friendship;
 use App\User;

$auth_id=Auth::user()->id;

$Friendships = App\Friendship::all();
$friendship_id=0;
global $isFriend;
foreach ($Friendships as $Friendship) {
    if ($Friendship->first_friend == $auth_id && $Friendship->second_friend==$details[0]->id){
     
$isFriend=True;

global $friendship_id;
$friendship_id=$Friendship->id;
}
elseif ($Friendship->second_friend == $auth_id && $Friendship->first_friend==$details[0]->id) {
 
$isFriend=True;
global $friendship_id;


$friendship_id=$Friendship->id;

}else{

$isFriend=False;



}

}

?>

@if($isFriend)

	<form action="{{ route('delete.friend') }}" method="POST" style="display :inline" >

        @csrf
   <input type="hidden" class="form-control " id="delete_request" name="delete_request" value="{{$friendship_id}}"> 


  <button type="submit" class="btn btn-danger btn-lg float-left" >Unfollow friend</button>
</form>

@else


	
<form action="{{ route('add.friend')}}" method="POST"  style="display :inline">

               		@csrf

   <input type="hidden" class="form-control" id="add_request" name="add_request" value="{{$details[0]->id}}" >


  <button type="submit" class="btn btn-primary btn-lg float-left ">Follow friend</button>

</form>;

@endif

















</div>

   <div class="row justify-content-center">
<div class = "col-md-3"> 
	
</div>

<div class = "col-md-6"> 

<?php

$posts = App\Post::where('user_id','=', $details[0]->id)->orderBy('updated_at', 'desc')->get();

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