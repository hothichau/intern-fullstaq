{{--
  Template Name: Home Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.home.home-header-banner')
    @include('partials.content-page')
  @endwhile
@endsection
