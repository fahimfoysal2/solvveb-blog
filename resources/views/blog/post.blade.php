@extends('layouts._blogLayout')

@section('main-content')

    @include('blog.top-heading')


    <div class="row">
        <div class="col-lg-9">

        {!!($post->post_details)!!}

        <!-- Post tags-->
            <div class="d-flex align-items-center flex-column flex-sm-row mb-4 mt-4 p-4 bg-light">
                <h3 class="h4 mb-3 mb-sm-0">Tags</h3>
                <ul class="list-inline mb-0 ml-0 ml-sm-3">

                    @foreach($post->tags as $tag)

                        <li class="list-inline-item my-1 mr-2">
                            <a class="sidebar-tag-link" href="{{route('blog.tag.post',$tag->tag_name)}}">
                                {{$tag->tag_name}}
                            </a>
                        </li>

                    @endforeach
                </ul>
            </div>
            <!-- Post share-->
            <div class="d-flex align-items-center flex-column flex-sm-row mb-5 p-4 bg-light">
                <h3 class="h4 mb-3 mb-sm-0">Share this post</h3>
                <ul class="list-inline mb-0 ml-0 ml-sm-3">
                    <li class="list-inline-item mr-1 my-1"><a class="social-link-share facebook" href="#"><i
                                class="fab fa-facebook-f mr-2"></i>Share</a></li>
                    <li class="list-inline-item mr-1 my-1"><a class="social-link-share twitter" href="#"><i
                                class="fab fa-twitter mr-2"></i>Tweet</a></li>
                    <li class="list-inline-item mr-1 my-1"><a class="social-link-share instagram" href="#"><i
                                class="fab fa-instagram mr-2"></i>Share</a></li>
                </ul>
            </div>
            <!-- Leave comment-->
            <h3 class="h4 mb-4">Leave a comment</h3>
            <form class="mb-5" method="post" action="{{route('comment.save')}}">
                @csrf
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <div class="row">
                    @auth
                        <div class="form-group col-lg-6">
                            <span class="text-danger">Comment As: </span><b>{{Auth::user()->name}}</b>
                        </div>
                    @else
                        <div class="form-group col-lg-6">
                            <input required class="form-control" type="text" name="user_name"
                                   placeholder="Full Name e.g. Jason Doe">
                        </div>

                        <div class="form-group col-lg-6">
                            <input required class="form-control" type="email" name="user_email"
                                   placeholder="Email Address e.g. Jason@email.com">
                        </div>
                    @endauth

                    <div class="form-group col-lg-12">
                                <textarea required class="form-control" name="comment_text" rows="5"
                                          placeholder="Leave your message"></textarea>
                    </div>
                    <div class="form-group col-lg-12">
                        <button class="btn btn-primary" type="submit">Submit your comment</button>
                    </div>
                </div>
            </form>
            <!-- Post comments-->
            <h3 class="h4 mb-4">Comments</h3>
            <ul class="list-unstyled comments">
                @foreach($post->comments as $comment)
                    @if($comment->comment_status === 'published')
                        {{$flag = ''}}
                        <li>
                            <div class="media mb-4"><img class="rounded-circle shadow-sm img-fluid"
                                                         src="{{Asset('blog/img/person-2.jpg')}}" alt="" width="60">
                                <div class="media-body ml-3">
                                    <p class="small mb-0 text-primary">{{$comment->created_at->diffForHumans()}}</p>
                                    <h5>{{$comment->user_name}}</h5>
                                    <p class="text-muted text-small mb-2">{{$comment->comment_text}}</p>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
                @if(!isset($flag))
                    <h3>Be the first one to post your thought...</h3>
                @endif

            </ul>
        </div>

@endsection
