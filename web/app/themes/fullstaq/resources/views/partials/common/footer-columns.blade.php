@if(!empty($footerColumn['title']))
  <h5 class="footer__title">{!! $footerColumn['title'] !!}</h5>
@endif
@if(!empty($footerColumn['footer_link']))
  <ul class="footer__top-list">
    @foreach($footerColumn['footer_link'] as $link)
      <li>{!! \App\get_button_html($link, 'footer__top-list-link') !!}</li>
    @endforeach
  </ul>
@endif
@if(!empty($footerColumn['link']))
  <a class="footer__btn-orange" href="{{ $footerColumn['link'] }}">{!! __('Subscribe', 'fullstaq') !!}</a>
@endif
@dump($link)
