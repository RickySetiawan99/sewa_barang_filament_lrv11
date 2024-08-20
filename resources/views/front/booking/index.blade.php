@extends('front.layouts.app')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div id="Top-navbar" class="flex items-center justify-between px-5 pt-5">
        <a href="{{ route('front.details', $product->slug) }}">
            <div class="size-[44px] flex shrink-0">
                <img src="{{ asset('assets') }}/images/icons/arrow-left.svg" alt="icon" />
            </div>
        </a>
        <p class="text-lg leading-[27px] font-semibold">Booking</p>
        <button class="size-[44px] flex shrink-0">
            <img src="{{ asset('assets') }}/images/icons/more.svg" alt="icon" />
        </button>
    </div>
    <section id="Product-name" class="flex flex-col gap-3 px-5 mt-[30px]">
        <h2 class="font-semibold text-lg leading-[27px]">Product</h2>
        <div class="flex items-center gap-[14px]">
            <div class="w-20 h-20 flex shrink-0 rounded-2xl overflow-hidden bg-[#F6F6F6] items-center">
                <div class="w-full h-[50px] flex shrink-0 justify-center">
                    <img src="{{ Storage::url($product->thumbnail) }}"
                        class="h-full w-full object-contain" alt="thumbnail" />
                </div>
            </div>
            <div class="w-full flex flex-col gap-2">
                <p class="font-bold text-lg leading-[27px]">{{ $product->name }}</p>
                <div class="flex items-center gap-[14px]">
                    <div class="flex items-center w-fit gap-1">
                        <p class="font-semibold text-sm leading-[21px] text-[#6E6E70]">Original 100%</p>
                        <div class="w-5 h-5 flex shrink-0">
                            <img src="{{ asset('assets') }}/images/icons/verify.svg" alt="verify" />
                        </div>
                    </div>
                    <div class="flex items-center w-fit gap-1">
                        <p class="font-semibold text-sm leading-[21px] text-[#6E6E70]">Insurance</p>
                        <div class="w-5 h-5 flex shrink-0">
                            <img src="{{ asset('assets') }}/images/icons/verify.svg" alt="verify" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr class="mt-[30px] border-[#EDEEF0] mx-5" />
    <div class="flex flex-col gap-3 px-5 mt-[30px]">
        <h2 class="font-semibold text-lg leading-[27px]">Details</h2>
        <p class="text-sm leading-[24px] text-[#6E6E70]">Silahkan tuliskan details booking dengan teliti untuk
            menghindari kesalahan biaya sewa barang</p>
    </div>
    <a id="promo" href="#" class="px-5 mt-[30px]">
        <div class="w-full aspect-[353/100] flex shrink-0 overflow-hidden rounded-2xl">
            <img src="{{ asset('assets') }}/images/backgrounds/promo.png" class="w-full h-full object-cover" alt="promo" />
        </div>
    </a>
    <form method="POST" enctype="multipart/form-data" action="{{ route('front.booking_save', $product->slug) }}" class="flex flex-col gap-[30px] mt-[30px]">
        @csrf
        <input type="hidden" value="{{ $product->price }}" id="productPrice">
        <input type="hidden" name="duration" id="duration" value="1" class="absolute -z-10 opacity-0 w-1" required />
        <div class="flex items-center justify-between px-5">
            <label for="Days" class="font-semibold">How many days?</label>
            <div class="flex items-center gap-3 relative">
                <button type="button" id="Minus"
                    class="w-11 h-11 flex shrink-0 rounded-full transition-all duration-300 hover:ring-2 hover:ring-[#FCCF2F]">
                    <img src="{{ asset('assets') }}/images/icons/minus.svg" alt="minus" />
                </button>
                <p id="CountDays" class="font-semibold text-lg leading-[27px]">1</p>
                <input type="number" name="days" id="Days" value="1" class="absolute -z-10 opacity-0 w-1"
                    required />
                <button type="button" id="Plus"
                    class="w-11 h-11 flex shrink-0 rounded-full transition-all duration-300 hover:ring-2 hover:ring-[#FCCF2F]">
                    <img src="{{ asset('assets') }}/images/icons/plus.svg" alt="plus" />
                </button>
            </div>
        </div>
        <div class="flex flex-col px-5 gap-2">
            <label for="date" class="font-semibold">Started At</label>
            <div
                class="group w-full rounded-2xl border border-[#EDEEF0] p-[18px_14px] flex items-center gap-3 relative transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FCCF2F]">
                <div class="w-6 h-6 flex shrink-0">
                    <img src="{{ asset('assets') }}/images/icons/calendar.svg" alt="icon" />
                </div>
                <button type="button" id="DateTriggerBtn" class="w-full appearance-none text-left"
                    onclick="document.getElementById('date').showPicker()">Select date</button>
                <input type="date" name="started_at" id="date" class="absolute -z-10 opacity-0" required />
            </div>
        </div>
        <div class="flex flex-col px-5 gap-2">
            <label for="date" class="font-semibold">Delivery</label>
            <div id="Menus" class="flex flex-col gap-4">
                <div class="tab-link-btns flex items-center gap-4">
                    <label
                        class="tablink relative w-full rounded-2xl p-[18px_14px] border border-[#EDEEF0] font-semibold text-sm leading-[21px] transition-all duration-300 hover:ring-2 hover:ring-[#FCCF2F]"
                        onclick="openPage('pickup-tab', this)" id="defaultOpen">
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets') }}/images/icons/buildings.svg" alt="icon" />
                            </div>
                            <p>Pickup Store</p>
                        </div>
                        <input type="radio" name="delivery_type" id="Pickup" value="true"
                            class="absolute -z-10 top-1/2 left-1/2 opacity-0" onchange="toggleRequiredOptions()"
                            required />
                    </label>
                    <label
                        class="tablink relative w-full rounded-2xl p-[18px_14px] border border-[#EDEEF0] font-semibold text-sm leading-[21px] transition-all duration-300 hover:ring-2 hover:ring-[#FCCF2F]"
                        onclick="openPage('delivery-tab', this)">
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets') }}/images/icons/house-2.svg" alt="icon" />
                            </div>
                            <p>Delivery</p>
                        </div>
                        <input type="radio" name="delivery_type" id="Delivery" value="false"
                            class="absolute -z-10 top-1/2 left-1/2 opacity-0" onchange="toggleRequiredOptions()"
                            required />
                    </label>
                </div>
                <div class="tabs-contents">
                    <div id="pickup-tab" class="tabcontent flex flex-col gap-4 hidden">
                        @forelse ($stores as $store)
                            <label
                                class="relative w-full rounded-2xl p-[18px_14px] border border-[#EDEEF0] transition-all duration-300 hover:ring-2 hover:ring-[#FCCF2F] has-[:checked]:ring-2 has-[:checked]:ring-[#FCCF2F]">
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 flex shrink-0">
                                        <img src="{{ Storage::url($store->thumbnail) }}" alt="icon" />
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <p class="font-semibold text-sm leading-[21px]">{{ $store->name }}</p>
                                        <p class="text-xs leading-[18px] text-[#6E6E70]">{{ $store->address }}</p>
                                    </div>
                                </div>
                                <input type="radio" name="store_id" value="{{ $store->id }}"
                                    class="absolute -z-10 top-1/2 left-1/2 opacity-0" />
                            </label>
                        @empty
                            
                        @endforelse
                    </div>
                    <div id="delivery-tab" class="tabcontent flex flex-col hidden">
                        <div class="flex flex-col gap-1">
                            <p class="font-semibold text-sm leading-[21px]">Alamat Rumah</p>
                            <p class="text-xs leading-[22px] text-[#6E6E70]">Sebagai contoh Perumahan Citra Lestari
                                No 12, Blok B 11/7, Jawa Barat, Bogor, 40556</p>
                        </div>
                        <textarea name="address" id="address"
                            class="appearance-none outline-none rounded-2xl border border-[#EDEEF0] p-[14px] bg-white placeholder:text-[#6E6E70] placeholder:font-normal font-semibold text-sm leading-[26px] mt-[10px] resize-none transition-all duration-300 focus:ring-2 focus:ring-[#FCCF2F]"
                            placeholder="Tuliskan alamat rumah anda dengan lengkap agar memudahkan kurir"
                            rows="4" autocomplete="off"></textarea>
                        <div class="flex items-center rounded-2xl p-[18px_14px] gap-3 bg-[#F6F6F6] mt-5">
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets') }}/images/icons/ticket-discount-black.svg" alt="icon" />
                            </div>
                            <p class="text-sm leading-[24px] text-[#6E6E70]">Biaya kirim barang gratis untuk seluruh
                                pulau Indonesia, please enjoy!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="Bottom-nav"
            class="fixed bottom-0 max-w-[640px] w-full mx-auto border-t border-[#F1F1F1] overflow-hidden z-10">
            <div class="bg-white/50 backdrop-blur-sm absolute w-full h-full"></div>
            <div class="flex items-center justify-between p-5 relative z-10">
                <div class="flex flex-col gap-1 w-fit">
                    <p id="Total" class="font-bold text-xl leading-[30px]"></p>
                    <p class="text-sm leading-[21px]">Sub total</p>
                </div>
                <button type="submit"
                    class="rounded-full p-[12px_24px] bg-[#FCCF2F] font-bold w-fit">Checkout</button>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script src="{{ asset('customjs') }}/booking.js"></script>
@endpush