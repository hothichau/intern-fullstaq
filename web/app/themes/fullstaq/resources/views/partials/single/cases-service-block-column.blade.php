<img class="service-block__item-img" src="{{ $icon['ico'] }}"{{ $icon['ico_2x'] }} alt="icon">
<div class="service-block__content">
  <h3 class="service-block__item-title">{!! $title !!}</h3>
  @if(empty($links))
  <p class="service-block__item-desc">
    {!! $txt !!}
  </p>
  @else
    <ul class="service-block__item-list">
      @foreach($links as $link)
        @unless(empty($link['link']['url']) || empty($link['link']['title']))
          <li class="service-block__item-list-item">
            <a class="service-block__item-list-link" href="{{ $link['link']['url'] }}">{!! $link['link']['title'] !!}</a>
          </li>
        @endunless
      @endforeach
    </ul>
  @endif
</div>
