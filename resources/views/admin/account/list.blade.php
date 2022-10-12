@extends('admin.layouts.master')

@section('title','Admin List')
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
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>

                </div>




                <div class="row">
                    <div class="col-3 ">
                        <h5 class=" text-secondary">Search Key : <span class="text-danger">{{ request('key')}}</span></h5>
                    </div>
                    <div class="col-4 offset-8">
                        <form action="{{ route('admin#list') }}" method="get">
                            @csrf
                            <div class="d-flex ">
                                <input type="text" class="form-control" name="key" value="{{ request('key')}}" placeholder="Search.......">
                                <button class="btn btn-dark text-white " type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-1 offset-10 bg-white shadow-sm p-2">
                        <h4> <i class="fa-solid fa-database ms-2"></i> - {{$admin->total()}} </h4>
                    </div>
                </div>
                @if (count($admin) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th> Name</th>
                                <th> Email</th>
                                <th> Phone</th>
                                <th> Gender</th>
                                <th> Address </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($admin as $a)
                            <tr class="tr-shadow ">
                                <input type="hidden" name="" class="userId" value="{{ $a->id }}">
                                <td class="col-2 shadow-sm">
                                    @if ($a->image == null )
                                        @if ($a->gender == 'male')
                                            <div class=""><img src="{{ asset('image/male_default.jpeg')}}" alt=""></div>
                                        @else
                                            <div class=""><img src="{{ asset('image/female_default.jpeg')}}" alt=""></div>
                                        @endif
                                    @else
                                        <div class=""><img src="{{ asset('storage/'.$a->image)}}" alt=""></div>
                                    @endif
                                 </td>
                                <td class="col-2"> {{ $a->name }} </td>
                                <td class="col-2"> {{ $a->email}} </td>
                                <td class="col-2"> {{ $a->phone}} </td>
                                <td class="col-2"> {{ $a->gender}} </td>
                                <td class="col-2"> {{ $a->address}} </td>
                                <td class="col-2">
                                    <div class="table-data-feature">
                                        @if (Auth::user()->id != $a->id)
                                            {{-- <a href="{{ route('admin#changeRole',$a->id)}}" class="me-2">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title=" Change Role">
                                                    <i class="fa-solid fa-user-minus"></i>
                                                </button>
                                            </a> --}}

                                        <select name="role" id="" class="roleChange ">
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>

                                       @endif

                                       @if (Auth::user()->id != $a->id)
                                            <a href="@if (Auth::user()->id == $a->id ) # @else {{ route('admin#delete',$a->id) }}@endif" class="ms-2">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                       @endif
                                    </div>
                                </td>
                            </tr>
                           @endforeach

                        </tbody>
                    </table>
                </div>
                <div class=" my-3">
                    {{ $admin->links() }}
                    {{-- {{ $categories->appends(request()->query())->links()}} --}}
                </div>
                @else
                    <h4 class=" text-secondary text-center my-3">There is no admin Here!</h4>
                @endif
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
        $('.roleChange').change(function(){
          $role = $(this).val()
          $parentNode = $(this).parents("tr")
          $userId = $parentNode.find('.userId').val()
            $data = {
                'role' : $role,
                'userId' : $userId
            }
            $.ajax({
                type : 'get',
                url  : '/order/ajax/roleChange',
                data : $data,
                dataType : 'json',
                success : function(response){

                }
            })
        })

    })
</script>
@endsection
