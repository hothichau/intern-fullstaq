<header>
  @unless(empty($site_logo))
    <img src="{{ $site_logo}}">
  @endunless
  @unless(empty($header_contact_link['url']) || empty($header_contact_link['title']))
    {!! $header_contact_link['title'] !!}
  @endunless
  @if(has_nav_menu('primary_navigation'))
    <nav>
      {!! wp_nav_menu($primary_navigation) !!}
    </nav>
  @endif
</header>
