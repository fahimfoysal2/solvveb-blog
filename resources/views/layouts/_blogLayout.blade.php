<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Solvveb | Personal Blog</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{Asset('blog/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Satisfy&amp;display=swap">
    <!-- Lightbox-->
    <link rel="stylesheet" href="{{Asset('blog/vendor/lightbox2/css/lightbox.min.css')}}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{Asset('blog/css/style.blue.min.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{Asset('blog/css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{Asset('blog/img/favicon.png')}}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    {{--  open every link in new tab  --}}
    {{--    <base target="_blank">--}}
</head>
<body>
<!-- navbar-->
<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light py-4 index-forward bg-white">
        <div class="container d-flex justify-content-center justify-content-lg-between align-items-center">
            <ul class="list-inline small mb-0 text-dark d-none d-lg-block">
                <li class="list-inline-item"><a class="reset-anchor" href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li class="list-inline-item"><a class="reset-anchor" href="#"><i class="fab fa-twitter"></i></a></li>
                <li class="list-inline-item"><a class="reset-anchor" href="#"><i class="fab fa-instagram"></i></a></li>
                <li class="list-inline-item"><a class="reset-anchor" href="#"><i class="fab fa-linkedin"></i></a></li>
                <li class="list-inline-item"><a class="reset-anchor" href="#"><i class="fab fa-youtube"></i></a></li>
            </ul>
            <a class="navbar-brand" href="/"><img src="{{Asset('blog/img/logo.svg')}}" alt="..." width="150"></a><a
                class="reset-anchor text-small mb-0 h6 d-none d-lg-block" href="mailto:admin@admin.com"><i
                    class="far fa-envelope mr-2 text-primary"></i>admin@admin.com</a>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light border-top border-bottom border-light">
        <div class="container">
            <ul class="list-inline small mb-0 text-dark d-block d-lg-none">
                <li class="list-inline-item"><a class="reset-anchor" href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li class="list-inline-item"><a class="reset-anchor" href="#"><i class="fab fa-twitter"></i></a></li>
                <li class="list-inline-item"><a class="reset-anchor" href="#"><i class="fab fa-instagram"></i></a></li>
                <li class="list-inline-item"><a class="reset-anchor" href="#"><i class="fab fa-linkedin"></i></a></li>
                <li class="list-inline-item"><a class="reset-anchor" href="#"><i class="fab fa-youtube"></i></a></li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation"><span></span><span></span><span></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <!-- Navbar link--><a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <!-- Navbar link--><a class="nav-link" href="{{route('blog.categories')}}">Categories</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                           id="pages" href="#"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                        <div class="dropdown-menu mt-2" aria-labelledby="pages">
                            <a class="dropdown-item" href="/">Home</a>
                            <a class="dropdown-item" href="/post">Post</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <!-- Navbar link-->
                        @auth
                            <a class="nav-link" href="/logout">Logout</a>
                        @else
                            <a class="nav-link" href="/login">Login</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>


<section class="">
    <div class="container py-4">

        <div>
        @yield('main-content')


        <!-- Blog sidebar-->
            <div class="col-lg-3">
                <!-- Recent posts-->
                <div class="card rounded-0 border-0 mb-4">
                    <div class="card-body p-0">
                        <h2 class="h5 mb-3">Recent post</h2>
                        <div class="media mb-3">
                            <a class="d-block" href="{{route('blog.post', $sidebar_data['recent_post']['title'])}}">
                                <img class="img-fluid" src="{{Asset('blog/img/recent-post-1.jpg')}}" alt="" width="70">
                            </a>
                            <div class="media-body ml-3">
                                <h6>
                                    <a class="reset-anchor"
                                       href="{{route('blog.post', $sidebar_data['recent_post']['title'])}}">
                                        {{$sidebar_data['recent_post']['title']}}
                                    </a>
                                </h6>
                                <p class="text-small text-muted line-height-sm mb-0">
                                    {{$sidebar_data['recent_post']['details']}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Categories -->
                <div class="card rounded-0 border-0 mb-4">
                    <div class="card-body p-0">
                        <h2 class="h5 mb-3">Trending categories</h2>
                        @foreach($sidebar_data['categories'] as $category)
                            <a class="category-block category-block-sm bg-center bg-cover mb-2"
                               style="background: url({{Asset('blog/img/category-bg-1.jpg')}})"
                               href="{{route('blog.category.post', $category)}}">
                            <span class="category-block-title">
                                {{$category}}
                            </span>
                            </a>
                        @endforeach
                    </div>
                </div>
                <!-- Tags-->
                <div class="card rounded-0 border-0 mb-4">
                    <div class="card-body p-0">
                        <h2 class="h5 mb-3">Tags cloud</h2>
                        <ul class="list-inline">
                            @foreach($sidebar_data['tags'] as $tag)
                                <li class="list-inline-item my-1 mr-2">
                                    <a class="sidebar-tag-link" href="{{route('blog.tag.post',$tag)}}">
                                        {{$tag}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- About category-->
                <div class="card rounded-0 border-0 bg-light mb-4 py-lg-4">
                    <div class="card-body text-center">
                        <h2 class="h3 mb-3">About me</h2><img class="rounded-circle mb-3"
                                                              src="{{Asset('blog/img/author.jpg')}}"
                                                              alt="..."
                                                              width="100">
                        <p class="text-small text-muted">I'm who I am.. 😇 </p>
                        <ul class="list-inline small mb-0 text-dark">
                            <li class="list-inline-item"><a class="reset-anchor" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                            </li>
                            <li class="list-inline-item"><a class="reset-anchor" href="#"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li class="list-inline-item"><a class="reset-anchor" href="#"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a class="reset-anchor" href="#"><i
                                        class="fab fa-linkedin"></i></a></li>
                            <li class="list-inline-item"><a class="reset-anchor" href="#"><i class="fab fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="py-4" style="background: #111">
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col-md-4 text-lg-left text-white logo-footer">
                <!-- <img src="blog/img/logo-footer.svg" alt="..." width="120"> -->
                Solvveb
            </div>
            <div class="col-md-4 text-center">
                <div class="d-flex align-items-center flex-wrap justify-content-center">
                    <h6 class="text-muted mb-0 py-2 mr-3">Follow me<span class="ml-3">-</span></h6>
                    <ul class="list-inline small mb-0 text-white">
                        <li class="list-inline-item"><a class="reset-anchor" href="#"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="list-inline-item"><a class="reset-anchor" href="#"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item"><a class="reset-anchor" href="#"><i
                                    class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a class="reset-anchor" href="#"><i
                                    class="fab fa-linkedin"></i></a></li>
                        <li class="list-inline-item"><a class="reset-anchor" href="#"><i class="fab fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 text-lg-right">
                <p class="mb-0 text-muted text-small text-heading">All Rights Reserved &copy;<a
                        href="/" class="text-reset">Solvveb Blog</a>. </p>
            </div>
        </div>
    </div>
</footer>
<!-- JavaScript files-->
<script src="{{Asset('blog/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{Asset('blog/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{Asset('blog/vendor/lightbox2/js/lightbox.min.js')}}"></script>
<script src="{{Asset('blog/js/front.js')}}"></script>
<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
      integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</body>
</html>
