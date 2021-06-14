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
  <div {!! $block_data['block_id'] !!} class="featured-block">
    @unless(empty($block_data['block_title']))
      <h2 class="featured-block__title text-center">{!! $block_data['block_title'] !!}</h2>
    @endunless
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-4 featured-block__item {{ $block_data['layout_style'] === 'large' ? 'col-lg-6 featured-block__item--large' : '' }}">
          @include('partials.overview.overview-item', ['article' => $block_data['featured_article_1']])
        </div>
        <div class="col-12 col-md-4 featured-block__item {{ $block_data['layout_style'] === 'large' ? 'col-lg-3' : '' }}">
          @include('partials.overview.overview-item', ['article' => $block_data['featured_article_2']])
        </div>
        <div class="col-12 col-md-4 featured-block__item {{ $block_data['layout_style'] === 'large' ? 'col-lg-3' : '' }}">
          <div class="{{ $block_data['layout_style'] === 'large' ? 'featured-block__item--purple' : '' }}">
            @include('partials.overview.overview-item', ['article' => $block_data['featured_article_3']])
          </div>
        </div>
      </div>
      @unless(empty($block_data['link']['title']) || empty($block_data['link']['url']))
        <div class="text-center">
          <a class="btn-readmore" href="{{ $block_data['link']['url'] }}">{!! $block_data['link']['title'] !!}</a>
        </div>
      @endunless
    </div>
  </div>
@elseif(is_admin())
  <h3>Featured Block</h3>
@endif
