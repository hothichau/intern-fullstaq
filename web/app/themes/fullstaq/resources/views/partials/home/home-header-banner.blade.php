@unless(empty($header_banner))
<div class="home-banner">
  <div class="container">
    <div class="row home-banner__content align-items-start">
      <img class="home-banner__img" src="{{ \App\asset_path('images/fullstaq-astronaut-small.png') }}" alt="astronaut">
      <div class="col-12 col-md-6">
        <div class="home-banner__boxed">
          @unless(empty($header_banner['title']))
            <h1 class="home-banner__title">{!! $header_banner['title'] !!} </h1>
          @endunless
          @unless(empty($header_banner['txt']))
            <p  class="home-banner__text">{!! \App\cut_string_by_char($header_banner['txt'], 135)  !!} </p>
          @endunless
          {!! \App\get_button_html($header_banner['link'], 'btn-orange') !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endunless
