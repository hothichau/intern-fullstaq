<article @php post_class() @endphp>
  <header>
    {!! get_the_title() !!}
    @if (get_post_type() === 'post')
      @include('partials/entry-meta')
    @endif
  </header>
    @php the_excerpt() @endphp
</article>
