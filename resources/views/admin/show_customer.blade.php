@extends('admin.layout')
@section('main')
@section('page_title','Customer Details')
@section('customer_active','active')


         <!-- MAIN CONTENT-->

                    <h1 class="mb10">Customer Details</h1>
                    <div class="row m-t-30">
                        <div class="col-sm-12">
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                            <th>Field</th>
                                            <th>Value</th>



                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>Name</td>
                                            <td>{{$data->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{$data->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <td>{{$data->mobile}}</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>{{$data->address}}</td>
                                        </tr>

                                        <tr>
                                            <td>city</td>
                                            <td>{{$data->city}}</td>
                                        </tr>
                                        <tr>
                                            <td>Zip</td>
                                            <td>{{$data->zip}}</td>
                                        </tr>
                                        <tr>
                                            <td>State</td>
                                            <td>{{$data->state}}</td>
                                        </tr>
                                        <tr>
                                            <td>Company</td>
                                            <td>{{$data->company}}</td>
                                        </tr>
                                        <tr>
                                            <td>Gst Number</td>
                                            <td>{{$data->gstin}}</td>
                                        </tr>
                                        <tr>
                                            <td>Created</td>
                                            <td>{{date('d/M/Y H:i:s', strtotime($data->updated_at))}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- END DATA TABLE-->
                        </div>
                    </div>


@endsection








