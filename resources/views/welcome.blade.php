@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Html Outputs</div>

                <div class="card-body">
                    <ul>
                        <li>
                            <a href="{{ url('/storage/print/bill.html') }}">bill</a>
                        </li>
                        <li>
                            <a href="{{ url('/storage/print/clossing.html') }}">clossing</a>
                        </li>
                        <li>
                            <a href="{{ url('/storage/print/shipping.html') }}">shipping</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
