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

                <div class="row my-2">
                    <div class="col-1 offset-10 bg-white shadow-sm p-2">
                        <h4> <i class="fa-solid fa-database ms-2"></i> -{{ $order->total()}}</h4>
                    </div>
                </div>

                <form action="{{ route('admin#changeStatus')}}" method="post">

                    @csrf

                    <div class="input-group mb-3">

                        <select name="orderStatus" id="orderStatus" class="form-control col-2">
                            <option value="">All</option>
                            <option value="0" @if(request('orderStatus') == '0' ) selected @endif>Pending</option>
                            <option value="1" @if(request('orderStatus') == '1' ) selected @endif>Success</option>
                            <option value="2" @if(request('orderStatus') == '2' ) selected @endif>Reject</option>
                        </select>
                        <button type="submit" class="btn btn-dark text-white " id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i> </button>

                    </div>

                </form>

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Date</th>
                                <th>Order Code</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="dataList">
                            @foreach ($order as $o )
                             <tr class="tr-shadow ">
                                <input type="hidden" class="orderId" value="{{ $o->id }}">
                                <td>{{ $o->user_id}}  </td>
                                <td>{{ $o->user_name}}  </td>
                                <td>{{ $o->created_at->format('j-F-Y')}}  </td>
                                <td>
                                    <a href="{{ route('admin#listInfo',$o->order_code) }}">{{ $o->order_code}}</a>
                                </td>
                                <td class="amount">{{ $o->total_price}} kyats </td>
                                <td>
                                    <select name="stautus" class="form-control statusChange" id="">
                                        <option value="0" @if($o->status == 0) selected @endif >Pending</option>
                                        <option value="1" @if($o->status == 1) selected @endif>Success</option>
                                        <option value="2" @if($o->status == 2) selected @endif>Reject</option>
                                    </select>
                                </td>
                             </tr>
                            @endforeach

                         </tbody>
                    </table>
                </div>
                <div class=" my-3">
                    {{ $order->links() }}
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
    <script>
        $(document).ready(function(){
            // $('#orderStatus').change(function(){
            //     $status = $('#orderStatus').val();

            //     $.ajax({
            //         type : 'get',
            //         url  : 'http://127.0.0.1:8000/order/ajax/status',
            //         data : {'status' : $status  },
            //         dataType : 'json',
            //         success : function(response){

            //             $list =``;
            //             for($i=0;$i < response.length;$i++){
            //                 $months = ['January','February','Match','April','May','June','July','August','September','October','November','December'];
            //                 $dbDate = new Date(response[$i].created_at);

            //                 $finalDate = $dbDate.getDate()+"-"+$months[$dbDate.getMonth()]+"-"+$dbDate.getFullYear();
            //                 if(response[$i].status == 0 ){
            //                     $statusMessage = `
            //                             <select name="stautus" class="form-control " id="">
            //                                 <option value="0" selected>Pending</option>
            //                                 <option value="1">Success</option>
            //                                 <option value="2">Reject</option>
            //                             </select>
            //                     `;
            //                 }else if(response[$i].status == 1){
            //                     $statusMessage = `
            //                             <select name="stautus" class="form-control " id="">
            //                                 <option value="0">Pending</option>
            //                                 <option value="1" selected>Success</option>
            //                                 <option value="2">Reject</option>
            //                             </select>
            //                     `;
            //                 }else{
            //                     $statusMessage = `
            //                             <select name="stautus" class="form-control " id="">
            //                                 <option value="0">Pending</option>
            //                                 <option value="1">Success</option>
            //                                 <option value="2" selected>Reject</option>
            //                             </select>
            //                     `;
            //                 }

            //                 $list +=`
            //                     <tr class="tr-shadow ">
            //                         <td>${response[$i].user_id }  </td>
            //                         <td>${response[$i].user_name } </td>
            //                         <td>${$finalDate }  </td>
            //                         <td>${response[$i].order_code }  </td>
            //                         <td>${response[$i].total_price } kyats </td>
            //                         <td>
            //                             ${$statusMessage}
            //                         </td>
            //                     </tr>
            //                 `;
            //             }

            //         $('.dataList').html($list);

            //         }
            //     })
            // })

            $('.statusChange').change(function(){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find(".orderId").val();

                $data = {
                    'status' : $currentStatus,
                    'orderId' : $orderId
                }
                $.ajax({
                    type : 'get',
                    url  : '/order/ajax/change/status',
                    data : $data,
                    dataType : 'json',
                    success : function(response){

                    }
                })
            })
        })
    </script>
@endsection

