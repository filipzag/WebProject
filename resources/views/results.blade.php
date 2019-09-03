@extends('layouts.app')

@section('content')

<div class="fluid-container">
    <div class="row justify-content-center">
<div class = "col-md-2"> 
</div>
<div class = "col-md-8"> 
<div class="container">
    @if(isset($details))
        <p> The Search results for your query <b> {{ $query }} </b> are :</p>
    <h2>Users: </h2>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Add friend</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>



                	<form action="{{ route('user.profile') }}" method="POST"  >

                		@csrf
  <?php

echo   ' <input type="hidden" class="form-control" id="profile_request" name="profile_request" value="'.$user->id.'" >'

?>

  <button type="submit" class="btn btn-primary">Go to profile</button>

</form>

</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h3> No results, try again! </h3>
    @endif
</div>
</div>
<div class = "col-md-2"> 
</div>
</div>
</div>

@endsection