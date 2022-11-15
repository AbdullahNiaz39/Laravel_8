@extends('front.layout')
@section('content')
@section('page_title','Registration')


 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">
            <div class="row">

              <div class="col-md-12">
                <div class="aa-myaccount-register">
                 <h4>Register</h4>
                 <form action="" id="frmRegistration" class="aa-login-form">
                     @csrf
                    <label for="">Username<span>*</span></label>
                    <input type="text" placeholder="Username" name="name">
                    <div id="name_error" class="field_error"></div>
                    <label for="">Email address<span>*</span></label>
                    <input type="email" placeholder="Email" name="email" required>
                    <div id="email_error" class="field_error"></div>
                    <label for="">Mobile No<span>*</span></label>
                    <input type="text" placeholder="Mobile" name="mobile" required>
                    <div id="mobile_error" class="field_error"></div>
                    <label for="">Password<span>*</span></label>
                    <input type="password" placeholder="Password" name="password">
                    <div id="password_error" class="field_error"></div>

                    <button type="submit" id="btnRegistration" class="aa-browse-btn">Register</button>
                  </form>
                </div>
                <div id="thank_you_msg" class="field_error"></div>
              </div>
            </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->


  @endsection
