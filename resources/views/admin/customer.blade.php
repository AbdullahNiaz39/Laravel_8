@extends('admin.layout')
@section('main')
@section('page_title','Customer')
@section('customer_active','active')


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
                    <h1 class="mb10">Customer</h1>
                    <div class="row m-t-30">
                        <div class="col-sm-12">
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>

                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $list)
                                        <tr>
                                            <td>{{$list->id}}</td>
                                            <td>{{$list->name}}</td>
                                            <td>{{$list->email}}</td>
                                            <td>{{$list->mobile}}</td>




                                            <td>
                                                @if($list->status =='1')
                                                <a href="{{url('admin/customer/status/0')}}/{{$list->id}}"><button  type="submit" class="btn btn-sm btn-success ">
                                                Active
                                            </button></a>
                                            @else
                                             <a href="{{url('admin/customer/status/1')}}/{{$list->id}}"><button  type="submit" class="btn btn-sm btn-warning">
                                                deactive
                                            </button></a>
                                            @endif
                                           <a href="{{url('admin/customer/show')}}/{{$list->id}}"> <button  type="submit" class="btn btn-sm btn-info ">
                                                View
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








