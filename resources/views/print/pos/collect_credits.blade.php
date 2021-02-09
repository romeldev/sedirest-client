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
            <td class="text-center">{{ __u('client') }}</td>
            <td class="text-right">{{ __u('cant') }}</td>
        </tr>
    </thead>
    
    <tbody>
        @foreach ($data['items'] as $item)
        <tr>
            <td>{{$item['client_name']}}</td>
            <td class="text-right">{{ number_format ($item['amount'], 2) }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr class="text-right">
            <td colspan="1">TOTAL</td>
            <td colspan="1">{{ number_format ($data['total'], 2) }}</td>
        </tr>
    </tfoot>
</table>

<hr style="border-top: 1px dotted  black;">
<div class="printed-at">{{__c('printed_at')}}: {{$data['datetime'] }}</div>

@endsection



