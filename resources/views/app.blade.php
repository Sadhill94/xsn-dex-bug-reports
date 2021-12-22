<!DOCTYPE html>
<html class="h-full">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="Report and browse issues of the Stakenet DEX ">
    <title inertia>{{ config('app.name', 'Stakenet DEX bug reports') }}</title>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @routes
  </head>
  <body class="h-full">
    @inertia
  </body>
</html>
