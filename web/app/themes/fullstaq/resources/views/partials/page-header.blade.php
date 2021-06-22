<div class="page-header">
  <div class="container">
    <div class="row justify-content-center align-items-center page-header__wrapper">
      <div class="col-12 col-md-8">
        <div class="page-header__inner">
          <h1 class="page-header__title">{!! App::title() !!}</h1>
          @if(is_page())
            @unless(empty($page_intro))
              <div class="page-header__intro">
                {!! $page_intro !!}
              </div>
            @endunless
          @elseif(!is_archive() && !is_404())
            @include('partials.entry-meta')
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="page-header__breadcrumb">
    @include('partials.common.breadcrumb')
  </div>
</div>
