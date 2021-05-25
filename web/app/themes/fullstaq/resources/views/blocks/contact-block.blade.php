{{--
  Title: Contact Block
  Description: Block with form and banner
  Category: acf-blocks
  Icon: align-left
  Keywords: contact form
  Mode: edit
  Align: none
  PostTypes: page post cases jobs
  SupportsAlign: false
  SupportsMultiple: true
--}}
@php
  $block_data = \App\Controllers\App::getContactBlockData();
@endphp
@if(!empty($block_data))
  <div {!! $block_data['block_id'] !!}>
    @unless(empty($block_data['block_title']))
      {!! $block_data['block_title'] !!}
    @endunless
    <div>
      <div {!! !empty($block_data['banner_image']) ? 'style="background-image:url(' . $block_data['banner_image'] .  ')"' : ''  !!} ></div>
        <div {!! !empty($block_data['banner_image']) ? 'style="background-image:url(' . $block_data['banner_image'] .  ')"' : ''  !!}>
            {!! $block_data['banner_content'] !!}

            {!! $block_data['phone'] !!}

            {!! $block_data['address'] !!}

          {!! do_shortcode( '[gravityform id="'.$block_data['form'].'" ajax="true" title="true" description="true"]') !!}
        </div>
      </div>
    </div>
  </div>
@elseif(is_admin())
  <h3>Contact Block</h3>
@endif
