<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>testiing</title>
  </head>
  <body>
    <form action="{{ route('user.follow', $user->id) }}" method="post">
               		      {!! csrf_field() !!}
               		    <button class="btn btn-danger"style="margin-top:1rem">Follow {{$user->name}}</button>
               		</form>
                  <br>
                  <form action="{{ route('user.unfollow', $user->id) }}" method="post">
       {!! csrf_field() !!}
    <button class="btn btn-success" style="margin-top:1rem">unfollow {{$user->name}}</button>
</form><br />
  </body>
</html>
