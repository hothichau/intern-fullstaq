{{--
  Template Name: Careers Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.careers.careers-header-banner')
    @include('partials.common.breadcrumb')
    @include('partials.content-page')
    <div class="js-content-loading" data-type="jobs">
      @include('partials.careers.careers-job-list')
    </div>
  @endwhile
@endsection
