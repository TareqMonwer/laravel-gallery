@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card p-2">
                <div class="card-body">
                    {{-- Success Alert --}}
                    <div id="msg"></div>
                    {{-- Multiple Image Upload Form --}}
                    <form id="image_form" action="{{ route('album.store') }}"
                          method="POST" enctype="multipart/form-data" class="mb-0">
                        @csrf
                        <div class="form-group">
                            <label>Name of Album</label>
                            <input type="text" name="album" id="album" class="form-control">
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

                        <div class="form-group my-2">
                            <button type="submit" class="btn btn-block btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script>
    $(document).ready(function (e) {
        // Hide alert btn
        $(".alert").hide();
        // Add more button
        $(".btn-add-more").click(function () {
            // copy the html inside copy div.
            const html = $(".copy").html();
            console.log(html);
            $(".init-add-more").after(html)
        });

        // Remove button
        $("body").on("click", ".remove", function () {
            $(this).parents(".control-group").remove();
        });

        // Form submit handle
        $("#image_form").on("submit", function (e) {
            e.preventDefault();

            $.ajax({
                url: '/album',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,

                success: function (response) {
                    $("#msg").html(response);
                    $(".alert").show();
                    $("#image_form")[0].reset();
                },

                error: function (data) {
                    $("#msg").html(
                        `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong id="msg">
                                ${data.responseJSON.errors.album} <br/>
                                ${data.responseJSON.errors.image}
                            </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                            </button>
                         </div>`
                    );
                }
            })
        })

    });

</script>

