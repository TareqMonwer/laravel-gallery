
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {{-- Album Title --}}
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">{{ $album->name }}</li>
{{--                        <form action="{{route('album.delete')}}" method="POST"></form>--}}
                    </ol>
                </nav>
            </div>
            @foreach($album->images as $img)
                <div class="col-md-3">
                    <img class="img-fluid img-thumbnail" src="/storage/{{$img->name}}" alt="">
                    <form action="{{ route('image.delete') }}">
                        @csrf
                        <input type="hidden" name="image_id" value="{{ $img->id }}">
                        <input type="hidden" name="album_id" value="{{ $img->album_id }}">
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
