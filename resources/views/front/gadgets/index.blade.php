@extends('front.layouts.app')

@section('content')
    <div id="Top-navbar" class="flex items-center justify-between px-5 pt-5 w-full">
        <a href="{{ route('front.category', $category->slug) }}">
            <div class="size-[44px] flex shrink-0">
                <img src="{{ asset('assets') }}/images/icons/arrow-left.svg" alt="icon" />
            </div>
        </a>
        <p class="text-lg leading-[27px] font-semibold">Choose Product</p>
        <button class="size-[44px] flex shrink-0">
            <img src="{{ asset('assets') }}/images/icons/more.svg" alt="icon" />
        </button>
    </div>
    <section id="brand"
        class="flex p-[24px_20px] outline outline-1 outline-[#EDEEF0] rounded-2xl overflow-hidden items-center justify-between mt-[30px] mx-5">
        <div class="h-[30px] flex shrink-0">
            <img src="{{ Storage::url($brand->logo) }}" alt="brand" class="size-full" />
        </div>
        <div class="flex flex-col items-end gap-[2x]">
            <p class="font-semibold">{{ $brand->name }}</p>
            <p class="text-sm leading-[21px] text-[#6E6E70] text-nowrap">{{ $brand->products->count() }} Products</p>
        </div>
    </section>
    <section id="Explore" class="flex flex-col gap-[10px] mx-5 mt-[30px]">
        <h2 class="text-lg leading-[27px] font-semibold">Explore Phones</h2>
        <div class="flex flex-col gap-5">
            @forelse ($products as $product)
                <a href="{{ route('front.details', $product->slug) }}" class="card">
                    <div class="flex items-center gap-3">
                        <div class="w-20 h-20 flex shrink-0 rounded-2xl overflow-hidden bg-[#F6F6F6] items-center">
                            <div class="w-full h-[50px] flex shrink-0 justify-center">
                                <img src="{{ Storage::url($product->thumbnail) }}"
                                    class="h-full w-full object-contain" alt="thumbnail" />
                            </div>
                        </div>
                        <div class="w-full flex flex-col gap-1">
                            <p class="font-semibold">{{ $product->name }}</p>
                            <div class="flex items-center justify-between">
                                <p class="text-sm leading-[21px] text-[#6E6E70]">Rp {{ number_format($product->price, 0, ',', '.') }}/day</p>
                                <div class="flex items-center w-fit gap-[2px]">
                                    <div class="w-4 h-4 flex shrink-0">
                                        <img src="{{asset('assets')}}/images/icons/Star 1.svg" alt="star" />
                                    </div>
                                    <p class="text-sm leading-[21px]"><span class="font-semibold">4/5</span> <span
                                            class="text-[#6E6E70]">(777)</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <p>Belum ada produk dari brand {{ $brand->name }} dan kategori ini</p>
            @endforelse
        </div>
    </section>
@endsection

@push('js')
@endpush