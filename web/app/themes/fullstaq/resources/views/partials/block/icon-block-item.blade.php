@php $image_2x = !empty($icon_data['icon_image_2x']) ? 'srcset="' . $icon_data['icon_image_2x'] . ' 2x"' : '' @endphp
@unless(empty($icon_data['icon_image']))
  @unless(empty($icon_data['link']))
  @endunless
    @unless(empty($icon_data['title']))
      {!! $icon_data['title'] !!}
    @endunless
    @unless(empty($icon_data['text']))
      {!! $icon_data['text'] !!}
    @endunless
  @unless(empty($icon_data['link']))
  @endunless
@endunless
