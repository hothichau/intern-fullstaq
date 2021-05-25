@unless(empty($related_posts))
  {!! _e('More News', 'fullstaq') !!}
    @foreach($related_posts as $article)
      @include('partials.overview.overview-item', ['article' => $article])
    @endforeach

    @unless(empty($related_category_link))
      {!! _e('All News', 'fullstaq') !!}
    @endunless
@endunless
