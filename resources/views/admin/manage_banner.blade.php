@extends('admin.layout')
@section('main')
@section('banner_active','active')
@section('page_title','Manage Banner')
    <h1 class="mb10">Manage Banner</h1>
    <a href="{{ url('admin/banner') }}"> <button type="button" class="btn btn-success">Back</button> </a>

    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    <form action="{{ route('manage_banner_process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                            <label for="btn_text" class="control-label mb-1">Button Text</label>
                            <input id="btn_text" name="btn_text" value="{{$btn_text}}" type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="btn_link" class="control-label mb-1">Button link</label>
                            <input id="btn_link" name="btn_link" value="{{$btn_link}}" type="text" class="form-control">
                                @error('btn_link')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label for="Image" class="control-label mb-1">Image</label>
                    <input id="image" name="image" value="{{$image}}" type="file" class="form-control">
                    @error('image')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    @if($image!='')
                    <img src="{{asset('admin_assets/images/banner/'.$image)}}" width="80px" alt="No Image">
                    @endif
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
