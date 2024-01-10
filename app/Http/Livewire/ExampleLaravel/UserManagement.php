<?php

namespace App\Http\Livewire\ExampleLaravel;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User_data;
use Livewire\WithFileUploads;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;


class UserManagement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search = '';
    public $search_name = '';




    use WithFileUploads;

    public $assign,  $user_name, $assign_user = [], $industry_details = [], $user_id, $name, $role, $email, $password,  $uuid,  $confirm_password, $father_name, $mother_name, $date_of_birth, $phone_number,
        $alternate_phone_number, $tenth_details, $twelfth_details, $university_details,
        $permanent_address, $current_address, $industry_experience, $tenth_marksheet,
        $twelfth_marksheet, $aadhar_card,  $alternative_govt_id_card, $graduation_diploma,
        $post_graduation, $experience_certificate, $salary_slip,
        $tenth_board_name, $tenth_qua_year, $tenth_percentage, $tenth_roll_no,
        $twelfth_board_name, $twelfth_qua_year, $twelfth_percentage, $twelfth_roll_no,
        $university_name, $university_qua_year, $university_percentage, $university_roll_no,
        $industry_name = [], $industry_designation = [], $industry_salary = [], $industry_total_year = [];

    public $isOpen = 0, $isAssign = 0 , $isView = 0;

    public $i = 0;

    public function addField($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->industry_details, $i);
        $this->industry_name[$i] = '';
        $this->industry_designation[$i] = '';
        $this->industry_salary[$i] = '';
        $this->industry_total_year[$i] = '';
    }

    public function removeIndustryField($y)
    {
        $key = array_search($y,  $this->industry_details);
        unset(
            $this->industry_details[$key],
            $this->industry_name[$key],
            $this->industry_designation[$key],
            $this->industry_salary[$key],
            $this->industry_total_year[$key],
        );
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $user = User::where('role', '!=', 'super_admin')
            ->where('role', 'like', '%' . $this->search . '%')
            ->where('name', 'like', '%' . $this->search_name . '%')
            ->paginate($this->perPage);
        return view(
            'livewire.example-laravel.user-management',
            [
                'users' => $user,
            ]
        );
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
        $this->isAssign = false;
        $this->isOpen = true;
        $this->isView = false;
    }

    public function openView()
    {
        $this->isAssign = false;
        $this->isOpen = false;
        $this->isView = true;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isAssign = false;
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
        $this->i = 0;
        $this->industry_details = array();
        array_push($this->industry_details, $this->i);
        $this->industry_name = array();
        $this->industry_designation = array();
        $this->industry_salary = array();
        $this->industry_total_year = array();
        $this->name = '';
        $this->role = '';
        $this->email = '';
        $this->password = '';
        $this->uuid = '';
        $this->father_name = '';
        $this->mother_name = '';
        $this->date_of_birth = '';
        $this->phone_number = '';
        $this->alternate_phone_number = '';
        $this->permanent_address = '';
        $this->current_address = '';
        $this->tenth_marksheet = '';
        $this->twelfth_marksheet = '';
        $this->aadhar_card = '';
        $this->alternative_govt_id_card = '';
        $this->graduation_diploma = '';
        $this->post_graduation = '';
        $this->experience_certificate = '';
        $this->salary_slip = '';
        $this->tenth_board_name = '';
        $this->tenth_qua_year = '';
        $this->tenth_percentage = '';
        $this->tenth_roll_no = '';
        $this->twelfth_board_name = '';
        $this->twelfth_qua_year = '';
        $this->twelfth_percentage = '';
        $this->twelfth_roll_no = '';
        $this->university_name = '';
        $this->university_qua_year = '';
        $this->university_percentage = '';
        $this->university_roll_no = '';
        $this->assign_user = '';
    }

    // copy field code

    public function copyFields()
    {
        $this->current_address = $this->permanent_address;
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
            'role' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'date_of_birth' => 'required',
            'phone_number' => 'required',
            'alternate_phone_number' => 'required',
            'permanent_address' => 'required',
            'current_address' => 'required',
            'tenth_board_name'       => 'required',
            'tenth_qua_year'         => 'required',
            'tenth_percentage'       => 'required',
            'tenth_roll_no'          => 'required',
            'twelfth_board_name'     => 'required',
            'twelfth_qua_year'       => 'required',
            'twelfth_percentage'     => 'required',
            'twelfth_roll_no'        => 'required',
            'university_name'        => 'required',
            'university_qua_year'    => 'required',
            'university_percentage'  => 'required',
            'university_roll_no'     => 'required',
            'industry_name.0'        => 'required',
            'industry_designation.0' => 'required',
            'industry_salary.0'      => 'required',
            'industry_total_year.0'  => 'required',
            'industry_name.*'        => 'required',
            'industry_designation.*' => 'required',
            'industry_salary.*'      => 'required',
            'industry_total_year.*'  => 'required',
        ]);
        $data = [
            'name' => $this->name,
            'role' => $this->role,

        ];
        if ($this->uuid == null) {
            $data['uuid'] = $uuid;
            $data['email'] = $this->email;
            $data['password'] = Hash::make($this->password);
            $this->validate([
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'required',
                'tenth_marksheet' => 'required',
                'twelfth_marksheet' => 'required',
                'aadhar_card' => 'required',
                'alternative_govt_id_card' => 'required',
            ]);
        } else {
            if ($this->password != null)
                $data['password'] = Hash::make($this->password);
            $this->validate([
                'email' => 'required|string|email|max:255|',
                'password' => 'required_with:confirm_password|same:confirm_password'
            ]);
        }
        $tenth_details = [
            'tenth_board_name' => $this->tenth_board_name,
            'tenth_qua_year' => $this->tenth_qua_year,
            'tenth_percentage' => $this->tenth_percentage,
            'tenth_roll_no' => $this->tenth_roll_no
        ];


        $twelfth_details =  [
            'twelfth_board_name' => $this->twelfth_board_name,
            'twelfth_qua_year' => $this->twelfth_qua_year,
            'twelfth_percentage' => $this->twelfth_percentage,
            'twelfth_roll_no' => $this->twelfth_roll_no
        ];


        $university_details =
            [
                'university_name' => $this->university_name,
                'university_qua_year' => $this->university_qua_year,
                'university_percentage' => $this->university_percentage,
                'university_roll_no' => $this->university_roll_no

            ];

        $industry_experience = array();
        foreach ($this->industry_name as $key => $value) {
            array_push(
                $industry_experience,
                [
                    'industry_name' => $this->industry_name[$key],
                    'industry_designation' => $this->industry_designation[$key],
                    'industry_salary' => $this->industry_salary[$key],
                    'industry_total_year' => $this->industry_total_year[$key]

                ]
            );
        }

        $users =  User::updateOrCreate(['uuid' => $this->uuid], $data);
        $user_data = [
            'user_id' => $users['id'],
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'date_of_birth' => $this->date_of_birth,
            'phone_number' => $this->phone_number,
            'alternate_phone_number' => $this->alternate_phone_number,
            'tenth_details' => json_encode($tenth_details),
            'twelfth_details' => json_encode($twelfth_details),
            'university_details' => json_encode($university_details),
            'industry_experience' => json_encode($industry_experience),
            'permanent_address' => $this->permanent_address,
            'current_address' => $this->current_address,
        ];

        if (is_object($this->tenth_marksheet)) {
            $tenth_marksheet =  $this->tenth_marksheet->store('user/tenth-marksheet');
            $user_data['tenth_marksheet'] = $tenth_marksheet;
        }
        if (is_object($this->twelfth_marksheet)) {
            $twelfth_marksheet = $this->twelfth_marksheet->store('user/twelfth-marksheet');
            $user_data['twelfth_marksheet'] = $twelfth_marksheet;
        }
        if (is_object($this->aadhar_card)) {
            $aadhar_card = $this->aadhar_card->store('user/aadhar-card');
            $user_data['aadhar_card'] = $aadhar_card;
        }
        if (is_object($this->alternative_govt_id_card)) {
            $alternative_govt_id_card =  $this->alternative_govt_id_card->store('user/alternative-govt-id-card');
            $user_data['alternative_govt_id_card'] = $alternative_govt_id_card;
        }


        if (is_object($this->graduation_diploma)) {
            $graduation_diploma =  $this->graduation_diploma->store('user/graduation-diploma');
            $user_data['graduation_diploma'] = $graduation_diploma;
        }
        if (is_object($this->post_graduation)) {
            $post_graduation =  $this->post_graduation->store('user/post-graduation');
            $user_data['post_graduation'] = $post_graduation;
        }
        if (is_object($this->experience_certificate)) {
            $experience_certificate = $this->experience_certificate->store('user/experience-certificate');
            $user_data['experience_certificate'] = $experience_certificate;
        }
        if (is_object($this->salary_slip)) {
            $salary_slip = $this->salary_slip->store('user/salary-slip');
            $user_data['salary_slip'] = $salary_slip;
        }



        if ($this->uuid == null) {
            User_data::Create($user_data);
        } else {
            User_data::updateOrCreate(['user_id' => $users['id']], $user_data);
        }

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
        $user =  User::join('user_data', 'user_data.user_id', '=', 'users.id')
            ->where('users.uuid', $uuid)->first();

        if ($user) {
            $this->uuid = $uuid;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role;
            $this->father_name = $user->father_name;
            $this->mother_name = $user->mother_name;
            $this->date_of_birth = $user->date_of_birth;
            $this->phone_number = $user->phone_number;
            $this->alternate_phone_number = $user->alternate_phone_number;
            $this->permanent_address = $user->permanent_address;
            $this->current_address  = $user->current_address;

            $this->tenth_marksheet = $user->tenth_marksheet;
            $this->twelfth_marksheet = $user->twelfth_marksheet;
            $this->aadhar_card = $user->aadhar_card;
            $this->alternative_govt_id_card = $user->alternative_govt_id_card;
            $this->graduation_diploma = $user->graduation_diploma;
            $this->post_graduation = $user->post_graduation;
            $this->experience_certificate = $user->experience_certificate;
            $this->salary_slip = $user->salary_slip;

            $tenth_details = json_decode($user->tenth_details);
            $this->tenth_board_name = $tenth_details->tenth_board_name;
            $this->tenth_qua_year = $tenth_details->tenth_qua_year;
            $this->tenth_percentage = $tenth_details->tenth_percentage;
            $this->tenth_roll_no = $tenth_details->tenth_roll_no;

            $twelfth_details = json_decode($user->twelfth_details);
            $this->twelfth_board_name = $twelfth_details->twelfth_board_name;
            $this->twelfth_qua_year = $twelfth_details->twelfth_qua_year;
            $this->twelfth_percentage = $twelfth_details->twelfth_percentage;
            $this->twelfth_roll_no = $twelfth_details->twelfth_roll_no;

            $university_details = json_decode($user->university_details);
            $this->university_name = $university_details->university_name;
            $this->university_qua_year = $university_details->university_qua_year;
            $this->university_percentage = $university_details->university_percentage;
            $this->university_roll_no = $university_details->university_roll_no;

            $industry_experience = json_decode($user->industry_experience);
            $ifFirst = true;
            foreach ($industry_experience as $industry) {
                array_push($this->industry_name, $industry->industry_name);
                array_push($this->industry_designation, $industry->industry_designation);
                array_push($this->industry_salary, $industry->industry_salary);
                array_push($this->industry_total_year, $industry->industry_total_year);
                if (!$ifFirst) {
                    $this->i++;
                    array_push($this->industry_details,  $this->i);
                }
                $ifFirst = false;
            }

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
    public function delete($uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        $user_id = $user['id'];
        $user_data = User_data::where('user_id', $user_id)->first();
        if ($user) {
            $user_data->delete();
            $user->delete();
            session()->flash('delete', 'User Deleted Successfully.');
        }
    }
    public function assign($uuid)
    {

        $user =  User::where('uuid', $uuid)->first();
        $this->user_name = $user['name'];
        $users = array();
        if ($user['role'] == 'Admin') {
            $users =  User::select('name', 'uuid')->where('role', 'Manager')->get();
        } else if ($user['role'] == 'Manager') {
            $users =  User::select('name', 'uuid')->where('role', 'Team Leader')->get();
        } else if ($user['role'] == 'Team Leader') {
            $users =  User::select('name', 'uuid')->where('role', 'Employee')->get();
        }
        $this->assign = $users;
        $this->assign_user = json_decode($user['assign_user']);
        $this->uuid = $uuid;
        $this->openAssign();
    }

    public function AssignStore()
    {

        $data = [
            'assign_user' =>  json_encode($this->assign_user)
        ];

        User::updateOrCreate(['uuid' => $this->uuid], $data);

        session()->flash(
            'message',
            $this->uuid ? 'Assign Updated Successfully.' : 'Assign Created Successfully.'
        );
        $this->closeAssign();
        $this->resetInputFields();
    }
    public function openAssign()
    {
        $this->closeModal();
        $this->isAssign = true;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeAssign()
    {
        $this->closeModal();
        $this->isAssign = false;
    }

    public function export()
    {
        $rows = [];
        User::query()
            ->where('role', 'like', '%' . $this->search . '%')
            ->where('name', 'like', '%' . $this->search_name . '%')
            ->lazyById(2000, 'id')
            ->each(function ($user) use (&$rows) {
                $rows[] = $user->toArray();
            });
        SimpleExcelWriter::streamDownload('users.csv')
            ->addRows($rows);
    }

    public function download($path)
    {
        $filePath = Storage::path('/' . $path);
        return response()->download($filePath);
    }
}
