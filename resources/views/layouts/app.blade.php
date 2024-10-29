<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
 
    <title>
        tourbinou
    </title>
 
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

</head>

<body class="{{ $class ?? '' }}">
    
    @include('layouts.header')
    
    <div class="content">
        @yield('content') <!-- Aqui é onde o conteúdo será inserido -->
    </div>

    {{-- @include('layouts.footer') <!-- Por exemplo --> --}}

    @stack('js')
    @yield('scripts')
</body>

</html>