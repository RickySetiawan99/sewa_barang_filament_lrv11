@extends('front.layouts.app')

@section('content')
	<div id="Top-navbar" class="flex items-center justify-between pt-5 px-5">
		<a href="{{ route('front.index') }}" class="flex shrink-0">
			<img src="{{ asset('assets') }}/images/logos/logo.svg" alt="logo" />
		</a>
		<a href="#" class="w-11 h-11 flex shrink-0">
			<img src="{{ asset('assets') }}/images/icons/notifications.svg" alt="icon" />
		</a>
	</div>
	<section id="Categories" class="flex flex-col gap-[10px] mt-[30px] px-5">
		<h2 class="font-semibold text-lg leading-[27px]">By Categories</h2>
		<div class="grid grid-cols-3 gap-4">
			@forelse ($categories as $category)
				<a href="{{ route('front.category', $category->slug) }}" class="card">
					<div class="rounded-2xl ring-1 ring-[#EDEEF0] p-4 flex flex-col items-center gap-3 text-center transition-all duration-300 hover:ring-2 hover:ring-[#FCCF2F]">
						<div class="w-[50px] h-[50px] flex shrink-0">
							<img src="{{ Storage::url($category->icon) }}" alt="icon" />
						</div>
						<p class="font-semibold">{{ $category->name }}</p>
					</div>
				</a>
			@empty
				<p>Belum ada kategori terbaru</p>
			@endforelse
		</div>
	</section>
	<a id="promo" href="#" class="px-5 mt-[30px]">
		<div class="w-full aspect-[353/100] flex shrink-0 overflow-hidden rounded-2xl">
			<img src="{{ asset('assets') }}/images/backgrounds/promo.png" class="w-full h-full object-cover" alt="promo" />
		</div>
	</a>
	<section id="New" class="flex flex-col gap-[10px] mt-[30px]">
		<h2 class="font-semibold text-lg leading-[27px] px-5">Brand New</h2>
		<div class="swiper w-full h-fit">
			<div class="swiper-wrapper">
				@forelse ($latest_products as $item)
					<a href="{{ route('front.details', $item->slug) }}" class="swiper-slide max-w-[150px] first-of-type:ml-5 last-of-type:mr-5">
						<div class="flex flex-col gap-3 bg-white">
							<div class="h-[130px] flex shrink-0 items-center rounded-2xl overflow-hidden bg-[#F6F6F6]">
								<div class="h-[70px] w-full flex shrink-0 justify-center">
									<img src="{{ Storage::url($item->thumbnail) }}" class="w-full h-full object-contain" alt="thumbnail" />
								</div>
							</div>
							<div class="flex flex-col gap-1">
								<p class="font-semibold break-words">{{ $item->name }}</p>
								<div class="flex items-center justify-between">
									<p class="text-sm leading-[21px] text-[#6E6E70]">{{ $item->category->name }}</p>
									<div class="flex items-center gap-[2px]">
										<div class="w-4 h-4 flex shrink-0">
											<img src="{{ asset('assets') }}/images/icons/Star 1.svg" alt="star" />
										</div>
										<p class="font-semibold text-sm leading-[21px]">4/5</p>
									</div>
								</div>
							</div>
						</div>
					</a>
				@empty
					<p>Belum ada produk terbaru</p>
				@endforelse
			</div>
		</div>
	</section>
	<section id="Recommendation" class="flex flex-col gap-[10px] mt-[30px] px-5">
		<h2 class="font-semibold text-lg leading-[27px]">You Might Like</h2>
		<div class="flex flex-col gap-5">
			@forelse ($random_products as $item)
				<a href="{{ route('front.details', $item->slug) }}" class="card">
					<div class="flex items-center gap-3">
						<div class="w-20 h-20 flex shrink-0 rounded-2xl overflow-hidden bg-[#F6F6F6] items-center">
							<div class="w-full h-[50px] flex shrink-0 justify-center">
								<img src="{{ Storage::url($item->thumbnail) }}" class="h-full w-full object-contain" alt="thumbnail" />
							</div>
						</div>
						<div class="w-full flex flex-col gap-1">
							<p class="font-semibold">{{ $item->name }}</p>
							<div class="flex items-center justify-between">
								<p class="text-sm leading-[21px] text-[#6E6E70]">Rp {{ number_format($item->price, 0, ',', '.') }}/day</p>
								<div class="flex items-center w-fit gap-[2px]">
									<div class="w-4 h-4 flex shrink-0">
										<img src="{{ asset('assets') }}/images/icons/Star 1.svg" alt="star" />
									</div>
									<p class="text-sm leading-[21px]"><span class="font-semibold">4/5</span> <span class="text-[#6E6E70]">(777)</span></p>
								</div>
							</div>
						</div>
					</div>
				</a>
			@empty
				<p>Belum ada produk terbaru</p>
			@endforelse
		</div>
	</section>
	@include('front.layouts.components.bottom_nav')
@endsection

@push('js')
@endpush