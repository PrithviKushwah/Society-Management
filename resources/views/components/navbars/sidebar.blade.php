             <?php 
  $user = auth()->user();   
?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href="{{ isset($user['user_name']) ? '#' : route('dashboard') }}">
            <img src="{{ asset('assets/img/3dlogo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-2 font-weight-bold text-white"></span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">

        @if(isset($user['name']) )
            <li class="nav-item">
                <a class="px-1 nav-link text-white {{ Route::currentRouteName() == 'dashboard' ? ' active bg-gradient-primary' : '' }} " href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="px-0 nav-link text-white {{ Route::currentRouteName() == 'admin_management' ? ' active bg-gradient-primary' : '' }} " href="{{ route('admin_management') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fas fa-lg fa-list-ul ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Admin Management</span>
                    
                </a>
            </li>          

            <li class="nav-item">
                <a href="{{ route('User Detail') }}" class="nav-link px-0 align-middle nav-link px-0 {{ Route::currentRouteName() == 'User Detail' ? ' active bg-gradient-primary' : '' }}">
                <i style="font-size: 1rem;" class="fas fa-lg fa-book ps-2 pe-2 text-center"></i> 
                <span class="nav-link-text ms-1">User Management</span> </a>
                
            </li>

            <li class="nav-item">
                <a href="{{ route('bulk-maintenance') }}" class="nav-link px-0 align-middle nav-link px-0 {{ Route::currentRouteName() == 'bulk-maintenance' ? ' active bg-gradient-primary' : '' }}">
                <i style="font-size: 1rem;" class="fas fa-lg fa-book ps-2 pe-2 text-center"></i> 
                <span class="nav-link-text ms-1">Maintenance</span> </a>
                
            </li>
            <li class="nav-item">
                <a href="{{ route('reciept') }}" class="nav-link px-0 align-middle nav-link px-0 {{ Route::currentRouteName() == 'reciept' ? ' active bg-gradient-primary' : '' }}">
                <i style="font-size: 1rem;" class="fas fa-lg fa-book ps-2 pe-2 text-center"></i> 
                <span class="nav-link-text ms-1">Reciept</span> </a>
                
            </li>
            <li class="nav-item">
                <a href="{{ route('properties') }}" class="nav-link px-0 align-middle nav-link px-0 {{ Route::currentRouteName() == 'properties' ? ' active bg-gradient-primary' : '' }}">
                <i style="font-size: 1rem;" class="fas fa-lg fa-book ps-2 pe-2 text-center"></i> 
                <span class="nav-link-text ms-1">Properties</span> </a>
                
            </li>

        @elseif(isset($user['user_name'])) 
         <li class="nav-item">
                <a href="{{ route('user') }}" class="nav-link px-0 align-middle nav-link px-0 {{ Route::currentRouteName() == 'user' ? ' active bg-gradient-primary' : '' }}">
                <i style="font-size: 1rem;" class="fas fa-lg fa-book ps-2 pe-2 text-center"></i> 
                <span class="nav-link-text ms-1">User</span> </a>
                
            </li>
            <li class="nav-item">
                <a href="{{ route('maintanence-history') }}" class="nav-link px-0 align-middle nav-link px-0 {{ Route::currentRouteName() == 'maintanence-history' ? ' active bg-gradient-primary' : '' }}">
                <i style="font-size: 1rem;" class="fas fa-lg fa-book ps-2 pe-2 text-center"></i> 
                <span class="nav-link-text ms-1">Maintanence History</span> </a>
                
            </li>
          @endif 
                    <!-- <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i style="font-size: 1rem;" class="fas fa-lg fa-list-ul ps-2 pe-2 text-center"></i> 
                        <span class="ms-1 d-sm-inline">Student Portal</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="{{ route('User Detail') }}" class="nav-link px-0 {{ Route::currentRouteName() == 'User Detail' ? ' active bg-gradient-primary' : '' }}"> <i class="fs-4 bi-speedometer2"></i>User Details</a>
                            </li> -->
                            <!-- <li>
                                <a href="#" class="nav-link px-0"> <i class="fs-4 bi-speedometer2"></i> Edit User Detail</a>
                            </li> -->
                        </ul>
                    </li>
       
        </ul>
                    
    </div>
</aside>
