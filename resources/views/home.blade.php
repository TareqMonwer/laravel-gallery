@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('album.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="album" id="album" class="form-control"
                placeholder="Your Album Name">
                <input type="file" name="image[]" class="form-control" id="image">
                <input type="file" name="image[]" class="form-control" id="image">
                <input type="file" name="image[]" class="form-control" id="image">
                <button class="btn btn-primary mt-2" type="submit">Submit</button>
            </form>

            @foreach($images as $image)
                <img src="{{ asset('storage/'.$image->name) }}" alt="" width="200">
            @endforeach

        </div>
    </div>
</div>
@endsection
