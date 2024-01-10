<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;





class UserDetail extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search = '';
    public $search_name = '';

    use WithFileUploads;

    public $uuid,
    $name,
    $email,
    $password,
    $phone,
    $document,
    $block_no,
    $floor_no,
    $flat_no,
    $area,
    $maintainance_price;
    
    public $isOpen = 0 , $isView = 0;

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search_name . '%')
            ->paginate($this->perPage);
        return view(
            'livewire.user.user-detail',
            [
                'users' => $users,
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
        $this->name = '';
        $this->password = '';
        $this->phone = '';
        $this->document = '';
        $this->block_no = '';
        $this->floor_no = '';
        $this->flat_no = '';
        $this->area = '';
        $this->email = '';
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
            'name' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'document' => 'required',
            'block_no' => 'required',
            'floor_no' => 'required',
            'flat_no' => 'required',
            'area' => 'required',           
        ]);


        $data = [
            'name' => $this->name,
            'password' => $this->password,
            'phone' => $this->phone,
            'document' => $this->document,
            'block_no' => $this->block_no,
            'floor_no' => $this->floor_no,
            'flat_no' => $this->flat_no,
            'area' => $this->area,           
        ];

        if ($this->uuid == null) {
            $data['uuid'] = $uuid;
            $data['email'] = $this->email;   
        } else {
            $this->validate([
                'email' => 'unique:users,email,required'
            ]);
        }
        if (is_object($this->document)) {
          $document =   $this->document->store('adhar');
            $data['document'] = $document;
        }
 
        User::updateOrCreate(['uuid' => $this->uuid], $data);
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
            $this->name = $user->name;
            $this->password = $user->password;
            $this->phone = $user->phone;
            $this->document = $user->document;
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
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->delete();
            session()->flash('delete', 'User Deleted Successfully.');
        }
    }


    public function export()
    {
        $rows = [];
        User::query()->lazyById(2000, 'id')
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
