@extends('front.layout')
@section('content')
@section('page_title','Checkout')
<section id="checkout">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
         <div class="checkout-area">
           <form id="frmPlaceOrder">
             <div class="row">
               <div class="col-md-8">
                 <div class="checkout-left">
                   <div class="panel-group" id="accordion">
                  @if (session()->has('FRONT_USER_LOGIN')==null)

                    <input type="button" value="Login" class="aa-browse-btn"
                     data-toggle="modal" data-target="#login-modal">
                     <br><br>
                    OR
                    <br><br>
                    @endif
                     <!-- Coupon section -->
                     {{-- <div class="panel panel-default aa-checkout-coupon">
                       <div class="panel-heading">
                         <h4 class="panel-title">
                           <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                             Have a Coupon?
                           </a>
                         </h4>
                       </div>
                       <div id="collapseOne" class="panel-collapse collapse in">
                         <div class="panel-body">
                           <input type="text" placeholder="Coupon Code" class="aa-coupon-code">
                           <input type="submit" value="Apply Coupon" class="aa-browse-btn">
                         </div>
                       </div>
                     </div> --}}

                     <!-- Billing Details -->
                     <div class="panel panel-default aa-checkout-billaddress">
                       <div class="panel-heading">
                         <h4 class="panel-title">
                           <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                             User Details
                           </a>
                         </h4>
                       </div>
                       <div id="collapseThree" class="panel-collapse collapse">
                         <div class="panel-body">
                           <div class="row">
                             <div class="col-md-4">
                               <div class="aa-checkout-single-bill">
                                 <input type="text" placeholder="Name*" value="{{$customers['name']}}" name="name">
                               </div>
                             </div>
                             <div class="col-md-4">
                                <div class="aa-checkout-single-bill">
                                  <input type="email" placeholder="Email Address*" name="email" value="{{$customers['email']}}" required>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="aa-checkout-single-bill">
                                  <input type="tel" placeholder="Phone*" value="{{$customers['mobile']}}" name="mobile" required>
                                </div>
                              </div>
                           </div>


                           <div class="row">
                             <div class="col-md-12">
                               <div class="aa-checkout-single-bill">
                                 <textarea cols="8" rows="3" name="address" required>{{$customers['address']}}</textarea>
                               </div>
                             </div>
                           </div>

                           <div class="row">
                             <div class="col-md-4">
                               <div class="aa-checkout-single-bill">
                                 <input type="text" placeholder="City / Town*" name="city" value="{{$customers['city']}}" required>
                               </div>
                             </div>
                             <div class="col-md-4">
                                <div class="aa-checkout-single-bill">
                                  <input type="text" placeholder="State*" name="state" value="{{$customers['state']}}" required>
                                </div>
                              </div>
                             <div class="col-md-4">
                                <div class="aa-checkout-single-bill">
                                  <input type="text" placeholder="Postcode / ZIP*" name="zip" value="{{$customers['zip']}}" required>
                                </div>
                              </div>
                           </div>


                           </div>
                         </div>
                       </div>

                     <!-- Shipping Address -->
                     {{-- <div class="panel panel-default aa-checkout-billaddress">
                       <div class="panel-heading">
                         <h4 class="panel-title">
                           <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                             Shippping Address
                           </a>
                         </h4>
                       </div>
                       <div id="collapseFour" class="panel-collapse collapse">
                         <div class="panel-body">
                          <div class="row">
                             <div class="col-md-6">
                               <div class="aa-checkout-single-bill">
                                 <input type="text" placeholder="First Name*">
                               </div>
                             </div>
                             <div class="col-md-6">
                               <div class="aa-checkout-single-bill">
                                 <input type="text" placeholder="Last Name*">
                               </div>
                             </div>
                           </div>
                           <div class="row">
                             <div class="col-md-12">
                               <div class="aa-checkout-single-bill">
                                 <input type="text" placeholder="Company name">
                               </div>
                             </div>
                           </div>
                           <div class="row">
                             <div class="col-md-6">
                               <div class="aa-checkout-single-bill">
                                 <input type="email" placeholder="Email Address*">
                               </div>
                             </div>
                             <div class="col-md-6">
                               <div class="aa-checkout-single-bill">
                                 <input type="tel" placeholder="Phone*">
                               </div>
                             </div>
                           </div>
                           <div class="row">
                             <div class="col-md-12">
                               <div class="aa-checkout-single-bill">
                                 <textarea cols="8" rows="3">Address*</textarea>
                               </div>
                             </div>
                           </div>
                           <div class="row">
                             <div class="col-md-12">
                               <div class="aa-checkout-single-bill">
                                 <select>
                                   <option value="0">Select Your Country</option>
                                   <option value="1">Australia</option>
                                   <option value="2">Afganistan</option>
                                   <option value="3">Bangladesh</option>
                                   <option value="4">Belgium</option>
                                   <option value="5">Brazil</option>
                                   <option value="6">Canada</option>
                                   <option value="7">China</option>
                                   <option value="8">Denmark</option>
                                   <option value="9">Egypt</option>
                                   <option value="10">India</option>
                                   <option value="11">Iran</option>
                                   <option value="12">Israel</option>
                                   <option value="13">Mexico</option>
                                   <option value="14">UAE</option>
                                   <option value="15">UK</option>
                                   <option value="16">USA</option>
                                 </select>
                               </div>
                             </div>
                           </div>
                           <div class="row">
                             <div class="col-md-6">
                               <div class="aa-checkout-single-bill">
                                 <input type="text" placeholder="Appartment, Suite etc.">
                               </div>
                             </div>
                             <div class="col-md-6">
                               <div class="aa-checkout-single-bill">
                                 <input type="text" placeholder="City / Town*">
                               </div>
                             </div>
                           </div>
                           <div class="row">
                             <div class="col-md-6">
                               <div class="aa-checkout-single-bill">
                                 <input type="text" placeholder="District*">
                               </div>
                             </div>
                             <div class="col-md-6">
                               <div class="aa-checkout-single-bill">
                                 <input type="text" placeholder="Postcode / ZIP*">
                               </div>
                             </div>
                           </div>
                            <div class="row">
                             <div class="col-md-12">
                               <div class="aa-checkout-single-bill">
                                 <textarea cols="8" rows="3">Special Notes</textarea>
                               </div>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div> --}}
                   </div>
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="checkout-right">
                   <h4>Order Summary</h4>
                   <div class="aa-order-summary-area">
                     <table class="table table-responsive">
                       <thead>
                         <tr>
                           <th>Product</th>
                           <th>Total</th>
                         </tr>
                       </thead>
                       <tbody>
                           @php
                               $totalPrice=0;
                           @endphp
                           @foreach ($cart_data as $list)
                           @php
                           $totalPrice=$totalPrice+($list->price*$list->qty);
                           @endphp
                           <tr>
                           <td>{{$list->name}} <strong> x  {{$list->qty}}</strong><br>
                            <span class="cart_color">{{$list->color}}</span>
                           </td>
                           <td>Rs {{$list->price*$list->qty}}</td>
                         </tr>
                         @endforeach
                        </tbody>
                       <tfoot>
                        <tr class="hide show_coupon_box">
                            <th>Coupon Code<a href="javascript:void(0)" onclick="remove_coupon_code()"
                                class="remove_coupon_code_link"> Remove</a></th>
                            <td id="coupon_code_str">Rs {{$totalPrice}}</td>
                          </tr>
                          <tr>
                           <th>Total</th>
                           <td id="total_price">Rs {{$totalPrice}}</td>
                         </tr>
                       </tfoot>
                     </table>
                   </div>

                   <div class="panel panel-default aa-checkout-coupon">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a  data-parent="#accordion" href="#collapseOne">
                        Coupon Code
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <input type="text" placeholder="Coupon Code"
                         class="Coupon_Code apply_coupon_code_box" name="coupon_code" id="coupon_code">
                        <input type="button" value="Apply Coupon"
                        class="aa-browse-btn btn-block apply_coupon_code_box"
                        onclick="applyCouponCode()">
                    <div id="coupon_code_msg"></div>
                    </div>
                    </div>
                  </div>

                   <h4>Payment Method</h4>
                   <div class="aa-payment-method">
                     <label for="COD">
                    <input type="radio" id="cod" value="COD" name="payment_type"> Cash on Delivery </label>
                     <label for="Instamojo">
                    <input type="radio" value="Gateway" id="instamojo" name="payment_type" checked> Via Instamoja </label>
                     <input type="submit" value="Place Order" class="aa-browse-btn"
                     id="btnPlaceOrder">
                   </div>
                   <div id="order_place_msg"></div>
                 </div>
               </div>
             </div>
             @csrf
           </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  @endsection
