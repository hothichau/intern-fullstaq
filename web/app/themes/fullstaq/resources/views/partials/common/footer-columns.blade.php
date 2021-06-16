@if(!empty($footerColumn['title']))
  <p class="footer__title">{!! $footerColumn['title'] !!}</p>
@endif
@if(!empty($footerColumn['footer_link']))
  <ul class="footer__top-list">
    @foreach($footerColumn['footer_link'] as $link)
      <li class="footer__top-list-link">{!! \App\get_button_html($link, 'footer__top-list-link') !!}</li>
    @endforeach
  </ul>
@endif
@if(!empty($footerColumn['link']))
  <a class="footer__btn btn-orange" href="{{ $footerColumn['link'] }}">{!! __('Subscribe', 'fullstaq') !!}</a>
@endif
