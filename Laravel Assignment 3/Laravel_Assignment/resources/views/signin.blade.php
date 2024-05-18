@extends('authentication')

@section('content')

<div class="login-page">
        <div class="form">
            <h2>Login</h2>
                    
                    <form action="{{ route('loginSubmit')}}" method="POST">
                        @csrf
                        
                            <input type="text" class="form-control" name="id" id="id" placeholder="Enter ID">
                        
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                        
                            <button type="submit" class="btn btn-primary" name="submit" id="submit">Login</button>
                            <a href="{{ route('register') }}" class="btn btn-link">Register</a>
                        
                    </form>
 
        </div>
    </div>
@endsection