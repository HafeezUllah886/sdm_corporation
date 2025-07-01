@extends('layout.popups')
@section('content')
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="card" id="demo">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end d-print-none p-2 mt-4">
                                <a href="javascript:window.print()" class="btn btn-success ml-4"><i class="ri-printer-line mr-4"></i> Print</a>
                            </div>
                            <div class="card-header border-bottom-dashed p-4">
                                @include('layout.header')
                            </div>
                            <div class="col-lg-12 ">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4 text-center"><h2>ORDER RECEIPT</h2></div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-2">
                                            <p class="text-muted mb-2 text-uppercase fw-semibold">Order #</p>
                                            <h5 class="fs-14 mb-0">{{$order->id}}</h5>
                                        </div>
                                        <div class="col-5">
                                            <p class="text-muted mb-2 text-uppercase fw-semibold">Customer</p>
                                            <h5 class="fs-14 mb-0"> <span class="text-muted">M/S :</span> {{$order->customer->title}}</h5>
                                            @if ($order->customerID != 2)
                                            <h5 class="fs-14 mb-0"> <span class="text-muted">CNIC :</span> {{$order->customer->cnic ?? "NA"}} | <span class="text-muted">Contact :</span> {{$order->customer->contact ?? "NA"}}</h5>
                                            <h5 class="fs-14 mb-0"> <span class="text-muted">Type :</span> {{$order->customer->c_type}} | NTN #</span> {{$order->customer->ntn ?? "NA"}} | <span class="text-muted">STRN #</span> {{$order->customer->strn ?? "NA"}}</h5>
                                            <h5 class="fs-14 mb-0"> <span class="text-muted">Address :</span> {{$order->customer->address ?? "NA"}}</h5>
                                            @endif

                                        </div>
                                        <div class="col-3">
                                            <p class="text-muted mb-2 text-uppercase fw-semibold">Order Booker</p>
                                            <h5 class="fs-14 mb-0">{{$order->orderbooker->name}}</h5>
                                        </div>
                                        <div class="col-2">
                                            <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                            <h5 class="fs-14 mb-0">{{date("d M Y" ,strtotime($order->date))}}</h5>
                                        </div>
                                        <!--end col-->
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end card-body-->
                            </div><!--end col-->
                            <!--end card-header-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr class="table-active">
                                                <th scope="col" style="width: 50px;">#</th>
                                                <th scope="col" class="text-start">Product</th>
                                                <th scope="col" class="text-start">Unit</th>
                                                <th scope="col" class="text-end">Qty</th>
                                                <th scope="col" class="text-end">Bonus</th>
                                                <th scope="col" class="text-end">Price</th>
                                                <th scope="col" class="text-end">Discount</th>
                                                <th scope="col" class="text-end">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalQty = 0;
                                                $totalDiscount = 0;
                                            @endphp
                                           @foreach ($order->details as $key => $product)
                                           @php
                                               $totalQty += $product->qty / $product->unitValue;
                                               $totalDiscount += $product->qty * $product->discount;
                                           @endphp
                                               <tr class="border-1 border-dark">
                                                <td class="m-1 p-1 border-1 border-dark">{{$key+1}}</td>
                                                <td class="text-start m-1 p-1 border-1 border-dark">{{$product->product->name}}</td>
                                                <td class="text-start m-1 p-1 border-1 border-dark">{{$product->unit->name}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($product->qty / $product->unitValue,2)}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($product->bonus)}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($product->price, 2)}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($product->discount, 2)}}</td>
                                                <td class="text-end m-1 p-1 border-1 border-dark">{{number_format($product->amount, 2)}}</td>
                                               </tr>
                                           @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="m-0 p-0">
                                                <th colspan="3" class="text-end p-0 m-0">Total Order</th>
                                                <th class="text-end p-0 m-0">{{number_format($totalQty,2)}}</th>
                                                <th></th>
                                                <th></th>
                                                <th class="text-end p-0 m-0">{{number_format($totalDiscount,2)}}</th>
                                                <th class="text-end p-0 m-0">{{number_format($order->details->sum('amount'),2)}}</th>
                                            </tr>
                                        </tfoot>
                                    </table><!--end table-->
                                </div>
                            </div>
                            <div class="card-footer">
                                @if ($order->notes != "")
                                <p><strong>Notes: </strong>{{$order->notes}}</p>
                                @endif
                             {{--   <p class="text-center urdu"><strong>نوٹ: مال آپ کے آرڈر کے مطابق بھیجا جا رہا ہے۔ مال ایکسپائر یا خراب ہونے کی صورت میں واپس نہیں لیا جائے گا۔ دکاندار سیلزمین کے ساتھ کسی قسم کے ذاتی لین دین کا ذمہ دار خود ہوگا۔</strong></p>
 --}}
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->

                    </div><!--end row-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

@endsection

@section('page-css')
<link rel="stylesheet" href="{{ asset('assets/libs/datatable/datatable.bootstrap5.min.css') }}" />
<!--datatable responsive css-->
<link rel="stylesheet" href="{{ asset('assets/libs/datatable/responsive.bootstrap.min.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/libs/datatable/buttons.dataTables.min.css') }}">
<link href='https://fonts.googleapis.com/css?family=Noto Nastaliq Urdu' rel='stylesheet'>
<style>
    .urdu {
        font-family: 'Noto Nastaliq Urdu';font-size: 12px;
    }
    </style>
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/vfs_fonts.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/jszip.min.js')}}"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection

