@extends('layouts.app')

@section('content')
<div class="fluid-container">
    <div class="row justify-content-center">
<div class = "col-md-3"> 



<form action="{{ route('search.results') }}" method="POST" role="search" >
    @csrf
    <div class="input-group">
        <input type="text" class="form-control" name="q"
            placeholder="Search users"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
              Search
            </button>
        </span>
    </div>
</form>




</div>
        <div class="col-md-6">

<?php 

 use Illuminate\Support\Facades\Auth;
 use App\Friendship;
 use App\User;

$auth_id=Auth::user()->id;

$Friendships = App\Friendship::all();
$i=0;
global $Friends_ids_array;
foreach ($Friendships as $Friendship) {
    if ($Friendship->first_friend == $auth_id){
     
$Friends_ids_array[$i] = User::where('id', $Friendship->second_friend)->pluck('id');


}
elseif ($Friendship->second_friend == $auth_id) {
    $Friends_ids_array[$i] = User::where('id', $Friendship->first_friend)->pluck('id');
 


}
    $i++;

}

if(empty($Friends_ids_array)){


echo '<div class="card mb-3">
  <div class="card-body">
    <h5 class="card-title">Friend alert</h5>
    <p class="card-text"> You don`t have any firends yet</p>
   
  </div>
</div>';


}else{

foreach ($Friends_ids_array as $friend_id) {
    

$Posts = App\Post::where('user_id',$friend_id)->get();

foreach ($Posts as $post) { 
    
   

echo   '<div class="card mb-3">
  
  <div class="card-body">
 <h3 class="card-title">'.App\User::where('id',$friend_id)->value('name').'</h3>

<form action="'.route('user.profile').'" method="POST" >'.

                        csrf_field().'


   <input type="hidden" class="form-control" id="profile_request" name="profile_request" value="'.$friend_id[0].'" >



  <button type="submit" class="btn btn-primary">Go to profile</button>

</form>




    <p class="card-text">'.$post->content.'</p>
   <img src="'.$post->picture_url.'" class="card-img-top" alt="...">
</br>

<form action="'.route('view.post').'" method="POST" >'.

                        csrf_field().'


   <input type="hidden" class="form-control" id="post_request" name="post_request" value="'.$post->id.'" >



    <button type="submit" class="btn  btn-outline-info">
 Comments <span class="badge badge-light">'.



App\Comment::where('post_id',$post->id)->count()

 .
'
 </span>
</button>
  </div>

</form>
 
</div>';

}
    
  
}}


 ?>


           
        </div>
        <div class="col-md-2">





<div class="card">
  
  <div class="card-body">
    <h5 class="card-title">Post</h5>

<form action="{{ route('post.update') }}" method="POST" role="form"  enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Post text</label>

    <input type="text" class="form-control" id="post_text" aria-describedby="Help" placeholder="Type something" name="post_text">

    <small id="emailHelp" class="form-text text-muted">Share your thoughts with your fiends :)</small>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Post picture</label>

     <input id="post_image" type="file" class="form-control" name="post_image">

 <small class="form-text text-muted">Share your picture with your fiends :)</small>
</div>


  
  <button type="submit" class="btn btn-primary">Publish</button>
</form>


  </div>
</div>
            </div> 
    </div>
</div>
@endsection
