<a class="card__link" href="{{ $article['url'] }}">
  @unless(empty($article['thumbnail']['thumb']))
    <figure class="card__thumb">
      <img class="card__img" src="{{ $article['thumbnail']['thumb'] }}" srcset="{{ $article['thumbnail']['thumb_2x'] }} 2x" alt="{{ $article['title'] }}">
    </figure>
  @endunless
  <div class="card__inner">
    @include('partials.entry-meta', ['id' => $article['ID']])
    <p class="card__title">{{ $article['title'] }}</p>
    <p class="card__text">{!! \App\cut_string_by_char($article['excerpt'], 80)  !!}</p>
  </div>
</a>
