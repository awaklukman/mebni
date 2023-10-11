@extends('layouts.backend.app')

@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Edit News / Publication</h3>
                            <div class="card-toolbar">
                                <div class="example-tools justify-content-center">
                                    <a href="{{ route('news_publication.index') }}" class="btn btn-default">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form id="contentForm" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title
                                                <span class="text-danger">*</span></label>
                                            <input id="title" name="title" type="text" class="form-control"
                                                placeholder="Enter title" maxlength="100" value="{{ $data->title }}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category">Category
                                                <span class="text-danger">*</span></label>
                                            <select class="form-control" id="category" name="category">
                                                <option value="news" {{ $data->category == 'news' ? 'selected' : '' }}>News</option>
                                                <option value="publication" {{ $data->category == 'publication' ? 'selected' : '' }}>Publication</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="publish_date">Publis Date
                                                <span class="text-danger">*</span></label>
                                            <input class="form-control" type="date" id="publish_date" name="publish_date" value="{{ date('Y-m-d', strtotime($data->publish_date)) }}"/>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="content_type">Content Type
                                                <span class="text-danger">*</span></label>
                                            <select class="form-control" id="content_type" name="content_type">
                                                <option value="public" {{ $data->category == 'public' ? 'selected' : '' }}>Public</option>
                                                <option value="member" {{ $data->category == 'member' ? 'selected' : '' }}>Member</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Short Description
                                                <span class="text-danger">*</span></label>
                                            <input id="short_description" name="short_description" type="text"
                                                class="form-control" placeholder="Enter short description"
                                                maxlength="100" value="{{ $data->short_description }}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <img src="{{ $data->image_path }}" alt="{{ $data->title }}" width="50%">
                                            <input hidden type="text" id="image_path_old" name="image_path_old" value="{{ $data->image_path }}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Image<span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image_path" name="image_path" accept="image/*"/>
                                                <label class="custom-file-label" for="image_path">Choose file</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Content
                                                <span class="text-danger">*</span></label>
                                            <textarea class="summernote" id="content" name="content">{{ $data->content }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="button" class="btn btn-primary mr-2" id="submitContentBtn"
                                    onclick="submitContent()">Submit</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var newsPublicationUpdateUrl = "{{ route('news_publication.update', [encrypt($data->id)]) }}";

        $(document).ready(function() {

        });

        function submitContent() {
            // $('#submitContentBtn').prop("disabled", true);

            var formData = new FormData(document.getElementById('contentForm'));

            let title = $('input[name="title"]').val();
            let category = $('#category').val();
            let publish_date = $('input[name="publish_date"]').val();
            let content_type = $('#content_type').val();
            let short_description = $('input[name="short_description"]').val();
            let content = $('textarea[name="content"]').val();

            let image_path_old = $('input[name="image_path_old"]').val();

            formData.append('title', title);
            formData.append('category', category);
            formData.append('publish_date', publish_date);
            formData.append('content_type', content_type);
            formData.append('short_description', short_description);
            formData.append('content', content);
            formData.append('file', $('#image_path')[0].files[0]);

            formData.append('image_path_old', image_path_old);

            $.ajax({
                url: newsPublicationUpdateUrl,
                type: "PATCH",
                data: formData,
                contentType: false, // Don't set content type
                processData: false, // Don't process data (FormData does it for you)
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    window.location.href = "{{ route('news_publication.index') }}";
                },
                error: function(error) {
                    $('#submitContentBtn').prop("disabled", false);

                    if (error.status === 422) {
                        let errors = error.responseJSON.errors;
                        // Clear previous errors
                        $('.error-message').remove();
                        for (let field in errors) {
                            let errorMsg = errors[field][0]; // Taking only the first error message per field
                            let inputElement = $(`input[name="${field}"], textarea[name="${field}"]`);

                            // Append error message and add error class
                            inputElement.after(`<span class="error-message">${errorMsg}</span>`);
                            inputElement.addClass('error-border');
                        }
                    } else if (error.status === 500) {
                        if (error.responseJSON && error.responseJSON.error) {
                            alert('Error: ' + error.responseJSON.error);
                        }
                    } else if (error.status === 401) {
                        if (error.responseJSON && error.responseJSON.error) {
                            $('#captMsg').html('<strong style="color: red">' + error.responseJSON.error +
                                '</strong>');
                        }
                    }
                },
                complete: function() {
                    // Remove overlay
                    $('.overlay').remove();
                }
            });
        }
    </script>
@endsection
