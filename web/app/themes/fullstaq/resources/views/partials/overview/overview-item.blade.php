@unless(empty($article['thumbnail']['thumb']))
  <img src="{{ $article['thumbnail']['thumb'] }}" srcset="{{ $article['thumbnail']['thumb_2x'] }} 2x">
@endunless
@include('partials.entry-meta', ['id' => $article['ID']])
{{ $article['title'] }}
{!! $article['excerpt'] !!}
