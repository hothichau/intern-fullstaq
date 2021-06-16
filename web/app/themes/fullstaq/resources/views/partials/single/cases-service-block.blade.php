@php use Illuminate\Support\Arr  @endphp
@unless(empty($service_block))
  @php $partial_slug = 'partials.single.cases-service-block-column' @endphp
  <section class="service-block--cases">
    <div class="container">
      <div class="row">
        @unless(empty($service_block['column_1']['title']) || empty(Arr::get($service_block, 'column_1.icon.ico', '')) || empty($service_block['column_1']['txt']))
        <div class="col-lg-4 service-block__item">
          @include($partial_slug, $service_block['column_1'])
        </div>
        @endunless
        @unless(empty($service_block['column_2']['title']) || empty(Arr::get($service_block, 'column_2.icon.ico', '')) || empty($service_block['column_2']['txt']))
        <div class="col-lg-4 service-block__item">
          @include($partial_slug, $service_block['column_2'])
        </div>
        @endunless
        @unless(empty($service_block['column_3']['title']) || empty(Arr::get($service_block, 'column_3.icon.ico', '')) || empty($service_block['column_3']['links']))
        <div class="col-lg-4 service-block__item">
          @include($partial_slug, $service_block['column_3'])
        </div>
        @endunless
      </div>
    </div>
  </section>
@endunless
