<div class="container-fluid py-4">
  <div class="row">
        <h3 class="text-start">User Form</h3>
    <form class="form-custom" enctype="multipart/form-data">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
    
        <div class="container add-user-form">
          

          <div class="row">

            <div class="col-sm-3 ">
              <div class="form-group">
                <label>Name :</label>
                <input wire:model="name" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter Name">
                @error('name') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>


@if(!$uuid)

            <div class="col-sm-3 ">
              <div class="form-group ">
                <label>Email Address :</label>
                <input wire:model="email" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" placeholder="Enter Email Address">
                @error('email') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

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

            <div class="col-sm-3 {{ isset($uuid) && $uuid != null ? '' : 'mt-3' }}">
              <div class="form-group">
                <label>Block Number</label>
             
                <select class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="block_no">
                  <option value="" @disabled(true)>--- Select An Option---</option>
                  @foreach ($block_numbers as $block_number )                                 
                    <option value="{{ $block_number }}">{{ $block_number }}</option>
                   @endforeach
                </select>
                @error('block_no') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 {{ isset($uuid) && $uuid != null ? '' : 'mt-3' }}">
              <div class="form-group">
                <label>Floor Number</label>
                <select wire:model="floor_no"  class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                  <option value="" @disabled(true)>--- Select An Option---</option>
                  @foreach ($floor_numbers as $floor_number )                                 
                    <option value="{{ $floor_number }}">{{ $floor_number }}</option>
                  @endforeach
                </select>
                @error('floor_no') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Flat Number</label>
                <select wire:model="flat_no" class=" w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                   <option value="" @disabled(true)>--- Select An Option---</option>
                  @foreach ($flat_numbers as $flat_number )                                 
                    <option value="{{ $flat_number }}">{{ $flat_number }}</option>
                  @endforeach
                </select>
                @error('flat_no') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Area :</label>
                <input wire:model="area" type="number" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  placeholder="Please Enter Area">
                @error('area') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

          <!-- <div class="col-sm-3 mt-3">
              <div class="form-group ">
                <label>Maintainance Price :</label>
                <input wire:model="maintainance_price" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Please Enter Floor Number">
                @error('maintainance_price') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>  -->

          </div>
          <div class="mt-3">
                 
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>Aadhar Card :</h6>
              <input class="demo1" type="file" wire:model="adhar" value="drage and drop file here or select files" />
              @error('adhar') <span class="text-danger">{{ $message }}</span>@enderror
              @if(!is_object($adhar)&& $adhar!='')
              <button wire:click.prevent="download('{{ $adhar }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
              @endif
            </div>
            <div class="mt-3">
                  
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>Registry :</h6>
              <input class="demo1" type="file" wire:model="registry" value="drage and drop file here or select files" />
              @error('registry') <span class="text-danger">{{ $message }}</span>@enderror
              @if(!is_object($registry)&& $registry!='')
              <button wire:click.prevent="download('{{ $adhar }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
              @endif
            </div>
            <div class="mt-3">
                
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>Profile-Picture:</h6>
              <input class="demo1" type="file" wire:model="profile_picture" value="drage and drop file here or select files" />
              @error('profile_picture') <span class="text-danger">{{ $message }}</span>@enderror
              @if(!is_object($profile_picture)&& $profile_picture!='')
              <button wire:click.prevent="download('{{ $profile_picture }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
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