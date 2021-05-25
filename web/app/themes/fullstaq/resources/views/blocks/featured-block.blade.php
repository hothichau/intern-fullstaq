{{--
  Title: Featured Articles Block
  Description: Block for displaying featured articles
  Category: acf-blocks
  Icon: align-left
  Keywords: featured article
  Mode: edit
  Align: none
  PostTypes: page post cases jobs
  SupportsAlign: false
  SupportsMultiple: true
--}}
@php
  $block_data = \App\Controllers\App::getFeaturedBlockData();
@endphp
@if(!empty($block_data))
  <div {!! $block_data['block_id'] !!}>
    @unless(empty($block_data['block_title']))
      {!! $block_data['block_title'] !!}
    @endunless
      @include('partials.overview.overview-item', ['article' => $block_data['featured_article_1']])
      @include('partials.overview.overview-item', ['article' => $block_data['featured_article_2']])
      @include('partials.overview.overview-item', ['article' => $block_data['featured_article_3']])

      @unless(empty($block_data['link']['title']) || empty($block_data['link']['url']))
        {!! $block_data['link']['title'] !!}
      @endunless
  </div>
@elseif(is_admin())
  <h3>Featured Block</h3>
@endif
