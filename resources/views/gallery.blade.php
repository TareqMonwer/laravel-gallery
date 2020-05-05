
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
                    <!-- Button trigger modal -->
                    <button class="btn btn-danger btn-sm" type="submit" data-toggle="modal" data-target="#deleteModalCenter{{ $img->id }}">
                        Delete
                    </button>
                </div>
                {{-- Delete Confirmation Modal --}}
                <div class="modal fade" id="deleteModalCenter{{ $img->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenter{{ $img->id }}Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title text-light" id="deleteModal{{ $img->id }}LongTitle">Delete Image</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure deleting this image?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('image.delete') }}">
                                    @csrf
                                    <input type="hidden" name="image_id" value="{{ $img->id }}">
                                    <input type="hidden" name="album_id" value="{{ $img->album_id }}">
                                    <!-- Actions -->
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End of Delete Confirmation Modal --}}
            @endforeach
        </div>
    </div>
@endsection
