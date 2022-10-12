@extends('user.layouts.master')

@section('content')
<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Chategory</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 py-1">
                        <label class="" for="price-all">Categories</label>
                        <span class="badge border font-weight-normal">{{ count($category)}}</span>
                    </div>
                    <div class=" d-flex align-items-center justify-content-between mb-3 pt-2">
                        <a href="{{route('user#home')}}" class="text-dark"><label class="text-dark" for="price-all">All</label></a>
                    </div>

                    @foreach ($category as $c)
                        <div class=" d-flex align-items-center justify-content-between mb-3 pt-2">
                            <a href="{{route('user#filter',$c->id)}}" class="text-dark"><label class="" for="price-all">{{ $c->name}}</label></a>
                        </div>
                    @endforeach
                </form>
            </div>
            <!-- Price End -->

           <div class="">
                <button class="btn btn-warning w-100">Order</button>
           </div>
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <a href="{{ route('user#cartList')}}">
                                <button type="button" class="btn btn-primary position-relative">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                      {{ count($carts)}}
                                    </span>
                                </button>
                            </a>
                            <a href="{{ route('user#history')}}" class="ms-2">
                                <button type="button" class="btn btn-primary position-relative">
                                    <i class="fa-solid fa-clock-rotate-left"></i> History
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                      {{ count($history)}}
                                    </span>
                                </button>
                            </a>

                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                {{-- <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div> --}}
                                <select name="sorting" id="sortingOption" class="form-control">
                                    <option value="">Choose Option</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row" id="dataList">
                    @if (count($pizzas) != 0)
                        @foreach ($pizzas as $p)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 250px" src="{{ asset('storage/'.$p->image)}}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href="" class="shoppingCart"><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetails',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $p->price }} kyats</h5><h6 class="text-muted ml-2">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                            <p class="text-center fs-2 p-5">There is no pizza ;'(<i class="fa-solid fa-pizza-slice ms-3"></i> </p>
                    @endif

                </div>

            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

@endsection

@section('scriptSource')
<script>
$(document).ready(function(){

$('#sortingOption').change(function(){
    $eventOption = $('#sortingOption').val();
    // console.log($eventOption);

    if($eventOption == 'asc'){
        $.ajax({
                type: 'get',
                url : 'http://127.0.0.1:8000/user/ajax/pizza/list',
                data:{'status':'asc'},
                dataType: 'json',
                success : function(response){
                    $list =``;
                    for($i=0;$i < response.length;$i++){
                        $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                                <div class="product-item bg-light mb-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height: 300px" src="{{ asset('storage/${response[$i].image}')}}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name } </a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5> ${response[$i].price }  kyats</h5><h6 class="text-muted ml-2">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    }
                    $('#dataList').html($list);
                }
            })
    }else if($eventOption == 'desc'){
    $.ajax({
            type: 'get',
            url : 'http://127.0.0.1:8000/user/ajax/pizza/list',
            data:{'status':'desc'},
            dataType: 'json',
            success : function(response){
                $list =``;
                    for($i=0;$i < response.length;$i++){
                        $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                                <div class="product-item bg-light mb-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height: 300px" src="{{ asset('storage/${response[$i].image}')}}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name } </a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5> ${response[$i].price }  kyats</h5><h6 class="text-muted ml-2">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    }
                    $('#dataList').html($list);
            }
        })
        $(".shoppingCart").click(function(){

            $source = {
                'count' : $("#orderCount").val(),
                'pizzaId' : $("#pizzaId").val(),
                'userId' : $("#userId").val()
            }
            // console.log($source);
            $.ajax({
                type : 'get',
                url  : '/user/ajax/addToCart',
                data : $source,
                dataType : 'json',
                success  : function(response){
                    if(response.status == 'success'){
                        window.location.href = "/user/homePage";
                    }
                }
            })
        });
    }
})
})

</script>
@endsection
