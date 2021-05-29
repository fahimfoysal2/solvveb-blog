@extends('layouts._blogLayout')

@section('main-content')
    <div class="row">

        <div class="col-lg-9 mb-5 mb-lg-0">

            {{--            {{dd($categories)}}--}}
            <section class="pb-5">
                <div class="container pb-4">
                    <div class="row mb-5 pb-4">
                        @foreach($categories as $category)
                            <div class="col-lg-4 mb-4 mb-lg-4">
                                <a class="category-block bg-center bg-cover"
                                   style="background: url('img/category-bg-1.jpg')"
                                   href="{{route('blog.category.post', $category->category_name)}}">
                                    <span class="category-block-title">
                                        {{$category->category_name}}
                                    </span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>


        </div>
@endsection
