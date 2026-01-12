<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{Product, Cart, CartItem, Order, OrderItem};
use Illuminate\Support\Facades\Auth;
use App\Jobs\NotifyLowStock;

class CartManager extends Component
{
    public $products;
    public $cart;

    public function mount()
    {
        $user = Auth::user();
        $this->cart = $user->cart()->firstOrCreate([]);
        $this->products = Product::all();
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $item = $this->cart->items()->firstOrCreate(
            ['product_id'=>$productId],
            ['quantity'=>0]
        );

        $item->quantity++;
        $item->save();

        $this->checkLowStock($product);
    }

    public function updateQty($itemId, $qty)
    {
        $item = CartItem::findOrFail($itemId);
        $item->quantity = max(1, $qty);
        $item->save();
        $this->checkLowStock($item->product);
    }

    public function remove($itemId)
    {
        CartItem::findOrFail($itemId)->delete();
    }

    public function checkout()
    {
        $this->cart->load('items.product');

        $order = Order::create([
            'user_id'=>Auth::id(),
            'total' => $this->cart->items->sum(fn($i)=>$i->product->price*$i->quantity),
        ]);

        foreach ($this->cart->items as $item) {
            OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>$item->product_id,
                'quantity'=>$item->quantity,
                'price'=>$item->product->price
            ]);

            $item->product->decrement('stock_quantity', $item->quantity);
        }

        $this->cart->items()->delete();
        session()->flash('message','Order completed!');
    }

    protected function checkLowStock(Product $product)
    {
        if ($product->stock_quantity < 5) {
            NotifyLowStock::dispatch($product);
        }
    }

    public function render()
    {
        return view('livewire.cart-manager', [
            'items'=>$this->cart->items()->with('product')->get()
        ]);
    }
}
