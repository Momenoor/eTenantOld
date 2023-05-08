    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico')}}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    @if (config('backpack.base.meta_robots_content'))<meta name="robots" content="{{ config('backpack.base.meta_robots_content', 'noindex, nofollow') }}"> @endif

    <meta name="csrf-token" content="{{ csrf_token() }}" /> {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
    <title>{{ isset($title) ? $title.' :: '.config('backpack.base.project_name') : config('backpack.base.project_name') }}</title>

    @yield('before_styles')
    @stack('before_styles')

    @foreach(config('backpack.base.styles', []) as $path)
        <link rel="stylesheet" type="text/css" href="{{ asset($path).'?v='.config('backpack.base.cachebusting_string') }}">
    @endforeach

    @foreach(config('backpack.base.mix_styles', []) as $path => $manifest)
        <link rel="stylesheet" type="text/css" href="{{ mix($path, $manifest) }}">
    @endforeach

    @if(!empty(config('backpack.base.vite_styles', [])))
        @vite(config('backpack.base.vite_styles', []))
    @endif

    @yield('after_styles')
    @stack('after_styles')

