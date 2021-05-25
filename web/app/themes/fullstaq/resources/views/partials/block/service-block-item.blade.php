@unless(empty($service['title']) || empty($service['text']) || empty($service['icon']))
  @unless(empty($service['link']))
  @endunless
    {!! $service['title'] !!}
      {{ $service['text'] }}
  @unless(empty($service['link']))
  @endunless
@endunless
