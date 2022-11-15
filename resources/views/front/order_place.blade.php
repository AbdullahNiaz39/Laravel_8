@extends('front.layout')
@section('content')
@section('page_title','Category')

<section id="aa-product-category">
    <div class="container">
       <div class="row">
         <br><br><br>
         <h2 style="text-align: center;">Order has place Successfully</h2>
         <h2 style="text-align: center;">Order Id:- {{session()->get('ORDER_ID')}}</h2>
         <br><br><br>
       </div>
    </div>
 </section>
  @endsection
