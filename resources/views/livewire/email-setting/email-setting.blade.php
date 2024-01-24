<div class="container-fluid py-4">
@if (session('message'))
            <div class="row">
                <div class="alert alert-success alert-dismissible text-white" role="alert">
                    <span class="text-sm">{{ Session::get('message') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif 
            
  <div class="row">
        <h3 class="text-start">EMAIL SETTING</h3>
    <form class="form-custom" enctype="multipart/form-data">
      <div class="bg-white row">
      @if(isset($error_msg) && $error_msg!=null)
        <h6 class='text-danger'>{{$error_msg}}</h6> 
          @endif
      
          <div class="col-sm-3 ">
              <div class="form-group">
                <label>COMPANY NAME:</label>
                <input wire:model="company_name" type="text" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Comment Here">
                @error('company_name') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="col-sm-3 ">
              <div class="form-group">
                <label>INSTA ID:</label>
                <input wire:model="insta" type="text" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Comment Here">
                @error('insta') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="col-sm-3 ">
              <div class="form-group">
                <label>WHATS APP:</label>
                <input wire:model="whatsapp" type="text" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Comment Here">
                @error('whatsapp') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="mt-3">
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>LOGO :</h6>
              <input class="demo1" type="file" wire:model="logo" value="drage and drop file here or select files" />
              @error('logo') <span class="text-danger">{{ $message }}</span>@enderror
              @if(!is_object($logo)&& $logo!='')
              <a href="{{ asset('storage/logo/' . $logo) }}" download type="button" class="btn btn-success mb-0 text-white mt-3">Download</a>
              @endif
</div>
          </div>
         
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
              <button wire:click.prevent="store()" type="button" class="btn bg-dark mb-0 text-white rounded-pill">
                Save
              </button>
            </span>
            
          </div>

        </div>
      </div>
    </form>
  </div>
</div>