@unless(empty($post_list))
  <div class="container">
    <div id="loading" style="display: none;">Loading...</div>
    <div class="row">
      @foreach($post_list as $post_item)
        <div class="col-12 col-md-6 {{ $loop->first ? 'col-lg-6 item-overview--large' : 'col-lg-3' }} item-overview">
          @include('partials.overview.overview-item', ['article' => $post_item])
        </div>
      @endforeach
    </div>
  </div>
  @include('partials.common.pagination')
@endunless
