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
            <td class="text-left bold">{{ __u('product') }}</td>
            <td class="text-right bold">{{ __u('cant') }}</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['items'] as $item)
        <tr>
            <td>{{ $item['product_name'] }}</td>
            <td class="text-right">{{ number_format($item['amount'], 3) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<hr style="border-top: 1px dotted  black;">
<div class="printed-at">{{__c('printed_at')}}: {{$data['datetime'] }}</div>
@endsection



