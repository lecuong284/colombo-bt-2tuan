<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Restaurant</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
        <link rel="stylesheet" href="{{asset("css/datepicker3.css")}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset("css/font-awesome.min.css")}}">
        <link rel="stylesheet" href="{{asset("css/style.css") }}">

        @yield('css')

                <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body>
        @include('admin.alertError')
        <div class="wrapper">
            <header class="main-header">
                <div class="container">
                    <div class="header-top clearfix">
                        <a href="{{route('/')}}" class="logo"><img src="{{asset('images/code/logo.png')}}" alt="logo"></a>
                        <nav>@include('code.menu')</nav>
                    </div>
                    <div class="slogan">
                        <h1>the right ingredients for the right food</h1>
                    </div>
                    <div class="btn-header">
                        <a href="javascript:void (0)" class="btn-book">BOOK A TABLE</a>
                        <a href="javascript:void (0)" class="btn-see-mn">SEE THE MENU</a>
                    </div>
                </div>
            </header>

            <div class="content-wrapper">
                <section class="st_first">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="title">Just the right food</h2>
                                <p>If you’ve been to one of our restaurants, you’ve seen – and tasted – what keeps our customers coming back for more. Perfect materials and freshly baked food, delicious Lambda cakes,  muffins, and gourmet coffees make us hard to resist! Stop in today and check us out!</p>
                                <img src="{{asset('images/code/auther.png')}}" alt="author">
                            </div>
                            <div class="col-md-6">
                                <img src="{{asset('images/code/food.png')}}" alt="food">
                            </div>
                        </div>
                    </div>
                </section>
                <section class="st_second">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-6">
                                <div class="info_food">
                                    <h2 class="title">Fine ingredients</h2>
                                    <p>If you’ve been to one of our restaurants, you’ve seen – and tasted – what keeps our customers coming back for more. Perfect materials and freshly baked food, delicious Lambda cakes,  muffins, and gourmet coffees make us hard to resist! Stop in today and check us out!</p>
                                    <div class="img_food">
                                        <img src="{{asset('images/code/img_sc1.png')}}" alt="img 1">
                                        <img src="{{asset('images/code/img_sc2.png')}}" alt="img 2">
                                        <img src="{{asset('images/code/img_sc3.png')}}" alt="img 3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="st_third">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                @foreach($cates as $key => $cate)
                                    @if($key % 2 == 0)
                                        <div class="mn_left">
                                            <h3 class="title">{{$cate->name}}</h3>
                                            <ul>
                                                @foreach($list as $item)
                                                    @if($cate->id == $item->cate_id)
                                                        <li {!! $item->special ? 'class="li_special"' : '' !!}}>
                                                            @if($item->special)
                                                                <span class="special">Special</span>
                                                            @endif
                                                            <div class="name_and_price clearfix">
                                                                <span class="name">{{$item->name}}</span>
                                                                <span class="price">{{$item->price . '$'}}</span>
                                                            </div>
                                                            <p class="summary">{{$item->summary}}</p>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                @foreach($cates as $key => $cate)
                                    @if($key % 2 != 0)
                                        <div class="mn_right">
                                            <h3 class="title">{{$cate->name}}</h3>
                                            <ul>
                                                @foreach($list as $item)
                                                    @if($cate->id == $item->cate_id)
                                                        <li {!! $item->special ? 'class="li_special"' : '' !!}}>
                                                            @if($item->special)
                                                                <span class="special">Special</span>
                                                            @endif
                                                            <div class="name_and_price clearfix">
                                                                <span class="name">{{$item->name}}</span>
                                                                <span class="price">{{$item->price . '$'}}</span>
                                                            </div>
                                                            <p class="summary">{{$item->summary}}</p>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
                <section class="sc_four">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="review">
                                    <h3 class="title">Guest Reviews</h3>
                                    <p>If you’ve been to one of our restaurants, you’ve seen – and tasted – what keeps our customers coming back for more. Perfect materials and freshly baked food, delicious Lambda cakes,  muffins, and gourmet coffees make us hard to resist! Stop in today and check us out!
                                        <span>- food inc, New York</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="sc_fifth">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 img_bk_fd">
                                <img src="{{asset("images/code/book_food1.jpg")}}" alt="book fook 1">
                            </div>
                            <div class="col-md-3 img_bk_fd">
                                <img src="{{asset("images/code/book_food2.jpg")}}" alt="book fook 2">
                            </div>
                            <div class="col-md-6 form_bk_fd">
                                <div class="smy_fd">
                                    <h3 class="title">Just the right food</h3>
                                    <p>If you’ve been to one of our restaurants, you’ve seen – and tasted – what keeps our customers coming back for more. Perfect materials and freshly baked food.</p>
                                    <p>Delicious Lambda cakes,  muffins, and gourmet coffees make us hard to resist! Stop in today and check us out! Perfect materials and freshly baked food.</p>
                                </div>
                                <form action="{!! route('book') !!}" class="book row" method="get">
                                    <div class="form-group col-md-6">
                                        <label for="Name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{!! old('name') !!}" placeholder="your name *">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="Name">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{!! old('email') !!}" placeholder="your email *">
                                    </div>
                                    <div class="form-group col-md-6 date">
                                        <label for="Name">Date</label>
                                        <input type="text" class="form-control" id="datepicker" name="date" value="{!! old('date') !!}" placeholder="date *">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="Name">Party number</label>
                                        <select name="number_person" id="number_person" value="{!! old('number_person') !!}" class="form-control">
                                            <option value="0">party number</option>
                                            <option value="1">one person</option>
                                            <option value="2">two persons</option>
                                            <option value="3">three persons</option>
                                            <option value="4">four persons</option>
                                            <option value="5">five persons</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-md-offset-3 inp_submit">
                                        <input type="submit" class="form-control" id="submit" name="submit" value="Book now!">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 about_us">
                            <h3 class="title">About Us</h3>
                            <p>Lambda's new and expanded Chelsea location represents a truly authentic <strong>Greek</strong> patisserie, featuring breakfasts of fresh croissants and steaming bowls of café.
                                <br>Lamda the best restaurant in town</p>
                        </div>
                        <div class="col-md-4 open_hour">
                            <h3 class="title">Opening Hours</h3>
                            <p><strong>Mon-Thu:</strong> 7:00am-8:00pm</p>
                            <p><strong>Fri-Sun:</strong> 7:00am-10:00pm</p>
                            <div class="card">
                                <a href="#"><i class="fa fa-cc-amex"></i></a>
                                <a href="#"><i class="fa fa-cc-paypal"></i></a>
                                <a href="#"><i class="fa fa-cc-visa"></i></a>
                                <a href="#"><i class="fa fa-cc-discover"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4 our_local">
                            <h3 class="title">Our Location</h3>
                            <p><strong>19th Paradise Street Sitia 128 Meserole Avenue</strong></p>
                            <div class="socie">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-trello"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3.1.1 -->
        <script src="{{asset("js/jquery-3.1.1.min.js")}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{asset("js/jquery-ui.min.js")}}"></script>
        <script src="{{asset("js/bootstrap-datepicker.js")}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{asset("js/bootstrap.js")}}"></script>
        <script>
            $('#datepicker').datepicker({
                autoclose: true
            });

            $(document).ready(function() {

                $(".btn-book").click(function (){
                    $('html, body').animate({
                        scrollTop: $(".sc_fifth").offset().top
                    }, 1500);
                });

                $(".btn-see-mn").click(function (){
                    $('html, body').animate({
                        scrollTop: $(".st_third").offset().top
                    }, 1500);
                });
            });

        </script>
        @yield('scripts')
    </body>
</html>
