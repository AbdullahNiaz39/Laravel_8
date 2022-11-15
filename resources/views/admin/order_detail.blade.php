@extends('admin.layout')
@section('main')
@section('page_title','Order_detail')
@section('order_active','active')


         <!-- MAIN CONTENT-->

                    <h1 class="mb10">Order - {{ $orders_detail[0]->id }}</h1>
                   <div class="row m-t-30 whitebg">
                    <div class="col-md-6">
                        <div class="order_detail">
                            <h3>Details Address</h3>
                            {{ $orders_detail[0]->name }} ({{ $orders_detail[0]->mobile }})<br/>{{ $orders_detail[0]->address }}<br/>{{ $orders_detail[0]->city }}<br/>
                            {{ $orders_detail[0]->state }}<br/>{{ $orders_detail[0]->zip }}<br/>
                    </div>
                      </div>
                      <div class="col-md-6">
                        <div class="order_detail">
                            <h3>Order Details</h3>
                            Order Status : {{ $orders_detail[0]->order_status }}
                            <br/>Payment Status : {{ $orders_detail[0]->payment_status }}<br/>
                            Payment Type : {{ $orders_detail[0]->payment_type}}<br/>
                            @php
                                if($orders_detail[0]->payment_id>0){
                                    echo 'Payment ID: '.$orders_detail[0]->payment_id;
                                }
                
                            @endphp
                    </div>
                    </div>

                    <div style="clear: both"></div>
                        <div class="col-md-12">
                          <div class="cart-view-area">
                
                            <div class="cart-view-table">
                
                
                            {{-- Card Data Display --}}
                              
                                <div class="table-responsive">
                                   <table class="table">
                                     <thead>
                                       <tr>
                                         <th>Image</th>
                                         <th>Product</th>
                                         <th>Color</th>
                                         <th>Size</th>
                                         <th>Price</th>
                                         <th>Qty</th>
                                         <th>Total </th>
                                        </tr>
                                     </thead>
                                     <tbody>
                                         @php
                                             $totalAmt=0;
                                         @endphp
                                         @foreach ($orders_detail as $list)
                                         @php
                                             $totalAmt=$totalAmt+($list->price* $list->qty);
                                         @endphp
                                         <tr>
                                             <td><img src="{{asset('admin_assets/images/'.$list->attr_image)}}" width="100px"></td>
                                             <td>{{ $list->pname }}</td>
                                             <td>{{ $list->color }}</td>
                                             <td>{{ $list->size }}</td>
                                             <td>{{ $list->price }}</td>
                                             <td>{{ $list->qty }}</td>
                                             <td>{{ $list->price* $list->qty }}</td>
                                             </tr>
                                         @endforeach
                                         <tr>
                                             <td colspan="5">&nbsp;</td>
                                             <td><b>Total</b></td>
                                             <td><b>{{$totalAmt}}</b></td>
                                         </tr>
                                         @php
                                         if($orders_detail[0]->coupon_value>0){
                                             echo '<tr>
                                             <td colspan="5">&nbsp;</td>
                                             <td><b>Coupon Code</b></td>
                                             <td>'.$orders_detail[0]->coupon_value.'</b></td>
                                                </tr>';
                                                $totalAmt=$totalAmt-$orders_detail[0]->coupon_value;
                                             echo '<tr>
                                             <td colspan="5">&nbsp;</td>
                                             <td><b>Final Total</b></td>
                                             <td><b>'.$totalAmt.'</b></td>
                                                </tr>';
                                            }
                                         @endphp
                
                                       </tbody>
                                   </table>
                                 </div>
                                  </form>
                              <!-- Cart Total view -->
                
                            </div>
                          </div>
                        </div>
                        
                    </div>
                    <div class="order_operation ">
                    <b>Update Payment Status</b>
                        <select class="form-control m-b-10" id="payment_status" onchange="update_payment_status({{$orders_detail[0]->id}})">
                            @foreach ($payment_status as $list)
                            @if ($orders_detail[0]->payment_status==$list)
                            <option value="{{ $list }}" selected>{{ $list }}</option>    
                            @else
                            <option value="{{ $list }}">{{ $list }}</option>
                            @endif
                            
                            @endforeach
                        </select>

                        <strong>Update Order Status</strong>
                        <select class="form-control m-b-10" id="order_status" onchange="update_order_status({{$orders_detail[0]->id}})">
                            @foreach ($order_status as $list)
                            @if ($orders_detail[0]->order_status==$list->order_status)
                            <option value="{{ $list->id }}" selected>{{ $list->order_status }}</option>    
                            @else
                            <option value="{{ $list->id }}">{{ $list->order_status }}</option>
                            @endif
                            @endforeach

                        </select>
                        


<form method="POST">
    @csrf
<textarea name="track_detail" class="form-control m-b-10">{{$orders_detail[0]->track_detail}}</textarea>
<button type="submit" class="btn btn-success">Update</button>
</form>

                    </div>


@endsection








