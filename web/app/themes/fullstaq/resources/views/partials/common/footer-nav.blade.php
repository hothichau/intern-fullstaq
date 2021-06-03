<div class="container">
  <div class="footer__bottom-info">
    <div class="footer__logo">
      @unless(empty($footer_logo))
        <img class="footer__logo-img" src="{{ $footer_logo }}" alt="{{ get_bloginfo('name', 'display') }}">
      @endunless
      @unless(empty($copyright))
        <span>{!! do_shortcode($copyright) !!}</span>
      @endunless
    </div>
    @if(has_nav_menu('footer_navigation'))
      <nav class="footer__bottom-menu">
        {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'container' => false]) !!}
      </nav>
    @endif
  </div>
  @unless(empty($footer_social_links))
    @include('partials.common.footer-social-links')
  @endunless
</div>
