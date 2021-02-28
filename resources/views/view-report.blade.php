@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{$filename}}</div>

                <div class="card-body">
                    html contennt
                  
                    @php
                        include base_path('public\storage\print\bill.html')
                    @endphp
                </div>
            </div>
        </div>
    </div>
@endsection
