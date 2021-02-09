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
            <td class="text-left bold">{{ __u('supply') }}</td>
            <td class="text-right bold">{{ __u('cant') }}</td>
            <td width="50"></td>
        </tr>
    </thead>
    <tbody>
        {{-- @php
            dd($item);
        @endphp --}}
        @foreach ($data['items'] as $item)
        <tr>
            <td>{{ $item['supply_name'] }}</td>
            <td class="text-right">{{ number_format($item['comercial_content'], 3) }}</td>
            <td class="text-center">{{ $item['comercial_unit_symbol'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<hr style="border-top: 1px dotted  black;">
<div class="printed-at">{{__c('printed_at')}}: {{$data['datetime'] }}</div>
@endsection



