{!! $title !!}
@if(empty($links))
  {!! $txt !!}
@else
  @foreach($links as $link)
    @unless(empty($link['link']['url']) || empty($link['link']['title']))
      {!! $link['link']['title'] !!}
    @endunless
  @endforeach
@endif

