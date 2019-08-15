@php use Illuminate\Support\Carbon; @endphp
@component('mail::message')
@if($order->printed == true)
# Order is Printed
@else
# Order is Printing
@endif
Thank you for your order.

**Order ID:** {{ $order->id }}

**Order Email:** {{ $order->client->email }}

**Order Name:** {{ $order->client->name }}

**Order Total:** ${{ round($order->total) }}

**Order Paid:** ${{ $paid = round($order->payments->sum('pay')) }}

**Order Remaining:** ${{ $order->total - $paid }}

**Items Ordered**

@foreach ($order->payments as $payment)
Paid time: ${{ $payment->pay }} - **({{ $payment->created_at->toDayDateTimeString() }})** <br>
@endforeach 

You can get further details about your order by logging into our website.

@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
Go to Website
@endcomponent

Thank you again for choosing us.

Regards,<br>
{{ config('app.name') }}
@endcomponent