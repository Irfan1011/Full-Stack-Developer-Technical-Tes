<!-- Extend layout for clean code -->
@extends('layout.header')

@section('content')
<body>
    <!-- Show error message -->
    @if($message=Session::get('error'))
        <p class="text-center">{{$message}}</p>
    @endif
    
    <!-- Register form -->
    <form action="{{ route('register.post') }}" method="post" class="container-fluid justify-content-start mt-5" style="width: 50%">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('login') }}">Login</a>
    </form>
</body>
@endsection