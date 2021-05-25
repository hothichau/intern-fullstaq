@if(!empty($footerColumn['title']))
  {!! $footerColumn['title'] !!}
@endif
@if(!empty($footerColumn['footer_link']))
  @foreach($footerColumn['footer_link'] as $link)
    {!! \App\get_button_html($link, 'footer__top-list-link') !!}
  @endforeach
@endif
@if(!empty($footerColumn['link']))
  {!! __('Subscribe', 'fullstaq') !!}
@endif
