<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
		@stack('js')

	</body>
</html>