<div class="container mx-auto p-6">

    <h2 class="text-2xl font-bold mb-4">Products</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded-lg shadow p-4 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-700 mb-2">${{ number_format($product->price, 2) }}</p>
                    <p class="text-sm text-gray-500">
                        Stock: {{ $product->stock_quantity }}
                    </p>
                </div>

                <button wire:click="addToCart({{ $product->id }})"
                    class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
                    Add to Cart
                </button>
            </div>
        @endforeach
    </div>

    {{-- Cart Section --}}
    <h2 class="text-2xl font-bold mt-12 mb-4">Your Cart</h2>
    @if($items->isEmpty())
        <p class="text-gray-600">Your cart is empty.</p>
    @else
        <div class="bg-white shadow rounded-lg p-4 space-y-4">
            @foreach($items as $item)
                <div wire:key="cart-item-{{ $item->id }}" class="flex justify-between items-center border-b pb-2">
                    <div>
                        <h3 class="font-semibold">{{ $item->product->name }}</h3>
                        <p class="text-gray-600 text-sm">${{ number_format($item->product->price,2) }}</p>
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="number" min="1"
                            wire:change="updateQty({{ $item->id }}, $event.target.value)"
                            value="{{ $item->quantity }}"
                            class="w-16 border rounded px-2 py-1">

                        <button wire:click="remove({{ $item->id }})"
                            class="text-red-600 hover:text-red-800 font-bold px-2 py-1 rounded">
                            Remove
                        </button>
                    </div>
                </div>
            @endforeach

            <div class="flex justify-between items-center mt-4">
                <span class="font-bold text-lg">
                    Total: ${{ number_format($items->sum(fn($i)=>$i->product->price*$i->quantity),2) }}
                </span>
                <button wire:click="checkout"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition">
                    Checkout
                </button>
            </div>
        </div>
    @endif

    @if(session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif
</div>

