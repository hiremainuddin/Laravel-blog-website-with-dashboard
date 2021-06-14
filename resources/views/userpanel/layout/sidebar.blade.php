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
           <a class="nav-link" href="{{url('user/dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link" href="{{url('/')}}">
                <i class="fas fa-eye"></i>
                <span>View Site</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link" href="{{url('/user/createblog')}}">
                <i class="fas fa-plus-circle"></i>
                <span>Create Blog</span></a>
        </li>

        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/user/awaitingBlogs')}}">
                <i class="fas fa-user-clock"></i>
                <span>Awaiting Approval</span></a>
        </li>

        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/user/approvedBlogs')}}">
                <i class="fas fa-user-check"></i>
                <span>Approved Blogs</span></a>
        </li>

        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/user/userProfile')}}">
                <i class="fas fa-user"></i>
                <span>Profile</span></a>

             <!--    <div class="dropdown no-arrow">
                <a class="dropdown-toggle nav-link" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>Profile
                </a>
                <div class="dropdown-menu dropdown-menu-left animated--fade-out"
                    aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{url('/user/userProfile')}}">Profile View</a>
                    <a class="dropdown-item" href="#">Profile Edit</a>
                </div>
            </div> -->
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
            <div class="text-center ">
                <button id="sidebarToggleTop" class="btn rounded-circle mr-3">

                </button>
            </div>

</ul>
<!-- End of Sidebar -->