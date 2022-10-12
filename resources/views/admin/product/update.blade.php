@extends('admin.layouts.master')

@section('title','Update Pizza')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <a href="{{ route('products#list')}}">
                                    <i class="fa-solid fa-arrow-left text-dark" "></i>
                                </a>
                            </div>
                            <hr>

                            <form action="{{ route('products#update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 ">
                                        <input type="hidden" value="{{ $pizzas->id }}" name="pizzaId">
                                        <div class="image">

                                            <a href="#">
                                                <img src="{{ asset('storage/'.$pizzas->image) }}" class="img-thumbnail shadow-sm" />
                                            </a>
                                        </div>

                                        <div class="my-2">
                                            <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror" id="" >

                                            @error('pizzaImage')
                                                <small class=" invalid-feedback">{{ $message}}</small>
                                            @enderror
                                        </div>

                                        <div class="my-2 ">
                                            <button class="w-100 btn btn-dark text-white" type="submit">
                                                <i class="fa-solid fa-circle-arrow-up me-2"></i> Update
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Name</label>
                                            <input id="" name="pizzaName"  value="{{ old('pizzaName',$pizzas->name) }}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                            @error('pizzaName')
                                                <small class=" invalid-feedback">{{ $message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" id="" class="form-control @error('pizzaCategory') is-invalid @enderror" >
                                                <option value="">Choose your pizza name</option>
                                                @foreach ($categories as $c)
                                                    <option value="{{ $c->id }}" {{ $pizzas->category_id == $c->id ? "selected":"" }}> {{ $c->name}} </option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                                <small class=" invalid-feedback">{{ $message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Price</label>
                                            <input id="" name="pizzaPrice"  value="{{ old('phone',$pizzas->price) }}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Price...">
                                            @error('pizzaPrice')
                                                <small class=" invalid-feedback">{{ $message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Waiting Time</label>
                                            <input id="" name="pizzaWaitingTime"  value="{{ $pizzas->waiting_time}}" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time">
                                            @error('pizzaWaitingTime')
                                                <small class=" invalid-feedback">{{ $message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" placeholder="Enter Description..." id="" cols="30" rows="10">{{ old('address',$pizzas->description) }}</textarea>
                                            @error('pizzaDescription')
                                                <small class=" invalid-feedback">{{ $message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">View Count</label>
                                            <input id="" name="viewCount"  value="{{ $pizzas->view_count}}" class="form-control " aria-required="true" aria-invalid="false"  disabled>

                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">View Count</label>
                                            <input id="" name="createdAt"  value="{{ $pizzas->created_at->format('j-F-Y')}}" class="form-control " aria-required="true" aria-invalid="false"  disabled>

                                        </div>

                                    </div>
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
