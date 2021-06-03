@php $image_2x = !empty($icon_data['icon_image_2x']) ? 'srcset="' . $icon_data['icon_image_2x'] . ' 2x"' : '' @endphp
@unless(empty($icon_data['icon_image']))
  <div class="icon-item">
    @unless(empty($icon_data['link']))
      <a class="icon-item-link" href="{{ $icon_data['link'] }}">
    @endunless
      <div class="icon-item-thumb d-flex justify-content-center">
        <img class="icon-item-img" src="{!! $icon_data['icon_image'] !!}" {!! $image_2x !!} alt="{{ $icon_data['title'] }}">
      </div>
      @unless(empty($icon_data['title']))
        <h3 class="icon-item-title">{!! $icon_data['title'] !!}</h3>
      @endunless
      @unless(empty($icon_data['text']))
        <p class="icon-item-description">{!! $icon_data['text'] !!}</p>
      @endunless
    @unless(empty($icon_data['link']))
      </a>
    @endunless
  </div>
@endunless
