@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card p-2">
                <div class="input-group control-group init-add-more mb-1">
                    <input type="file" name="image[]" id="image" class="form-control">
                    <div class="input-group-btn">
                        <button class="btn btn-success btn-add-more" type="button">
                            Add
                        </button>
                    </div>
                </div>

                <div class="copy" style="display: none";>
                    <div class="input-group control-group add-more">
                        <input type="file" name="image[]" id="image" class="form-control">
                        <div class="input-group-btn">
                            <button class="btn btn-danger remove" type="button">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script>
    $(document).ready(function (e) {
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
    });
</script>
