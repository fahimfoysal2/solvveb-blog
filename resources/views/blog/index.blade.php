@extends('layouts._blogLayout')

@section('main-content')
    <div class="row">
        <!-- Blog listing-->
        <div class="col-lg-9 mb-5 mb-lg-0 position-relative">
            @if(isset($flag_typeOfPost))
                <div class="text-center pb-4 text-primary">
                    <h3>All posts that are associated with {{$flag_typeOfPost}}</h3>
                </div>
            @endif

            @foreach($posts as $counter=>$post)
                {{------------ Single Post ---------------}}
                <div class="row align-items-center mb-5">

                    {{--Post Image--}}
                    <div class="col-lg-6">
                        <a class="d-block post-trending mb-4" href="{{route('blog.post', $post->post_title)}}">
                            <img class="img-fluid w-100" src="{{Asset($post->post_image)}}"
                                 alt="{{$post->post_title}}"/>
                        </a>
                    </div>

                    <div class="col-lg-6">

                        <ul class="list-inline">
                            {{-- post category --}}
                            <li class="list-inline-item mr-2">
                                <a class="category-link font-weight-normal"
                                   href="{{route('blog.category.post',$post->category_name)}}">
                                    {{$post->category_name}}
                                </a>
                            </li>


                            {{-- post author --}}
                            <li class="list-inline-item mx-2">
                                <a class="text-uppercase meta-link font-weight-normal"
                                   href="#">{{$post->user->name}}</a></li>


                            {{-- publish date --}}
                            <li class="list-inline-item mx-2">
                                <a class="text-uppercase meta-link font-weight-normal"
                                   href="#">{{$post->created_at->diffForHumans()}}</a></li>
                        </ul>


                        {{-- post title --}}
                        <h2 class="h3 mb-4">
                            <a class="d-block reset-anchor" href="{{route('blog.post', $post->post_title)}}">
                                {{$post->post_title}}
                            </a>
                        </h2>

                        {{-- post details up to 150 char --}}
                        <p class="text-muted">
                            {{Str::limit(strip_tags($post->post_details), 150)}}
                        </p>

                        {{-- Read Full Post --}}
                        <a class="btn btn-link p-0 read-more-btn" href="{{route('blog.post', $post->post_title)}}">
                            <span>Read more</span><i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach

            <!-- Pagination-->
                <div class="d-flex justify-content-center">
                    {!! $posts->links() !!}
                </div>
        </div>
@endsection
