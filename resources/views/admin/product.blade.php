@extends('admin.layout')
@section('main')
@section('page_title','Product')
@section('product_active','active')


         <!-- MAIN CONTENT-->
         @if (session()->has('msg'))
         <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
             {{session('msg')}}
             <button type="button" class="close" data-dismiss="alert" aria-label="close">
                 <span aria-hidden="true">x</span>
             </button>
         </div>

         @endif
         @if (session()->has('del'))
         <div class="sufee-alert alert with-close alert-danger alert-dismissible fade-show">
             {{session('del')}}
             <button type="button" class="close" data-dismiss="alert" aria-label="close">
                 <span aria-hidden="true">x</span>
             </button>
         </div>
         @endif
                    <h1 class="mb10">Product</h1>
               <a href="{{url('admin/product/manage_product')}}">     <button type="button" class="btn btn-success">Add Product</button> </a>
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Slug</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $list)
                                        <tr>
                                            <td>{{$list->id}}</td>
                                            <td>
                                                @if ($list->image=="")
                                                    No Image
                                                @else
                                                <img src="{{asset('admin_assets/images/'.$list->image)}}" width="80px" alt="No Image">
                                                @endif
                                              </td>
                                            <td>{{$list->name}}</td>
                                            <td>{{$list->slug}}</td>


                                            <td>
                                                @if($list->status =='1')
                                                <a href="{{url('admin/product/status/0')}}/{{$list->id}}"><button  type="submit" class="btn btn-sm btn-success ">
                                                Active
                                            </button></a>
                                            @else
                                             <a href="{{url('admin/product/status/1')}}/{{$list->id}}"><button  type="submit" class="btn btn-sm btn-warning">
                                                deactive
                                            </button></a>
                                            @endif
                                             <a href="{{url('admin/product/manage_product')}}/{{$list->id}}"><button  type="submit" class="btn btn-sm btn-info ">
                                                Edit
                                            </button></a>

                                           <a href="{{url('admin/product/delete')}}/{{$list->id}}"> <button  type="submit" class="btn btn-sm btn-danger ">
                                                Delete
                                            </button></a>
                                        </td>
                                        </tr>
                                        @endforeach




                                    </tbody>
                                </table>
                            </div>
                            <!-- END DATA TABLE-->
                        </div>
                    </div>


@endsection








