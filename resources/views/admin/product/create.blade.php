@extends('admin.layouts.master')

@section('title','Category Create')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8 ">
                        <a href="{{ route('products#list')}}"><button class="btn bg-dark text-white my-3"> Lists</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create Your Products </h3>
                            </div>
                            <hr>
                            <form action="{{ route('products#create')}}" enctype="multipart/form-data" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Name</label>
                                    <input id="" name="pizzaName" type="text" value="{{ old('pizzaName')}}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your pizza name...">
                                    @error('pizzaName')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Category</label>
                                    <select name="pizzaCategory" id="" class="form-control @error('pizzaCategory') is-invalid @enderror" >
                                        <option value="">Choose your pizza name</option>
                                        @foreach ($categories as $c)
                                            <option value="{{ $c->id }}" {{ (old("pizzaCategory") == $c->id ? "selected":"") }}> {{ $c->name}} </option>
                                        @endforeach
                                    </select>
                                    @error('pizzaCategory')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Description</label>
                                    <textarea name="pizzaDescription" id="" class="form-control @error('pizzaDescription') is-invalid @enderror" placeholder="Enter Description" cols="30" rows="10">{{ old('pizzaDescription')}}</textarea>
                                    @error('pizzaDescription')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Image</label>
                                    <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror" id="">
                                    @error('pizzaImage')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Waiting Time</label>
                                    <input id="" name="pizzaWaitingTime" type="number" value="{{ old('pizzaWaitingTime')}}" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizza waiting time...">
                                    @error('pizzaWaitingTime')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Price</label>
                                    <input id="" name="pizzaPrice" type="number" value="{{ old('pizzaPrice')}}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizza price...">
                                    @error('pizzaPrice')
                                        <small class=" invalid-feedback">{{ $message}}</small>
                                    @enderror
                                </div>


                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                        <i class="fa-solid fa-circle-right"></i>
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
