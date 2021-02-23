@extends('layouts.pos_print')

@section('content')

<style>
    table, th, td {
        /* border: 1px solid black; */
    }

</style>

@php
    $decimals = 1;

    // echo json_encode($data['items']);
@endphp

<div class="title">{{ $data['title'] }}</div>

<table style="width:100%" style=" border-collapse: collapse;">
    <thead>
        <tr>
            <td class="text-center" width="50">#</td>
            <td class="text-center">{{ __u('descrip') }}</td>
            <td class="text-right">{{ __u('cant') }}</td>
        </tr>
    </thead>
    <tbody>
        {{-- sales by method payments --}}
        @foreach ($data['items'] as $key => $mov)
        @php
            $sign = $mov['type']==1? 1: -1;
        @endphp
        <tr>
            <td class="text-center">{{ $key+1 }}</td>
            <td class="text-left">{{ $mov['concept_descrip'] }}</td>
            <td class="text-right">{{ number_format($mov['total']*$sign, 2) }}</td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="2" class="text-right bold">{{ __u('total') }}</td>
            <td class="text-right bold">{{ number_format(collect($data['items'])->sum('total'), $decimals) }}</td>
        </tr>
    </tfoot>

</table>
<hr style="border-top: 1px dotted  black;">
<div class="printed-at">{{__c('printed_at')}}: {{$data['datetime'] }}</div>

@endsection 




