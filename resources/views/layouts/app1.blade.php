<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>{{ config('app.name', 'LSAPP') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    
</head>
<body>
  @include('inc.navbar')
  <div class="container">
     @include('inc.messages')
     @yield('content')
  </div>
  <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
       CKEDITOR.replace('article-ckeditor');
       CKEDITOR.replace('edit-article-ckeditor');
</script>
     
</body>
</html>
