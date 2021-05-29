@extends('layouts._adminLayout')
@section('title', 'Admin - Post')

@section('page-level-stylesheets')
    {{--      Select2  --}}
    <link href="{{Asset('admin/vendor/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{Asset('admin/vendor/select2/select2-bootstrap4.min.css')}}" rel="stylesheet"/>
@endsection

@section('main-content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-1 text-gray-800">Create New Blog Post</h1>
        <br>
        <!-- Content Row -->
        <div class="row pb-4">

            <div class="col">
                @if (count($errors) > 0)
                    <div class="errors-container">
                        <ul>
                            @foreach($errors as $error)
                                <li> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(isset($post->id))
                    <form method="POST" action="{{route('posts.update', $post->id)}}" enctype="multipart/form-data">
                        @else
                            <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
                                @endif

                                @csrf
                                @if(isset($post->id))
                                    @method('PUT')
                                @endif

                                <div class="form-row">
                                    {{--  Category  --}}
                                    <div class="form-group col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="category">Category</label>
                                            </div>
                                            <select class="custom-select" id="category" name="post_category">
                                                @if(isset($post->category->category_name))
                                                    <option value="{{$post->category->id}}" selected>
                                                        {{$post->category->category_name}}
                                                    </option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    {{--  Tags  --}}
                                    <div class="form-group col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="tags">Tags</label>
                                            </div>
                                            <select class="custom-select" id="tags" name="post_tags[]"
                                                    multiple="multiple">
                                                @if(isset($post->tags))
                                                    @foreach($post->tags as $tag)
                                                        <option value="{{$tag->tag_name}}" selected>
                                                            {{$tag->tag_name}}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="title">Post Title</label>
                                            </div>
                                            <input autocomplete="off" type="text" class="form-control"
                                                   name="post_title" id="title"
                                                   placeholder="A grate post title"
                                                   value="{{$post->post_title ?? ''}}"
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="image">Image</label>
                                            </div>
                                            <input type="file" class="form-control" name="post_image" id="image"
                                                   placeholder="{{$post->post_image ?? 'no image selected'}}"
                                                   value="{{$post->post_image ?? ''}}"
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="post_details">Post Details</label>
                                    <textarea class="form-control" id="post_details"
                                              name="post_details">{{$post->post_details ?? "New Blog Post"}}</textarea>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="post_status">Post Status</label>
                                            </div>
                                            <select class="custom-select" id="post_status" name="post_status">
                                                @if(isset($post->id))
                                                    @if($post->post_status === 'paused')
                                                        <option value="published">Publish</option>
                                                        <option selected value="paused">Paused</option>
                                                    @else
                                                        <option selected value="published">Published</option>
                                                        <option value="paused">Pause</option>
                                                    @endif
                                                @else
                                                    <option selected value="published">Publish</option>
                                                    <option value="paused">Paused</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 text-center">
                                        <button type="submit" class="btn w-50 btn-primary">
                                            {{isset($post->id) ? 'Update':'Create'}}
                                        </button>
                                    </div>
                                </div>
                            </form>

            </div>

        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('data-table')@endsection

@section('page-level-scripts')
    <script src="{{Asset('admin/vendor/select2/select2.min.js')}}"></script>
    <script
        {{--        src="{{Asset('admin/vendor/tinymce/tinymce.min.js')}}"> --}}
        src="https://cdn.tiny.cloud/1/rdp4z63jkf04t2luyb9lk58h9190u98eclz40st3bx1uyc7n/tinymce/5/tinymce.min.js"
        referrerpolicy="origin">
    </script>

    <script>
        $(document).ready(function () {

            $('#category').select2({
                placeholder: "Select a Category",
                theme: 'bootstrap4',
                allowClear: true,
                ajax: {
                    url: '{{route('search-category')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.category_name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            $('#tags').select2({
                placeholder: "Select Tags",
                theme: 'bootstrap4',
                allowClear: true,
                tags: true,
                ajax: {
                    url: '{{route('search-tag')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.tag_name,
                                    id: item.tag_name
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            tinymce.init({
                selector: '#post_details',
                plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                toolbar_mode: 'sliding',
                toolbar_sticky: true,
                height: 400,
            });

        });

    </script>
@endsection
