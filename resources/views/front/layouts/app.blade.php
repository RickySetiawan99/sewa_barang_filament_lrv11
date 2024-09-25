<html>
	<head>
		<meta name="theme-color" content="#6777ef"/>
		<link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
		<link rel="manifest" href="{{ asset('/manifest.json') }}">
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="{{ asset('assets/images/icons/Star.svg') }}">
		<title>
			@yield('title')
		</title>
		<link href="{{ asset('/customcss') }}/output.css" rel="stylesheet" />
		<link href="{{ asset('/customcss') }}/main.css" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
	</head>
	<body>

		<main class="max-w-[640px] mx-auto min-h-screen flex flex-col relative has-[#Bottom-nav]:pb-[144px]">
			{{-- content --}}
			@yield('content')
		</main>

		{{-- file js --}}
		<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
		<script src="{{ asset('/customjs') }}/browse.js"></script>
		<script src="{{ asset('/sw.js') }}"></script>
		<script>
		if (!navigator.serviceWorker.controller) {
			navigator.serviceWorker.register("/sw.js").then(function (reg) {
				console.log("Service worker has been registered for scope: " + reg.scope);
			});
		}
		</script>
		@stack('js')

	</body>
</html>