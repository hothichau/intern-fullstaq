@php
  $post_id = !empty($id) ? $id : get_the_ID();
  $category = App\get_primary_category($post_id);
  $is_cases_type = get_post_type($post_id) === 'cases' ;
@endphp
<div class="time-cate">
  @if (is_singular('post'))
    <span class="time-cate__author">{{ sprintf(__('by %s', 'fullstaq'), get_the_author()) }}</span>
    <span class="time-cate__line">|</span>
  @endif
  @if (!$is_cases_type)
    <span class="time-cate__time text-uppercase">
      {{ get_the_date(get_option('date_format'), $post_id) }}
    </span>
  @endif
  @if(!empty($category->name))
    @if (!$is_cases_type)
      <span class="time-cate__line">|</span>
    @endif
    <span class="time-cate__category">{!! $category->name !!}</span>
  @endif
</div>
