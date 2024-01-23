<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">

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
            @if (Session::has('delete'))
            <div class="row">
                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                    <span class="text-sm">{{ Session::get('delete') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif

            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">

                </div>
                <div class="me-3 my-3 text-start">

            <div class="d-flex justify-content-end">
                    <div class="text-end mx-2"><button wire:click="create()" class="btn bg-dark mb-0 my-auto rounded-pill text-white">Add Single maintenance</button></div>
                    <div class="text-end"><button wire:click="createBulk()" class="btn bg-dark mb-0 my-auto rounded-pill text-white">Add Bulk maintenance</button></div>
            </div>
                    @if($isOpen)
                    @include('livewire.maintenance.add')
                    @endif
                    @if($isView)
                    @include('livewire.maintenance.view')
                    @endif
                       @if($isBulkOpen)
                    @include('livewire.maintenance.bulk_add')
                    @endif
                    @if($isUserOpen)
                    @include('livewire.maintenance.user_view')
                    @endif

                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive pt-5 ">
                            <div id="order-listing_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row align-items-center mb-2 row-filter-d">
                                    <div class="col-md-3 col-12">
                                        <div class="dropdown">

                                            <div class="filter-by input-group input-group-outline ">
                                                <label for="filter" class="form-label align-items-center"><span><i class="fa fa-filter"></i> Filter by</span>
                                                    <input wire:model="search_name" type="text" class="form-control" placeholder="Search by name..." />
                                                </label>
                                               
                                            </div>
                                        </div>

                                    </div>
                          
                             <div class="col-md-3 col-12 ">
             
                            
                                <select wire:model="search_year"   class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <option value="" @disabled(false)>Filter By Year</option>
                                
                                @foreach ($years as $year )                                 
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                                </select>
                               
             
                          

                              </div>
                              <div class="col-md-3 col-12 ">
              
                
                                    <select wire:model="search_month"    class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                    <option value="" @disabled(false)>Filter By Month</option>
                                    @foreach ($months as $month )                                 
                                        <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                    </select>
                                  
                                
                                </div>
                                    <div class="col-md-3 ms-auto-none col-12 justify-content-between d-flex">
                                        <div class="showing-results input-group input-group-outline d-flex mt-0 custom-showing align-items-center justify-content-end">
                                            <!-- <span class="text-center text-uppercase text-xs font-weight-bolder px-2 ">Results Per Page: &nbsp;</span> -->
                                            <select wire:model="perPage" class="input-group input-group-outline select-custom-clg">
                                                <option>10</option>
                                                <option>20</option>
                                                <option>50</option>
                                                <option>100</option>
                                                <option>500</option>
                                                <option>1000</option>

                                            </select>

                                        </div>

                                        <div class="print header-btn ms-2">
                                            <span class="nav-link mb-0 ml-2 active " data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i class="fa fa-print" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="export header-btn ms-2">
                                            <a href="{{route('maintenance_export')}}"><span class="nav-link mb-0  active" data-bs-toggle="tooltip" data-bs-placement="top" title="Export CSV"><i class="fas fa-file-export"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr class="bg-dark">
                                                    <th class="text-uppercase text-xxs font-weight-bolder">S. No.</th>
                                                    <th class="text-uppercase text-xxs font-weight-bolder ps-2">
                                                        ADMIN NAME</th>
                                                    <th class="text-uppercase text-xxs font-weight-bolder">
                                                        USERNAME
                                                    </th>
                                                    <th class="text-uppercase text-xxs font-weight-bolder">
                                                    YEAR</th>    
                                                    <th class="text-uppercase text-xxs font-weight-bolder">
                                                    MONTH</th>
                                                    
                                                    <th class="text-uppercase text-xxs font-weight-bolder">
                                                    AREA</th>
                                                       
                                                    <th class="text-uppercase text-xxs font-weight-bolder">
                                                    TYPE</th>
                                                    <th class="text-uppercase text-xxs font-weight-bolder">
                                                    MAINTAINENCE PRICE</th>
                                                    <th class="text-uppercase text-xxs font-weight-bolder">
                                                    TOTAL COST</th>
                                                    <th class="text-uppercase text-xxs font-weight-bolder">
                                                        COMMENT</th>

                                                    <th class="text-uppercase text-xxs font-weight-bolder">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @if ($maintenance_user->count())
                                                    @foreach ($maintenance_user as $key => $maintenance)
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{($maintenance_user->currentPage()-1)*$perPage+$key +1 }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center justify-content-center">
                                                           <h6 class="mb-0 text-sm">{{ $maintenance->name }}</h6> 

                                                        </div>
                                                    </td>
                                                    <td class=" text-center">
                                                        <div class=" px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center text-center">
                                                                <!-- <span class="text-secondary text-xs font-weight-bold text-center">{{ $maintenance->user_name }}</span> -->
                                                                <button rel="tooltip" wire:click="userView('{{ $maintenance->user_id }}')" class="open-user">
                                                                {{ $maintenance->user_name }}
                                                            </button>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold">{{ $maintenance->year }}</span>
                                                    </td>  
                                                    <td class="align-middle text-center text-sm">
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $maintenance->month }}
                                                        </p>
                                                    </td>
                                                    
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold">{{ $maintenance->area }}</span>
                                                    </td>  
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold">    {{$maintenance->type}}</span>
                                                    </td> 
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold">{{ $maintenance->price }}</span>
                                                    </td>   
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold">   {{$maintenance->total_amount}}</span>
                                                    </td>      
                                                   
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold">    {{$maintenance->comment}}</span>
                                                    </td>                                             
                                                    <td class="align-middle text-center">
                                                        <button rel="tooltip" wire:click="edit('{{ $maintenance->uuid }}','edit')" class="btn mb-0 btn-success btn-link bg-dark rounded-pill" href="" data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                            <div class="ripple-container"></div>
                                                        </button>
                                                        <!-- <button rel="tooltip" wire:click="edit('{{ $maintenance->uuid }}','view')" class="btn mb-0 btn-success btn-link bg-dark rounded-pill" href="" data-original-title="" title="">
                                                            <i class="material-icons">visibility</i>
                                                            <div class="ripple-container"></div>
                                                        </button> -->
                                                        <button type="button" wire:click="delete('{{ $maintenance->id }}')" class="btn mb-0 btn-danger btn-link rounded-pill" data-original-title="" title="">
                                                            <i class="material-icons">close</i>
                                                            <div class="ripple-container"></div>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="5">No record found</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        <br>
                                        {{ $maintenance_user->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
