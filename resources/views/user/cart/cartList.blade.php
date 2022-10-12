@extends('user.layouts.master')

@section('content')

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr >
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $c )

                            <tr>
                                <td><img src="{{ asset('storage/'.$c->pizzaImage)}}" class=" img-thumbnail shadow-sm" alt="" style="width: 100px"></td>
                                <td class="align-middle"> {{ $c->pizza_name}}
                                    <input type="hidden" value="{{ $c->product_id }}" class="productId">
                                    <input type="hidden" value="{{ $c->user_id }}" class="userId">
                                    <input type="hidden" value="{{ $c->cart_id }}" class="orderId">
                                </td>
                                <td class="align-middle" id="pizzaPrice"> {{ $c->pizza_price}} kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">

                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" >
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>

                                        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" id="qty"   value="{{ $c->qty}}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle col-3" id="total">{{$c->pizza_price * $c->qty}} kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove" id="btnRemove"><i class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{$totalPrice}} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">5000kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice" >{{ $totalPrice + 5000}}kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-outline-danger font-weight-bold my-3 py-3" id="clearBtn">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection


@section('scriptSource')

   <script src="{{ asset('js/cart.js')}}"></script>
   <script>
    $(document).ready(function(){
        $('#orderBtn').click(function(){

            $orderList = [];

            $random = Math.floor(Math.random() * 10000001);
            $('#dataTable tbody tr').each(function(index,row){
                $orderList.push({
                    'user_id' : $(row).find('.userId').val(),
                    'product_id' : $(row).find('.productId').val(),
                    'qty' : $(row).find('#qty').val(),
                    'total' : Number($(row).find('#total').text().replace('kyats','')),
                    'order_code' : 'POS'+$random
                })

            })
            $.ajax({
                type : 'get',
                url  : '/user/ajax/order',
                data : Object.assign({}, $orderList),
                dataType : 'json',
                success  : function(response){
                    // console.log(response);
                    if(response.status == 'success'){
                        window.location.href = "/user/homePage";
                    }
                }
            })
        });
        $('#clearBtn').click(function(){
            $('#dataTable tbody tr').remove();
            $('#subTotal').html('0 kyats');
            $('#finalPrice').html('5000 kyats');
            $.ajax({
                type : 'get',
                url  : '/user/ajax/clear/cart',
                dataType : 'json',
            })
        })

        $('.btnRemove').click(function(){
            $productId = $('.productId').val();
            $orderId = $('.orderId').val();
            console.log($productId);
            $.ajax({
                type : 'get',
                url  : '/user/ajax/clear/current/product',
                data : {'productId' : $productId ,'orderId' : $orderId },
                dataType : 'json',
            })
            $parentNode = $(this).parents('tr');
            $parentNode.remove();
        })
    });
   </script>

@endsection
