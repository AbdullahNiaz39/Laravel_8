@extends('front.layout')
@section('content')
@section('page_title','Cart Page')
   <section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-view-area">

            <div class="cart-view-table">


            {{-- Card Data Display --}}
              <form action="">

                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>

                         <th>Order ID</th>
                         <th>Order Status</th>
                         <th>Payment Status</th>
                         <th>Total Amt</th>
                         <th>Payment ID</th>
                         <th>Placed At</th>
                        </tr>
                     </thead>
                     <tbody>
                         @foreach ($orders as $list)
                         <tr>
                            <td class="order_id_btn"><a class="order_id_btn" href="{{ url('order_detail') }}/{{ $list->id }}">{{ $list->id }}</a></td>
                            <td>{{ $list->order_status }}</td>
                            <td>{{ $list->payment_status }}</td>
                            <td>{{ $list->total_amt }}</td>
                            <td>{{ $list->payment_id }}</td>
                            <td>{{ $list->added_on}}</td>

                        </tr>
                         @endforeach

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
