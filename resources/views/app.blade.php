<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="theme-color" content="#ffffff">
	<!-- Search engines -->
	<meta name="description" content="Profile Kerja untuk Skills Malaysia">
	<!-- Google Plus -->
	<!-- Update your html tag to include the itemscope and itemtype attributes. -->
	<!-- html itemscope itemtype="http://schema.org/{CONTENT_TYPE}" -->
	<meta itemprop="name" content="Profile Kerja">
	<meta itemprop="description" content="Profile Kerja untuk Skills Malaysia">
	<meta itemprop="image" content="http://profilekerja.com/icon.png">
	<!-- Twitter -->
	<meta name="twitter:card" content="Profile Kerja">
	<meta name="twitter:site" content="@zuljzul">
	<meta name="twitter:title" content="Profile Kerja">
	<meta name="twitter:description" content="Profile Kerja untuk Skills Malaysia">
	<meta name="twitter:creator" content="@zuljzul">
	<meta name="twitter:image:src" content="http://profilekerja.com/icon.png">
	<meta name="twitter:player" content="">
	<!-- Open Graph General (Facebook & Pinterest) -->
	<meta property="og:url" content="http://profilekerja.com">
	<meta property="og:title" content="Profile Kerja">
	<meta property="og:description" content="Profile Kerja untuk Skills Malaysia">
	<meta property="og:site_name" content="Profile Kerja">
	<meta property="og:image" content="http://profilekerja.com/icon.png">
	<meta property="fb:admins" content="">
	<meta property="fb:app_id" content="">
	<meta property="og:type" content="">
	<meta property="og:locale" content="">
	<meta property="og:audio" content="">
	<meta property="og:video" content="">
	<title>{{ app('config')->get('app.name') }}</title>

	<link rel="stylesheet" href="{{ elixir("assets/build.css") }}">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	@yield('styles')

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	@include('partials.navbar')
	@include('partials.notification')

	<div class="container">{!! app('menu')->handler('breadcrumbs')->render('breadcrumbs') !!}</div>

	@yield('content')

	<!-- Scripts -->
	<script src="{{ elixir("assets/build.js") }}"></script>
	@yield('scripts')
</body>
</html>
