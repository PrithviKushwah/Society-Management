<?php

namespace App\Http\Livewire\Property;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Models\PropertyModel;





class Properties extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search = '';
    public $search_name = '';

    use WithFileUploads;

    public 
    $uuid,
    $registry,
    $block_no,
    $floor_no,
    $flat_no,
    $area,
    $errorMessage,
    $users,
    $user_id;
    
    public $isOpen = 0 , $isView = 0;
    public function mount(){

    $this->users = User::all();   

    }

    public function render()
    {
        $properties = PropertyModel::where('user_id', 'like', '%' . $this->area . '%')
            ->paginate($this->perPage);
        return view(
            'livewire.property.properties',
            [
                'property' => $properties,
            ]
        );
    }
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }

    public function openView()
    {
        $this->isView = true;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
        $this->isView = false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
    {
        $this->resetErrorBag();
        $this->uuid = '';
        $this->registry = '';
        $this->block_no = '';
        $this->floor_no = '';
        $this->flat_no = '';
        $this->area = '';
        $this->errorMessage = '';
        $this->user_id = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        
        $uuid = (string) Str::uuid();

        $this->validate([            
           
            'user_id' => 'required',
            'registry' => 'required',
            'block_no' => 'required',
            'floor_no' => 'required',
            'flat_no' => 'required',
            'area' => 'required',           
        ]);


        $data = [
           
            'user_id' => $this->user_id,
            'block_no' => $this->block_no,
            'floor_no' => $this->floor_no,
            'flat_no' => $this->flat_no,
            'area' => $this->area,           
        ];

        
        $data['uuid'] = $uuid;
        

        if (is_object($this->registry)) {
            $registry = $this->registry->store('public/registry');
            $filename = basename($registry);
            $data['registry'] = $filename;
        }
        
        PropertyModel::updateOrCreate(['uuid' => $this->uuid], $data);
        session()->flash(
            'message',
            $this->uuid ? 'User Updated Successfully.' : 'User Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();

         
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($uuid ,$view)
    {
        $this->resetInputFields();
        $user = User::where('uuid', $uuid)->first();
        if ($user) {
            $this->uuid = $user->uuid;            
            $this->registry = $user->registry;
            $this->block_no = $user->block_no;
            $this->floor_no = $user->floor_no;
            $this->flat_no = $user->flat_no;
            $this->area = $user->area;
           
           if($view == 'edit')
            $this->openModal();
            else
            $this->openView();
        }
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        $user = PropertyModel::where('id', $id)->first();
        if ($user) {
            $user->delete();
            session()->flash('delete', 'User Deleted Successfully.');
        }
    }


    public function export()
    {
        $rows = [];
        PropertyModel::query()->lazyById(2000, 'id')
            ->each(function ($student) use (&$rows) {
                $rows[] = $student->toArray();
            });

        SimpleExcelWriter::streamDownload('students.csv')
            ->addRows($rows);
    }

    public function download($path)
    {   
        
        $filePath = Storage::path('/' .$path);
        
        return response()->download($filePath);
    }
}
