@extends('admin.layouts.master')

@section('title','Pizza Details')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-10 offset-1">
                    {{-- alert  --}}
                        @if(session('updateSuccess'))
                            <div class="w-100">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-regular fa-circle-xmark"></i> {{ session('updateSuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                    {{-- alert end  --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">

                                <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i> <span>Back</span>

                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-5 ">
                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('storage/'.$pizzas->image) }}" class="img-thumbnail shadow-sm" />
                                            </a>
                                        </div>
                                </div>
                                <div class="col-7">
                                    <form action="">
                                        <div class="my-3 bg-danger btn btn-danger d-block w-50"> <i class="fa-solid fa-pizza-slice me-2"></i> {{ $pizzas->name }}</div>


                                        <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-hand-holding-dollar me-2"></i> {{ $pizzas->price }} kyats</span>
                                        <span class="my-3 btn bg-dark text-white"> <i class="fa-regular fa-clock me-2"></i>  {{ $pizzas->waiting_time }} mins </span>
                                        <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-clone me-2"></i> {{ $pizzas->category_name }}  </span>
                                        <span class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-eye"></i> {{ $pizzas->view_count }}</span>
                                        <div class="my-3"> <i class="fa-solid fa-clock me-2"></i> {{ $pizzas->created_at->format('j-F Y') }}</div>

                                        <div class="my-3"> <i class="fa-regular fa-comments me-2"></i> {{ $pizzas->description }}</div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
