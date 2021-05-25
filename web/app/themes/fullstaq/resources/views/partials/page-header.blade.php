  {!! App::title() !!}

  @if(is_page())
    @unless(empty($page_intro))
      {!! $page_intro !!}
    @endunless
  @elseif(!is_archive() && !is_404())
    @include('partials.entry-meta')
  @endif

  @include('partials.common.breadcrumb')
