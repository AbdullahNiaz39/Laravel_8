@extends('admin.layout')
@section('main')
@section('size_active','active')
@section('page_title','Manage Size')
    <h1 class="mb10">Manage Size</h1>
    <a href="{{ url('admin/size') }}"> <button type="button" class="btn btn-success">Back</button> </a>

    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    <form action="{{ route('manage_size_process') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="size" class="control-label mb-1">Size</label>
                            <input id="size" name="size" value="{{$size}}" type="text" class="form-control"
                                 >
                            @error('size')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
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
