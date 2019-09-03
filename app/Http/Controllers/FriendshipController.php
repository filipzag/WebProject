<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friendship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class FriendshipController extends Controller
{
   
  public function AddFriend(Request $request)
    {
    
 
        	$friendship = New Friendship;
        
            $friendship->first_friend = Auth::user()->id;
        
       		$friendship->second_friend = $request->input('add_request');

       
       		 $friendship->save();

    
        return redirect()->route('home');
    }


public function DeleteFriend(Request $request)
    {
    
 

      
        
        $friendship = $request->input('delete_request');

       
     
$i = Friendship::where('id', '=', $friendship)->delete();


      //  DB::delete('delete from friendships where id= ?', [$friendship]);
    

        return redirect()->route('home');
    }



}
