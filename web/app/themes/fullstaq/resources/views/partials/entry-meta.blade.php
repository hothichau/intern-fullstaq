@php
  $post_id = !empty($id) ? $id : get_the_ID();
  $category = App\get_primary_category($post_id)
@endphp
{{ get_the_date(get_option('date_format'), $post_id) }}
@if(!empty($category->name))
  {!! $category->name !!}
@endif

