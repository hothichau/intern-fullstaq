<div {!! $header_background !!}>
  {!! App::title() !!}
  @if(!is_single())
    @unless(empty($page_intro))
      {!! $page_intro !!}
      @unless(empty($header_button))
        {!! \App\get_button_html($header_button, 'btn-orange') !!}
      @endunless
    @endunless
  @else
    @include('partials.careers.careers-tags', ['tags' => $job_tags])
      {{ the_excerpt() }}
  @endif
  @include('partials.single.single-share-buttons')
</div>
