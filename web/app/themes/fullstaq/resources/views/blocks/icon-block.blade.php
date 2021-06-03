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
    <div {!! $block_data['block_id'] !!} class="icons-block">
      <div class="container">
        @unless(empty($block_data['block_title']) && empty($block_data['block_subtitle']))
          <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-8">
              <div class="icons-block__header">
                @unless(empty($block_data['block_title']))
                  <h2 class="icons-block__title">{{ $block_data['block_title']  }}</h2>
                @endunless
                @unless(empty($block_data['block_subtitle']))
                  <p class="icons-block__subtitle">{{ $block_data['block_subtitle']  }}</p>
                @endunless
              </div>
            </div>
          </div>
        @endunless
        <div class="js-icon-slider">
          @foreach($block_data['icons'] as $icon_data)
            @include('partials.block.icon-block-item')
          @endforeach
        </div>
      </div>
    </div>
  @endunless
@elseif(is_admin())
  <h3>Icons Block</h3>
@endif
