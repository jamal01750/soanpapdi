@extends('layouts.app')

@section('title', 'Edit Order')
@section('heading', 'Edit Order #' . $order->id)

@section('content')
<div class="container mx-auto px-4 py-8">
<!-- <pre>{{ json_encode($order, JSON_PRETTY_PRINT) }}</pre> -->

    <!-- Pass order data to Alpine.js -->
    <section id="order-edit-form" class="bg-white py-10 px-4 md:px-8"
         x-data="orderForm(window.order)">
        <h2 class="text-center text-3xl font-bold text-gray-800 mb-2">Edit Order #{{ $order->id }}</h2>
        <hr class="w-24 h-1 bg-blue-500 mx-auto mb-8 border-0 rounded">

        @if (session('error'))<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 max-w-5xl mx-auto" role="alert"><strong class="font-bold">Error!</strong><span class="block sm:inline">{{ session('error') }}</span></div>@endif
        @if ($errors->any())<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 max-w-5xl mx-auto" role="alert"><strong class="font-bold">Please fix the errors:</strong><ul class="mt-2 list-disc list-inside">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

        <form action="{{ route('orders.update', $order->id) }}" method="POST" class="max-w-5xl mx-auto">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Side: Products, User Info -->
                <div class="space-y-8">
                    <!-- Part 1: Product & Quantity -->
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">1. Update Products & Quantity</h3>
                        <div class="space-y-4">
                            <template x-for="product in products" :key="product.id">
                                <div class="flex flex-col sm:flex-row items-center p-4 border rounded-lg shadow-sm bg-gray-50">
                                    <img :src="product.image" :alt="product.name" class="w-24 h-24 rounded-md object-cover mb-4 sm:mb-0 sm:mr-4">
                                    <div class="flex-grow w-full">
                                        <h4 class="font-bold text-lg" x-text="`${product.name}`"></h4>
                                        <div class="flex items-center justify-between mt-2">
                                            <div class="flex items-center border border-gray-300 rounded-md">
                                                <button type="button" @click="decrement(product.id)" class="px-3 py-1 text-lg font-bold text-gray-600 hover:bg-gray-200">-</button>
                                                <span class="px-4 py-1 text-center font-bold" x-text="product.quantity"></span>
                                                <button type="button" @click="increment(product.id)" class="px-3 py-1 text-lg font-bold text-gray-600 hover:bg-gray-200">+</button>
                                            </div>
                                            <p class="text-orange-600 font-bold text-xl">৳<span x-text="product.price * product.quantity"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Part 2: User Info -->
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">2. Update Customer Information</h3>
                        <div class="space-y-4">
                            <div><label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label><input type="text" name="full_name" id="full_name" x-model="customer.name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></div>
                            <div><label for="address" class="block text-sm font-medium text-gray-700">Address</label><textarea name="address" id="address" rows="3" x-model="customer.address" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea></div>
                            <div><label for="mobile_number" class="block text-sm font-medium text-gray-700">Mobile Number</label><input type="tel" name="mobile_number" id="mobile_number" x-model="customer.phone" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Summary, Delivery, Payment, Status -->
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 h-fit space-y-8">
                    <!-- Part 3 & 4: Order Summary & Delivery -->
                    <div>
                         <h3 class="text-xl font-bold mb-4">3. Update Delivery & Payment</h3>
                         <!-- Delivery Area -->
                         <div class="space-y-2 mb-6">
                            <label x-show="isFreeDeliveryEligible" class="flex items-center p-3 border rounded-md cursor-pointer has-[:checked]:bg-green-50"><input type="radio" name="delivery_option" x-model="deliveryOption" value="free"><span class="ml-3 font-medium text-green-700">Free Delivery</span></label>
                            <label class="flex items-center p-3 border rounded-md cursor-pointer has-[:checked]:bg-orange-50"><input type="radio" name="delivery_option" x-model="deliveryOption" value="inside_dhaka"><span class="ml-3">Inside Dhaka</span></label>
                            <label class="flex items-center p-3 border rounded-md cursor-pointer has-[:checked]:bg-orange-50"><input type="radio" name="delivery_option" x-model="deliveryOption" value="outside_dhaka"><span class="ml-3">Outside Dhaka</span></label>
                         </div>
                         <!-- Payment Method -->
                         <div class="space-y-2">
                             <label class="flex items-center p-3 border rounded-md cursor-pointer has-[:checked]:bg-blue-50"><input type="radio" name="payment_method" x-model="paymentMethod" value="cod"><span class="ml-3">Cash on Delivery</span></label>
                             <label class="flex items-center p-3 border rounded-md cursor-pointer has-[:checked]:bg-pink-50"><input type="radio" name="payment_method" x-model="paymentMethod" value="bkash"><span class="ml-3">bKash</span></label>
                             <label class="flex items-center p-3 border rounded-md cursor-pointer has-[:checked]:bg-orange-50"><input type="radio" name="payment_method" x-model="paymentMethod" value="nagad"><span class="ml-3">Nagad</span></label>
                         </div>
                         <!-- bKash/Nagad Info -->
                         <div x-show="paymentMethod !== 'cod'" x-transition class="mt-4 p-4 bg-gray-100 rounded-lg space-y-3">
                             <div><label class="text-sm font-medium">Payment Number</label><input type="text" name="payment_number" x-model="paymentDetails.number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm"></div>
                             <div><label class="text-sm font-medium">Transaction ID</label><input type="text" name="transaction_id" x-model="paymentDetails.trxId" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm"></div>
                         </div>
                    </div>
                     <!-- Part 5: Order Status -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">4. Update Order Status</h3>
                        <select name="status" x-model="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <template x-for="s in availableStatuses" :key="s">
                                <option :value="s" x-text="s" :selected="s === order.status"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Final Price Summary -->
                    <div class="border-t border-gray-200 pt-4 space-y-2">
                        <div class="flex justify-between text-sm"><span class="text-gray-600">Subtotal:</span><span class="font-medium">৳<span x-text="subtotal"></span></span></div>
                        <div class="flex justify-between text-sm" x-show="paymentDiscount > 0"><span class="text-gray-600">Discount:</span><span class="font-medium text-green-600">- ৳<span x-text="paymentDiscount"></span></span></div>
                        <div class="flex justify-between text-sm"><span class="text-gray-600">Delivery:</span><span class="font-medium">৳<span x-text="deliveryCharge"></span></span></div>
                        <div class="flex justify-between text-lg font-bold mt-2 pt-2 border-t"><span>Total:</span><span>৳<span x-text="finalTotal"></span></span></div>
                    </div>
                </div>
            </div>

            <!-- Hidden inputs for submission -->
            <input type="hidden" name="cart_items" :value="JSON.stringify(cartItems)">
            
            <div class="mt-8 flex justify-between items-center">
                <!-- *** FIX: Corrected the route name here *** -->
                <a href="{{ route('order.list') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-semibold"> &larr; Cancel</a>
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-bold text-lg rounded-md shadow-lg hover:bg-blue-700">
                    Update Order
                </button>
            </div>
        </form>
    </section>
</div>

<script>
    // Reusing the same Alpine.js logic from the main page, but initializing it with order data
    window.order = {!! $order->toJson() !!};
    function orderForm(order) {
        return {
            products: [
                { id: 1, name: '৫০০ গ্রাম শনপাপড়ি', price: 450, weightKg: 0.5, quantity: 0, image: "{{asset('/images/soanpapdi.jpg')}}" },
                { id: 2, name: '১ কেজি শনপাপড়ি', price: 850, weightKg: 1, quantity: 0, image: "{{asset('/images/soanpapdi.jpg')}}" },
                { id: 3, name: '২ কেজি শনপাপড়ি', price: 1600, weightKg: 2, quantity: 0, image: "{{asset('/images/soanpapdi.jpg')}}" }
            ],
            customer: { name: '', address: '', phone: '' },
            deliveryOption: 'inside_dhaka',
            paymentMethod: 'cod',
            paymentDetails: { number: '', trxId: '' },
            status: 'Pending',
            availableStatuses: ['Pending', 'Processing', 'Confirmed', 'In Courier', 'Cancelled', 'Delivered', 'Returned'],
            deliveryCosts: { inside_dhaka: 70, outside_dhaka: 120 },

            init() {
                if (order) {
                    
                    this.customer.name = order.full_name;
                    this.customer.address = order.address;
                    this.customer.phone = order.mobile_number;
                    this.deliveryOption = order.delivery_option;
                    this.paymentMethod = order.payment_method;
                    this.status = order.status;

                    // *** FIX: Safely handle null payment_details for COD orders ***
                    if (order.payment_method !== 'cod' && order.payment_details) {
                        this.paymentDetails.number = order.payment_details.number || '';
                        this.paymentDetails.trxId = order.payment_details.trxId || '';
                    }

                    if (order.cart_items && Array.isArray(order.cart_items)) {
                        order.cart_items.forEach(item => {
                            let product = this.products.find(p => p.name === item.name);
                            if (product) {
                                product.quantity = item.quantity;
                            }
                        });
                    }
                }
                 this.$watch('totalWeightInKg', (newWeight) => {
                        if (newWeight >= 2 && this.deliveryOption !== 'free') {
                            this.deliveryOption = 'free';
                        } else if (newWeight < 2 && this.deliveryOption === 'free') {
                             this.deliveryOption = 'inside_dhaka';
                        }
                 });
            },

            increment(id) { let p = this.products.find(p => p.id === id); if (p) p.quantity++; },
            decrement(id) { let p = this.products.find(p => p.id === id); if (p && p.quantity > 0) p.quantity--; },
            get cartItems() { return this.products.filter(p => p.quantity > 0).map(p => ({name: p.name, quantity: p.quantity, price: p.price, image: p.image})); },
            get subtotal() { return this.cartItems.reduce((total, item) => total + (item.price * item.quantity), 0); },
            get totalWeightInKg() { return this.products.reduce((total, p) => total + (p.weightKg * p.quantity), 0); },
            get isFreeDeliveryEligible() { return this.totalWeightInKg >= 2; },
            get paymentDiscount() { return (this.paymentMethod !== 'cod') ? Math.round(this.subtotal * 0.05) : 0; },
            get deliveryCharge() { return this.deliveryOption === 'free' ? 0 : this.deliveryCosts[this.deliveryOption] || 0; },
            get finalTotal() { return (this.subtotal - this.paymentDiscount) + this.deliveryCharge; }
        }
    }
</script>
@endsection

