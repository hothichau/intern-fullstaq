<header class="header js-header fixed-top">
  <div class="container-fluid d-flex justify-content-between">
    @unless(empty($site_logo))
      <a class="header__logo" href="{{ home_url('/') }}" title="{{ get_bloginfo('name', 'display') }}">
        <img class="header__logo-img" src="{{ $site_logo}}" alt="{{ get_bloginfo('name', 'display') }}">
      </a>
    @endunless
    <div class="nav-primary d-flex align-items-center">
      @unless(empty($header_contact_link['url']) || empty($header_contact_link['title']))
        <a class="header__btn" href="{{ $header_contact_link['url'] }}" title="{{ $header_contact_link['title'] }}">
          {!! $header_contact_link['title'] !!}
        </a>
      @endunless
      @if(has_nav_menu('primary_navigation'))
        <nav class="navbar">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main"
            aria-controls="navbar-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbar-main">
            {!! wp_nav_menu($primary_navigation) !!}
          </div>
        </nav>
      @endif
    </div>
  </div>
</header>
