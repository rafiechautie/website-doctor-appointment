<!DOCTYPE html>
<html lang="en">
  <head>
    @include('includes.frontsite.meta')
    <title>@yield('title') | MeetDoctor</title>

    @stack('before-style')
    @include('includes.frontsite.style')
    @stack('after-style')
</head>
<body>
    @yield('content')
    {{-- modals --}}
    {{-- if you have any modals, create here  --}}
</body>
</html>