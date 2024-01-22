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
                    <div class="text-end mx-2"><button wire:click="create()" class="btn bg-dark mb-0 my-auto rounded-pill text-white">Create Invoice</button></div>
            </div>
                    

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
                                                    PAYMENT METHOD</th>
                                                       
                                                    <th class="text-uppercase text-xxs font-weight-bolder">
                                                    PAID AMOUNT</th>
                                                    <th class="text-uppercase text-xxs font-weight-bolder">
                                                    REMAINING AMOUNT</th>
                                                    <th class="text-uppercase text-xxs font-weight-bolder">
                                                    PAYMENT DATE</th>
                                                    
                                                    <th class="text-uppercase text-xxs font-weight-bolder">
                                                        COMMENT</th>
                                             </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @if ($maintenance_history->count())
                                                    @foreach ($maintenance_history as $key => $invoice)
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{($maintenance_history->currentPage()-1)*$perPage+$key +1 }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center justify-content-center">
                                                           <h6 class="mb-0 text-sm">{{ $invoice->user_name }}</h6> 

                                                        </div>
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
                                        {{ $maintenance_history->links() }}
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
