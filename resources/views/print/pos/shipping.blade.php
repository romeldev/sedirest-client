@extends('layouts.pos_print')

@section('content')

<style>
    table, th, td {
        /* border: 1px solid black; */
    }

</style>

<div class="title-command">{{ $data['title'] }}</div>

<table style="width: 100%">
    <tbody>
        <tr>
            <td class="td-label text-right">PRINT:</td>
            <td>{{ $data['print_counter'] }}</td>
            <td class="td-label text-right">CMD:</td>
            <td>{{ $data['command_id'] }}</td>
            <td class="td-label text-right">SHIP:</td>
            <td>{{ $data['shipping_id'] }}</td>
        </tr>
        <tr>
            <td class="td-label text-right">{{ __u('date') }}:</td>
            <td colspan="5">{{ $data['datetime'] }}</td>
        </tr>
        <tr>
            <td class="td-label text-right">{{ __u('user') }}</td>
            <td colspan="5">{{ $data['username'] }}</td>
        </tr>
    </tbody>
</table>

<table style="width: 100%; margin-top:10px;" >
    <thead>
        <tr>
            <td class="text-right">{{ __u('cant') }}</td>
            <td class="text-center">{{ __u('product') }}</td>
        </tr>
    </thead>

    <tbody>
        @foreach ($data['shipping_preparations'] as $sp)
        <tr style="font-size: 30px; font-weight: bold">
            <td class="text-right pr-10">{{ $sp['quantity'] }}</td>
            <td>{{ $sp['preparation_name'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<hr style="border-top: 1px dotted  black;">

@if (trim($data['note'])!='')
    <div class="note"><b>{{ __u('note') }}: </b>{{ $data['note'] }} </div>
@endif

<div class="printed-at">{{__c('dispatch_in')}}: {{$data['dispatch_in'] }}</div>
@endsection



