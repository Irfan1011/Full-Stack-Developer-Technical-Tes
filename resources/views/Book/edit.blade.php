<!-- Extend layout for clean code -->
@extends('layout.header')

@section('content')
<body>
    <!-- Load Book Data on Database -->
    <form action="{{ route('book.update', $book->id) }}" method="post" class="container-fluid justify-content-start mt-5" style="width: 50%">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" name="description" required> {{ $book->description }} </textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</body>
@endsection