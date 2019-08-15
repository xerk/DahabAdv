@php use Illuminate\Support\Carbon; @endphp
@component('mail::message')
# Hello {{$client->name}}

Welcome to Dahab Adv

*Created At: {{ $client->created_at->toDayDateTimeString() }}*<br>
*Updated At: {{ $client->updated_at->toDayDateTimeString() }}*
@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
Go to Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent