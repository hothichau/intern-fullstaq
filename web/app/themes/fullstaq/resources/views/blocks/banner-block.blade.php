{{--
  Title: Banner Block
  Description: Block with banner
  Category: acf-blocks
  Icon: align-left
  Keywords: banner
  Mode: edit
  Align: none
  PostTypes: page post cases jobs
  SupportsAlign: false
  SupportsMultiple: true
--}}
@php
  $block_data = \App\Controllers\App::getBannerBlockData();
@endphp
@if(!empty($block_data))
  <div {!! $block_data['block_id'] !!} class="@php echo empty($block_data['banner_image']) ? 'no-image-banner' : ''  @endphp"
    @php echo $block_data['banner_image'] ? 'style="background-image:url(' .  $block_data['banner_image'] . ')"' : ''  @endphp>
    @unless(empty($block_data['banner_content']['title']))
      {!! $block_data['banner_content']['title'] !!}
    @endunless
    @unless(empty($block_data['banner_content']['txt']))
      {!! $block_data['banner_content']['txt'] !!}
    @endunless
    @unless(empty($block_data['banner_content']['image']))
    @endunless
    @unless(empty($block_data['banner_content']['link']))
      {!! \App\get_button_html($block_data['banner_content']['link'], 'btn-orange') !!}
    @endunless
  </div>
@elseif(is_admin())
  <h3>Banner Block</h3>
@endif
