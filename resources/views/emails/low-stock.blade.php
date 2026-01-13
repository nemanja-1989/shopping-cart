@component('mail::message')
# Low Stock Alert

The product **{{ $product->name }}** is running low on stock.

Current stock: {{ $product->stock_quantity }}

@component('mail::button', ['url' => route('cart')])
View Products
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
