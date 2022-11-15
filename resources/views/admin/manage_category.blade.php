@extends('admin.layout')
@section('main')
@section('category_active','active')
@section('page_title','Manage Category')
    <h1 class="mb10">Manage Category</h1>
    <a href="{{ url('admin/category') }}"> <button type="button" class="btn btn-success">Back</button> </a>

    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    <form action="{{ route('manage_category_process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                            <label for="category" class="control-label mb-1">Category Name</label>
                            <input id="category_name" name="category_name" value="{{$category_name}}" type="text" class="form-control"
                                 >
                            @error('category_name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="category_slug" class="control-label mb-1">Category Slug</label>
                            <input id="category_slug" name="category_slug" value="{{$category_slug}}" type="text" class="form-control"
                                 >
                                @error('category_slug')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            </div>
                            <div class="col-md-4">
                                <label for="parent_category_id" class="control-label mb-1">Parent Category</label>
                                <select id="Parent Category" name="parent_category_id" value="{{$parent_category_id}}"  class="form-control" required>
                                    <option value="0">Select Categories</option>
                                            @foreach ($categorys as $list )
                                            @if ($parent_category_id==$list->id)
                                            <option selected value="{{$list->id}}">
                                                @else
                                                <option value="{{$list->id}}">
                                                @endif
                                            {{$list->category_name}}</option>
                                            @endforeach
                                            </select>

                                </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Image" class="control-label mb-1">Image</label>
                    <input id="category_image" name="category_image" value="{{$category_image}}" type="file" class="form-control"
                        >

                    @error('category_image')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    @if($category_image!='')
                    <img src="{{asset('admin_assets/images/category/'.$category_image)}}" width="80px" alt="No Image">
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
