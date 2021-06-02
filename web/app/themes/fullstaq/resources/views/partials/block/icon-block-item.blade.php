@php $image_2x = !empty($icon_data['icon_image_2x']) ? 'srcset="' . $icon_data['icon_image_2x'] . ' 2x"' : '' @endphp
@unless(empty($icon_data['icon_image']))
  <div class="icons-block__item">
    @unless(empty($icon_data['link']))
      <a class="icons-block__item-link" href="{{ $icon_data['link'] }}">
    @endunless
      <div class="icons-block__item-thumb d-flex justify-content-center">
        <img class="icons-block__item-img" src="{!! $icon_data['icon_image'] !!}" {!! $image_2x !!} alt="{{ $icon_data['title'] }}">
      </div>

      @unless(empty($icon_data['title']))
        <h3 class="icons-block__item-title">{!! $icon_data['title'] !!}</h3>
      @endunless
      @unless(empty($icon_data['text']))
        <p class="icons-block__item-description">{!! $icon_data['text'] !!}</p>
      @endunless
    @unless(empty($icon_data['link']))
      </a>
    @endunless
  </div>
@endunless
