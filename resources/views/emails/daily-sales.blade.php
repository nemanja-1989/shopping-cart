@component('mail::message')
# Daily Sales Report

Here is a summary of all products sold today:

@component('mail::table')
| Product Name | Quantity Sold | Total Revenue |
|--------------|--------------|---------------|
@foreach($items as $item)
| {{ $item->product->name }} | {{ $item->quantity }} | ${{ number_format($item->quantity * $item->price, 2) }} |
@endforeach
@endcomponent

Total Orders: {{ $items->count() }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
