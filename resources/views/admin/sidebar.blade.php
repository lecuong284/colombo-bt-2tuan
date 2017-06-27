<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel dropdown">
            <div class="pull-left image" data-toggle="dropdown">
                <img src="{{asset("images/no-image-tiny.jpg")}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info" data-toggle="dropdown">
                <p>{{ Auth::user()->name }}</p>
            </div>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                    <img src="{{asset("images/no-image-tiny.jpg")}}" class="img-circle" alt="User Image">
                    {{--<p>
                        Alexander Pierce - Web Developer
                        <small>Member since Nov. 2012</small>
                    </p>--}}
                </li>
                <!-- Menu Body -->
                {{--<li class="user-body">
                    <div class="row">
                        <div class="col-xs-4 text-center">
                            <a href="#">Followers</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="#">Sales</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="#">Friends</a>
                        </div>
                    </div>
                    <!-- /.row -->
                </li>--}}
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-left">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                        <a href="{!! route('logout') !!}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            {{--<li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i>Product Categories</a></li>
                    <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i>Product List</a></li>
                </ul>
            </li>--}}
            <li>
                <a href="{!! route('admin.menu.listData') !!}">
                    <i class="fa fa-pie-chart"></i>
                    <span>Menu</span>
                    {{--<span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>--}}
                </a>
                {{--<ul class="treeview-menu">
                    <li><a href="{!! route('admin.menuGroup.listData') !!}"><i class="fa fa-circle-o"></i>Menu Group</a></li>
                    <li><a href="{!! route('admin.menu.listData') !!}"><i class="fa fa-circle-o"></i>Menu List</a></li>
                </ul>--}}
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Food</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! route('admin.cateFood.listData') !!}"><i class="fa fa-circle-o"></i>Categories Food</a></li>
                    <li><a href="{!! route('admin.food.listData') !!}"><i class="fa fa-circle-o"></i>Food List</a></li>
                </ul>
            </li>
            <li>
                <a href="{!! route('admin.order') !!}">
                    <i class="fa fa-pie-chart"></i>
                    <span>Order</span>
                </a>
            </li>
            {{--<li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>--}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>