@extends('admin.layout')
@section('main')
@section('tax_active','active')
@section('page_title','Manage Tax')
    <h1 class="mb10">Manage Tax</h1>
    <a href="{{ url('admin/tax') }}"> <button type="button" class="btn btn-success">Back</button> </a>

    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    <form action="{{ route('manage_tax_process') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="Tax" class="control-label mb-1">Tax Value</label>
                            <input id="Tax" name="tax_value" value="{{$tax_value}}" type="text" class="form-control"
                                 >
                            @error('tax_value')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Tax_desc" class="control-label mb-1">Tax Description</label>
                            <input id="Tax" name="tax_desc" value="{{$tax_desc}}" type="text" class="form-control"
                              required   >

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
