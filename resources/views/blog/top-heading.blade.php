{{--@section('top-heading')--}}
<div class="row text-center">
    <div class="col-lg-8 mx-auto"><a class="category-link mb-3 d-inline-block"
                                     href="{{route('blog.category.post',$post->category_name)}}">{{$post->category_name}}</a>
        <h1>{{$post->post_title}}</h1>
        {{--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis aliquid.</p>--}}
        <ul class="list-inline mb-5">
            <li class="list-inline-item mx-2"><a class="text-uppercase text-muted reset-anchor"
                                                 href="#">{{$post->user->name}}</a></li>
            <li class="list-inline-item mx-2"><a class="text-uppercase text-muted reset-anchor"
                                                 href="#">{{$post->created_at->diffForHumans()}}</a></li>
        </ul>
    </div>
</div>
<div class="text-center w-100">
    <img class="w-75 mb-5" src="{{Asset($post->post_image)}}" alt="{{$post->post_title}}">
</div>
{{--@endsection--}}
