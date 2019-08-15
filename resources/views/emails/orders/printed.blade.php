@component('mail::message')
# Order is Printed
@php $remaining = $order->total - $order->payments->sum('pay') @endphp
@if($remaining == 0)
You can come to receive your order now.
@else
You can come to receive your order now, but you have to pay {{ $remaining }}
@endif

**Client Name:** {{ $order->client->name }}

**Order Name:** {{ $order->name_file }}

Thank you!.

**Items Ordered**


@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
Go to Website
@endcomponent

Thank you again for choosing us.

Regards,<br>
{{ config('app.name') }}
@endcomponent