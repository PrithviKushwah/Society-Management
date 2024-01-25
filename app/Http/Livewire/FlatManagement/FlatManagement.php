<?php

namespace App\Http\Livewire\FlatManagement;

use Livewire\Component;
use App\Models\User;
use App\Models\PropertyModel;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class FlatManagement extends Component
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
        $profile_picture,
        $phone,
        $adhar,
        $maintainance_price,
        $errorMessage,
        $status,
        $user_check,
        $property_list,
        $property_id;


    public $isOpen = 0, $isView = 0;

    public function mount(){
        $this->user_check = auth()->user(); 
        $this->property_list = PropertyModel::where('user_id' , $this->user_check['id'])->get();
    }
 
    public function render()
    { 
       

        $users = DB::table('users')
        ->join('properties', 'users.asign_property_id', '=', 'properties.id')
        ->select('users.*', 'properties.flat_no' , 'properties.block_no' , 'properties.floor_no')
        ->where('users.user_name', 'like', '%' . $this->search_name . '%')
        ->where('owner_id', $this->user_check['id'])
        ->where('flat_status', '!=', '0')
        ->where('user_name', 'like', '%' . $this->search_name . '%')
        ->paginate($this->perPage);

        return view(
            'livewire.flat-management.flat-management',
            [
                'users' => $users,
            ]);

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
        $this->adhar = '';
        $this->profile_picture = '';
        $this->email = '';
        $this->errorMessage = '';
        $this->status = '';
        $this->property_id = '' ;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {

        $user_Property = User::where('owner_id', $this->user_check['id'])
        ->where('asign_property_id', $this->property_id)
        ->first();

        if ($user_Property && $this->uuid == null) {
            session()->flash('delete', 'Property already exists.');
            $this->closeModal();
            $this->resetInputFields();
        }


        try {
            $uuid = (string) Str::uuid();

            $this->validate([
                'name' => 'required',
                'password' => 'required',
                'phone' => 'required',
                // 'adhar' => 'required',
                // 'profile_picture' => 'required',
                'property_id' => 'required',
            ]);

            $data = [
                'user_name' => $this->name,
                'password' => $this->password,
                'phone' => $this->phone,
                'asign_property_id' => $this->property_id,
                'flat_status' => '1',
                'owner_id' => $this->user_check['id'],
            ];

            if ($this->uuid == null) {
                $this->validate([
                    'email' => 'required|email|unique:users,email'
                ]);
                $data['uuid'] = $uuid;
                $data['email'] = $this->email;
            }

            if ($this->status) {
                $data['status'] = $this->status;
            }
            if (is_object($this->adhar)) {
                $adhar = $this->adhar->store('public/adhar');
                $filename = basename($adhar);
                $data['adhar'] = $filename;
            }

            if (is_object($this->profile_picture)) {
                $profile_picture = $this->profile_picture->store('public/profile_picture');
                $filename = basename($profile_picture);
                $data['profile_picture'] = $filename;
            }
            

            User::updateOrCreate(['uuid' => $this->uuid], $data);
            session()->flash(
                'message',
                $this->uuid ? 'Property Updated Successfully.' : 'Property Created Successfully.'
            );

            $this->closeModal();
            $this->resetInputFields();
        } catch (QueryException $e) {

            // Check if the exception is due to a unique constraint violation
            if ($e->getCode() == '23000' && strpos($e->getMessage(), 'users_phone_unique') !== false) {
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
        $user = User::where('uuid', $uuid)->first();
        if ($user) {
            $this->uuid = $user->uuid;
            $this->name = $user->user_name;
            $this->email = $user->email;
            $this->password = $user->password;
            $this->phone = $user->phone;
            $this->adhar = $user->adhar;
            $this->profile_picture = $user->profile_picture;
            $this->status = $user->status;
            $this->property_id = $user->asign_property_id;
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
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->delete();
            session()->flash('delete', 'Property Deleted Successfully.');
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

        $filePath = Storage::path('/' . $path);

        return response()->download($filePath);
    }

    
}
