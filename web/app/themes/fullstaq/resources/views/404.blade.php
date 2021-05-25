@extends('layouts.app')

@section('content')
  @include('partials.page-header')
  @if (!have_posts())
    <div class="error-page-content text-center">
      @unless(empty($content_info['txt']))
        {!! $content_info['txt'] !!}
      @endunless
      @unless(empty($content_info['link']))
        {!! \App\get_button_html($content_info['link'], 'btn-orange') !!}
      @endunless
    </div>
  @endif
@endsection
