@extends('admin.layouts.master')

@section('title','Change Role')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-8 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin#list')}}">
                                <i class="fa-solid fa-arrow-left text-dark" "></i>
                            </a>
                            <div class="card-title">
                                <h3 class="password-center title-2 text-center">Role Change </h3>
                            </div>
                            <hr>

                            <form action="{{ route('admin#change',$account->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 ">
                                        @if ($account->image == null)
                                             @if ($account->gender == 'male')
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
                                                    <img src="{{ asset( 'storage/'.$account->image ) }}"  />
                                                </a>
                                            </div>
                                        @endif

                                        <div class="my-2">
                                            <input type="file" name="image" class="form-control " id="" disabled>

                                        </div>

                                        <div class="my-2 ">
                                            <button class="w-100 btn btn-dark text-white" type="submit">
                                                <i class="fa-solid fa-circle-arrow-up me-2"></i> Change
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col">

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Name</label>
                                            <input id="" name="name"  value="{{ old('name',$account->name) }}" class="form-control " aria-required="true" aria-invalid="false" placeholder="Enter Name..." disabled>

                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Role</label>
                                            <select name="role" id="" class="form-control">
                                                <option value="admin" @if($account->role == 'admin') selected  @endif >Admin</option>
                                                <option value="user" @if($account->role == 'user') selected  @endif >User</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Email</label>
                                            <input id="" name="email"  value="{{ old('email',$account->email) }}" class="form-control " aria-required="true" aria-invalid="false" placeholder="Enter Name..." disabled>

                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Phone</label>
                                            <input id="" name="phone"  value="{{ old('phone',$account->phone) }}" class="form-control " aria-required="true" aria-invalid="false" placeholder="Enter Email..." disabled>

                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control " id="" disabled>
                                                <option value="">Choose your gender..</option>
                                                <option value="male" @if($account->gender == 'male') selected @endif >Male</option>
                                                <option value="female" @if($account->gender == 'female') selected @endif> Female</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Address</label>
                                            <input type="text"  class="form-control" value="{{ old('address',$account->address) }}" disabled>

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
