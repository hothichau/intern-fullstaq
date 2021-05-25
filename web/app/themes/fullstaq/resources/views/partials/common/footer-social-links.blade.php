@foreach($footer_social_links['links'] as $link)
  @unless(empty($link['icon']) && empty($link['social_icon_class']))
    @if($link['custom_image'])
      @unless(empty($link['icon']['image']))
        <img src="{{ $link['icon']['image'] }}">
      @endunless
      @unless(empty($link['icon']['image_hover']))
        <img src="{{ $link['icon']['image_hover'] }}">
      @endunless
    @else
      @unless(empty($link['social_icon_class']))
        <i class="{{ $link['social_icon_class'] }}"></i>
      @endunless
    @endif
  @endunless
@endforeach
