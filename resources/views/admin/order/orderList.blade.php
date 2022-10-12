@extends('admin.layouts.master')

@section('title','Product Lists')
@section('content')


<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order Lists</h2>

                        </div>
                    </div>

                </div>
                <a href="{{ route('order#orderList')}}" class="text-dark">
                    <i class="fa-solid fa-arrow-left me-2"></i>Back
                </a>

                <div class="row ">
                    <div class="col-1 offset-10 bg-white shadow-sm p-2">
                        <h4> <i class="fa-solid fa-database ms-2"></i> -{{count($orderList)}}</h4>
                    </div>
                </div>

                <div class="row col-6">
                    <div class="card mt-4">
                        <div class="cart-title fw-bold text-center mt-3"> <i class="fa-solid fa-file-invoice me-1"></i> Order Info

                        </div>
                        <small class=" text-warning text-center"> <i class="fa-solid fa-triangle-exclamation"></i> Include Delivery Charges</small>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5"><i class="fa-solid fa-user me-1"></i> User Name</div>
                                <div class="col">  {{ strtoupper($orderList[0]->user_name) }} </div>
                            </div>
                            <div class="row">
                                <div class="col-5"><i class="fa-solid fa-id-card-clip me-1"></i> Order Code</div>
                                <div class="col"> {{ $orderList[0]->order_code}}</div>
                            </div>
                            <div class="row">
                                <div class="col-5"><i class="fa-solid fa-clock me-1"></i> Order Date </div>
                                <div class="col">  {{ $orderList[0]->created_at->format('j-F-Y')}}</div>
                            </div>
                            <div class="row">
                                <div class="col-5"><i class="fa-solid fa-money-check-dollar me-1"></i> Total </div>
                                <div class="col">  {{ $order->total_price}} kyats</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2 ">
                    <table class="table table-data2 w-100">
                        <thead>
                            <tr>
                                <th></th>
                                <th>User ID</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Total Price</th>

                            </tr>
                        </thead>
                        <tbody class="dataList ">
                            @foreach ($orderList as $o )
                             <tr class="tr-shadow ">
                                <td class="col-0"></td>
                                <td>{{ $o->user_id }} </td>
                                <td>
                                    <img src="{{ asset('storage/'.$o->pizzaImage) }}" style="height: 100px;width:130px" class=" img-thumbnail " alt="">
                                </td>
                                <td>{{ $o->pizza_name}} </td>
                                <td>{{ $o->qty}} </td>
                                <td>{{ $o->total}} kyats</td>

                             </tr>
                            @endforeach
                         </tbody>
                    </table>
                </div>
                <div class=" my-3">
                    {{-- {{ $order->links() }} --}}
                </div>

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
@endsection
@section('scriptSource')

@endsection

