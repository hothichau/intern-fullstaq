<article @php post_class() @endphp>
  @if(has_post_thumbnail())
    {{ the_post_thumbnail('full') }}
  @endif
    @php the_content() @endphp
    @include('partials.single.single-share-buttons')
</article>
@include('partials.single.single-related-posts')
