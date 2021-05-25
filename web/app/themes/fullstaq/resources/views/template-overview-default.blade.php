{{--
  Template Name: Default Overview Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    <div class="js-content-loading" data-type="{{ $queried_post_type }}">
      @include('partials.overview.overview-list')
    </div>
    @include('partials.content-page')
  @endwhile
@endsection
