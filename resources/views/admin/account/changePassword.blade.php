@extends('admin.layouts.master')

@section('title','Category Create')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-8 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="password-center title-2 text-center">Change Password </h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#changePassword')}}" method="post" novalidate="novalidate">
                                @csrf

                                {{-- //message alert --}}
                                <div class="form-group">
                                     @if(session('changeSuccess'))
                                        <div class="col-12 ">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="fa-solid fa-cloud-arrow-down"></i> {{ session('changeSuccess') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif
                                     @if(session('notMatch'))
                                        <div class="col-12 ">
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="fa-solid fa-circle-exclamation"></i> {{ session('notMatch') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Old Password</label>
                                    <input id="" name="oldPassword" type="password" value="" class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="old password...">
                                    @error('oldPassword')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">New Password</label>
                                    <input id="" name="newPassword" type="password" value="" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="new password...">
                                    @error('newPassword')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Confirm Password</label>
                                    <input id="" name="confirmPassword" type="password" value="" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="confirm password...">
                                    @error('confirmPassword')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <i class="fa-solid fa-key"></i>
                                        <span id="payment-button-amount">Change Password</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
