@extends('admin.layout')
@section('main')
@section('product_active','active')
@section('page_title','Manage Product')
{{-- @if ($id>0)
{{$image_required=""}}
@else
{{$image_required="required"}}
@endif --}}
    <h1 class="mb10">Manage Product</h1>

    @if (session()->has('sku_error'))
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade-show">
        {{session('sku_error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">x</span>
        </button>
    </div>
    @endif
    @error('price.*')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
@enderror
 @error('mrp.*')
<div class="alert alert-danger">
    {{ $message }}
</div>
@enderror
  @error('qty.*')
<div class="alert alert-danger">
    {{ $message }}
</div>
@enderror
    @error('attr_image.*')
         <div class="sufee-alert alert with-close alert-danger alert-dismissible fade-show">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">x</span>
        </button>
    </div>
    @enderror
    @error('images.*')
         <div class="sufee-alert alert with-close alert-danger alert-dismissible fade-show">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">x</span>
        </button>
    </div>
    @enderror

    <a href="{{ url('admin/product') }}"> <button type="button" class="btn btn-success">Back</button> </a>

    <div class="row m-t-30">

            <div class="col-md-12">
                <form action="{{ route('manage_product_process') }}" method="POST" enctype="multipart/form-data">
    <div class="row">
            <div class="col-lg-12">
                 <div class="card">
                     <div class="card-body">
                                         @csrf
                                 <div class="form-group">
                            <label for="Image" class="control-label mb-1">Image</label>
                            <input id="product_image" name="image" value="{{$image}}" type="file" class="form-control"
                                 >
                            @error('image')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            @if($image!='')
                            <img src="{{asset('admin_assets/images/'.$image)}}" width="80px" alt="No Image">
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="product" class="control-label mb-1">Product Name</label>
                            <input id="product_name" name="name" value="{{$name}}" type="text" class="form-control"
                               required  >
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_slug" class="control-label mb-1">Product Slug</label>
                            <input id="product_slug" name="slug" value="{{$slug}}" type="text" class="form-control"
                                 >
                                @error('slug')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="brand" class="control-label mb-1">Brand</label>
                                             <select id="brand" name="brand" value="{{$brand}}" type="number" class="form-control" required>
                                               <option value="">Select Brand</option>
                                                       @foreach ($brands as $list )
                                                       @if ($brand==$list->id)
                                                       <option selected value="{{$list->id}}">
                                                           @else
                                                           <option value="{{$list->id}}">
                                                           @endif
                                                       {{$list->name}}</option>
                                                       @endforeach
                                                       </select>
                                               </div>
                            <div class="col-md-4">
                                <label for="model" class="control-label mb-1">Model</label>
                                <input id="Model" name="model" value="{{$model}}" type="text" class="form-control"
                                     >
                            </div>
                <div class="col-md-4">
                     <label for="brand" class="control-label mb-1">Category</label>
                          <select id="Category" name="category_id" value="{{$category_id}}" type="number" class="form-control" required>
                            <option value="">Select Categories</option>
                                    @foreach ($categorys as $list )
                                    @if ($category_id==$list->id)
                                    <option selected value="{{$list->id}}">
                                        @else
                                        <option value="{{$list->id}}">
                                        @endif
                                    {{$list->category_name}}</option>
                                    @endforeach
                                    </select>
                            </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                <label for="short_desc" class="control-label mb-1">Short_description</label>
                             <textarea name="short_desc"  class="form-control" aria-required="true" aria-invalid="false" rows="2">{{$short_desc}}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="technical_Spec" class="control-label mb-1">Technical_Specfication</label>
                             <textarea name="technical_specs"  class="form-control" aria-required="true" aria-invalid="false" rows="2">{{$technical_specs}}</textarea>
                            </div>
                        </div>
                    </div>
                            <div class="form-group">
                                <label for="uses" class="control-label mb-1">Uses</label>
                             <textarea name="uses"  class="form-control" aria-required="true" aria-invalid="false" rows="2">{{$uses}}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                <label for="Warranty" class="control-label mb-1">Warranty</label>
                             <textarea name="warranty"  class="form-control" aria-required="true" aria-invalid="false" rows="1">{{$warranty}}</textarea>
                                    </div>
                             <div class="col-md-6">
                                <label for="keyword" class="control-label mb-1">Keyword</label>
                             <textarea name="keywords"  class="form-control" aria-required="true" aria-invalid="false" rows="1">{{$keywords}}</textarea>
                            </div>
                        </div>
                            </div>

                            <div class="form-group">
                                <label for="desc" class="control-label mb-1">Description</label>
                             <textarea id="tiny" name="desc" class="form-control" aria-required="true" aria-invalid="false">{{$desc}}</textarea>
                            </div>

                            <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="Lead_time" class="control-label mb-1">Lead time</label>
                                   <input id="Lead_time" name="lead_time" value="{{$lead_time}}" type="text" class="form-control"
                                    >
                                </div>



                                    <div class="col-md-4">
                                        <label for="tax_type" class="control-label mb-1">Tax type</label>
                                        <select id="tax_id" name="tax_id" value="{{$tax_id}}"  class="form-control" required>
                                            <option value="">Select Taxes</option>
                                                    @foreach ($taxes as $list )
                                                    @if ($tax_id==$list->id)
                                                    <option selected value="{{$list->id}}">
                                                        @else
                                                        <option value="{{$list->id}}">
                                                        @endif
                                                    {{$list->tax_desc}}</option>
                                                    @endforeach
                                                    </select>
                                    </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="is_promo" class="control-label mb-1">Is Promo</label>
                                        <select id="is_promo" name="is_promo" value="{{$is_promo}}" class="form-control">
                                            @if ($is_promo=="1")
                                            <option value="1" selected>Yes
                                            </option>
                                            <option value="0">No
                                            </option>
                                            @else
                                            <option value="1">Yes
                                            </option>
                                            <option value="0" selected>No
                                            </option>
                                            @endif
                                        </select>
                                     </div>
                                    <div class="col-md-3">
                                        <label for="is_featured" class="control-label mb-1">Is featured</label>
                                        <select id="is_featured" name="is_featured" value="{{$is_featured}}" class="form-control">
                                            @if ($is_featured=="1")
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                            @else
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                    </div>


                                        <div class="col-md-3">

                                        <label for="is_discounted" class="control-label mb-1">Discounted</label>
                                        <select id="is_discounted" name="is_discounted" value="{{$is_discounted}}" class="form-control">
                                            @if ($is_discounted=="1")
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                            @else
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                      </div>

                                      <div class="col-md-3">
                                        <label for="is_trending" class="control-label mb-1">Trending</label>
                                        <select id="is_trending" name="is_trending" value="{{$is_trending}}" class="form-control">
                                            @if ($is_trending=="1")
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                            @else
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                      </div>
                                </div>
                                </div>

                        </div>{{--card Body  --}}
                        </div>{{--card Body  --}}
                 </div>{{--coloumn  --}}

                 {{-- ///////////////////////////Product images --}}
                 <h2 style="margin-left: 15px" class="mb10"> Product Images</h2>
                 <div class="col-md-12" >
                    <div class="card" >
                        <div class="card-body">
                            <div class="form-group">
                <div class="row" id="product_images_box" >
                    @php
                    $loop_count_num=1;
                    $loop_count_prev= $loop_count_num;
                @endphp
                    @foreach ($prod_images as $key)
                    @php
                    $PiArr=(array)$key;
                    $loop_count_prev= $loop_count_num;
                @endphp
                <input type="hidden" id="piid" name="piid[]" value="{{$PiArr['id']}}">
            <div class="col-md-4 product_images_{{$loop_count_num++}}">
                <label for="Image" class="control-label mb-1">Attr_Image</label>
                <input id="images" name="images[]"  type="file" class="form-control">
                @if($PiArr['images']!='')
                   <a href="{{asset('admin_assets/images/'.$PiArr['images'])}}" target="_blank"> <img src="{{asset('admin_assets/images/'.$PiArr['images'])}}" width="80px" alt="No Image"></a>
                @endif
            </div>
            <div class="col-md-2" >
               <br>
               @if ($loop_count_num==2)
             <button onclick="add_images_more()" id="Add" type="button" class="btn btn-lg btn-success">
                 <i class="fa fa-plus"></i>   Add
                </button>
                @else
               <a href="{{url('admin/product/prod_images_delete')}}/{{$PiArr['id']}}/{{$id}}" >
                <button onclick="remove_images_more('{{$loop_count_prev}}')" id="Remove" type="button" class="btn btn-lg btn-danger">
                    <i class="fa fa-minus"></i>   Remove
                   </button>
                </a>
                @endif
</div>
@endforeach
</div>
            </div>

    </div>
</div>


</div>

                 {{-- Multiples//images --}}
                 <h2 style="margin-left: 15px" class="mb10"> Products Attributes</h2>
                 <div class="col-md-12" id="product_attr_box">
                    @php
                    $loop_count_num=1;
                    $loop_count_prev= $loop_count_num;
                @endphp
                    @foreach ($prods_Attr as $key)
                    @php
                    $loop_count_prev= $loop_count_num;
                @endphp
                <input type="hidden" id="paid" name="paid[]" value="{{$key['id']}}">
                    <div class="card" id="product_attr_{{$loop_count_num++}}">
                        <div class="card-body">
                            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                <label for="SKU" class="control-label mb-1">SKU</label>
                <input id="sku" name="sku[]" required value="{{$key['sku']}}" type="text" class="form-control"
                     required>
            </div>

            <div class="col-md-2">
                <label for="price" class="control-label mb-1">Price</label>
                <input id="price" required name="price[]" value="{{$key['price']}}" type="text" class="form-control" required>

            </div>
            <div class="col-md-2">
                <label for="mrp" class="control-label mb-1">MRP</label>
                <input id="mrp" required name="mrp[]" type="text" value="{{$key['mrp']}}" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label for="brand" class="control-label mb-1">Size</label>
               <select id="Size" name="size_id[]" value="{{$key['size_id']}}"  class="form-control">
            <option value="">Select Size</option>
                    @foreach ($sizes as $list )
                    @if($key['size_id'] ==$list->id)
                    <option selected value="{{$list->id}}"> {{$list->size}} </option>
                    @else
                    <option value="{{$list->id}}"> {{$list->size}} </option>
                    @endif
                    @endforeach
                    </select>
            </div>

            <div class="col-md-3">
                <label for="color" class="control-label mb-1">Color</label>
               <select id="color" name="color_id[]" value="{{$key['color_id']}}"  class="form-control">
            <option value="">Select Color</option>
                    @foreach ($colors as $list )
                    @if($key['color_id'] ==$list->id)
                <option selected value="{{$list->id}}">{{$list->color}}</option>
                @else
                <option value="{{$list->id}}">{{$list->color}}</option>
                @endif
                @endforeach
                    </select>
            </div>


                    <div class="col-md-2">
                <label for="Qty" class="control-label mb-1">Quatity</label>
                <input id="qty" required name="qty[]" value="{{$key['qty']}}" type="number" class="form-control">
            </div>

            <div class="col-md-4">
                <label for="Image" class="control-label mb-1">Attr_Image</label>
                <input id="Attr_image" name="attr_image[]" value="{{$key['attr_image']}}" type="file" class="form-control">
                @if($key['attr_image']!='')
                <img src="{{asset('admin_assets/images/'.$key['attr_image'])}}" width="80px" alt="No Image">
                @endif
                @error('image')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="col-md-2">
               <br>
               @if ($loop_count_num==2)
             <button onclick="add_more()" id="Add" type="button" class="btn btn-lg btn-success">
                 <i class="fa fa-plus"></i>   Add
                </button>
                @else
               <a href="{{url('admin/product/prod_attr_delete')}}/{{$key['id']}}/{{$id}}" ><button onclick="remove_more('{{$loop_count_prev}}')" id="Remove" type="button" class="btn btn-lg btn-danger">
                    <i class="fa fa-minus"></i>   Remove
                   </button></a>
                @endif
</div>



                </div>
            </div>

    </div>
</div>

@endforeach
</div>

    </div>
    <div>
        <button id="button" type="submit" class="btn btn-lg btn-info btn-block">
            Submit
        </button>
    </div>
    <input type="hidden" name="id" value="{{$id}}">
</form>
</div>
    </div>
    <script>
        var loop_count=1;
        function add_more(){
            loop_count++;
            var html='<input type="hidden" id="paid" name="paid[]"><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';
     html+='<div class="col-md-2"><label for="SKU" class="control-label mb-1">SKU</label><input id="sku" name="sku[]" value="" type="text" class="form-control" required></div>';
    html+='<div class="col-md-2"><label for="price" class="control-label mb-1">Price</label><input id="price" name="price[]" type="text" class="form-control" required></div>';
    html+='<div class="col-md-2"><label for="mrp" class="control-label mb-1">MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" required></div>';
    html+='<div class="col-md-3"><label for="brand" class="control-label mb-1">Size</label><select id="Size" name="size_id[]" value=""  class="form-control"><option value="">Select Size</option>@foreach ($sizes as $list )<option value="{{$list->id}}"> {{$list->size}} </option>@endforeach</select></div>';
    html+='<div class="col-md-3"><label for="color" class="control-label mb-1">Color</label><select id="color" name="color_id[]" value=""  class="form-control"><option value="">Select Color</option>@foreach ($colors as $list )<option value="{{$list->id}}">{{$list->color}}</option>@endforeach</select></div>';
    html+='<div class="col-md-2"><label for="Qty" class="control-label mb-1">Quatity</label><input id="qty" name="qty[]" value="" type="number" class="form-control" required></div>';
    html+='<div class="col-md-4"><label for="Image" class="control-label mb-1">Attr_Image</label><input id="Attr_image" name="attr_image[]" value="" type="file" class="form-control">@error("image")<div class="alert alert-danger">{{ $message }}</div>@enderror</div>';
    html+='<div class="col-md-2"><br><button onclick=remove_more("'+loop_count+'") id="remove" type="button" class="btn btn-lg btn-danger"><i class="fa fa-minus"></i>&nbsp;Remove</button></div>';
    html+='</div></div></div></div>';
    jQuery('#product_attr_box').append(html);
        }

        function remove_more(loop_count){
           jQuery('#product_attr_'+loop_count).remove();
        }

        /////for image/// multiple
        loop_images_count=1;
        function add_images_more(){
          loop_images_count++;
            var html='<input type="hidden" id="piid" name="piid[]">';
             html+='<div class="col-md-4 product_images_'+loop_images_count+'" ><label for="Image" class="control-label mb-1">Product_Images</label><input id="p_images" name="images[]" type="file" class="form-control"></div>';
    html+='<div class="col-md-2 product_images_'+loop_images_count+'"><br><button onclick=remove_images_more("'+loop_images_count+'") id="remove" type="button" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i>&nbsp;Remove</button></div>';

    jQuery('#product_images_box').append(html);
        }

//////Remove images
        function remove_images_more(loop_images_count){
           jQuery('.product_images_'+loop_images_count).remove();
        }
        </script>

@endsection
