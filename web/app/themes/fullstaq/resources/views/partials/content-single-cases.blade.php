@include('partials.single.cases-service-block')
<article @php post_class() @endphp>
  @if(has_post_thumbnail())
    {{ the_post_thumbnail('full') }}
  @endif
    @php the_content() @endphp
</article>
