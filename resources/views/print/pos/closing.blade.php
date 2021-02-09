@extends('layouts.pos_print')

@section('content')

<style>
    table, th, td {
        /* border: 1px solid black; */
    }

</style>

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

    <tbody>
        {{-- (+) opening_amount --}}
        <tr>
            <td class="text-left">{{ __c('init_cash') }}</td>
            <td class="text-right">{{ number_format($item['opening_amount'], 2) }}</td>
        </tr>

        {{-- (+) total_sales_cash --}}
        <tr>
            <td class="text-left">{{ __c('sales') }}</td>
            <td class="text-right">{{ number_format($item['total_sales_cash'], 2) }}</td>
        </tr>
        {{-- (+) total_collect_credit_cash --}}
        <tr>
            <td class="text-left">{{ __c('collect_credits') }}</td>
            <td class="text-right">{{ number_format($item['total_collect_credits_cash'], 2) }}</td>
        </tr>
        {{-- (+) total_other_inputs_cash --}}
        <tr>
            <td class="text-left">{{ __c('other_inputs') }}</td>
            <td class="text-right">{{ number_format($item['total_other_inputs_cash'] - $item['opening_amount'], 2) }}</td>
        </tr>

        {{-- (-) retire_amount --}}
        <tr>
            <td class="text-left">{{ __c('retire_amount') }}</td>
            <td class="text-right">-{{number_format($item['retire_amount'], 2) }}</td>
        </tr>
        {{-- (-) total_payment_purchases_cash --}}
        <tr>
            <td class="text-left">{{ __c('payment_purchases') }}</td>
            <td class="text-right">-{{number_format($item['total_payment_purchases_cash'], 2) }}</td>
        </tr>
        {{-- (-) total_other_outputs_cash --}}
        <tr>
            <td class="text-left">{{ __c('other_outputs') }}</td>
            <td class="text-right">-{{number_format($item['total_other_outputs_cash'] - $item['retire_amount'], 2) }}</td>
        </tr>
    </tbody>

    <tfoot>
        {{-- total_cash --}}
        <tr>
            <td class="text-left">{{ __c('total_cash') }}</td>
            <td class="text-right">{{ $item['total_cash'] }}</td>
        </tr>
        {{-- closing_amount --}}
        <tr>
            <td class="text-left">{{ __c('closing_amount') }}</td>
            <td class="text-right">{{ $item['closing_amount'] }}</td>
        </tr>
        {{-- cierre exacto? --}}
        <tr>
            <td class="text-left">{{ __c('closing_exact') }}</td>
            <td class="text-right">{{$item['is_exact']? __u('yes'): __('no') }}</td>
        </tr>
    </tfoot>

</table>
<hr style="border-top: 1px dotted  black;">
<div class="printed-at">{{__c('printed_at')}}: {{$data['datetime'] }}</div>
@endforeach

@endsection 




