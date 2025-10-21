@extends('layouts.app')

@section('title', 'Dashboard')
@section('heading', 'Welcome back, ' . Auth::user()->name)

@section('content')
<div class="space-y-6">

    <!-- Section 1 & 2: Summaries (Full Width) -->
    <section>
        <h2 class="text-lg font-bold text-gray-800 mb-4">Financial Summary</h2>
        <!-- <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <div class="bg-white p-4 rounded-xl shadow-sm border">
                <h3 class="text-xs font-semibold text-gray-500 uppercase">Total Revenue</h3>
                <p class="text-2xl font-bold text-cyan-600 mt-1">৳ 0</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border">
                <h3 class="text-xs font-semibold text-gray-500 uppercase">Total Revenue</h3>
                <p class="text-2xl font-bold text-cyan-600 mt-1">৳ 0</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border">
                <h3 class="text-xs font-semibold text-gray-500 uppercase">Total Revenue</h3>
                <p class="text-2xl font-bold text-cyan-600 mt-1">৳ 0</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border">
                <h3 class="text-xs font-semibold text-gray-500 uppercase">Total Revenue</h3>
                <p class="text-2xl font-bold text-cyan-600 mt-1">৳ 0</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border">
                <h3 class="text-xs font-semibold text-gray-500 uppercase">Total Revenue</h3>
                <p class="text-2xl font-bold text-cyan-600 mt-1">৳ 0</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border">
                <h3 class="text-xs font-semibold text-gray-500 uppercase">Total Revenue</h3>
                <p class="text-2xl font-bold text-cyan-600 mt-1">৳ 0</p>
            </div>
        </div> -->
    </section>

    

    
</div>




@endsection

