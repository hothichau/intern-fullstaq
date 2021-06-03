{{--
  Title: Service Block
  Description: Block for displaying services information
  Category: acf-blocks
  Icon: align-left
  Keywords: service
  Mode: edit
  Align: none
  PostTypes: page post cases jobs
  SupportsAlign: false
  SupportsMultiple: true
--}}
@php
  $block_data = \App\Controllers\App::getServiceBlockData();
@endphp
@if(!empty($block_data['block_title']) && !empty($block_data['item_list']))
  <div {!! $block_data['block_id'] !!}>
    <h2 class="service-block__title">{!! $block_data['block_title'] !!}</h2>
    @unless(empty($block_data['feature_image']))
      <img class="service-block_image" src="{!! $block_data['feature_image'] !!}">
    @endunless
    @if(!empty($block_data['item_list']))
      @foreach($block_data['item_list'] as $service)
        @include('partials.block.service-block-item')
      @endforeach
    @endif
  </div>
@elseif(is_admin())
  <h3>Service Block</h3>
@endif
