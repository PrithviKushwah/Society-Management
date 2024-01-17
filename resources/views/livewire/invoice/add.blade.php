<div class="container-fluid py-4">
  <div class="row">
        <h3 class="text-start">SINGLE MAINTENANCE FORM</h3>
    <form class="form-custom" enctype="multipart/form-data">
      <div class="bg-white row">
      @if(isset($error_msg) && $error_msg!=null)
        <h6 class='text-danger'>{{$error_msg}}</h6> 
          @endif
      <div class="col-sm-3 ">
              <div class="form-group">
                <label>User:</label>
                <select wire:model="created_for" {{ isset($create_for) && $create_for != null ? 'disabled' : '' }} class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                  <option value="" @disabled(true)>--- Select An Option---</option>
                  <?php 
                      $users = App\Models\User::select('id','user_name')->get();
                  ?>
                  @foreach ($users as $user )                                 
                    <option value="{{ $user->id }}">{{ $user->user_name }}</option>
                  @endforeach
                </select>
                @error('create_for') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
        


            <div class="col-sm-3 ">
              <div class="form-group">
                <label>MONTH</label>
                <select wire:model="month"   class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
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
                <label>YEAR</label>
                <select wire:model="year" {{isset($year) && $year != null ? 'disabled' : '' }}  class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                  <option value="" @disabled(true)>--- Select An Option---</option>
                
                  @foreach ($years as $year )                                 
                    <option value="{{ $year }}">{{ $year }}</option>
                  @endforeach
                </select>
                @error('year') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <?php
            
            
          
             $maintenance = App\Models\MaintenanceUser::where('month','=',$this->month)
             ->where('year','=',$this->year)
             ->where('create_for','=',$this->created_for)
             ->select('total_cost')
             ->first();
             if(!empty( $maintenance)){
           $this->payable_amount =  $maintenance->total_cost;
             }
            ?>
            <div class="col-sm-3 ">
              <div class="form-group">
                <label>PAYABLE AMOUNT:</label>
                <input disabled wire:model="payable_amount" type="text" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Comment Here">
                @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="col-sm-3 ">
              <div class="form-group">
                <label>PAID AMOUNT:</label>
                <input wire:model="" type="text" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Comment Here">
                @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 ">
              <div class="form-group">
                <label>COMMENT:</label>
                <input wire:model="comment" type="text" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Comment Here">
                @error('comment') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class=" mt-3">
              <input   type="radio" wire:model="type" value="PRICE BY AREA" >
            <label for="css">Price By Area</label><br>
            <input  type="radio" wire:model="type" value="FIX PRICE">
            <label for="javascript">Fixed Price</label><br>
            @error('type') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>PRICE :</label>
                <input wire:model="price" type="number" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter Price">
                @error('price') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
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