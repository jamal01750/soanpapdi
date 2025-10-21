<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Soan Papdi - Order Now!</title>

    <!-- Google Fonts (using a common Bengali font) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo.png') }}">

    <style>
        body {
            font-family: 'Hind Siliguri', sans-serif;
            background-color: #f0fdfa; /* A light teal background */
        }
        .wave-divider {
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }
        .wave-divider svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 60px; /* Adjust height of wave */
        }
        .wave-divider-bottom {
             position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }
        .wave-divider-bottom svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 60px; /* Adjust height of wave */
        }
        .wave-fill {
            fill: #58ddbeff; /* Updated fill color to match the body bg */
        }
        .section-bg {
             background-color: #149a83; /* Main teal color from image */
        }

        /* Animation for glowing text */
        @keyframes pulse-glow {
            0%, 100% {
                text-shadow: 0 0 5px rgba(255, 255, 255, 0.7), 0 0 10px rgba(255, 221, 119, 0.7), 0 0 15px rgba(255, 221, 119, 0.7);
                transform: scale(1);
            }
            50% {
                text-shadow: 0 0 10px #fff, 0 0 20px #ffdd77, 0 0 30px #ffdd77, 0 0 40px #ffdd77;
                transform: scale(1.05);
            }
        }
        .animate-pulse-glow {
            animation: pulse-glow 3.5s infinite ease-in-out;
            display: inline-block;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .animate-pulse-slow {
            animation: pulse 1s infinite;
        }
    </style>
</head>

<body class="bg-slate-50">

    <div class="w-full mx-auto bg-white shadow-lg">

        <!-- Logo Section -->
        <div class="items-center justify-center max-w-md mx-auto p-4">
            <a class="" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto h-20">
            </a>
        </div> 
        <!-- Header Section -->
        <header class="section-bg text-center relative border-4 border-orange-500 rounded w-full p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold pb-6">
                পুরান ঢাকার ইতিহাসের মিষ্টি রসনা <span class="text-blue-500 animate-pulse-glow">"প্রিমিয়াম ক্ষীরমালাই শনপাপড়ি"</span> এখন আপনার ঘরেই
            </h1>
            <div class="wave-divider">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                    preserveAspectRatio="none">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="wave-fill"></path>
                </svg>
            </div>
        </header>

        <!-- Countdown Timer Section with Alpine.js -->
        <section class="bg-white py-6 px-4" 
         x-data="countdownTimer()" 
         x-init="init()">

            <h2 class="text-center text-3xl md:text-4xl font-bold mb-4">
                🔥 অফার শেষ হতে আর বাকি মাত্র 🔥
            </h2>

            <!-- Wrapper to center and limit width -->
            <div class="w-full md:w-4/5 mx-auto">
                <!-- Timer boxes -->
                <div class="flex flex-wrap justify-center items-center gap-3 md:gap-6 w-full">

                    <!-- Days -->
                    <div class="flex-1 min-w-[70px] sm:min-w-[120px] md:min-w-[160px] 
                                text-center border-2 border-black bg-orange-500 text-white 
                                p-2 sm:p-2 rounded-2xl shadow-md">
                        <div class="text-6xl sm:text-5xl md:text-8xl font-bold animate-pulse-slow" x-text="days">00</div>
                        <div class="text-base sm:text-lg md:text-2xl uppercase">দিন</div>
                    </div>

                    <!-- Hours -->
                    <div class="flex-1 min-w-[70px] sm:min-w-[120px] md:min-w-[160px] 
                                text-center border-2 border-black bg-orange-500 text-white 
                                p-2 sm:p-2 rounded-2xl shadow-md">
                        <div class="text-6xl sm:text-5xl md:text-8xl font-bold animate-pulse-slow" x-text="hours">00</div>
                        <div class="text-base sm:text-lg md:text-2xl uppercase">ঘণ্টা</div>
                    </div>

                    <!-- Minutes -->
                    <div class="flex-1 min-w-[70px] sm:min-w-[120px] md:min-w-[160px] 
                                text-center border-2 border-black bg-orange-500 text-white 
                                p-2 sm:p-2 rounded-2xl shadow-md">
                        <div class="text-6xl sm:text-5xl md:text-8xl font-bold animate-pulse-slow" x-text="minutes">00</div>
                        <div class="text-base sm:text-lg md:text-2xl uppercase">মিনিট</div>
                    </div>

                    <!-- Seconds -->
                    <div class="flex-1 min-w-[70px] sm:min-w-[120px] md:min-w-[160px] 
                                text-center border-2 border-black bg-orange-500 text-white 
                                p-2 sm:p-2 rounded-2xl shadow-md">
                        <div class="text-6xl sm:text-5xl md:text-8xl font-bold animate-pulse-slow" x-text="seconds">00</div>
                        <div class="text-base sm:text-lg md:text-2xl uppercase">সেকেন্ড</div>
                    </div>

                </div>
            </div>

        </section>


        <!-- Call to Action Button & Hero Image -->
        <section class="section-bg relative py-8 md:py-8">
             <div class="px-6 pb-12">
                <a href="tel:+8801750789636" class="block w-full md:w-2/3 mx-auto bg-orange-500 text-center font-bold text-3xl py-4 rounded-xl shadow-lg hover:bg-orange-600 transition-transform transform hover:scale-105">
                    অর্ডার করতে কল করুন: +8801341707394
                </a>
                <div class="mt-8 rounded-lg overflow-hidden shadow-2xl border-4 border-white">
                    <!-- <img src="https://placehold.co/600x600/FFF/333?text=Soan+Papdi+Image" alt="Soan Papdi" class="w-full h-auto object-cover"> -->
                    <img src="{{ asset('images/hero.jpg') }}" alt="Soan Papdi" class="w-full h-auto object-cover">
                </div>
            </div>
             <!-- Wave Divider -->
            <div class="wave-divider-bottom">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                    preserveAspectRatio="none">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="wave-fill"></path>
                </svg>
            </div>
        </section>

        <!-- Product Features -->
        <section class="bg-gray-200 py-6 px-4">
             <div class="border-b-4 border-orange-500 pb-4 mb-6">
                <h2 class="text-center text-4xl font-bold text-gray-800">ঘিয়ে ভাজা শনপাপড়ি কেন খাবেন?</h2>
             </div>
             <div class="space-y-3 text-gray-700 max-w-md mx-auto">
                 <div class="flex items-start space-x-3 text-2xl">
                    <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p>সম্পূর্ণ হাইজেনিক এবং নিজস্ব ফ্যাক্টরিতে বানানো হয়।</p>
                 </div>
                  <div class="flex items-start space-x-3 text-2xl">
                    <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p>কোন প্রকার ডালডা ব্যবহার করা হয়না, সম্পূর্ণ খাঁটি গাওয়া ঘি দ্বারা তৈরি।</p>
                  </div>
                 <div class="flex items-start space-x-3 text-2xl">
                    <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p>শনপাপড়ির উপর অরিজিনাল ইরানি জাফরান দেয়া হয়।</p>
                 </div>
             </div>
             <div class="mt-8 bg-teal-50 border-l-4 border-teal-500 text-teal-800 p-4 rounded-r-lg w-full mx-auto">
                <p class="italic text-2xl">"আমাদের ফ্যাক্টরির বিশেষত্ব হলো আমরা শুধুমাত্র কোয়ালিটি পণ্য তৈরি করি। এখানে গুণগত মানের সাথে কোনো আপোস করা হয় না।"</p>
             </div>
        </section>

        <!-- Image Gallery -->
        <section class="bg-white py-8 px-4">
            <div class="grid grid-cols-2 md:grid-cols-2 gap-4 w-full mx-auto">
                <img src="{{ asset('images/gallery1.jpg') }}" alt="Gallery Image 1" class="rounded-lg shadow-md w-full h-auto object-cover">
                <img src="{{ asset('images/gallery2.jpg') }}" alt="Gallery Image 2" class="rounded-lg shadow-md w-full h-auto object-cover">
                <img src="{{ asset('images/gallery3.jpg') }}" alt="Gallery Image 3" class="rounded-lg shadow-md w-full h-auto object-cover">
                <img src="{{ asset('images/gallery4.jpg') }}" alt="Gallery Image 4" class="rounded-lg shadow-md w-full h-auto object-cover">
            </div>
        </section>

        <!-- Ingredients Section -->
        <section class="bg-white pb-12">
            <div class="border-4 rounded-lg section-bg w-full border-orange-500 mb-6">
                <h2 class="text-center text-4xl font-bold p-4">মুখরোচক শনপাপড়ির উপাদান সমূহঃ</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 w-full mx-auto text-center">
                <div class="flex flex-col items-center p-8 bg-gray-200 shadow-lg rounded-lg">
                    <span class="text-4xl">🧈</span>
                    <p class="font-bold text-3xl mt-2">ঘি</p>
                </div>
                <div class="flex flex-col items-center p-8 bg-gray-200 shadow-lg rounded-lg">
                     <span class="text-4xl">🍚</span>
                    <p class="font-bold text-3xl mt-2">চিনি</p>
                </div>
                <div class="flex flex-col items-center p-8 bg-gray-200 shadow-lg rounded-lg">
                     <span class="text-4xl">🌾</span>
                    <p class="font-bold text-3xl mt-2">বেসন</p>
                </div>
                <div class="flex flex-col items-center p-8 bg-gray-200 shadow-lg rounded-lg">
                    <span class="text-4xl">🌰</span>
                    <p class="font-bold text-3xl mt-2">কাঠ বাদাম</p>
                </div>
                <div class="flex flex-col items-center p-8 bg-gray-200 shadow-lg rounded-lg">
                    <span class="text-4xl">🧈</span>
                    <p class="font-bold text-3xl mt-2">ঘি</p>
                </div>
                <div class="flex flex-col items-center p-8 bg-gray-200 shadow-lg rounded-lg">
                     <span class="text-4xl">🍚</span>
                    <p class="font-bold text-3xl mt-2">চিনি</p>
                </div>
                <div class="flex flex-col items-center p-8 bg-gray-200 shadow-lg rounded-lg">
                     <span class="text-4xl">🌾</span>
                    <p class="font-bold text-3xl mt-2">বেসন</p>
                </div>
                <div class="flex flex-col items-center p-8 bg-gray-200 shadow-lg rounded-lg">
                    <span class="text-4xl">🌰</span>
                    <p class="font-bold text-3xl mt-2">কাঠ বাদাম</p>
                </div>
            </div>
        </section>

        <!-- Second CTA -->
        <section class="section-bg p-6 md:p-10 text-center relative">
             <div class="wave-divider" style="transform: rotate(0); top: -1px;">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                    preserveAspectRatio="none">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="wave-fill"></path>
                </svg>
            </div>
             <h2 class="text-2xl md:text-3xl text-white font-bold pt-10 mb-4">২ কেজি শনপাপড়ি অর্ডার করলেই ডেলিভারি "সম্পূর্ণ ফ্রী"</h2>
             <a href="#order-form" class="animate-pulse-slow inline-block bg-orange-500 font-bold text-2xl md:text-2xl py-4 px-10 rounded-xl shadow-lg hover:bg-orange-600 transition-transform transform hover:scale-105">
                অর্ডার করতে ক্লিক করুন
            </a>
        </section>

        <!-- ========== NEW ORDER FORM SECTION STARTS HERE ========== -->
        <section id="order-form" class="bg-white py-10 px-4 md:px-8" x-data="orderForm()">
            <h2 class="text-center text-3xl font-bold text-gray-800 mb-2">অর্ডার কনফার্ম করতে নিচের ফর্মটি পূরণ করুন</h2>
            <hr class="w-full h-2 bg-orange-500 mx-auto mb-8 border-0 rounded">

            <!-- Success/Error Messages -->
            @if (session('success'))<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 max-w-5xl mx-auto" role="alert"><strong class="font-bold">Success!</strong><span class="block sm:inline">{{ session('success') }}</span></div>@endif
            @if ($errors->any())<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 max-w-5xl mx-auto" role="alert"><strong class="font-bold">Please fix the errors:</strong><ul class="mt-2 list-disc list-inside">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

            <form action="{{ route('order.store') }}" method="POST" class="max-w-5xl mx-auto">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Side: Products, User Info -->
                    <div class="space-y-8">
                        <!-- Part 1: Product & Quantity -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-4">১. আপনার পছন্দের প্যাকেজটি বাছাই করুন</h3>
                            <div class="space-y-4">
                                <template x-for="product in products" :key="product.id">
                                    <div class="flex flex-col sm:flex-row items-center p-4 border rounded-lg shadow-sm bg-gray-50">
                                        <img :src="product.image" :alt="product.name" class="w-24 h-24 rounded-md object-cover mb-4 sm:mb-0 sm:mr-4">
                                        <div class="flex-grow w-full">
                                            <h4 class="font-bold text-lg" x-text="`${product.name} x ${product.quantity}`"></h4>
                                            <div class="flex items-center justify-between mt-2">
                                                <div class="flex items-center border border-gray-300 rounded-md">
                                                    <button type="button" @click="decrement(product.id)" class="px-3 py-1 text-lg font-bold text-gray-600 hover:bg-gray-200 rounded-l-md">-</button>
                                                    <span class="px-4 py-1 text-center font-bold" x-text="product.quantity"></span>
                                                    <button type="button" @click="increment(product.id)" class="px-3 py-1 text-lg font-bold text-gray-600 hover:bg-gray-200 rounded-r-md">+</button>
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
                            <h3 class="text-xl font-bold text-gray-800 mb-4">২. আপনার যোগাযোগের তথ্য দিন</h3>
                            <div class="space-y-4">
                                <div><label for="full_name" class="block text-sm font-medium text-gray-700">আপনার সম্পূর্ণ নাম <span class="text-red-500">*</span></label><input type="text" name="full_name" id="full_name" placeholder="আপনার নাম *" value="{{ old('full_name') }}" required class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-md"></div>
                                <div><label for="address" class="block text-sm font-medium text-gray-700">আপনার সম্পূর্ণ ঠিকানা <span class="text-red-500">*</span></label><textarea name="address" id="address" rows="3" placeholder="সম্পূর্ণ ঠিকানা, থানা, জেলা *" required class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-md">{{ old('address') }}</textarea></div>
                                <div><label for="mobile_number" class="block text-sm font-medium text-gray-700">আপনার মোবাইল নাম্বার <span class="text-red-500">*</span></label><input type="tel" name="mobile_number" id="mobile_number" placeholder="আপনার ১১ ডিজিটের মোবাইল নাম্বার *" value="{{ old('mobile_number') }}" required class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-md"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Summary, Delivery, Payment -->
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 h-fit space-y-8">
                        <!-- Part 3: Order Details -->
                        <div>
                            <h3 class="text-xl font-bold mb-4">৩. অর্ডার সারাংশ</h3>
                            <div class="space-y-3" x-show="cartItems.length > 0">
                                <template x-for="item in cartItems" :key="item.id">
                                    <div class="flex items-center justify-between text-sm">
                                        <div class="flex items-center">
                                            <img :src="item.image" class="w-10 h-10 rounded-md mr-3">
                                            <span><span x-text="item.name"></span> x <span x-text="item.quantity"></span></span>
                                        </div>
                                        <span class="font-medium">৳<span x-text="item.price * item.quantity"></span></span>
                                    </div>
                                </template>
                            </div>
                            <p x-show="cartItems.length === 0" class="text-gray-500">Please select a product.</p>
                        </div>
                        
                        <!-- Part 4: Delivery Area -->
                        <div>
                            <h3 class="text-xl font-bold mb-4">৪. ডেলিভারি এলাকা বাছাই করুন</h3>
                            <div class="space-y-2">
                                <label x-show="isFreeDeliveryEligible" class="flex items-center p-3 border rounded-md cursor-pointer has-[:checked]:bg-green-50 has-[:checked]:border-green-400">
                                    <input type="radio" name="delivery_option" x-model="deliveryOption" value="free" class="h-4 w-4 text-green-600"><span class="ml-3 font-medium text-green-700">ফ্রি ডেলিভারি (২ কেজি বা তার বেশির জন্য)</span>
                                </label>
                                <label class="flex items-center p-3 border rounded-md cursor-pointer has-[:checked]:bg-orange-50 has-[:checked]:border-orange-400">
                                    <input type="radio" name="delivery_option" x-model="deliveryOption" value="inside_dhaka" class="h-4 w-4 text-orange-600"><span class="ml-3">ঢাকার ভিতরে (৳ 70.00)</span>
                                </label>
                                <label class="flex items-center p-3 border rounded-md cursor-pointer has-[:checked]:bg-orange-50 has-[:checked]:border-orange-400">
                                    <input type="radio" name="delivery_option" x-model="deliveryOption" value="outside_dhaka" class="h-4 w-4 text-orange-600"><span class="ml-3">ঢাকার বাইরে (৳ 120.00)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Part 5: Payment Method -->
                        <div>
                             <h3 class="text-xl font-bold mb-4">৫. পেমেন্ট মেথড বাছাই করুন</h3>
                             <div class="space-y-2">
                                 <label class="flex items-center p-3 border rounded-md cursor-pointer has-[:checked]:bg-blue-50 has-[:checked]:border-blue-400">
                                     <input type="radio" name="payment_method" x-model="paymentMethod" value="cod"><span class="ml-3">ক্যাশ অন ডেলিভারি</span>
                                 </label>
                                 <label class="flex items-center p-3 border rounded-md cursor-pointer has-[:checked]:bg-pink-50 has-[:checked]:border-pink-400">
                                     <input type="radio" name="payment_method" x-model="paymentMethod" value="bkash"><img src="{{asset('/images/bkash.png')}}" class="h-6 ml-3">
                                 </label>
                                 <label class="flex items-center p-3 border rounded-md cursor-pointer has-[:checked]:bg-orange-50 has-[:checked]:border-orange-400">
                                     <input type="radio" name="payment_method" x-model="paymentMethod" value="nagad"><img src="{{asset('/images/nagad.png')}}" class="h-6 ml-3">
                                 </label>
                             </div>
                             <!-- bKash/Nagad Info Fields -->
                             <div x-show="paymentMethod === 'bkash' || paymentMethod === 'nagad'" x-transition class="mt-4 p-4 bg-gray-100 rounded-lg space-y-3">
                                 <p class="text-sm">অনুগ্রহ করে নিচের নাম্বারে টাকা পাঠিয়ে তথ্য দিন:</p>
                                 <p class="font-bold text-center text-lg text-gray-800">01341707394</p>
                                 <div><label class="text-sm font-medium">আপনার নাম্বার <span class="text-red-500">*</span></label><input type="text" name="payment_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm"></div>
                                 <div><label class="text-sm font-medium">ট্রানজেকশন আইডি <span class="text-red-500">*</span></label><input type="text" name="transaction_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm"></div>
                             </div>
                        </div>

                        <!-- FINAL PRICE SUMMARY -->
                        <div class="border-t border-gray-200 pt-4 space-y-2">
                            <div class="flex justify-between text-sm"><span class="text-gray-600">সাবটোটাল:</span><span class="font-medium">৳<span x-text="subtotal"></span></span></div>
                            <div class="flex justify-between text-sm" x-show="paymentDiscount > 0"><span class="text-gray-600">ডিসকাউন্ট (5%):</span><span class="font-medium text-green-600">- ৳<span x-text="paymentDiscount"></span></span></div>
                            <div class="flex justify-between text-sm"><span class="text-gray-600">ডেলিভারি চার্জ:</span><span class="font-medium">৳<span x-text="deliveryCharge"></span></span></div>
                            <div class="flex justify-between text-lg font-bold text-gray-900 border-t pt-2 mt-2"><span>মোট:</span><span>৳<span x-text="finalTotal"></span></span></div>
                        </div>
                    </div>
                </div>

                <!-- Hidden inputs for submission -->
                <input type="hidden" name="cart_items" :value="JSON.stringify(cartItems)">
                <input type="hidden" name="final_total" :value="finalTotal">

                <div class="mt-8">
                    <button type="submit" class="w-full bg-orange-500 text-white font-bold text-2xl py-4 rounded-xl shadow-lg hover:bg-orange-600 transition-transform transform hover:scale-105">
                        অর্ডার কনফার্ম করুন (৳<span x-text="finalTotal"></span>)
                    </button>
                </div>
            </form>
        </section>
        <!-- ========== NEW ORDER FORM SECTION ENDS HERE ========== -->

        <!-- Footer Section -->
        <footer class="bg-gray-800 text-white text-center p-4">
            <p>&copy; {{ date('Y') }} All Rights Reserved.</p>
        </footer>
        
    </div>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine (defer important) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        // --- FIX 3: REBUILT AND FULLY WORKING COUNTDOWN TIMER SCRIPT ---
        function countdownTimer() {
            return {
                days: '00',
                hours: '00',
                minutes: '00',
                seconds: '00',
                timerInterval: null,

                init() {
                    // 🔹 Load or create target timestamp
                    let savedTarget = localStorage.getItem('offer_target_time');

                    if (!savedTarget) {
                        // First visit → set 1 days from now
                        const newTarget = new Date();
                        newTarget.setDate(newTarget.getDate() + 1);
                        savedTarget = newTarget.getTime();
                        localStorage.setItem('offer_target_time', savedTarget);
                    }

                    const targetTimestamp = parseInt(savedTarget);
                    this.updateTimer(targetTimestamp);

                    this.timerInterval = setInterval(() => {
                        this.updateTimer(targetTimestamp);
                    }, 1000);
                },

                updateTimer(target) {
                    const now = Date.now();
                    const distance = target - now;

                    if (distance <= 0) {
                        clearInterval(this.timerInterval);
                        this.days = this.hours = this.minutes = this.seconds = '00';
                        localStorage.removeItem('offer_target_time'); // reset for next visit
                        return;
                    }

                    this.days = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
                    this.hours = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                    this.minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                    this.seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
                }
            }
        }
        
        // --- ALL-NEW ALPINE.JS LOGIC FOR THE ORDER FORM ---
        function orderForm() {
            return {
                products: [
                    { id: 1, name: '৫০০ গ্রাম শনপাপড়ি', price: 450, weightKg: 0.5, quantity: 0, image: "{{asset('/images/soanpapdi.jpg')}}" },
                    { id: 2, name: '১ কেজি শনপাপড়ি', price: 850, weightKg: 1, quantity: 0, image: "{{asset('/images/soanpapdi.jpg')}}" },
                    { id: 3, name: '২ কেজি শনপাপড়ি', price: 1600, weightKg: 2, quantity: 1, image: "{{asset('/images/soanpapdi.jpg')}}" } // Default
                ],
                deliveryOption: 'free', // Default delivery option
                paymentMethod: 'cod',
                deliveryCosts: { inside_dhaka: 70, outside_dhaka: 120 },

                init() {
                    this.$watch('totalWeightInKg', (newWeight) => {
                        if (newWeight >= 2) {
                            this.deliveryOption = 'free';
                        } else {
                            if (this.deliveryOption === 'free') {
                                this.deliveryOption = 'inside_dhaka'; // Default back to a paid option
                            }
                        }
                    });
                },

                increment(id) { this.products.find(p => p.id === id).quantity++; },
                decrement(id) { let product = this.products.find(p => p.id === id); if (product.quantity > 0) product.quantity--; },

                get cartItems() { return this.products.filter(p => p.quantity > 0); },
                get subtotal() { return this.cartItems.reduce((total, item) => total + (item.price * item.quantity), 0); },
                get totalWeightInKg() { return this.cartItems.reduce((total, item) => total + (item.weightKg * item.quantity), 0); },
                get isFreeDeliveryEligible() { return this.totalWeightInKg >= 2; },
                
                get paymentDiscount() {
                    if (this.paymentMethod === 'bkash' || this.paymentMethod === 'nagad') {
                        return Math.round(this.subtotal * 0.05);
                    }
                    return 0;
                },
                get deliveryCharge() {
                    if (this.deliveryOption === 'free') return 0;
                    return this.deliveryCosts[this.deliveryOption] || 0;
                },
                get finalTotal() {
                    return (this.subtotal - this.paymentDiscount) + this.deliveryCharge;
                }
            }
        }
    </script>

</body>
</html>
