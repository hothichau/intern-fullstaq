@unless(empty($post_list))
  <div id="loading" style="display: none;">Loading...</div>
    @foreach($post_list as $post_item)
      @include('partials.overview.overview-item', ['article' => $post_item])
    @endforeach
  </div>
  @include('partials.common.pagination')
@endunless
