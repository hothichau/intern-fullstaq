@include('partials.single.cases-service-block')
<article @php post_class() @endphp>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8">
        <div class="entry-content">
          @php the_content() @endphp
        </div>
      </div>
    </div>
  </div>
</article>
