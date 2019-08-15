@component('mail::message')
# Order is Received

Thank you for your order, we hope you come again.

**Order ID:** {{ $order->id }}

**Client Name:** {{ $order->client->name }}

**Order Name:** {{ $order->name_file }}

@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
Go to Website
@endcomponent

Thank you again for choosing us.

Regards,<br>
{{ config('app.name') }}
@endcomponent