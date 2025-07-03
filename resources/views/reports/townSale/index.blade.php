@extends('layout.app')
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>View Town Sales Report</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('reportTownSalesData')}}" method="get">
                    <div class="form-group mt-2">
                        <label for="town">Town</label>
                        <select name="townID" id="townID" class="form-control">
                            @foreach($towns as $town)
                                <option value="{{ $town->id }}">{{ $town->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="from">From</label>
                        <input type="date" name="from" id="from" value="{{firstDayOfMonth()}}" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="to">To</label>
                                <input type="date" name="to" id="to" value="{{lastDayOfMonth()}}" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-success w-100" type="submit" id="viewBtn">View Report</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/libs/selectize/selectize.min.css') }}">
    <style>
        .no-padding {
            padding: 5px 5px !important;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-js')
<script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script>
         /* $(document).ready(function() {
        $(".selectize").selectize();
        $("#viewBtn").on("click", function (){
            var from = $("#from").val();
            var to = $("#to").val();
            var area = $("#areaID").find().val();
            var url = "{{ route('reportAreaSalesData', ['from' => ':from', 'to' => ':to', 'area' => ':area']) }}"
                .replace(':from', from)
                .replace(':area', area)
                .replace(':to', to);
            window.open(url, "_blank", "width=1000,height=800");
        }); */
    });
    </script>
@endsection
