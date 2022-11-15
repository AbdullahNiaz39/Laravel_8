@extends('front.layout')
@section('content')
@section('page_title','Home')

<section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            <!-- single slide item -->
            @foreach ($home_banner as $list )

            <li>
              <div class="seq-model">
                <img data-seq src="{{asset('admin_assets/images/banner/'.$list->image)}}" alt="Men slide img" />
              </div>
              <div class="seq-title">
               <span data-seq>Save Up to 75% Off</span>
                <h2 data-seq>Men Collection</h2>
                <p data-seq>The FaShIOn and StYlE To people WhicH FOLlOw YoU.</p>
                @if ($list->btn_text =='')

                @else
                <a data-seq target="_blank" href="{{$list->btn_link}}" class="aa-shop-now-btn aa-secondary-btn">{{$list->btn_text}}</a>
                @endif

              </div>
            </li>

            @endforeach


          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <!-- / slider -->
  <section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
              <!-- promo left -->

              <!-- promo right -->
              <div class="col-md-12 no-padding">
                <div class="aa-promo-right">


                 @foreach ($home_categories as $list)
                   <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">
                      <img src="{{asset('admin_assets/images/category/'.$list->category_image)}}" alt="img">
                      <div class="aa-prom-content">

                        <h4><a href="{{url('category/'.$list->category_slug)}}">{{$list->category_name}}</a></h4>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Promo section -->
  <!-- Products section -->
  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <!-- start prduct navigation -->
                 <ul class="nav nav-tabs aa-products-tab">
                     @foreach ($home_categories as $list)
            <li class=""><a href="#cat{{$list->id}}" data-toggle="tab">{{$list->category_name}}</a></li>
                    @endforeach
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <!-- Start men product category -->
                    @php
                    $loop_count=1;
                    @endphp
                    @foreach ($home_categories as $list)
                    @php
                     $cat_class="";
            if($loop_count==1){
              $cat_class="in active";
                $loop_count++;
            }
                    @endphp
                    <div class="tab-pane fade in {{$cat_class}}" id="cat{{$list->id}}">
                      <ul class="aa-product-catg">
                        <!-- start single product item -->
                        @if(isset($home_categories_product[$list->id][0]))
                        @foreach ($home_categories_product[$list->id] as $prodArr)
                        <li>
                          <figure>
                            <a class="aa-product-img" href="{{url('product/'.$prodArr->slug)}}"><img src="{{asset('admin_assets/images/'.$prodArr->image)}}" width="200px" height="300" alt="{{$prodArr->name}}"></a>
                            <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{$prodArr->id}}','{{$home_product_attr[$prodArr->id][0]->size}}','{{$home_product_attr[$prodArr->id][0]->color}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="{{url('product/'.$prodArr->slug)}}">{{$prodArr->name}}</a></h4>
                              <span class="aa-product-price">RS {{$home_product_attr[$prodArr->id][0]->price}}</span><span class="aa-product-price"><del>{{$home_product_attr[$prodArr->id][0]->mrp}}</del></span>
                            </figcaption>
                          </figure>
                          <div class="aa-product-hvr-content">

                            <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>

                          </div>
                          <!-- product badge -->

                        </li>
                        <!-- start single product item -->
                        @endforeach

                        @else
                        <li>
                            <figure>
                        NO Data Found
                            </figure>
                        </li>
                        @endif
                      </ul>
                   </div>
@endforeach

                    <!-- / women product category -->
                    <!-- start sports product category -->

                    <!-- / sports product category -->
                    <!-- start electronic product category -->

                    <!-- / electronic product category -->
                  </div>
                  <!-- quick view modal -->

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Products section -->
  <!-- banner section -->
  <section id="aa-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-banner-area">
            <a href="#"><img src="{{asset('front_assets/img/fashion-banner.jpg')}}" alt="fashion banner img"></a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- popular section -->
  <section id="aa-popular-category">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-popular-category-area">
              <!-- start prduct navigation -->
             <ul class="nav nav-tabs aa-products-tab">

                <li class="active"><a href="#trending" data-toggle="tab">Trending</a></li>
                <li><a href="#featured" data-toggle="tab">Featured</a></li>
                <li><a href="#discounted" data-toggle="tab">Discounted</a></li>

              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <!-- Start men popular category -->
                <div class="tab-pane fade in active" id="trending">
                  <ul class="aa-product-catg aa-trending-slider">
                    <!-- start single product item -->
                    @if(isset($home_trending_product[$list->id][0]))
                    @foreach ($home_trending_product[$list->id] as $prodArr)
                    <li>
                      <figure>
                        <a class="aa-product-img" href="{{url('product/'.$prodArr->slug)}}"><img src="{{asset('admin_assets/images/'.$prodArr->image)}}" width="200px" height="300" alt="{{$prodArr->name}}"></a>
                        <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{$prodArr->id}}','{{$home_product_attr[$prodArr->id][0]->size}}','{{$home_product_attr[$prodArr->id][0]->color}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                          <figcaption>
                          <h4 class="aa-product-title"><a href="{{url('product/'.$prodArr->slug)}}">{{$prodArr->name}}</a></h4>
                          <span class="aa-product-price">RS {{$home_trending_product_attr[$prodArr->id][0]->price}}</span><span class="aa-product-price"><del>{{$home_trending_product_attr[$prodArr->id][0]->mrp}}</del></span>
                        </figcaption>
                      </figure>
                      <div class="aa-product-hvr-content">

                        <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>

                      </div>
                      <!-- product badge -->

                    </li>
                    <!-- start single product item -->
                    @endforeach
                    @else
                    <li>
                        <figure>
                    NO Data Found
                        </figure>
                    </li>
                    @endif

                  </ul>
                </div>
                <!-- / popular product category -->

                <!-- start featured product category -->

                <div class="tab-pane fade" id="featured">
                    <ul class="aa-product-catg aa-discounted-slider">
                      <!-- start single product item -->
                      @if(isset($home_featured_product[$list->id][0]))
                      @foreach ($home_featured_product[$list->id] as $prodArr)
                      <li>
                        <figure>
                          <a class="aa-product-img" href="{{url('product/'.$prodArr->slug)}}"><img src="{{asset('admin_assets/images/'.$prodArr->image)}}" width="200px" height="300" alt="{{$prodArr->name}}"></a>
                          <a class="aa-add-card-btn"href="javascript:void(0)" onclick="home_add_to_cart('{{$prodArr->id}}','{{$home_product_attr[$prodArr->id][0]->size}}','{{$home_product_attr[$prodArr->id][0]->color}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                            <figcaption>
                            <h4 class="aa-product-title"><a href="{{url('product/'.$prodArr->slug)}}">{{$prodArr->name}}</a></h4>
                            <span class="aa-product-price">RS {{$home_featured_product_attr[$prodArr->id][0]->price}}</span>
                            <span class="aa-product-price"><del>{{$home_featured_product_attr[$prodArr->id][0]->mrp}}</del></span>
                          </figcaption>
                        </figure>
                        <div class="aa-product-hvr-content">

                          <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>

                        </div>
                        <!-- product badge -->

                      </li>
                      <!-- start single product item -->
                      @endforeach
                      @else
                      <li>
                          <figure>
                      NO Data Found
                          </figure>
                      </li>
                      @endif

                    </ul>
                  </div>
                <!-- / featured product category -->

                <!-- start latest product category -->
                <div class="tab-pane fade" id="discounted">
                    <ul class="aa-product-catg aa-discounted-slider">
                      <!-- start single product item -->
                      @if(isset($home_discounted_product[$list->id][0]))
                      @foreach ($home_discounted_product[$list->id] as $prodArr)
                      <li>
                        <figure>
                          <a class="aa-product-img" href="{{url('product/'.$prodArr->slug)}}"><img src="{{asset('admin_assets/images/'.$prodArr->image)}}" width="200px" height="300" alt="{{$prodArr->name}}"></a>
                          <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{$prodArr->id}}','{{$home_product_attr[$prodArr->id][0]->size}}','{{$home_product_attr[$prodArr->id][0]->color}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                            <figcaption>
                            <h4 class="aa-product-title"><a href="{{url('product/'.$prodArr->slug)}}">{{$prodArr->name}}</a></h4>
                            <span class="aa-product-price">RS {{$home_discounted_product_attr[$prodArr->id][0]->price}}</span><span class="aa-product-price"><del>{{$home_discounted_product_attr[$prodArr->id][0]->mrp}}</del></span>
                          </figcaption>
                        </figure>
                        <div class="aa-product-hvr-content">

                          <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>

                        </div>
                        <!-- product badge -->

                      </li>
                      <!-- start single product item -->
                      @endforeach
                      @else
                      <li>
                          <figure>
                      NO Data Found
                          </figure>
                      </li>
                      @endif

                    </ul>
                  </div>
       <!-- / latest product category -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / popular section -->
  <!-- Support section -->
  <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>FREE SHIPPING</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4>30 DAYS MONEY BACK</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>SUPPORT 24/7</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Support section -->
  <!-- Testimonial -->

  <!-- / Testimonial -->

  <!-- Latest Blog -->

  <!-- / Latest Blog -->

  <!-- Client Brand -->
  <section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">
                @foreach ($home_brand as $list)
              <li><a href="#"><img src="{{asset('admin_assets/images/'.$list->image)}}" height="50px" alt="{{$list->name}}"></a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Client Brand -->

  <!-- Subscribe section -->
  <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <h3>Subscribe our newsletter </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
            <form action="" class="aa-subscribe-form">
              <input type="email" name="" id="" placeholder="Enter your Email">
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <input type="hidden" id="qty"  value="1"/>
  <form id="frmAddToCart">
   <input type="hidden" id="color_id" name="color_id"/>
   <input type="hidden" id="size_id" name="size_id"/>
   <input type="hidden" id="pqty" name="pqty"/>
   <input type="hidden" id="product_id" name="product_id"/>
   @csrf
   </form>

  @endsection
