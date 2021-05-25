
@unless(empty($footer_logo))
  <img src="{{ $footer_logo }}">
@endunless
@unless(empty($copyright))
  {!! do_shortcode($copyright) !!}
@endunless
@if(has_nav_menu('footer_navigation'))
  {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'container' => false]) !!}
@endif
@unless(empty($footer_social_links))
  @include('partials.common.footer-social-links')
@endunless
