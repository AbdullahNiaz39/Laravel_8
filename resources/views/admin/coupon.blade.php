@extends('admin.layout')
@section('main')
@section('page_title','Coupons')
@section('coupon_active','active')


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
                    <h1 class="mb10">Coupon</h1>
               <a href="{{url('admin/coupon/manage_coupon')}}"><button type="button" class="btn btn-success">Add Coupon</button> </a>
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Code</th>
                                            <th>Value</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $list)
                                        <tr>
                                            <td>{{$list->id}}</td>
                                            <td>{{$list->title}}</td>
                                            <td>{{$list->code}}</td>
                                            <td>{{$list->value}}</td>
                                            <td>
                                                @if($list->status =='1')
                                                <a href="{{url('admin/coupon/status/0')}}/{{$list->id}}"><button  type="submit" class="btn btn-sm btn-success ">
                                                Active
                                            </button></a>
                                            @else
                                             <a href="{{url('admin/coupon/status/1')}}/{{$list->id}}"><button  type="submit" class="btn btn-sm btn-warning ">
                                                deactive
                                            </button></a>
                                            @endif
                                                <a href="{{url('admin/coupon/manage_coupon')}}/{{$list->id}}"><button  type="submit" class="btn btn-sm btn-info ">
                                                Edit
                                            </button></a>

                                           <a href="{{url('admin/coupon/delete')}}/{{$list->id}}"> <button  type="submit" class="btn btn-sm btn-danger ">
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
