<?php

namespace App\Http\Controllers;

use App\Models\Order; // Import the Order model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    

    // New method to display all orders
    public function listOrders()
    {
        $orders = Order::latest()->paginate(10); // Get the most recent orders, 20 per page
        return view('orders.list', ['orders' => $orders]);
    }

    public function storeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'mobile_number' => 'required|string|regex:/^01[3-9]\d{8}$/',
            'cart_items' => 'required|json',
            'delivery_option' => 'required|string|in:free,inside_dhaka,outside_dhaka',
            'payment_method' => 'required|string|in:cod,bkash,nagad',
            'payment_number' => 'nullable|required_if:payment_method,bkash,nagad|string|max:50',
            'transaction_id' => 'nullable|required_if:payment_method,bkash,nagad|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous() . '#order-form')->withErrors($validator)->withInput()->with('error', 'Please check the form for errors.');
        }

        // --- Server-Side Calculation (For Security) ---
        $cartItems = json_decode($request->cart_items, true);
        
        $productPrices = [
            '৫০০ গ্রাম শনপাপড়ি' => 450,
            '১ কেজি শনপাপড়ি' => 850,
            '২ কেজি শনপাপড়ি' => 1600,
        ];

        $subtotal = 0;
        foreach ($cartItems as $item) {
            if (isset($productPrices[$item['name']])) {
                $subtotal += $productPrices[$item['name']] * $item['quantity'];
            }
        }

        $discount = ($request->payment_method === 'bkash' || $request->payment_method === 'nagad') ? round($subtotal * 0.05) : 0;

        $deliveryCharge = 0;
        if ($request->delivery_option === 'inside_dhaka') {
            $deliveryCharge = 70;
        } elseif ($request->delivery_option === 'outside_dhaka') {
            $deliveryCharge = 120;
        }
        
        $finalTotal = ($subtotal - $discount) + $deliveryCharge;
        // --- End of Calculation ---


        // --- Create and Save Order ---
        try {
            Order::create([
                'full_name' => $request->full_name,
                'address' => $request->address,
                'mobile_number' => $request->mobile_number,
                'cart_items' => $cartItems,
                'delivery_option' => $request->delivery_option,
                'payment_method' => $request->payment_method,
                'payment_details' => $request->payment_method !== 'cod' 
                    ? ['number' => $request->payment_number, 'trxId' => $request->transaction_id] 
                    : null,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'delivery_charge' => $deliveryCharge,
                'final_total' => $finalTotal,
                'status' => 'Pending', // Default status
            ]);
        } catch (\Exception $e) {
            Log::error('Order creation failed: ' . $e->getMessage());
            return redirect(url()->previous() . '#order-form')->with('error', 'Something went wrong! Please try again.');
        }

        // *** FIX: Redirect back to the form's anchor on success ***
        return redirect(url()->previous() . '#order-form')
            ->with('success', 'Order placed successfully! We will contact you soon.');
        // return redirect()->route('home')->with('success', 'Order placed successfully! We will contact you soon.');
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        return view('orders.edit', ['order' => $order]);
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('order.list')->with('success', "Order #{$order->id} has been deleted.");
    }
    
    /**
     * Update only the status of an order via AJAX.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:Pending,Processing,Confirmed,In Courier,Cancelled,Delivered,Returned',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid status.'], 422);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json(['success' => true, 'message' => "Order #{$order->id} status updated to {$order->status}."]);
    }


    /**
     * Update the specified order in storage with full recalculation.
     */
    public function update(Request $request, Order $order)
    {
        // --- Comprehensive Validation ---
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'mobile_number' => 'required|string|regex:/^01[3-9]\d{8}$/',
            'cart_items' => 'required|json',
            'delivery_option' => 'required|string|in:free,inside_dhaka,outside_dhaka',
            'payment_method' => 'required|string|in:cod,bkash,nagad',
            'payment_number' => 'nullable|required_if:payment_method,bkash,nagad|string|max:50',
            'transaction_id' => 'nullable|required_if:payment_method,bkash,nagad|string|max:100',
            'status' => 'required|string|in:Pending,Processing,Confirmed,In Courier,Cancelled,Delivered,Returned',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Please check the form for errors.');
        }

        // --- Full Server-Side Recalculation (Crucial for Security) ---
        $cartItems = json_decode($request->cart_items, true);
        
        $productPrices = [ '৫০০ গ্রাম শনপাপড়ি' => 450, '১ কেজি শনপাপড়ি' => 850, '২ কেজি শনপাপড়ি' => 1600 ];
        $subtotal = 0;
        foreach ($cartItems as $item) {
            if (isset($productPrices[$item['name']])) {
                $subtotal += $productPrices[$item['name']] * $item['quantity'];
            }
        }

        $discount = ($request->payment_method === 'bkash' || $request->payment_method === 'nagad') ? round($subtotal * 0.05) : 0;
        
        $deliveryCharge = 0;
        if ($request->delivery_option === 'inside_dhaka') $deliveryCharge = 70;
        elseif ($request->delivery_option === 'outside_dhaka') $deliveryCharge = 120;
        
        $finalTotal = ($subtotal - $discount) + $deliveryCharge;

        // --- Update the Order Model ---
        $order->update([
            'full_name' => $request->full_name,
            'address' => $request->address,
            'mobile_number' => $request->mobile_number,
            'cart_items' => $cartItems,
            'delivery_option' => $request->delivery_option,
            'payment_method' => $request->payment_method,
            'payment_details' => $request->payment_method !== 'cod' 
                ? ['number' => $request->payment_number, 'trxId' => $request->transaction_id] 
                : null,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'delivery_charge' => $deliveryCharge,
            'final_total' => $finalTotal,
            'status' => $request->status,
        ]);

        return redirect()->route('order.list')->with('success', "Order #{$order->id} updated successfully.");
    }

    
}

