<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function index()
    {
        $data['bottom_nav']         = 'home';
        $data['categories']         = Category::all();
        $data['latest_products']    = Product::latest()->take(4)->get();
        $data['random_products']    = Product::inRandomOrder()->take(4)->get();

        return view('front.home.index', $data);
    }

    public function category(Category $category)
    {
        session()->put('category_id', $category->id);
        
        $data['category'] = $category;

        return view('front.brand.index', $data);
    }

    public function brand(Brand $brand)
    {
        $category_id = session()->get('category_id');

        $data['category']       = Category::find($category_id);
        $data['brand']          = $brand;
        $data['products']       = Product::where('brand_id', $brand->id)
                                ->where('category_id', $category_id)
                                ->latest()
                                ->get();

        return view('front.gadgets.index', $data);
    }

    public function details(Product $product)
    {
        $data['product'] = $product;

        return view('front.product.index', $data);
    }

    public function booking(Product $product)
    {
        $data['product']    = $product;
        $data['stores']     = Store::all();

        return view('front.booking.index', $data);
    }

    public function booking_save(Request $request, Product $product): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'duration'      => ['required', 'integer', 'min:1'],
            'started_at'    => ['required', 'date', 'after:today'],
            'store_id'      => ['nullable', 'integer', 'required_without:address'],
            'address'       => ['nullable', 'string', 'required_without:store_id'],
        ]);

        // dd($request->all(), $product);
        if ($validator->fails()) {
            $message = Helper::parsing_alert($validator->errors()->all());

            return redirect()->back()->with('error', $message)->withInput();
        }
 
        session()->put('product_id', $product->id);
        session()->put('delivery_type', $request->all()['delivery_type']);

        $bookingData = $validator->safe()->only(['duration', 'started_at', 'store_id', 'delivery_type', 'address']);
        
        session($bookingData);

        return to_route('front.checkout', $product->slug);
    }

    public function checkout(Product $product){
        $duration = session('duration');
        
        $data['insurance'] = 900000;
        $ppn = 0.11;
        $price = $product->price;
        
        $data['product'] = $product; 
        $data['subTotal'] = $price * $duration;
        $data['totalPpn'] = $data['subTotal'] * $ppn;
        $data['grandTotal'] = $data['subTotal'] + $data['totalPpn'] + $data['insurance'];

        return view('front.checkout.index', $data);
    }

    public function checkout_store(StorePaymentRequest $request)
    {
        $bookingData = session()->only(['duration', 'started_at', 'store_id', 'delivery_type', 'address', 'product_id']);

        $duration = (int) $bookingData['duration'];
        $startedDate = Carbon::parse($bookingData['started_at']);

        $productDetails = Product::find($bookingData['product_id']);
        if (!$productDetails) {
            return redirect()->back()->withErrors(['product_id' => 'Product not found.']);
        }

        $insurance = 900000;
        $ppn = 0.11;
        $price = $productDetails->price;

        $subTotal = $price * $duration;
        $totalPpn = $subTotal * $ppn;
        $grandTotal = $subTotal + $totalPpn + $insurance;

        $bookingTransactionId = null;

        // closure based database transaction
        DB::transaction(function() use ($request, &$bookingTransactionId, $duration, $bookingData, $grandTotal, $productDetails, $startedDate) {

            $validated = $request->validated();

            if($request->hasFile('proof')){
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $endedDate = $startedDate->copy()->addDays($duration);

            $validated['started_at'] = $startedDate;
            $validated['ended_at'] = $endedDate;
            $validated['duration'] = $duration;
            $validated['total_amount'] = $grandTotal;
            $validated['store_id'] = $bookingData['store_id'];
            $validated['product_id'] = $productDetails->id;
            $validated['delivery_type'] = $bookingData['delivery_type'] == true ? 'pickup' : 'home_delivery';
            $validated['address'] = $bookingData['address'] ?? '-';
            $validated['is_paid'] = false;
            $validated['trx_id'] = Transaction::generateUniqueTrxId();

            $newBooking = Transaction::create($validated);

            $bookingTransactionId = $newBooking->id;
        });

        return redirect()->route('front.success.booking', $bookingTransactionId);
    }

    public function success_booking(Transaction $transaction)
    {
        $data['transaction'] = $transaction;

        return view('front.booking.success_booking', $data);
    }

    public function transactions()
    {
        $data['bottom_nav'] = 'order';

        return view('front.transactions.index', $data);
    }

    public function transactions_details(Request $request) {
        $request->validate([
            'trx_id' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
        ]);

        $trx_id = $request->input('trx_id');
        $phone_number = $request->input('phone_number');

        $data['details'] = Transaction::with(['store', 'product'])
            ->where('trx_id', $trx_id)
            ->where('phone_number', $phone_number)
            ->first();

        if (!$data['details']) {
            return redirect()->back()->withErrors(['error' => 'Transactions not found.']);
        }

        $data['insurance'] = 900000;
        $ppn = 0.11;
        $data['totalPpn'] = $data['details']->product->price * $ppn;
        $data['duration'] = $data['details']->duration;
        $data['subTotal'] = $data['details']->product->price * $data['duration'];
        $data['transaction'] = $data['details'];

        return view('front.transactions.detail', $data);
    }
}
