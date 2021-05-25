@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @if(!is_singular('jobs'))
      @include('partials.page-header')
    @else
      @include('partials.careers.careers-header-banner')
      @include('partials.common.breadcrumb')
    @endif
    @include('partials.content-single-'.get_post_type())
  @endwhile
@endsection
