@extends('layouts.app')

@section('title', 'All Orders')
@section('heading', 'All Orders')

@section('content')
    
    <div class="container mx-auto px-4 py-8">
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 max-w-5xl mx-auto" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif    
    <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Submitted Orders</h1>
        </div>

        <!-- Notification placeholder -->
        <div id="notification" class="hidden mb-4 p-4 rounded-md text-white"></div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-3 text-left">Order</th>
                            <th class="py-3 px-3 text-left">Customer</th>
                            <th class="py-3 px-3 text-left">Items</th>
                            <th class="py-3 px-3 text-left">Delivery</th>
                            <th class="py-3 px-3 text-center">Total Price</th>
                            <th class="py-3 px-3 text-center">Payment Method</th>
                            <th class="py-3 px-3 text-center">Order Status</th>
                            <th class="py-3 px-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @php $statuses = ['Pending', 'Processing', 'Confirmed', 'In Courier', 'Cancelled', 'Delivered', 'Returned']; @endphp
                        @forelse ($orders as $order)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-3"><span class="font-medium">#{{ $order->id }}</span><br>
                                    <span class="text-xs text-gray-700">{{ $order->created_at->format('d M, Y') }}</span>
                                </td>
                                <td class="py-3 px-3">
                                    <span class="font-bold">{{ $order->full_name }}</span><br>
                                    <span class="text-gray-700">{{ $order->mobile_number }}</span>
                                    <span class="text-xs text-gray-700 mt-1">{{ $order->address }}</span>
                                </td>
                                <td class="py-3 px-3">
                                    @if (is_array($order->cart_items))
                                        <ul class="list-none">
                                            @foreach ($order->cart_items as $item)<li>{{ $item['name'] }} x {{ $item['quantity'] }}</li>@endforeach
                                        </ul>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-center">
                                    @if ($order->delivery_option == 'free')
                                        <span class="text-red-700 py-1 text-sm font-semibold">Free Delivery</span>
                                    @elseif ($order->delivery_option == 'inside_dhaka')
                                        <span class="text-green-700 py-1 text-sm font-semibold">Inside Dhaka</span> 
                                    @else
                                        <span class="text-gray-700 py-1 text-sm font-semibold">Outside Dhaka</span>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-center font-bold">৳{{ number_format($order->final_total, 2) }}</td>
                                <td class="py-3 px-3 text-center">
                                    <span class="bg-gray-200 text-gray-700 py-1 px-3 rounded-full text-xs font-semibold">{{ strtoupper($order->payment_method) }}</span>
                                    @if ($order->payment_details)
                                        <div class="text-xs mt-1 text-gray-700">
                                        Mobile: {{ $order->payment_details['number'] ?? 'N/A' }}
                                        TrxID: {{ $order->payment_details['trxId'] ?? 'N/A' }}
                                        </div>
                                    @endif
                                </td>
                                <!-- === MODIFIED STATUS COLUMN === -->
                                <td class="py-2 px-3 align-center
                                    @switch($order->status)
                                        @case('Pending')
                                        @case('Processing')
                                            bg-yellow-50 border-l-4 border-yellow-400
                                            @break
                                        @case('Confirmed')
                                        @case('In Courier')
                                            bg-blue-50 border-l-4 border-blue-400
                                            @break
                                        @case('Delivered')
                                            bg-green-50 border-l-4 border-green-500
                                            @break
                                        @case('Cancelled')
                                        @case('Returned')
                                            bg-red-50 border-l-4 border-red-400
                                            @break
                                        @default
                                            bg-gray-50 border-l-4 border-gray-300
                                    @endswitch ">
                                    <!-- Layout changed to flex-col for stacking -->
                                    <div class="flex flex-col space-y-2">
                                        <select id="status-{{ $order->id }}" class="text-sm font-medium border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status }}" @if($order->status == $status) selected @endif>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        @if( $order->status == 'Pending' || $order->status == 'Processing' || $order->status == 'Confirmed' || $order->status == 'In Courier' )
                                            {{-- The onclick error in VS Code is a linter false positive. This is valid and will work perfectly. --}}
                                            <button onclick="updateStatus({{ $order->id }})" class="py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600 font-semibold">
                                                Update
                                            </button>
                                        @else  
                                            <button class="py-1 text-sm bg-gray-300 text-white rounded cursor-not-allowed font-semibold" disabled>
                                                Update 
                                            </button> 
                                        @endif
                                    </div>
                                </td>
                                <!-- === END OF MODIFIED COLUMN === -->
                                <td class="py-3 px-3 text-center">
                                    <!-- Action Buttons -->
                                    <div class="flex item-center justify-center space-x-2">
                                        @if( $order->status == 'Pending' || $order->status == 'Processing' || $order->status == 'Confirmed' || $order->status == 'In Courier' )
                                            <a href="{{ route('orders.edit', $order->id) }}" class="w-8 h-8 inline-flex items-center justify-center rounded-full bg-green-200 hover:bg-green-300" title="Edit">
                                                <svg class="w-4 h-4 text-green-700" fill="currentColor" viewBox="0 0 20 20"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                            </a>
                                        @endif
                                    
                                        @auth
                                            @if(auth()->user()->role === 'admin')
                                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-8 h-8 inline-flex items-center justify-center rounded-full bg-red-200 hover:bg-red-300" title="Delete">
                                                        <svg class="w-4 h-4 text-red-700" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="py-6 text-center text-gray-500">No orders found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-5 bg-white border-t">{{ $orders->links() }}</div>
        </div>
    </div>

<script>
    function updateStatus(orderId) {
        const status = document.getElementById(`status-${orderId}`).value;
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const notification = document.getElementById('notification');

        fetch(`/orders/${orderId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            notification.classList.remove('hidden', 'bg-red-500', 'bg-green-500');
            if (data.success) {
                notification.classList.add('bg-green-500');
                notification.textContent = data.message;
            } else {
                notification.classList.add('bg-red-500');
                notification.textContent = 'Error: ' + (data.message || 'Could not update status.');
            }
            notification.classList.remove('hidden');
            setTimeout(() => notification.classList.add('hidden'), 4000);
        })
        .catch(error => {
            console.error('Error:', error);
            notification.classList.add('bg-red-500');
            notification.textContent = 'A network error occurred.';
            notification.classList.remove('hidden');
            setTimeout(() => notification.classList.add('hidden'), 4000);
        });
    }
</script>
@endsection


