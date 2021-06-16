@unless(empty($related_posts))
  <div id="related-post" class="item-overview item-overview--related">
    <div class="container">
      <h2 class="featured-block__title text-center">{!! _e('More News', 'fullstaq') !!}</h2>
      <div class="row">
        @foreach($related_posts as $article)
        <div class="col-12 col-lg-4 item-overview {{ $loop->first ? 'col-xl-6 item-overview--small' : 'col-xl-3' }}">
          @include('partials.overview.overview-item', ['article' => $article])
        </div>
        @endforeach
      </div>
      @unless(empty($related_category_link))
        <div class="text-center">
          <a class="btn-readmore" href="{{ $related_category_link }}">{!! _e('All News', 'fullstaq') !!}</a>
        </div>
      @endunless
    </div>
  </div>
@endunless
