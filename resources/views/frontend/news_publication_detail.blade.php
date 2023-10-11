@extends('layouts.frontend.app')

@section('content')
<main>
    <div class="brand_color">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>{{ $title }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--? Blog Area Start -->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 posts-list">
              <div class="single-post">
                <div class="feature-img" style="text-align: center;">
                  <img class="img-fluid" src="{{ $news_publication->image_path }}" alt="">
                </div>
                <div class="blog_details">
                  <h2 style="color: #2d2d2d;">
                    {{ $news_publication->title }}
                  </h2>
                  <div style="display: flex; flex-direction: row; justify-content: space-between; font-size: 14px; margin-bottom: 15px">
                    <div style="display: flex; justify-content: flex-start; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                            <style>svg{fill:#5aac4e}</style>
                            <path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z"/>
                        </svg>
                        <span style="padding-left: 10px; margin-bottom: 0px;">{{ $news_publication->publish_date }}</span>
                    </div>
                    <div style="display: flex; justify-content: flex-end; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                            <style>svg{fill:#5aac4e}</style>
                            <path d="M168 80c-13.3 0-24 10.7-24 24V408c0 8.4-1.4 16.5-4.1 24H440c13.3 0 24-10.7 24-24V104c0-13.3-10.7-24-24-24H168zM72 480c-39.8 0-72-32.2-72-72V112C0 98.7 10.7 88 24 88s24 10.7 24 24V408c0 13.3 10.7 24 24 24s24-10.7 24-24V104c0-39.8 32.2-72 72-72H440c39.8 0 72 32.2 72 72V408c0 39.8-32.2 72-72 72H72zM176 136c0-13.3 10.7-24 24-24h96c13.3 0 24 10.7 24 24v80c0 13.3-10.7 24-24 24H200c-13.3 0-24-10.7-24-24V136zm200-24h32c13.3 0 24 10.7 24 24s-10.7 24-24 24H376c-13.3 0-24-10.7-24-24s10.7-24 24-24zm0 80h32c13.3 0 24 10.7 24 24s-10.7 24-24 24H376c-13.3 0-24-10.7-24-24s10.7-24 24-24zM200 272H408c13.3 0 24 10.7 24 24s-10.7 24-24 24H200c-13.3 0-24-10.7-24-24s10.7-24 24-24zm0 80H408c13.3 0 24 10.7 24 24s-10.7 24-24 24H200c-13.3 0-24-10.7-24-24s10.7-24 24-24z"/>
                        </svg>
                        <span style="padding-left: 10px; margin-bottom: 0px;">{{ $news_publication->category }}</span>
                    </div>
                </div>
                  <p class="excert" style="text-align: justify;">
                    {!! $news_publication->content !!}
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    {{-- <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title" style="color: #2d2d2d;">Category</h4>
                        <ul class="list cat-list">
                            @foreach ($categories as $data)
                            <li>
                                <a href="{{ $data->category == 'news' ? route('public.news') : route('public.publication') }}" class="d-flex">
                                    <p>{{ $data->category }}</p>
                                    <p>({{ $data->total }})</p>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </aside> --}}

                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title" style="color: #2d2d2d;">Recent Post</h3>
                        @foreach ($recent_posts as $data )
                        <div class="media post_item">
                            <img src="{{ $data->image_path }}" alt="{{ $data->title }}" width="65px">
                            <div class="media-body">
                                <a href="{{  $data->category == 'news' ? route('public.news_detail', [$data->slug]) : route('public.publication_detail', [$data->slug]) }}">
                                    <h3 style="color: #2d2d2d;">{{ $data->title }}</h3>
                                </a>
                                <p>{{ $data->publish_date }}</p>
                            </div>
                        </div>
                        @endforeach
                    </aside>
                </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Blog Area End -->
</main>
@endsection
