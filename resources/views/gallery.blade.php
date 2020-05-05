@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {{-- Album Title --}}
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-between">
                        <li class="breadcrumb-item active" aria-current="page">{{ $album->name }}</li>
                        <li class="action-buttons">
                            <!-- Add Images Trigger Modal -->
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addImageModal">
                                Add More Image
                            </button>

                            <!-- Add Images Modal -->
                            <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="addImageModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add More Images</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            {{-- Multiple Image Upload Form --}}
                                            <form id="image_form" action="{{ route('album.add-more') }}"
                                                  method="POST" enctype="multipart/form-data" class="mb-0">
                                                @csrf
                                                {{-- Success Alert --}}
                                                <div id="msg"></div>
                                                <div class="form-group">
                                                    <input type="hidden" name="album_id" id="album_id" value="{{ $album->id }}">
                                                </div>

                                                {{-- Handle multiple image upload fields --}}
                                                <div class="input-group control-group init-add-more mb-1">
                                                    <input type="file" name="image[]" id="image" class="form-control">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-success btn-add-more ml-1" type="button">
                                                            Add
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="copy" style="display: none";>
                                                    <div class="input-group control-group add-more">
                                                        <input type="file" name="image[]" id="image" class="form-control">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-danger remove ml-1" type="button">
                                                                Remove
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="submit" value="Confirm" class="btn btn-sm btn-success">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ol>
                    <!-- Breadcrumb end -->
                </nav>
            </div>
            {{-- All Images Inside Album --}}
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

@section('js_block')
<script>
    $(document).ready(function (e) {
        // Hide alert btn
        $(".alert").hide();
        // Add more button
        $(".btn-add-more").click(function () {
            // copy the html inside copy div.
            const html = $(".copy").html();
            $(".init-add-more").after(html)
        });

        // Remove button
        $("body").on("click", ".remove", function () {
            $(this).parents(".control-group").remove();
        });

        // Form submit handle
        $("#image_form").on("submit", function (e) {
            $.ajax({
                url: '/album/add-more',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,

                success: function (response) {
                    console.log('success');
                },

                error: function (data) {
                    console.log('error');
                }
            })
        })

    });

</script>
@endsection
