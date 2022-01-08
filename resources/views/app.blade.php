<!DOCTYPE html>
<html class="h-full">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="Report, submit and browse issues/features of the Stakenet DEX ">
    <title inertia>{{ config('app.name', 'Stakenet DEX Feedbacks') }}</title>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="36x36" href="/favicon-36x36.png">
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @routes
  </head>
  <body class="h-full">
    @inertia
  </body>
</html>
