<!-- Extend layout for clean code -->
@extends('layout.header')

@section('content')
<body>
    <!-- Edit Password Form -->
    <form action="{{ route('updatePassword', Auth::user()->id) }}" method="post" class="container-fluid justify-content-start mt-5" style="width:50%">
        @csrf
        <div class="mb-3">
            <label for="password" class="form-label">Change Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</body>
@endsection