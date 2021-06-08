<div id="careers-header" {!! $header_background !!} class="career-banner">
  <div class="container">
    <div class="row career-banner__inner align-items-center justify-content-center text-center">
      <div class="col-12 col-md-8">
        <h1 class="career-banner__title">{!! App::title() !!}</h1>
        @if(!is_single())
          @unless(empty($page_intro))
            <div class="career-banner__desc">{!! $page_intro !!}</div>
            @unless(empty($header_button))
              <div class="text-center">
                {!! \App\get_button_html($header_button, 'btn-orange') !!}
              </div>
            @endunless
          @endunless
        @else
          @include('partials.careers.careers-tags', ['tags' => $job_tags])
          <div class="career-banner__desc">{{ the_excerpt() }}</div>
        @endif
        @include('partials.single.single-share-buttons')
      </div>
    </div>
  </div>
</div>
