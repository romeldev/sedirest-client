@extends('layouts.pos_print')

@section('content')

<style>
    table, th, td {
        /* border: 1px solid black; */
    }

</style>

<div class="title">{{ $data['title'] }}</div>

@foreach ($data['items'] as $item)
<table style="width:100%">
    <tr>
        <td class="td-label">{{__c('date')}}:</td>
        <td class="text-right">{{ $item['opened_at'] }}</td>
    </tr>
    <tr>
        <td class="td-label">{{__c('box')}}</b></td>
        <td class="text-right">{{ $item['box_name'] }}</td>
    </tr>
    <tr>
        <td class="td-label">{{__c('open_user')}}</b></td>
        <td class="text-right">{{ $item['opening_user_name'] }}</td>
    </tr>
    <tr>
        <td class="td-label">{{__c('previous_amount')}}</b></td>
        <td class="text-right">{{ number_format($item['previous_closing_amount'], 2) }}</td>
    </tr>
    <tr>
        <td class="td-label">{{__c('init_cash')}}</b></td>
        <td class="text-right">{{ number_format($item['opening_amount'], 2) }}</td>
    </tr>
</table>
<hr style="border-top: 1px dotted  black;">
<div class="printed-at">{{__c('printed_at')}}: {{$data['datetime'] }}</div>
@endforeach

@endsection 




