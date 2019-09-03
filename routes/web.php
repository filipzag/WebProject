<?php
use App\User;
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile/update', 'ProfileController@updateProfile')->name('profile.update');
Route::post('/post/update', 'PostController@updatePost')->name('post.update');


Route::any('/results', function () {
    return view('results');
});



Route::any('/search',function(){
    $q = Input::get ( 'q' );

    $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
  
    if(count($user) > 0){
        return view('results')->withDetails($user)->withQuery ( $q );}
    
    else {

    	return view ('results');}
})->name('search.results');

Route::post('/add_friend', 'FriendshipController@AddFriend')->name('add.friend');

Route::post('/delete_friend', 'FriendshipController@DeleteFriend')->name('delete.friend');

Route::post('/user/profile', function () {

  
$q = Input::get ( 'profile_request' );

$user = User::where('id','=',$q)->get();
 return view ('friend_profile')->withDetails($user);

})->name('user.profile');


Route::post('/post/view', function(){

$q = Input::get ( 'post_request' );



 return view ('post')->withDetails($q);

}

)->name('view.post');


Route::post('/add_comment', 'PostController@AddComment')->name('add.comment');
