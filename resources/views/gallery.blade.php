
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($album->images as $img)
                <div class="col-md-3">
                    <img class="img-fluid img-thumbnail" src="/storage/{{$img->name}}" alt="">
                </div>
            @endforeach
        </div>
    </div>
@endsection
