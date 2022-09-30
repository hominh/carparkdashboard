<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="">
                <a href="{{url('basement')}}">
                    <i class="fa fa-bed"></i> <span>Bãi giữ xe</span><span data-toggle="tooltip" title=""></span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>

            <li class="">
                <a href="{{url('camera')}}">
                    <i class="fa fa-camera"></i> <span>Camera</span><span data-toggle="tooltip" title=""></span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="">
                <a href="{{url('sensor')}}">
                    <i class="fa fa-eye"></i> <span>Cảm biến</span><span data-toggle="tooltip" title=""></span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{url('kiosk')}}">
                    <i class="fa fa-arrows"></i> <span>Cài đặt vị trí</span><span data-toggle="tooltip" title=""></span>
                    <span class="pull-right-container">
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{url('status/settings')}}">
                            <span>Cài đặt tọa độ</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{url('lot')}}">
                            <i class="fa fa-history"></i> <span>Vị trí</span><span data-toggle="tooltip" title=""></span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="{{url('kiosk')}}">
                    <i class="fa fa-arrows"></i> <span>Kiosk</span><span data-toggle="tooltip" title=""></span>
                    <span class="pull-right-container">
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{url('kiosk')}}">
                            <span>Quản lý kiosk</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{url('kiosk/settings')}}">
                            <span>Cài đặt vị trí kiosk</span>
                        </a>
                    </li>

                </ul>
            </li>
             <li class="treeview">
                <a href="{{url('status')}}">
                    <i class="fa fa-car"></i> <span>Trạng thái</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{url('status')}}">
                            <span>Theo dõi trạng thái</span>
                        </a>
                    </li>
                    
                    <li class="">
                        <a href="{{url('status/setting-path')}}">
                            <span>Cài đặt đường đi</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{url('params')}}">
                    <i class="fa fa-plug"></i> <span>Cấu hình tham số</span><span data-toggle="tooltip" title=""></span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{url('status')}}"><i class="fa fa-desktop" aria-hidden="true"></i><span>Thiết bị trung tâm</span></a>
                <ul class="treeview-menu">
                    <li class="" id="status_connect_device_center">
                        <a href="#">
                            <span>Theo dõi trạng thái</span>
                        </a>
                    </li>
                </ul>
            </li>
            
        </ul>
    </section>
</aside>
