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
  <div {!! $block_data['block_id'] !!} class="service-block">
    <div class="service-block__item">
      <h2 class="service-block__item-title">{!! $block_data['block_title'] !!}</h2>
      @unless(empty($block_data['feature_image']))
        <img class="service-block__item-feature_image" src="{!! $block_data['feature_image'] !!}" alt="featured-image">
      @endunless
    </div>
    @if(!empty($block_data['item_list']))
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-8">
            <div class="row">
              @foreach($block_data['item_list'] as $service)
                @include('partials.block.service-block-item')
              @endforeach
            </div>
          </div>
        </div>
      </div>
    @endif
  </div>
@elseif(is_admin())
  <h3>Service Block</h3>
@endif
