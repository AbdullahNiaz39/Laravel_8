@extends('admin.layout')
@section('main')
@section('brand_active','active')
@section('page_title','Manage Brand')
    <h1 class="mb10">Manage Brand</h1>
    <a href="{{ url('admin/brand') }}"> <button type="button" class="btn btn-success">Back</button> </a>

    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    <form action="{{ route('manage_brand_process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="Brand_name" class="control-label mb-1">Brand Name</label>
                            <input id="Brand_name" name="name" value="{{$name}}" type="text" class="form-control"
                                 >
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Image" class="control-label mb-1">Image</label>
                            <input id="Brand_image" name="image" type="file" class="form-control"
                                 >
                            @error('image')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            @if($image!='')
                            <img src="{{asset('admin_assets/images/'.$image)}}" width="80px" alt="No Image">
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="is_home" name="is_home"  type="checkbox" {{$is_home_selected}}>
                            <label for="is_home" class="control-label mb-1">Show in home Page</label>
                        </div>

                        <div>
                            <button id="button" type="submit" class="btn btn-lg btn-info btn-block">
                                Submit
                            </button>
                        </div>
                        <input type="hidden" name="id" value="{{$id}}">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
