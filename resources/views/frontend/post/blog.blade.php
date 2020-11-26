@extends('frontend.post.layouts.app')



@section('main-content')

    <section class="page-title parallax">
        <div data-parallax="scroll" data-image-src="frontend/images/bg/18.jpg" class="parallax-bg"></div>
        <div class="parallax-overlay">
            <div class="centrize">
                <div class="v-center">
                    <div class="container">
                        <div class="title center">
                            <h1 class="upper">This is our blog<span class="red-dot"></span></h1>
                            <h4>We have a few tips for you.</h4>
                            <hr>
                        </div>
                    </div>
                    <!-- end of container-->
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="blog-posts">
                    @foreach($all_data as $data)
                        <article class="post-single">
                            <div class="post-info">
                                <h2><a href="#">{{ $data -> title }}</a></h2>
                                <h6 class="upper"><span>By</span><a href="#"> {{ $data -> author -> name }}</a><span class="dot"></span><span>{{ $data -> created_at ->diffForHumans() }}</span><span class="dot"></span><a href="#" class="post-tag">Startups</a></h6>
                            </div>
                            <div class="post-media">
                                <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true" class="flexslider nav-outside">
                                    <ul class="slides">
                                        <li>
                                            <img src="{{ URL::to('/') }}/media/posts/{{ $data -> featured_image }}" alt="">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="post-body">
                               {!! htmlspecialchars_decode($data -> content) !!}
                            </div>
                        </article>
                    @endforeach
                        <!-- end of article-->
                    </div>
                    <ul class="pagination">
                        <li><a href="#" aria-label="Previous"><span aria-hidden="true"><i class="ti-arrow-left"></i></span></a>
                        </li>
                        <li class="active"><a href="#">1</a>
                        </li>
                        <li><a href="#">2</a>
                        </li>
                        <li><a href="#">3</a>
                        </li>
                        <li><a href="#">4</a>
                        </li>
                        <li><a href="#">5</a>
                        </li>
                        <li><a href="#" aria-label="Next"><span aria-hidden="true"><i class="ti-arrow-right"></i></span></a>
                        </li>
                    </ul>
                    <!-- end of pagination-->
                </div>
            </div>
            <!-- end of row-->

        </div>
    </section>

@endsection
