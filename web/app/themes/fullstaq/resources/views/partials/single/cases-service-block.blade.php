@php use Illuminate\Support\Arr  @endphp
@unless(empty($service_block))
  @php $partial_slug = 'partials.single.cases-service-block-column' @endphp
  <section>
    @unless(empty($service_block['column_1']['title']) || empty(Arr::get($service_block, 'column_1.icon.ico', '')) || empty($service_block['column_1']['txt']))
      @include($partial_slug, $service_block['column_1'])
    @endunless
    @unless(empty($service_block['column_2']['title']) || empty(Arr::get($service_block, 'column_2.icon.ico', '')) || empty($service_block['column_2']['txt']))
      @include($partial_slug, $service_block['column_2'])
    @endunless
    @unless(empty($service_block['column_3']['title']) || empty(Arr::get($service_block, 'column_3.icon.ico', '')) || empty($service_block['column_3']['links']))
      @include($partial_slug, $service_block['column_3'])
    @endunless
  </section>
@endunless
@dump($service_block)
