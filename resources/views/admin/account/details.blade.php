@extends('admin.layouts.master')

@section('title','Account Profile')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-6 offset-3">
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
                                <h3 class="password-center title-2 text-center">Account Info </h3>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-5 ">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{ asset('image/male_default.jpeg')}}" class=" img-thumbnail rounded" />
                                                </a>
                                            </div>
                                        @else
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{ asset('image/female_default.jpeg')}}" class=" img-thumbnail rounded" />
                                                </a>
                                            </div>
                                        @endif
                                    @else
                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('storage/'.Auth::user()->image) }}"  />
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-7">
                                    <form action="">
                                        <h4 class="my-3"> <i class="fa-regular fa-circle-user me-2"></i> {{ Auth::user()->name }}</h4>
                                        <h4 class="my-3"> <i class="fa-solid fa-envelope me-2"></i> {{ Auth::user()->email }}</h4>
                                        <h4 class="my-3"> <i class="fa-solid fa-mobile-screen me-2"></i> {{ Auth::user()->phone }}</h4>
                                        <h4 class="my-3"> <i class="fa-solid fa-venus-mars me-2"></i> {{ Auth::user()->gender }}</h4>
                                        <h4 class="my-3"> <i class="fa-solid fa-map-location-dot me-2"></i> {{ Auth::user()->address }}</h4>
                                        <h4 class="my-3"> <i class="fa-solid fa-clock me-2"></i> {{ Auth::user()->created_at->format('j-F Y') }}</h4>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5  ">
                                   <a href="{{ route('admin#edit')}}" class="w-100">
                                        <button class="btn btn-dark text-white w-100">
                                            <i class="fa-solid fa-user-pen me-2"></i> Edit Profile
                                        </button>
                                   </a>
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
