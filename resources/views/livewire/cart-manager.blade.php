<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Products</h1>
    <div class="grid grid-cols-3 gap-4">
        @foreach($products as $p)
            <div class="p-4 border rounded">
                <div>{{ $p->name }}</div>
                <div>${{ $p->price }}</div>
                <button wire:click="addToCart({{ $p->id }})"
                    class="bg-blue-500 text-white px-3 py-1 rounded">Add</button>
            </div>
        @endforeach
    </div>

    <h2 class="text-xl font-bold mt-8 mb-2">Your Cart</h2>
    @foreach($items as $item)
        <div class="flex gap-4 items-center border-b py-2">
            {{ $item->product->name }} ({{ $item->product->price }})
            <input type="number" wire:change="updateQty({{ $item->id }}, $event.target.value)"
                   value="{{ $item->quantity }}" class="w-16 border rounded p-1">
            <button wire:click="remove({{ $item->id }})" class="text-red-600">Remove</button>
        </div>
    @endforeach

    @if($items->count())
        <button wire:click="checkout"
            class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Checkout</button>
    @endif

    @if(session('message'))
        <div class="text-green-700 mt-3">{{ session('message') }}</div>
    @endif
</div>
