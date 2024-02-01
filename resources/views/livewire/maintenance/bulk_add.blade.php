<div class="container-fluid py-4">
  <div class="row">
        <h3 class="text-start">{{ __('messages.BULK MAINTENANCE') }}</h3>
    <form class="form-custom" enctype="multipart/form-data">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        
        <div class="container add-user-form">
          <!-- radio button -->
         
          <div class="row">
          @if(isset($error_msg) && $error_msg!=null)
        <h6 class='text-danger'>{{$error_msg}}</h6> 
          @endif
          <div>

<input   type="radio" wire:model="type" value="PRICE BY AREA" >
  <label for="css">Price By Area</label><br>
  <input  type="radio" wire:model="type" value="FIX PRICE">
  <label for="javascript">Fixed Price</label><br>
  @error('type') <span class="text-danger">{{ $message }}</span>@enderror

  
</div>

            <div class="col-sm-3 ">
              <div class="form-group">
                <label>{{ __('messages.PRICE') }} :</label>
                <input wire:model="price" type="number" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter Price">
                @error('price') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>   
            
            <div class="col-sm-3 ">
              <div class="form-group">
                <label>{{ __('messages.YEAR') }}</label>
                <select wire:model="year" {{$edit != null && isset($year) && $year != null ? 'disabled' : '' }}  class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                  <option value="" @disabled(true)>--- Select An Option---</option>
                
                  @foreach ($years as $year )                                 
                    <option value="{{ $year }}">{{ $year }}</option>
                  @endforeach
                </select>
                @error('year') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 ">
              <div class="form-group">
                <label>{{ __('messages.MONTH') }}</label>
                <select wire:model="month" {{$edit != null && isset($month) && $month != null ? 'disabled' : '' }}   class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                  <option value="" @disabled(true)>--- Select An Option---</option>
                  @foreach ($months as $month )                                 
                    <option value="{{ $month }}">{{ $month }}</option>
                  @endforeach
                </select>
                @error('month') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 ">
              <div class="form-group">
                <label>{{ __('messages.COMMENT') }}</label>
                <input wire:model="comment" type="text" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Comment Here">
                @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
            

        

          </div>
         
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
              <button wire:click.prevent="bulkStore()" type="button" class="btn bg-dark mb-0 text-white rounded-pill">
              {{ __('messages.SAVE') }}
              </button>
            </span>
            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
              <button wire:click="closeModal()" type="button" class=" rounded-pill inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5 cancel-btn">
              {{ __('messages.CANCEL') }}
              </button>
            </span>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>