@extends('layouts.pos_print')

@section('content')

<style>
    table, th, td {
        /* border: 1px solid black; */
    }

</style>

@php
    $decimals = 1;
@endphp

<div class="title">{{ $data['title'] }}</div>

@foreach ($data['items'] as $item)

<table style="width:100%" style=" border-collapse: collapse;">
    <thead>
        <tr>
            <td class="text-left">{{ __c('date')}}:</td>
            <td class="text-right">{{ $item['closed_at'] }}</td>
        </tr>
        <tr>
            <td class="text-left">{{ __c('box') }}</td>
            <td class="text-right">{{ $item['box_name'] }}</td>
        </tr>
        <tr>
            <td class="text-left">{{ __c('closing_user') }}</td>
            <td class="text-right">{{ $item['closing_user_name'] }}</td>
        </tr>
    </thead>
</table>
<br>

<table style="width:100%" style=" border-collapse: collapse;">
    <thead>
        <tr>
            <td>MOV</td>
            <td class="text-right">CD</td>
            <td class="text-right">BC</td>
            <td class="text-right">EF</td>
            <td class="text-right">TOTAL</td>
        </tr>
    </thead>
    <tbody>
        {{-- inputs --}}
        {{-- total inputs --}}
        <tr>
            <td class="text-left">{{ __u('inputs') }}</td>
            <td class="text-right">{{ number_format($item['total_inputs_credit'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_inputs_bank'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_inputs_cash'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_inputs'], $decimals) }}</td>
        </tr>

        {{-- opening_amount --}}
        <tr>
            <td class="text-left" style="padding-left: 15px;">{{ __c('opening_amount') }}</td>
            <td class="text-right">--</td>
            <td class="text-right">--</td>
            <td class="text-right">{{ number_format($item['opening_amount'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['opening_amount'], $decimals) }}</td>
        </tr>

        {{-- sales --}}
        <tr>
            <td class="text-left" style="padding-left: 15px;">{{ __c('sales') }}</td>
            <td class="text-right">{{ number_format($item['total_sales_credit'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_sales_bank'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_sales_cash'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_sales'], $decimals) }}</td>
        </tr>
        {{-- sales by method payments --}}
        @foreach ($item['sales_by_payment_methods'] as $paymentMethod)
        <tr>
            <td class="text-left" style="padding-left: 30px;">{{ $paymentMethod['name'] }}</td>
            <td class="text-right"></td>
            <td class="text-right">{{ number_format($paymentMethod['amount'], $decimals) }}</td>
            <td class="text-right"></td>
            <td class="text-right"></td>
        </tr>
        @endforeach

        {{-- collect_credits --}}
        <tr>
            <td class="text-left" style="padding-left: 15px;">{{ __c('collect_credits') }}</td>
            <td class="text-right">--</td>
            <td class="text-right">{{ number_format($item['total_collect_credits_bank'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_collect_credits_cash'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_collect_credits'], $decimals) }}</td>
        </tr>

        {{-- other inputs --}}
        <tr>
            <td class="text-left" style="padding-left: 15px;">{{ __c('other_inputs') }}</td>
            <td class="text-right">--</td>
            <td class="text-right">{{ number_format($item['total_other_inputs_bank'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_other_inputs_cash'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_other_inputs'], $decimals) }}</td>
        </tr>

        {{-- outputs --}}
        {{-- total outputs --}}
        <tr>
            <td class="text-left">{{ __u('outputs') }}</td>
            <td class="text-right">--</td>
            <td class="text-right">{{ number_format($item['total_outputs_bank'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_outputs_cash'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_outputs'], $decimals) }}</td>
        </tr>

        {{-- payment_purchases --}}
        <tr>
            <td class="text-left" style="padding-left: 15px;">{{ __c('payment_purchases') }}</td>
            <td class="text-right">--</td>
            <td class="text-right">{{ number_format($item['total_payment_purchases_bank'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_payment_purchases_cash'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_payment_purchases'], $decimals) }}</td>
        </tr>
        {{-- outher outputs --}}
        <tr>
            <td class="text-left" style="padding-left: 15px;">{{ __c('other_outputs') }}</td>
            <td class="text-right">--</td>
            <td class="text-right">{{ number_format($item['total_other_outputs_bank'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_other_outputs_cash'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['total_other_outputs'], $decimals) }}</td>
        </tr>

        {{-- retire_amount --}}
        <tr>
            <td class="text-left" style="padding-left: 15px;">{{ __c('retire_amount') }}</td>
            <td class="text-right">--</td>
            <td class="text-right">--</td>
            <td class="text-right">{{ number_format($item['retire_amount'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['retire_amount'], $decimals) }}</td>
        </tr>
        
    </tbody>

    <tfoot>
        <tr>
            <td class="text-left">{{ __u('utility') }}</td>
            <td class="text-right">{{ number_format($item['utility_credit'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['utility_bank'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['utility_cash'], $decimals) }}</td>
            <td class="text-right">{{ number_format($item['utility'], $decimals) }}</td>
        </tr>
    </tfoot>

</table>
<hr style="border-top: 1px dotted  black;">
<div class="printed-at">{{__c('printed_at')}}: {{$data['datetime'] }}</div>
@endforeach

@endsection 




