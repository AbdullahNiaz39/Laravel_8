@extends('front.layout')
@section('content')
@section('page_title','Change Password')


 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">
            <div class="row">

              <div class="col-md-12">
                <div class="aa-myaccount-register">
                 <h4>Change Password</h4>
                <form action="" id="frmUpdatePassword" class="aa-login-form">
                      @csrf

                    <label for="">Password<span>*</span></label>
                    <input type="password" placeholder="Password" name="password" required>
                    <div id="password_error" class="field_error"></div>

                    <button type="submit" id="btnUpdatePassword" class="aa-browse-btn">Update Password</button>
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
