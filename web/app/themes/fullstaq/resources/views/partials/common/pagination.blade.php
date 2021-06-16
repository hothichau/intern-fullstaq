@if ($post_query->max_num_pages > 1)
  <div class="pagination text-center">
    {!! \App\pagination($post_query->max_num_pages, ['current' => !empty($current) ? $current : max(1, get_query_var('paged'))]) !!}
    {!! wp_reset_query() !!}
  </div>
@endif
