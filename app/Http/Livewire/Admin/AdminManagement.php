<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Exception;


class AdminManagement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search = '';
    public $search_name = '';

    use WithFileUploads;

    public
        $uuid,
        $name,
        $email,
        $password,        
        $phone,
        $role,
        $errorMessage;

    public $isOpen = 0, $isView = 0;

    public function render()
    {
        $admins = Admin::where('name', 'like', '%' . $this->search_name . '%')
            ->where('role', '!=', 'admin')
            ->paginate($this->perPage);
        return view(
            'livewire.admin.admin-management',
            [
                'admins' => $admins,
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
        $this->name = '';
        $this->password = '';
        $this->phone = '';
        $this->role = '';
        $this->email = '';
        $this->errorMessage = '';

 
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        try {
        
        $uuid = (string) Str::uuid();
        $this->validate([
            'name' => 'required',
            'password' => 'required',
            'role' => 'required',
            'phone' => 'required',
        ]);
           

        $data = [
            'name' => $this->name,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            'role' => $this->role
        ];

        if ($this->uuid == null) {
            $this->validate([
                'email' => 'required|email|unique:admins,email'
            ]);
            $data['uuid'] = $uuid;
            $data['email'] = $this->email;
          
        }

        Admin::updateOrCreate(['uuid' => $this->uuid], $data);
        session()->flash(
            'message',
            $this->uuid ? 'Admin Updated Successfully.' : 'Admin Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();

        } catch (QueryException $e) {
            
            // Check if the exception is due to a unique constraint violation
            if ($e->getCode() == '23000') {
               
                $errorMessage = 'Error: The phone number  already exists.';
                $this->errorMessage =  $errorMessage;
            } else {
                // Handle other types of exceptions if needed
                // Log the error, notify the user, or perform other actions
                // ...
                echo "Error: An unexpected error occurred.";
            }
        }
     
    
}

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($uuid, $view)
    {
        $this->resetInputFields();
        $admin = Admin::where('uuid', $uuid)->first();
        if ($admin) {
            $this->uuid = $admin->uuid;
            $this->name = $admin->name;
            $this->email = $admin->email;
            $this->password = $admin->password;
            $this->phone = $admin->phone;
            $this->role = $admin->role;         
            if ($view == 'edit')
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
        $admin = Admin::where('id', $id)->first();
        if ($admin) {
            $admin->delete();
            session()->flash('delete', 'Admin Deleted Successfully.');
        }
    }


    public function export()
    {
        $rows = [];
        Admin::query()->lazyById(2000, 'id')
            ->each(function ($student) use (&$rows) {
                $rows[] = $student->toArray();
            });

        SimpleExcelWriter::streamDownload('students.csv')
        ->addRows($rows);
    }

    public function download($path)
    {

        $filePath = Storage::path('/' . $path);

        return response()->download($filePath);
    }
}
