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
                            <h2 class="title-1">Contact Message </h2>
                        </div>
                    </div>

                </div>
                <div class="card-title">
                    <a href="{{ route('admin#contactMessage')}}" class=" text-dark">
                         <i class="fa-solid fa-arrow-left text-dark me-2"></i>Back
                    </a>
                </div>

                {{-- alert  --}}
                @if(session('sendSuccess'))
                    <div class="w-25">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-regular fa-circle-xmark"></i> {{ session('sendSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                {{-- alert end  --}}
                <div class="row col-5">
                    <div class="card mt-4">
                        <div class="cart-title fw-bold text-center mt-3">User Info

                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-5"><i class="fa-solid fa-user me-2"></i>Name</div>
                                <div class="col"> {{ $contact->name}} </div>
                            </div>
                            <div class="row">
                                <div class="col-5"><i class="fa-solid fa-envelope me-2"></i>Email</div>
                                <div class="col"> {{ $contact->email}} </div>
                            </div>

                            <div class="row">
                                <div class="col-5"><i class="fa-regular fa-clock me-2"></i>Date Time </div>
                                <div class="col"> {{ $contact->created_at->format('j-F-Y')}}  </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row col-12">
                    <div class="card mt-4">
                        <div class="cart-title fw-bold text-center mt-3">Description

                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-5"><i class="fa-solid fa-spa me-2"></i> Subject </div>
                                <div class="col">  {{ $contact->subject}} </div>
                            </div>
                            <div class="row">
                                <div class="col-5"><i class="fa-solid fa-envelope-open me-2"></i> Message </div>
                                <div class="col">  {{ $contact->message}} </div>
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

