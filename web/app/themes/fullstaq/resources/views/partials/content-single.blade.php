<article @php post_class() @endphp>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8">
        @if(has_post_thumbnail())
          <figure class="feature-image">
            {{ the_post_thumbnail('full') }}
          </figure>
        @endif
        <div class="entry-content">
          @php the_content() @endphp
          @include('partials.single.single-share-buttons')
        </div>
      </div>
    </div>
  </div>
</article>
@include('partials.single.single-related-posts')
