@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Top Cards --}}
        <div class="row w-100 my-5 justify-content-center">
            <div class="col-md-3">
                <div class="card border-success mx-sm-1 p-3">
                    <div class="card border-success shadow text-success p-3 my-card">
                        <a class="text-success" href="{{ route('album') }}"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="text-success text-center mt-3">
                        <h4><a class="text-success" href="{{ route('album') }}">New Album</a></h4>
                    </div>
                    <div class="text-success text-center mt-2"><h1>{{ $albums->count() }}</h1></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-danger mx-sm-1 p-3">
                    <div class="card border-danger shadow text-danger p-3 my-card" >
                        <i class="far fa-images"></i>
                    </div>
                    <div class="text-danger text-center mt-3"><h4>Images</h4></div>
                    <div class="text-danger text-center mt-2"><h1>{{ $total_img }}</h1></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-warning mx-sm-1 p-3">
                    <div class="card border-warning shadow text-warning p-3 my-card" >
                        <span class="fa fa-inbox" aria-hidden="true"></span>
                    </div>
                    <div class="text-warning text-center mt-3"><h4>Inbox</h4></div>
                    <div class="text-warning text-center mt-2"><h1>346</h1></div>
                </div>
            </div>
        </div>

        {{-- Showing Albums --}}
        <div class="row">
            @foreach($albums as $album)
            <div class="col-md-3">
                <div class="card album-card bg-dark text-white mb-4">
                    <a href="albums/{{$album->id}}">
                        @foreach($album->images as $img_index => $img)
                            @if($img_index == 0)
                                <img class="card-img img-thumbnail" src="storage/{{ $img->name }}" alt="Card image">
                            @endif
                        @endforeach
                        <div class="card-img-overlay">
                            <h3 class="card-title">
                                <a id="album-name" class="text-light" href="albums/{{$album->id}}">{{ $album->name }}</a>
                            </h3>
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
        transition: .3s all ease-in;
    }
    .album-card:hover .card-img-overlay {
        background-color: rgba(0, 0, 0, .01);
    }
    .album-card:hover .card-img-overlay .card-title a#album-name {
        background: rgba(0, 219, 22, 0.74);
        display: inline-block;
        padding: .5rem;
        text-decoration: none;
        border-radius: 20px;
        overflow: hidden;
    }
    .my-card {
        position:absolute !important;
        left:40%;
        top:-20px;
        border-radius:50% !important;
    }
</style>
