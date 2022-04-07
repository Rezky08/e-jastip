@section("sidebar")
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">{{$appName ?? ""}}</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.html">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>


    @foreach($sidebar as $item)

        <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{$item['title']}}
            </div>
        @foreach($item['children'] as $itemChild)
            <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed"
                       href="#"
                       @if(count($itemChild['children']) > 0)

                       data-toggle="collapse"
                       data-target="#{{$itemChild['code']}}"
                       aria-expanded="true"
                       aria-controls="collapseTwo"
                        @endif
                    >
                        <i class="fas fa-fw fa-cog"></i>
                        <span>{{$itemChild['title']}}</span>
                    </a>
                    @if(count($itemChild['children']) > 0)
                        <div id="{{$itemChild['code']}}" class="collapse" aria-labelledby="headingTwo"
                             data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">{{$itemChild['childrenTitle']??""}}</h6>
                                @foreach($itemChild['children'] as $itemSubChild)
                                    <a class="collapse-item"
                                       href="{{$itemSubChild['url']}}">{{$itemSubChild['title']??""}}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </li>
        @endforeach
    @endforeach

    <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
@endsection
