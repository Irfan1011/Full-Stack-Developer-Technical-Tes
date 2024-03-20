<!-- Extend layout for clean code -->
@extends('layout.header')

@section('content')
<body>
    <!-- Create new book form -->
    <form action="{{ route('book.store') }}" method="post" class="container-fluid justify-content-start mt-5" style="width: 50%">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" name="description" required></textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</body>
@endsection