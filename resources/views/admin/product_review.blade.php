@extends('admin.layout')
@section('main')
@section('page_title','Product Review')
@section('review_active','active')


         <!-- MAIN CONTENT-->

                    <h1 class="mb10">Product Review</h1>
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>Product</th>
                                            <th>Rating</th>
                                            <th>Review</th>
                                            <th>Added On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product_review as $list)
                                        <tr>
                                            <td>{{$list->id}}</td>
                                            <td>{{$list->name}}</td>
                                            <td>{{$list->pname}}</td>
                                            <td>{{$list->rating}}</td>
                                            <td>{{$list->review}}</td>
                                            <td>{{$list->added_on}}</td>


                                            <td>
                                                @if($list->status =='1')
                                                <a href="{{url('admin/update_product_review_status/0')}}/{{$list->id}}"><button  type="submit" class="btn btn-sm btn-success ">
                                                Active
                                            </button></a>
                                            @else
                                             <a href="{{url('admin/update_product_review_status/1')}}/{{$list->id}}"><button  type="submit" class="btn btn-sm btn-warning">
                                                deactive
                                            </button></a>
                                            @endif
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








