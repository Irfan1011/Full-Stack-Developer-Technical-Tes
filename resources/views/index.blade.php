<!-- Extend layout for clean code -->
@extends('layout.header')

@section('content')
<body>
    <!-- Show error message for login -->
    @if($message=Session::get('error'))
        <p class="text-center">{{$message}}</p>
    @endif
    
    <!-- If user still login, no need to relogin -->
    @if(Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <form action="{{ route('login.post') }}" method="post" class="container-fluid justify-content-start mt-5" style="width: 50%">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('register') }}">Register</a>
                </form>
            @endauth
        </div>
    @endif
</body>
@endsection