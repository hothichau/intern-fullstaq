<div class="container">
  <div class="row">
    <div class="col-12">
      @unless(empty($service['title']) || empty($service['text']) || empty($service['icon']))
        @unless(empty($service['link']))
        @endunless
          <h3 class="service-item__title">{!! $service['title'] !!}</h3>
          <p class="service-item__text">{!! $service['text'] !!}</p>
        @unless(empty($service['link']))
        @endunless
      @endunless
    </div>
  </div>
</div>
