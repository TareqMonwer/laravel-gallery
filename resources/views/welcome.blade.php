@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($albums as $album)
            <div class="col-md-3">
                <div class="card bg-dark text-white mb-4">
                    <a href="albums/{{$album->id}}">
                        @foreach($album->images as $img_index => $img)
                            @if($img_index == 0)
                                <img class="card-img img-thumbnail" src="storage/{{ $img->name }}" alt="Card image">
                            @endif
                        @endforeach
                        <div class="card-img-overlay">
                            <h3 class="card-title"><a class="text-light" href="albums/{{$album->id}}">{{ $album->name }}</a></h3>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

<style>
    .card-img-overlay {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(35, 35, 36, 0.71);
    }
</style>
