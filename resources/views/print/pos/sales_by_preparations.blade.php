@extends('layouts.pos_print')

@section('content')

<style>
    table, th, td {
        /* border: 1px solid black; */
    }

</style>

<div class="title">{{ $data['title'] }}</div>

<table style="width: 100%">
    <thead>
        <tr>
            <td class="text-right">{{ __u('cant') }}</td>
            <td class="text-center">{{ __u('preparation') }}</td>
            <td class="text-center">{{ __u('s_total') }}</td>
        </tr>
    </thead>

    @foreach ($data['items'] as $item)
    <tr>
        <td class="text-right pr-10">{{ $item['quantity'] }}</td>
        <td>{{ $item['preparation_name'] }}</td>
        <td class="text-right">{{ number_format ($item['subtotal'], 2) }}</td>
    </tr>
    @endforeach
    <tfoot>
        <tr class="text-right">
            <td colspan="2">{{ __u('total') }}</td>
            <td colspan="1">{{ number_format ($data['total'], 2) }}</td>
        </tr>
    </tfoot>
</table>

<hr style="border-top: 1px dotted  black;">
<div class="printed-at">{{__c('printed_at')}}: {{$data['datetime'] }}</div>
@endsection



