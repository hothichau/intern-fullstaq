@unless(empty($service['title']) || empty($service['text']) || empty($service['icon']))
  <div class="col-12 col-md-6 service-block__item">
    @unless(empty($service['link']))
      <a class="service-block__item-link d-flex align-items-start" href="{{ $service['link'] }}">
    @endunless
      <img class="service-block__item-img" src="{!! $service['icon'] !!}" alt="{!! $service['title'] !!}">
      <div class="service-block__item-content">
        <h3 class="service-block__item-content-title">{!! $service['title'] !!}</h3>
        <p class="service-block__item-content-text">{{ $service['text'] }}</p>
      </div>
    @unless(empty($service['link']))
      </a>
    @endunless
  </div>
@endunless
