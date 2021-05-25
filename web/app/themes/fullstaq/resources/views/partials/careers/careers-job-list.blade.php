@unless(empty($post_list))
{!! __('Open positions', 'fullstaq') !!}
    @foreach($post_list as $job)
      @unless(empty($job['title']))
        {!! $job['title'] !!}
      @endunless
        @include('partials.careers.careers-tags', ['tags' => $job['tags']])
      @unless(empty($job['excerpt']))
          {!! $job['excerpt'] !!}
      @endunless
      @unless(empty($job['url']))
        {!! __('More Information') !!}
      @endunless
    @endforeach
  @include('partials.common.pagination')
@endunless
