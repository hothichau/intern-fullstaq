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
  <div {!! $block_data['block_id'] !!} class="banner-block @php echo empty($block_data['banner_image']) ? 'no-image-banner' : ''  @endphp"
    @php echo $block_data['banner_image'] ? 'style="background-image:url(' .  $block_data['banner_image'] . ')"' : ''  @endphp>
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-5">
          <div class="banner-block__content text-center text-md-left">
            @unless(empty($block_data['banner_content']['title']))
              <h2 class="banner-block__title">{!! $block_data['banner_content']['title'] !!}</h2>
            @endunless
            @unless(empty($block_data['banner_content']['txt']))
              <div class="banner-block__text">{!! \App\cut_string_by_char($block_data['banner_content']['txt'], 150)  !!}</div>
            @endunless
            @unless(empty($block_data['banner_content']['image']))
              <img class="banner-block__img" src="{!! $block_data['banner_content']['image'] !!}" alt="banner-image">
            @endunless
            @unless(empty($block_data['banner_content']['link']))
              <div class="text-center text-md-left">{!! \App\get_button_html($block_data['banner_content']['link'], 'btn-orange') !!}</div>
            @endunless
          </div>
        </div>
      </div>
    </div>
  </div>
@elseif(is_admin())
  <h3>Banner Block</h3>
@endif
