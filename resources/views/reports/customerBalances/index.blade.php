@extends('layout.app')
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>View Customer Balances Report</h3>
                </div>
                <div class="card-body">
                    <div class="form-group mt-2">
                        <label for="area">Area</label>
                        <select name="area" id="area_id" class="form-control">
                            <option value="All">All</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-success w-100" id="viewBtn">View Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('page-js')

    <script>
        $("#viewBtn").on("click", function (){
            var area_id = $("#area_id").find(':selected').val();
            console.log(area_id);
        
            var url = "{{ route('reportCustomersBalanceData', ['area' => ':area']) }}"
        .replace(':area', area_id);
            window.open(url, "_blank", "width=1000,height=800");
        });
    </script>
@endsection
