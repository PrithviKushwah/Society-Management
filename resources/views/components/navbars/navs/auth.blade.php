<div class="container-fluid mt-3 custom-header">
<nav class="navbar navbar-expand-lg bg-dark rounded px-0">

  <div class="container-fluid d-flex w-100">
<?php 
use Illuminate\Support\Facades\Session;
  $user = auth()->user();   
  $properties = App\Models\PropertyModel::where('user_id' , $user['id'])->get();
  $property_data =  Session::get('property_data');
  if ($property_data == null) {
     $propertydata = App\Models\PropertyModel::where('user_id' , $user['id'])->first();
     if (isset($propertydata)) {
      Session::put('property_data', $propertydata->id);
    }
  }

?>

<ul class="navbar-nav w-80">
  <li class="nav-item nav-profile">
    <a class="nav-link text-white px-0" href="#" data-bs-toggle="dropdown">
      <img src="assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="profile">
      <span class="nav-profile-name">{{ isset($user['user_name']) ? $user['user_name'] : $user['name'] }}</span>
    </a>
  </li>
   <li class="nav-item nav-profile mx-4 mt-3">
                  <select class=" changeLang">
                      <option disabled>Select Language</option>
                      <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                      <option value="hi" {{ session()->get('locale') == 'hi' ? 'selected' : '' }}>हिंदी</option>
                  </select>

    </li>
        @if (isset($user['user_name']) && $user['owner_id'] == 0)                    
       <li class="nav-item nav-profile mx-4 mt-3">
                  <select class="property">
                      <option value="">Select Property</option>
                      @foreach ($properties as $property )
                          <option class="propertyId" value="{{$property->id }}" {{ isset($property_data) && $property_data == $property->id ? 'selected' : '' }}>
                            {{ $property->user->user_name }} Block {{ $property->block_no }}, Floor No {{ $property->floor_no }}, Flat No {{ $property->flat_no}}
                          </option>

                      @endforeach
                  </select>
    </li> 
    @endif

</ul>


      
      <button class="navbar-toggler text-white collapsed button-toggle-custom" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
      <i class="fa fa-bars text-white"></i>
      </span>
    </button>
    
    <div class="collapse navbar-collapse w-20 user-info" id="navbarSupportedContent">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 justify-content-end" style="column-gap: 10px;">
       
      <li class="nav-item dropdown  user-bg">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-user mx-0"></i>
          </a>
          <ul class="dropdown-menu edit-menu">
            <li><a class="dropdown-item" href="#"><i class="fa fa-user text-primary" aria-hidden="true"></i>&nbsp;&nbsp; Edit Profile</a></li>
            <li><a href="{{ route('logout') }}" class="dropdown-item log-out-bg">
            <i class="fa fa-eject text-primary"></i> 
            &nbsp;&nbsp;<livewire:auth.logout/>
                    </a></li>
            
          </ul>
        </li>
       
        
      </ul>
    </div>
  </div>
</nav>
</div>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">{{ str_replace('-', ' ', Route::currentRouteName()) }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Route::currentRouteName()) }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 justify-content-end" id="navbar">
           
           
            <ul class="navbar-nav  justify-content-end">
                
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
