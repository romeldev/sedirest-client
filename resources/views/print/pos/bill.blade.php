@extends('layouts.pos_print')

@section('content')

<style>
    table, th, td {
        /* border: 1px solid black; */
    }

    .logo-head {
        display: block;
    }

</style>

@php
    // solo mostrar el logo si tiene tiket
    $logoName = '/img/ticket-logo.png';
@endphp

@if (file_exists(public_path($logoName)))
    <div class="logo-head">
        <img src="{{ asset($logoName) }}" width="100%">
    </div>
@endif

<div class="title-command">{{ $data['title'] }}</div>

<table style="width: 100%">
    <tbody>
        <tr>
            <td class="td-label text-right">COMANDA:</td>
            <td>{{ $data['command_id'] }}</td>
        </tr>
        <tr>
            <td class="td-label text-right">USUARIO:</td>
            <td>{{ $data['username'] }}</td>
        </tr>

        @if (trim($data['client_name']!=''))
        <tr>
            <td class="td-label text-right">CLIENTE:</td>
            <td>{{ $data['client_name'] }}</td>
        </tr>
        @endif

        <tr>
            <td class="td-label text-right">FECHA:</td>
            <td>{{ $data['mov']['created_at'] }}</td>
        </tr>

        @if (trim($data['client_phone']!=''))
        <tr>
            <td class="td-label text-right">TELEFONO:</td>
            <td>{{ $data['client_phone'] }}</td>
        </tr>
        @endif
    </tbody>
</table>

<table style="width: 100%; margin-top:10px;">
    <thead>
        <tr>
            <td class="bold text-right pr-10">CANT</td>
            <td class="bold text-center">PRODUCTO</td>
            <td class="bold text-center">S.TOTAL</td>
        </tr>
    </thead>

    <tbody>
        @foreach ($data['command_preparations'] as $sp)
        <tr>
            <td class="text-right pr-10">{{ $sp['quantity'] }}</td>
            <td>{{ $sp['preparation_name'] }}</td>
            <td class="text-right pr-10">{{ number_format ($sp['subtotal'], 2) }}</td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr class="bold text-right pr-10">
            <td colspan="2">TOTAL</td>
            <td colspan="2">{{ number_format ($data['total'], 2) }}</td>
        </tr>

        @foreach ($data['mov']['payments'] as $payment)
        <tr class="text-right pr-10">
            <td colspan="2">{{ $payment['payment_method_name'] }}</td>
            <td colspan="2">{{ number_format ($payment['amount'], 2) }}</td>
        </tr>
        @endforeach
    </tfoot>
</table>

@if (trim($data['client_address']!=''))
<p>DIRECCION: {{$data['client_address']}}</p>  
@endif

@endsection



