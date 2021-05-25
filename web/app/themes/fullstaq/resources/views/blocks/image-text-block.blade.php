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
  <div {!! $block_data['block_id'] !!}>
    {!! $block_data['content']['title'] !!}
    {!! $block_data['content']['txt'] !!}
    {!! \App\get_button_html( $block_data['content']['link'], 'btn-readmore' ) !!}
  </div>
@elseif(is_admin())
  <h3>Image Text Block</h3>
@endif
