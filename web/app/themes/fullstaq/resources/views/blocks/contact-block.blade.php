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
  <div {!! $block_data['block_id'] !!} class="contact-block contact-block--gtb">
    @unless(empty($block_data['block_title']))
      <h2 class="text-center">{!! $block_data['block_title'] !!}</h2>
    @endunless
    <div class="contact-block__wrapper">
      <div class="contact-block__background-sm-visible" {!! !empty($block_data['banner_image']) ? 'style="background-image:url(' . $block_data['banner_image'] .  ')"' : ''  !!} ></div>
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-5 contact-block__background" {!! !empty($block_data['banner_image']) ? 'style="background-image:url(' . $block_data['banner_image'] .  ')"' : ''  !!}>
            <div class="contact-block__background-info">
              <div class="contact-block__background-content">
                {!! $block_data['banner_content'] !!}
              </div>
              @if(!empty($block_data['phone']['phone_txt']) && !empty($block_data['phone']['phone_number']))
                <p class="contact-block__background-phone">
                  <a href="tel:{!! $block_data['phone']['phone_number'] !!}">
                    {!! $block_data['phone']['phone_txt'] !!}
                  </a>
                </p>
              @endif
              <p class="contact-block__background-address">
                {!! $block_data['address'] !!}
              </p>
            </div>
          </div>
          <div class="col-12 col-sm-7 contact-block__form">
            {!! do_shortcode( '[gravityform id="'.$block_data['form'].'" ajax="true" title="true" description="true"]') !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@elseif(is_admin())
  <h3>Contact Block</h3>
@endif

