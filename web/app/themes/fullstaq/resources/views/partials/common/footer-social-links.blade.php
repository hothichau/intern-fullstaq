<div class="footer-social d-flex justify-content-center align-items-center">
  @foreach($footer_social_links['links'] as $link)
    @unless(empty($link['icon']) && empty($link['social_icon_class']))
      <a class="footer-social__link" href=" {{ $link['url'] }}">
        @if($link['custom_image'])
          @unless(isset($link['icon']['image']))
            <img class="footer-social__icon footer-social__icon--normal" src="{{ $link['icon']['image'] }}" alt="{{  $link['name'] }}">
          @endunless
          @unless(empty($link['icon']['image_hover']))
            <img class="footer-social__icon footer-social__icon--hover" src="{{ $link['icon']['image_hover'] }}" alt="{{  $link['name'] }}">
          @endunless
        @else
          @unless(empty($link['social_icon_class']))
            <i class="{{ $link['social_icon_class'] }}"></i>
          @endunless
        @endif
      </a>
    @endunless
  @endforeach
</div>
