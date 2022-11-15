<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('page_title')</title>
    <link rel="icon" href="{{asset('admin_assets/images/category/logo.png')}}" type="image/gif/png">

    <!-- Fontfaces CSS-->
    <link href="{{asset('admin_assets/css/font-face.css')}}" rel="stylesheet" media="all">

    <link href="{{asset('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS-->
    <link href="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('admin_assets/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('admin_assets/css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="{{asset('admin_assets/images/icon/logo.png')}}" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a  href="{{url('admin/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                        </li>
                        <li class="has-sub">
                            <a  href="{{url('admin/order')}}">
                                <i class="fas fa-first-order"></i>Orders</a>

                        </li>
                        <li>
                            <a href="{{url('admin/category')}}">
                                <i class="fas fa-list"></i>Categorys</a>
                        </li>

                        <li>
                            <a href="{{url('admin/coupon')}}">
                                <i class="fas fa-tag"></i>Coupon</a>
                        </li>
                        <li>
                            <a href="{{url('admin/size')}}">
                                <i class="fas fa-window-maximize"></i>Size</a>
                        </li>
                        <li>
                            <a href="{{url('admin/product')}}">
                                <i class="fas fa-picture-o"></i>Product</a>
                        </li>
                        <li class="@yield('brand_active')">
                            <a href="{{url('admin/brand')}}">
                                <i class="fas fa-code-branch"></i>Brand</a>
                        </li>
                        <li class="@yield('tax_active')">
                            <a href="{{url('admin/tax')}}">
                                <i class="fas fa-code-branch"></i>Tax</a>
                        </li>
                        <li class="@yield('customer_active')">
                            <a href="{{url('admin/customer')}}">
                                <i class="fas fa-user"></i>Customer</a>
                        </li>
                        <li class="@yield('banner_active')">
                            <a href="{{url('admin/banner')}}">
                                <i class="fas fa-user"></i>banner</a>
                        </li>


                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('admin_assets/images/icon/logo.png')}}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="@yield('dashboard_active') has-sub">
                            <a class="js-arrow" href="{{url('admin/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                        </li>
                        <li class="@yield('order_active')">
                            <a href="{{url('admin/order')}}">
                                <i class="fas fa-pause-circle"></i>Orders</a>
                        </li>
                        <li class="@yield('category_active')">
                            <a href="{{url('admin/category')}}">
                                <i class="fas fa-list"></i>Categorys</a>
                        </li>
                        <li class="@yield('coupon_active')">
                            <a href="{{url('admin/coupon')}}">
                                <i class="fas fa-tag"></i>Coupons</a>
                        </li>
                        <li class="@yield('size_active')">
                            <a href="{{url('admin/size')}}">
                                <i class="fas fa-window-maximize"></i>Size</a>
                        </li>
                        <li class="@yield('color_active')">
                            <a href="{{url('admin/color')}}">
                                <i class="fas fa-paint-brush"></i>Color</a>
                        </li>
                        <li class="@yield('product_active')">
                            <a href="{{url('admin/product')}}">
                                <i class="fas fa-puzzle-piece"></i>Product</a>
                        </li>
                        <li class="@yield('brand_active')">
                            <a href="{{url('admin/brand')}}">
                                <i class="fas fa-code-branch"></i>Brand</a>
                        </li>
                        <li class="@yield('tax_active')">
                            <a href="{{url('admin/tax')}}">
                                <i class="fas fa-percent"></i>Tax</a>
                        </li>
                        <li class="@yield('customer_active')">
                            <a href="{{url('admin/customer')}}">
                                <i class="fas fa-user"></i>Customer</a>
                        </li>
                        <li class="@yield('banner_active')">
                            <a href="{{url('admin/banner')}}">
                                <i class="fas fa-image"></i>banner</a>
                        </li>

                        <li class="@yield('review_active')">
                            <a href="{{url('admin/product_review')}}">
                                <i class="fas fa-image"></i>Product Review</a>
                        </li>
                            </ul>


                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">

                            </form>
                            <div class="header-button">

                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">

                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Welcome Admin</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">

                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>

                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="{{url('admin/logout')}}">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="main-content">

                <div class="section__content section__content--p30">

                    <div class="container-fluid">

@yield('main')
                    </div>
                </div>
            </div>

<div class="row">
    <div class="col-md-12">
        <div class="copyright">
            <p>Copyright © 2017 I.T. Vision All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
        </div>
    </div>
</div>

  <!-- Jquery JS-->
  <script src="{{asset('admin_assets/vendor/jquery-3.2.1.min.js')}}"></script>
  <!-- Bootstrap JS-->
  <script src="{{asset('admin_assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
  <script src="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
  <!-- Vendor JS       -->
  <script src="{{asset('admin_assets/vendor/slick/slick.min.js')}}">
  </script>
  <script src="{{asset('admin_assets/vendor/wow/wow.min.js')}}"></script>
  <script src="{{asset('admin_assets/vendor/animsition/animsition.min.js')}}"></script>
  <script src="{{asset('admin_assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
  </script>
  <script src="{{asset('admin_assets/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('admin_assets/vendor/counter-up/jquery.counterup.min.js')}}">
  </script>
  <script src="{{asset('admin_assets/vendor/circle-progress/circle-progress.min.js')}}"></script>
  <script src="{{asset('admin_assets/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('admin_assets/vendor/chartjs/Chart.bundle.min.js')}}"></script>
  <script src="{{asset('admin_assets/vendor/select2/select2.min.js')}}">
  </script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


  <!-- Main JS-->
  <script src="{{asset('admin_assets/js/main.js')}}"></script>
  <script>
    tinymce.init({
      selector: 'textarea#tiny'
    });
  </script>


</body>

</html>
<!-- end document-->
