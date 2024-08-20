@extends('front.layouts.app')

@section('content')
    <section id="CheckBook" class="w-full flex flex-col gap-10 px-5 items-center pt-20 max-w-[353px] m-auto">
        <div class="size-[100px] rounded-full overflow-hidden bg-[#FCCF2F] flex items-center justify-center">
            <div class="flex shrink-0 size-[46px]">
                <img src="{{ asset('assets') }}/images/icons/crown.svg" alt="crown" class="size-full" />
            </div>
        </div>
        <div class="flex flex-col gap-2 items-center">
            <h1 class="text-2xl leading-[36px] font-bold">Check Booking</h1>
            <p class="leading-[30px] text-[#6E6E70] text-center">Masukkan details berikut untuk melihat status pemesanan Anda saat ini</p>
        </div>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="py-3 w-full rounded-3xl bg-[#FCCF2F] text-white">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <form method="POST" action="{{ route('front.transaction.details') }}" class="flex flex-col gap-5 rounded-[20px] overflow-hidden outline outline-1 outline-[#E9E8ED] p-5 w-full">
            @csrf
            <div class="flex flex-col gap-2">
                <label for="phone" class="font-semibold">Phone Number</label>
                <div class="group w-full rounded-2xl border border-[#EDEEF0] p-[18px_14px] flex items-center gap-3 relative transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FCCF2F]">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ asset('assets') }}/images/icons/call.svg" alt="icon" />
                    </div>
                    <input type="tel" name="phone_number" id="phone" class="appearance-none outline-none w-full placeholder:font-normal placeholder:text-black font-semibold text-sm leading-[24px]" placeholder="Write your phone number" required />
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label for="bookId" class="font-semibold">Book ID</label>
                <div class="group w-full rounded-2xl border border-[#EDEEF0] p-[18px_14px] flex items-center gap-3 relative transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FCCF2F]">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ asset('assets') }}/images/icons/crown.svg" alt="icon" />
                    </div>
                    <input
                        type="text"
                        name="trx_id"
                        id="bookId"
                        class="appearance-none outline-none w-full placeholder:font-normal placeholder:text-black font-semibold text-sm leading-[24px]"
                        placeholder="Write your booking id"
                        required
                    />
                </div>
            </div>
            <button type="submit" class="rounded-full p-[12px_24px] bg-[#FCCF2F] font-bold w-full text-center">Check My Booking</button>
        </form>
    </section>
    @include('front.layouts.components.bottom_nav')
@endsection