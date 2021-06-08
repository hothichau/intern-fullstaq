{{--
  Title: Image Left/Right
  Description: Block with side by side img/text
  Category: acf-blocks
  Icon: align-left
  Keywords: image left/right
  Mode: edit
  Align: none
  PostTypes: page post cases jobs
  SupportsAlign: false
  SupportsMultiple: true
--}}
@php
  $block_data = \App\Controllers\App::getImageTextBlockData();
@endphp
@if($block_data['image'] && !empty($block_data['content']['title']  && !empty($block_data['content']['txt'])))
<div {!! $block_data['block_id'] !!} class="img-text {!! ($block_data['image_position'] === 'img-right') ? 'img-text--left' : 'img-text--right' !!}">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6 {!! ($block_data['image_position'] === 'img-right') ? 'order-md-2' : 'img-text--right' !!}">
        <div class="img-text__thumb">
          <img class="img-text__thumb-img" src="{!! $block_data['image'] !!}" {!! $block_data['image_2x'] !!} alt="{!! $block_data['block_title'] !!}">
        </div>
      </div>
      <div class="col-12 col-md-6 img-text__text">
        <div class="img-text__content">
          <h2 class="img-text__title">{!! $block_data['content']['title'] !!}</h2>
          <div class="img-text__desc">{!! $block_data['content']['txt'] !!}</div>
          {!! \App\get_button_html( $block_data['content']['link'], 'btn-readmore' ) !!}
        </div>
      </div>
    </div>
  </div>
</div>
@elseif(is_admin())
  <h3>Image Text Block</h3>
@endif
