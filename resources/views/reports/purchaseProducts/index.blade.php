@extends('layout.app')
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>View Products Purchases Report</h3>
                </div>
                <div class="card-body">
                    <div class="form-group mt-2">
                        <label for="from">From</label>
                        <input type="date" name="from" id="from" value="{{firstDayOfMonth()}}" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="to">To</label>
                                <input type="date" name="to" id="to" value="{{lastDayOfMonth()}}" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="category">Product Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="All">All</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="vendor">Vendor</label>
                        <select name="vendor" id="vendor" class="form-control">
                            <option value="All">All</option>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->title }}</option>
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
            var from = $("#from").val();
            var to = $("#to").val();
            var catID = $("#category").val();
            var vendor = $("#vendor").val();
            var url = "{{ route('reportPurchaseProductsData', ['from' => ':from', 'to' => ':to', 'catID' => ':catID', 'vendor' => ':vendor']) }}"
        .replace(':from', from)
        .replace(':to', to)
        .replace(':catID', catID)
        .replace(':vendor', vendor);
            window.open(url, "_blank", "width=1000,height=800");
        });
    </script>
@endsection
