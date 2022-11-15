@extends('admin.layout')
@section('main')
@section('page_title','Order')
@section('order_active','active')


         <!-- MAIN CONTENT-->

                    <h1 class="mb10">Order</h1>
                   <div class="row m-t-30">
                        <div class="col-md-12">
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer Details</th>
                                            <th>Order Status</th>
                                            <th>Payment Type</th>
                                            <th>Payment Status</th>
                                            <th>Order Date</th>
                                            <th>Total Amt</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order as $list)
                                        <tr>
                                            <td><a href="{{ url('/admin/order_detail') }}/{{$list->id}}">{{$list->id}}</a></td>
                                            <td>{{$list->name}}<br>
                                                {{$list->email}}<br>
                                                {{$list->mobile}}<br>
                                                {{$list->address}},{{$list->state}}<br>
                                                {{$list->city}},{{$list->zip}}</td>
                                            <td>{{$list->order_status}}</td>
                                            <td>{{$list->payment_type}}</td>
                                            <td>{{$list->payment_status}}</td>
                                            <td>{{$list->added_on}}</td>
                                            <td>{{$list->total_amt}}</td>


                                            {{-- <td>
                                                @if($list->status =='1')
                                                <a href="{{url('admin/tax/status/0')}}/{{$list->id}}"><button  type="submit" class="btn btn-sm btn-success ">
                                                Active
                                            </button></a>
                                            @else
                                             <a href="{{url('admin/tax/status/1')}}/{{$list->id}}"><button  type="submit" class="btn btn-sm btn-warning">
                                                deactive
                                            </button></a>
                                            @endif
                                             <a href="{{url('admin/tax/manage_tax')}}/{{$list->id}}"><button  type="submit" class="btn btn-sm btn-info ">
                                                Edit
                                            </button></a>

                                           <a href="{{url('admin/tax/delete')}}/{{$list->id}}"> <button  type="submit" class="btn btn-sm btn-danger ">
                                                Delete
                                            </button></a>
                                        </td> --}}
                                        </tr>
                                        @endforeach




                                    </tbody>
                                </table>
                            </div>
                            <!-- END DATA TABLE-->
                        </div>
                    </div>


@endsection








