@unless(empty($service['title']) || empty($service['text']) || empty($service['icon']))
<div class="col-12 col-md-6 service-item">
  @unless(empty($service['link']))
    <a class="service-item__link" href="{{ $service['link'] }}">
  @endunless
    <img class="service-item__img" src="{!! $service['icon'] !!}" alt="{!! $service['title'] !!}">
    <div class="service-item__content">
      <h3 class="service-item__content-title">{!! $service['title'] !!}</h3>
      <p class="service-item__content-text">{{ $service['text'] }}</p>
    </div>
  @unless(empty($service['link']))
    </a>
  @endunless
</div>
@endunless
