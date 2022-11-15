@extends('front.layout')
@section('content')
@section('page_title','Cart Page')
   <section id="cart-view">
    <div class="container">
      <div class="row">
      <div class="col-md-6">
        <div class="order_detail">
            <h3>Details Address</h3>
            {{ $orders_detail[0]->name }}<br/>{{ $orders_detail[0]->mobile }}<br/>{{ $orders_detail[0]->address }}<br/>{{ $orders_detail[0]->city }}<br/>
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
        <div class="col-md-12">
          <div class="cart-view-area">

            <div class="cart-view-table">


            {{-- Card Data Display --}}
              <form action="">

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
                             <td><img src="{{asset('admin_assets/images/'.$list->attr_image)}}"></td>
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
    </div>
  </section>



  @endsection
