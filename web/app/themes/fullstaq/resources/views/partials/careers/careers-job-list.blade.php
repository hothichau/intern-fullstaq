@unless(empty($post_list))
  <div id="job-list" class="job-list">
    <div class="container">
      <h2 class="job-list__title text-center">{!! __('Open Positions', 'fullstaq') !!}</h2>
      <div class="row justify-content-center">
        <div class="col-12 col-md-8">
          @foreach($post_list as $job)
            <div class="job-list__item">
              @unless(empty($job['title']))
                <h2 class="job-list__item-title">{!! $job['title'] !!}</h2>
              @endunless
                @include('partials.careers.careers-tags', ['tags' => $job['tags']])
              @unless(empty($job['excerpt']))
                <p class="job-list__item-desc">{!! $job['excerpt'] !!}</p>
              @endunless
              @unless(empty($job['url']))
                <a class="btn-orange" href="{{ $job['url'] }}" title="{{ !empty($job['title']) ? $job['title'] : __('More Information') }}">
                  {!! __('More Information') !!}
                </a>
              @endunless
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  @include('partials.common.pagination')
@endunless
