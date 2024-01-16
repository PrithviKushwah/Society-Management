<div class="container-fluid py-4">
  <div class="row">
        <h3 class="text-start">User Details</h3>
    <form class="form-custom" enctype="multipart/form-data">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
    
        <div class="container add-user-form">
          

          <div class="row">

            <div class="col-sm-3 ">
              <div class="form-group">
                <label>Name :</label>
                <h6>{{$this->user_detail->user_name}}</h6>
              </div>
            </div>


@if(!$uuid)
            <div class="col-sm-3 ">
              <div class="form-group ">
                <label>Email Address :</label>
                <h6>{{$this->user_detail->email}}</h6>
              </div>
            </div>  
@endif

          <div class="col-sm-3 ">
              <div class="form-group">
                <label>Phone Number :</label>
                <h6>{{$this->user_detail->phone}}</h6>
              </div>
            </div>

            <div class="col-sm-3 {{ isset($uuid) && $uuid != null ? '' : 'mt-3' }}">
              <div class="form-group">
                <label>Block Number</label>
                <h6>{{$this->user_detail->block_no}}</h6>
              </div>
            </div>

            <div class="col-sm-3 {{ isset($uuid) && $uuid != null ? '' : 'mt-3' }}">
              <div class="form-group">
                <label>Floor Number</label>
                <h6>{{$this->user_detail->floor_no}}</h6>
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Flat Number</label>
                <h6>{{$this->user_detail->flat_no}}</h6>
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Area :</label>
                <h6>{{$this->user_detail->area}}</h6>
              </div>
            </div>

          </div>
          <div class="mt-3">
                 
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>Aadhar Card :</h6>
              <a href="{{ asset('storage/adhar/' . $this->user_detail->adhar) }}" class="btn btn-success mb-0 text-white mt-3" download>Download</a>
            </div>
            <div class="mt-3">
                  
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>Registry :</h6>
              <a href="{{ asset('storage/registry/' . $this->user_detail->registry) }}" class="btn btn-success mb-0 text-white mt-3" download>Download</a>
            </div>
            <div class="mt-3">
                
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>Profile-Picture:</h6>

              <img width='80' src="{{ asset('storage/profile_picture/' . $this->user_detail->profile_picture) }}" alt="alt">
              <a href="{{ asset('storage/profile_picture/' . $this->user_detail->profile_picture) }}" class="btn btn-success mb-0 text-white mt-3" download>Download</a>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
           
            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click="closeModal()" type="button" class=" rounded-pill inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5 cancel-btn">
                Back
              </button>
            </span>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>