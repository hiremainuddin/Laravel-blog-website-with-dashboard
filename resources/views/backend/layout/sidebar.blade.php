<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
       <li class="nav-item">
           <a class="nav-link" href="{{url('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link" href="{{url('/categories')}}">
                <i class="fab fa-cuttlefish"></i>
                <span>Categories</span></a>
        </li> 
              <!-- Divider -->
        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/tags')}}">
                <i class="fas fa-tags"></i>
                <span>Tags</span></a>
        </li>

        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/blogs')}}">
                <i class="fas fa-fw fa-table"></i>
                <span>Blogs</span></a>
        </li>

        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/awaitingApproval')}}">
                <i class="fas fa-user-clock"></i>
                <span>Awaiting Approval</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
            <div class="text-center ">
                <button id="sidebarToggleTop" class="btn rounded-circle mr-3">

                </button>
            </div>

</ul>
<!-- End of Sidebar -->