<div class="container-fluid py-4">
  <div class="row">
        <h3 class="text-start">Property Form</h3>
    <form class="form-custom" enctype="multipart/form-data">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
    
        <div class="container add-user-form">
          

          <div class="row">

            <div class="col-sm-3 ">
              <div class="form-group">
                <label>Property List</label>
                <select  {{ isset($this->uuid) && $this->uuid != null ? 'disabled' : '' }} wire:model="property_id"   class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                  <option value="" @disabled(true)>--- Select An Option---</option>
                  @foreach ($property_list as $property )                                 
                    <option value="{{ $property->id }}">Block {{ $property->block_no}}, Floor No {{ $property->floor_no}},Flat No {{ $property->flat_no}}</option>
                  @endforeach
                </select>
                @error('property_id') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 ">
              <div class="form-group">
                <label>Name :</label>
                <input wire:model="name" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter Name">
                @error('name') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 ">
              <div class="form-group ">
                <label>Email Address :</label>
                <input wire:model="email" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" placeholder="Enter Email Address">
                @error('email') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
@if(!$uuid)
            <div class="col-sm-3 ">
              <div class="form-group">
                <label>Password :</label>
                <input wire:model="password" type="password" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter Password">
                @error('password') 
                <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
            
@endif

          <div class="col-sm-3 ">
              <div class="form-group">
                <label>Phone Number :</label>
                <input wire:model="phone" type="number"  class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter Phone Number">
                  @error('phone')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                  @if(!empty($errorMessage) && $errorMessage != null )
                  <span class="text-danger">                       
                            The phone number must be unique.
                  </span>
                    @endif
              </div>
            </div>
@if($this->uuid)
            <div class="col-sm-3 ">
              <div class="form-group">
                <label>status</label>
                <select wire:model="status"   class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                  <option value="" @disabled(true)>--- Select An Status---</option>
                    <option value="1">Active</option>
                    <option value="2">InActive</option>
                </select>
              </div>
            </div>
@endif
          <div class="mt-3">
                 
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>Aadhar Card(Optional) :</h6>
              <input class="demo1" type="file" wire:model="adhar" value="drage and drop file here or select files" />
              @error('adhar') <span class="text-danger">{{ $message }}</span>@enderror
              @if(!is_object($adhar)&& $adhar!='')
              <a href="{{ asset('storage/adhar/' . $adhar) }}" download type="button" class="btn btn-success mb-0 text-white mt-3">Download</a>
              @endif
            </div>
            <div class="mt-3">  
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>Profile-Picture(Optional):</h6>
              <input class="demo1" type="file" wire:model="profile_picture" value="drage and drop file here or select files" />
              @error('profile_picture') <span class="text-danger">{{ $message }}</span>@enderror
              @if(!is_object($profile_picture)&& $profile_picture!='')
              <a href="{{ asset('storage/profile_picture/' . $profile_picture) }}" download type="button" class="btn btn-success mb-0 text-white mt-3">Download</a>
              @endif
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
              <button wire:click.prevent="store()" type="button" class="btn bg-dark mb-0 text-white rounded-pill">
                Save
              </button>
            </span>
            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
              <button wire:click="closeModal()" type="button" class=" rounded-pill inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5 cancel-btn">
                Cancel
              </button>
            </span>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>