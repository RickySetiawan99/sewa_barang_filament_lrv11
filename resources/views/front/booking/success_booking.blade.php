@extends('front.layouts.app')
@section('title', 'Finish Booking')
@section('content')
    <section id="finishBook" class="flex flex-col gap-[30px] max-w-[353px] p-[30px_20px] items-center m-auto">
        <div class="flex flex-col gap-2 items-center">
            <h1 class="text-2xl leading-[36px] font-bold">Finish Booking</h1>
            <p class="leading-[30px] text-[#6E6E70] text-center">Kami akan segera menghubungi anda untuk proses pemberian barang</p>
        </div>
        <div class="w-full h-[220px] flex items-center justify-center flex-shrink-0">
            <img src="{{ Storage::url($transaction->product->thumbnail) }}" alt="Thumbnail" class="size-full object-contain" />
        </div>
        <div class="flex flex-col gap-2 rounded-2xl overflow-hidden outline outline-1 outline-[#E9E8ED] p-4 w-full">
            <p class="font-semibold">Your Booking ID</p>
            <div class="flex items-center gap-3">
                <div class="w-[60px] h-[60px] flex shrink-0">
                    <img src="{{ asset('assets') }}/images/icons/crown-circle.svg" alt="icon" />
                </div>
                <div class="flex flex-col">
                    <p class="font-semibold">{{ $transaction->trx_id }}</p>
                    <p class="text-sm leading-[21px] text-[#6E6E70]">Protect your booking ID</p>
                </div>
            </div>
        </div>
        <div class="w-[220px] flex flex-col gap-3 items-center">
            <a href="{{ route('front.index') }}" class="w-full text-center rounded-full p-[12px_24px] bg-[#FCCF2F] font-bold text-black">Rent More</a>
            <a href="{{ route('front.transactions') }}" class="w-full text-center rounded-full p-[12px_24px] bg-white font-bold text-black outline outline-1">Booking Details</a>
        </div>
    </section>
@endsection

@push('js')
@endpush