@extends('front.layouts.app')
@section('title', 'Booking Details')
@section('content')
    <div id="Top-navbar" class="flex items-center justify-between px-5 pt-5">
        <a href="{{ route('front.success.booking', $transaction) }}">
            <div class="size-[44px] flex shrink-0">
                <img src="{{ asset('assets') }}/images/icons/arrow-left.svg" alt="icon" />
            </div>
        </a>
        <p class="text-lg leading-[27px] font-semibold">Booking Details</p>
        <button class="size-[44px] flex shrink-0">
            <img src="{{ asset('assets') }}/images/icons/more.svg" alt="icon" />
        </button>
    </div>
    <section class="flex flex-col gap-[30px] mt-[30px] px-5">
        <div class="flex items-center rounded-2xl border border-[#E9E8ED] gap-2 p-4">
            <div class="w-[60px] h-[60px] flex shrink-0">
                <img src="{{ asset('assets') }}/images/icons/crown-circle.svg" alt="icon">
            </div>
            <div class="flex flex-col">
                <p class="font-semibold">{{ $details->trx_id }}</p>
                <p class="text-sm leading-[21px] text-[#6E6E70]">Protect your booking ID</p>
            </div>
        </div>
        <hr class="border-[#EDEEF0]">
        @if ($details->is_paid == 1)
            <div id="Payment-success" class="flex items-center rounded-2xl p-[14px_16px] gap-4 bg-black text-white">
                <div class="w-6 h-6 flex shrink-0">
                    <img src="{{ asset('assets') }}/images/icons/note-white.svg" alt="icon">
                </div>
                <div class="flex flex-col gap-1">
                    <div class="flex items-center gap-1">
                        <p class="font-semibold text-sm leading-[21px]">Payment Success</p>
                        <div class="w-5 h-5 flex shrink-0">
                            <img src="{{ asset('assets') }}/images/icons/verify.svg" alt="icon">
                        </div>
                    </div>
                    <p class="text-xs leading-[18px]">Pembayaran Anda sudah kami terima dan silahkan menunggu instruksi selanjutnya</p>
                </div>
            </div>
        @else     
            <div id="Payment-pending" class="flex items-center rounded-2xl p-[14px_16px] gap-4 bg-[#FCCF2F]">
                <div class="w-6 h-6 flex shrink-0">
                    <img src="{{ asset('assets') }}/images/icons/note-black.svg" alt="icon">
                </div>
                <div class="flex flex-col gap-1">
                    <div class="flex items-center gap-1">
                        <p class="font-semibold text-sm leading-[21px]">Payment Pending</p>
                    </div>
                    <p class="text-xs leading-[18px]">Tim kami sedang memeriksa transaksi ada pada booking berikut</p>
                </div>
            </div>
        @endif
        
        <hr class="border-[#EDEEF0]">
        <div class="flex items-center gap-[14px]">
            <div class="w-20 h-20 flex shrink-0 rounded-2xl overflow-hidden bg-[#F6F6F6] items-center">
                <div class="w-full h-[50px] flex shrink-0 justify-center">
                    <img src="{{ Storage::url($details->product->thumbnail) }}" class="h-full w-full object-contain" alt="thumbnail">
                </div>
            </div>
            <div class="w-full flex flex-col gap-2">
                <p class="font-bold text-lg leading-[27px]">{{ $details->product->name }}</p>
                <div class="flex items-center gap-[14px]">
                    <div class="flex items-center w-fit gap-1">
                        <p class="font-semibold text-sm leading-[21px] text-[#6E6E70]">Original 100%</p>
                        <div class="w-5 h-5 flex shrink-0">
                            <img src="{{ asset('assets') }}/images/icons/verify.svg" alt="verify">
                        </div>
                    </div>
                    <div class="flex items-center w-fit gap-1">
                        <p class="font-semibold text-sm leading-[21px] text-[#6E6E70]">Insurance</p>
                        <div class="w-5 h-5 flex shrink-0">
                            <img src="{{ asset('assets') }}/images/icons/verify.svg" alt="verify">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="flex flex-col gap-5">
            <div class="info-card flex flex-col gap-2">
                <p class="font-semibold">Full Name</p>
                <div class="flex items-center rounded-2xl p-[18px_14px] gap-3 bg-[#F4F4F6]">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ asset('assets') }}/images/icons/user.svg" alt="icon">
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="font-semibold">{{ $details->name }}</p>
                    </div>
                </div>
            </div>
            <div class="info-card flex flex-col gap-2">
                <p class="font-semibold">Phone Number</p>
                <div class="flex items-center rounded-2xl p-[18px_14px] gap-3 bg-[#F4F4F6]">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ asset('assets') }}/images/icons/call.svg" alt="icon">
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="font-semibold">{{ $details->phone_number }}</p>
                    </div>
                </div>
            </div>
            <div class="info-card flex flex-col gap-2">
                <p class="font-semibold">Started At</p>
                <div class="flex items-center rounded-2xl p-[18px_14px] gap-3 bg-[#F4F4F6]">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ asset('assets') }}/images/icons/calendar.svg" alt="icon">
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="font-semibold">{{ App\Helpers\Helper::formatDate($details->started_at) }}</p>
                    </div>
                </div>
            </div>
            <div class="info-card flex flex-col gap-2">
                <p class="font-semibold">Ended At</p>
                <div class="flex items-center rounded-2xl p-[18px_14px] gap-3 bg-[#F4F4F6]">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ asset('assets') }}/images/icons/calendar.svg" alt="icon">
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="font-semibold">{{ App\Helpers\Helper::formatDate($details->ended_at) }}</p>
                    </div>
                </div>
            </div>
            @if ($details->delivery_type == 'pickup')
                <div class="info-card flex flex-col gap-2">
                    <p class="font-semibold">Pick Up At</p>
                    <div class="flex items-center rounded-2xl p-[18px_14px] gap-3 bg-[#F4F4F6]">
                        <div class="w-6 h-6 flex shrink-0">
                            <img src="{{ asset('assets') }}/images/icons/buildings.svg" alt="icon">
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="font-semibold">{{ $details->store->name }}</p>
                            <p class="text-sm leading-[21px] text-[#6E6E70]">{{ $details->store->address }} </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="info-card flex flex-col gap-2">
                    <p class="font-semibold">Home Deliver to</p>
                    <div class="flex items-center rounded-2xl p-[18px_14px] gap-3 bg-[#F4F4F6]">
                        <div class="w-6 h-6 flex shrink-0">
                            <img src="{{ asset('assets') }}/images/icons/house-2.svg" alt="icon">
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="font-semibold">{{ $details->address }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </section>
        <hr class="border-[#EDEEF0]">
        <div id="Payment-details" class="flex flex-col gap-3">
            <h2 class="font-semibold text-lg leading-[27px]">Payment Details</h2>
            <div class="flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <p>Sub total</p>
                    <p class="font-semibold">Rp {{ number_format($subTotal, 0, ',', '.') }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p>PPN 11%</p>
                    <p class="font-semibold">Rp {{ number_format($totalPpn, 0, ',', '.') }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p>Insurance</p>
                    <p class="font-semibold">Rp {{ number_format($insurance, 0, ',', '.') }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p>Grand total</p>
                    <p class="font-bold text-xl leading-[30px] underline">Rp {{ number_format($details->total_amount, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </section>
    <div id="Bottom-nav" class="fixed bottom-0 max-w-[640px] w-full mx-auto border-t border-[#F1F1F1] overflow-hidden z-10">
        <div class="bg-white/50 backdrop-blur-sm absolute w-full h-full"></div>
        <div class="flex items-center justify-between p-5 relative z-10">
            <a href="https://wa.me/+6287786068778" class="rounded-full p-[12px_24px] bg-[#FCCF2F] font-bold w-full text-center">Contact Customer Service</a>
        </div>
    </div>
@endsection