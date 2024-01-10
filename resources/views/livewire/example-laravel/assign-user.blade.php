<div class="container-fluid bg-white rounded pt-3 pb-3">
  <div class="row">
    <div class="col-md-12">
      <h3>Assign Employee {{$user_name}}</h3>
      <form>

        <div class="row stable-bg mt-3"  >
          @foreach ($assign as $assign_manage )
          <div class="form-check col-6 col-xs-6 col-sm-3 col-md-2">
            <input type="checkbox" class="form-check-input" wire:model="assign_user" value="{{$assign_manage->uuid}}">{{$assign_manage->name}}<br>
          </div>
          @endforeach
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <span class="flex w-full rounded-pill shadow-sm sm:ml-3 sm:w-auto">
            <button type="button" wire:click.prevent="AssignStore()" class="btn bg-dark mb-0 text-white rounded-pill">
              Submit
            </button>
          </span>
          <span class="mt-3 flex w-full rounded-pill shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click="closeAssign()" type="button" class="inline-flex justify-center w-full rounded-pill border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5 cancel-btn">
              Cancel
            </button>
          </span>
        </div>

      </form>
    </div>
  </div>
</div>