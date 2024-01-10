<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            @if($isAssign)
            @include('livewire.example-laravel.assign-user')
            @endif
        </div>
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
                <div class=" me-3 my-3 text-end">
                    <button wire:click="create()" class="btn bg-gradient-dark mb-0">Create New User</button>
                    @if($isOpen)
                    @include('livewire.example-laravel.create-user')
                    @endif

                    @if($isView)
                    @include('livewire.example-laravel.view')
                    @endif
                </div>

                <div class="card-body px-0 pb-2">

                    <div class="row1">
                        <div class="container custom-container">
                            <div class="row align-items-center mb-2">
                                <div class="col-md-7 col-12">
                                    <div class="row dropdown filter-bg">
 <div class="col-md-6">
                                        <div class="filter-by input-group input-group-outline mb-5">
                                           
                                            <label for="filter" class="form-label align-items-center filter-label-1"><span class="filter-title"><i class="fa fa-filter"></i> Filter by</span>
                                                <input wire:model="search" class="form-control filter-input" list="datalistOptions" placeholder="Search by role...">
                                            </label>
                                            <datalist id="datalistOptions">
                                                <option value="Admin">Admin</option>
                                                <option value="Manager">Manager</option>
                                                <option value="Team Leader">Team Leader</option>
                                                <option value="Employee">Employee</option>
                                                <option value="Other">Other</option>
                                            </datalist>
</div>      </div>

<div class="col-md-6">
                                        <div class="filter-by input-group input-group-outline">     
                                        <label>
                                            <input wire:model="search_name" type="text" class="form-control" placeholder="Search by name..."/>
                                            </label>
                                        </div>

                                    
                                        </div></div>
                                    
                 
                                </div>
                                
                                <div class="col-md-5 ms-auto-none col-12 justify-content-between d-flex">
                                    <div class="showing-results input-group input-group-outline d-flex mt-0 custom-showing align-items-center justify-content-end">
                                        <span class="text-center text-uppercase text-xs font-weight-bolder px-2 ">Results Per Page: &nbsp;</span>
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
                                        <a href="{{route('export')}}"> <span class="nav-link mb-0  active" data-bs-toggle="tooltip" data-bs-placement="top" title="Export CSV"><i class="fas fa-file-export"></i></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 ">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th class="text-uppercase text-xxs font-weight-bolder">
                                                S. No.
                                            </th>
                                            <th class="text-uppercase  text-xxs font-weight-bolder ">
                                                PHOTO</th>
                                            <th class="text-uppercase text-xxs font-weight-bolder  ps-2">
                                                NAME</th>
                                            <th class="text-center text-uppercase  text-xxs font-weight-bolder">
                                                EMAIL</th>
                                            <th class="text-center text-uppercase  text-xxs font-weight-bolder ">
                                                ROLE</th>
                                            <th class="text-center text-uppercase  text-xxs font-weight-bolder">
                                                CREATION DATE
                                            </th>
                                            <th class="text-center text-uppercase text-xxs font-weight-bolder"> ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($users->count())

                                        @foreach($users as $key => $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{($users->currentPage()-1)*$perPage+$key +1 }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('assets') }}/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                    </div>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $user->name }}</h6>

                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs text-secondary mb-0">{{ $user->email }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $user->role }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ date('Y-m-d', strtotime($user->created_at)) }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <button rel="tooltip" wire:click="edit('{{ $user->uuid }}','edit')" class="btn mb-0 btn-success btn-link bg-dark" href="" data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </button>
                                                <button type="button" wire:click="assign('{{ $user->uuid }}')" class="btn mb-0 btn-primary btn-link bg-dark" data-original-title="" title="">
                                                    <i class="fa fa-user-plus"></i>
                                                </button>
                                                <button rel="tooltip" wire:click="edit('{{ $user->uuid }}','view')" class="btn mb-0 btn-success btn-link bg-dark rounded-pill" href="" data-original-title="" title="">
                                                            <i class="material-icons">visibility</i>
                                                            <div class="ripple-container"></div>
                                                        </button>
                                                <button type="button" wire:click="delete('{{ $user->uuid }}')" class="btn mb-0 btn-danger btn-link" data-original-title="" title="">
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
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>