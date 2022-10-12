@extends('user.layouts.master')

@section('content')
 <!-- MAIN CONTENT-->
 <div class="main-content p-5">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-md-6 offset-3 ">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="password-center title-2 text-center">Contact Us</h3>
                        </div>
                        <hr>
                        <form action="{{ route('user#contact')}}" method="post" novalidate="novalidate">
                            @csrf
                            {{-- //message alert --}}
                            <div class="form-group my-3">
                                 @if(session('SendSuccess'))
                                    <div class="col-12 ">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="fa-solid fa-circle-check"></i> {{ session('SendSuccess') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif

                            </div>
                            {{-- end alert  --}}

                            <div class="form-group my-3 row">
                                <div class="col">
                                    <label for="" class="control-label mb-1 fw-bold">Name</label>
                                    <input id="" name="name" type="text" value="" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder=" Enter your name...">
                                    @error('name')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="" class="control-label mb-1 fw-bold">Email </label>
                                    <input id="" name="email" type="email" value="" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder=" Enter your email...">
                                    @error('email')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group my-3">
                                <label for="" class="control-label mb-1 fw-bold">Subject</label>
                                <input id="" name="subject" type="text" value="" class="form-control @error('subject') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder=" Enter Subject...">
                                @error('subject')
                                    <small class=" invalid-feedback">{{ $message}}</small>
                                @enderror
                            </div>
                            <div class="form-group my-3">
                                <label for="" class="control-label mb-1 fw-bold">Message</label>
                                <textarea name="message" id="" class="form-control @error('message') is-invalid @enderror" cols="30" rows="10" placeholder="Enter your message..."></textarea>
                                @error('message')
                                    <small class=" invalid-feedback">{{ $message}}</small>
                                @enderror
                            </div>

                            <div class="form-group my-3">
                                <button id="payment-button" type="submit" class="btn btn-lg btn-warning text-white btn-block my-3">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    <span id="payment-button-amount">Send</span>
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
