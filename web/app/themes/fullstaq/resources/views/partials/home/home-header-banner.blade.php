@unless(empty($header_banner))
  @unless(empty($header_banner['title']))
    {!! $header_banner['title'] !!}
  @endunless
  @unless(empty($header_banner['txt']))
    {!! $header_banner['txt']  !!}
  @endunless
  {!! \App\get_button_html($header_banner['link'], 'btn-orange') !!}
@endunless
