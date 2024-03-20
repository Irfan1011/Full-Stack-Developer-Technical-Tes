<!-- Extend layout for clean code -->
@extends('layout.header')

@section('content')
<body>
    <!-- Show JWT Token based on given question for technical test-->
    @if($message=Session::get('token'))
        <p class="text-center">JWT Token: {{$message}}</p>
    @endif

    <!-- Dashboard Content -->
    <form action="{{ route('logout') }}" method="post" class="text-center mt-5">
        @csrf
        <div style="display: flex; flex-direction: column; flex-wrap: wrap; align-content: center">
            <a href="{{ route('profile.edit', Auth::user()->id) }}">Change Password</a>
            <button type="submit" class="btn btn-outline-dark">Logout</button>
        </div>
    </form>

    <!-- Add new Book button -->
    <div class="text-end mt-5">
        <!-- Show success notification message -->
        @if($message=Session::get('success'))
            <p class="text-center">{{$message}}</p>
        @endif
        <a href="{{ route('book') }}"><button class="btn btn-outline-dark me-5">Create new Book</button></a>
    </div>

    <!-- If there's book on database it'll show here -->
     @if($book= DB::select('SELECT * FROM book'))
        <!-- Load all books added in database -->
        @foreach($book as $Book)
        <hr>
        <div class="row ms-5" style="display:flex; align-items:center; justify-content:center;">
            <div class="col">{{$Book->title}}</div>
            <div class="col">{{$Book->author}}</div>
            <div class="col">{{$Book->description}}</div>
            <div class="col">
            <div style="display: flex; flex-direction: row;">
                <!-- Edit book from database-->
                <a href="{{ route('book.edit', $Book->id) }}" style="text-decoration:none">
                    <button class="btn btn-outline-warning me-2">Edit</button>
                </a>
                <!-- Delete book from database-->
                <form action="{{ route('book.destroy', $Book->id) }}" method="post">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-outline-dark ms-2" type="submit" onclick="return confirm('Are you sure?')" style="color:#ff0000">Delete</button>
                </form>
            </div>
            </div>
        </div>
        @endforeach
    @else
        <!-- If none book added -->
        <p>Empty Book</p>
    @endif
</body>
@endsection