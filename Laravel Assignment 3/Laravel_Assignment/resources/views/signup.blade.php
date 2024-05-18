@extends('authentication')
@if ($errors->has('loginError'))
    <p id="error">{{ $errors->first('loginError') }}</p>
@endif
@section('content')

<div class="login-page">
        <div class="form">
            <h2>Register</h2>
        <form action="{{ route('signup')}}" method="POST">
            @csrf
            <input type="text" name="email" placeholder="Email" size="40" required><br/>
            <input type="text" name="id" placeholder="ID" size="40" required><br/>
            <input type="password" name="password" placeholder="Password" size="40" required><br/>
            <button type="submit" class="btn btn-primary" value="Register" name="submit" id="submit"> Register </button>
        </form>
         
        </div>
    </div>
@endsection