{{--@section('top-heading')--}}
<div class="row text-center">
    <div class="col-lg-8 mx-auto"><a class="category-link mb-3 d-inline-block" href="#">{{$post->category->category_name}}</a>
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
{{--<img class="w-100 mb-5" src="{{Asset('blog/img/post-single-img.jpg')}}" alt="...">--}}
{{--@endsection--}}
