{{--
  Title: Icon Block
  Description: Block with icons or icon slider
  Category: acf-blocks
  Icon: align-left
  Keywords: icon slider
  Mode: edit
  Align: none
  PostTypes: page post cases jobs
  SupportsAlign: false
  SupportsMultiple: true
--}}
@php
  $block_data = \App\Controllers\App::getIconsBlockData();
@endphp
@if(!empty($block_data))
  @unless(empty($block_data['icons']))
  <div {!! $block_data['block_id'] !!}>
      @unless(empty($block_data['block_title']))
        {{ $block_data['block_title']  }}
      @endunless
      @foreach($block_data['icons'] as $icon_data)
        @include('partials.block.icon-block-item')
      @endforeach
  </div>
  @endunless
@elseif(is_admin())
  <h3>Icons Block</h3>
@endif
