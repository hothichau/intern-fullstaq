<article @php post_class() @endphp>
  <header>
    {!! get_the_title() !!}
    @include('partials/entry-meta')
  </header>
  @php the_excerpt() @endphp
</article>
