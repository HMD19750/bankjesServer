<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Even Uitrusten</title>
   {{-- <link rel="apple-touch-icon" sizes="150x150" href="asset('js/assets/images/app_icon_150.png')}}"> --}}
    <link rel="apple-touch-icon" sizes="150x150" href="images/app_icon_150.png">
    <meta name="keywords" content="bankjes, picnicbankjes,schuilhutten,wandelen,nederland,belgie">
    <meta name="description" content="Voor wandelaars: alle bankjes, picnicbankjes en schuilhutten in Nederland, Belgie en Luxemburg.">
</head>

<body>

    <div id="app">
        
        <map-app/>
    </div>

    <script type='text/javascript' src="{{ asset('js/app.js') }}"></script>

</body>

</html>
