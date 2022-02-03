<!DOCTYPE html>
<html class="h-full">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- Primary Meta Tags -->
    <title inertia>{{ config('app.name', 'Stakenet DEX Feedbacks') }}</title>
    <meta name="title" content="Stakenet DEX Feedbacks">
    <meta name="description" content="Report, submit and browse issues/features of the Stakenet DEX">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://dex-feedbacks.stakenet.info/">
    <meta property="og:title" content="Stakenet DEX Feedbacks">
    <meta property="og:description" content="Report, submit and browse issues/features of the Stakenet DEX">
    <meta property="og:image" content="/xsn-logo-black.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://dex-feedbacks.stakenet.info/">
    <meta property="twitter:title" content="Stakenet DEX Feedbacks">
    <meta property="twitter:description" content="Report, submit and browse issues/features of the Stakenet DEX">
    <meta property="twitter:image" content="/xsn-logo-black.png">


    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="36x36" href="/favicon-36x36.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @routes
  </head>
  <body class="h-full">
    @inertia
  </body>
</html>
