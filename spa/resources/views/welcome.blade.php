<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel SPA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css">
    <link rel="stylesheet" href="{{ mix ('/css/app.css') }}">
</head>

<body>
    <div id="app">
        <product-component></product-component>
        <progress-bar></progress-bar>
    </div>
    <script src="{{ mix ('/js/app.js') }}"></script>
</body>

</html>