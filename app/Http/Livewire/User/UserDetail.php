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

    public $application_availability, $application_number, $year, $number, $uuid, $self_image, $aadhar_card_front,
        $aadhar_card_back, $prtc, $caste_certificate, $bonafide_nsp, $bonafide_college, $pre_year_mark, $income_certificate,
        $signature, $agent_name, $agent_mobile, $ten_path_year, $ten_total_mark, $ten_mark, $ten_percentage, $twelve_path_year,
        $twelve_total_mark, $twelve_mark, $twelve_percentage, $student_name, $father_name, $mother_name, $email_address, $dob,
        $gender, $phone_number, $family_income, $state, $district, $sub_division, $cast, $city, $pincode, $address_1, $address_2,
        $account_number, $IFSC_code, $bank_name, $branch_name, $college_name, $course_details, $collage_current_year, $collage_percentage;
    public $isOpen = 0 , $isView = 0;

    public function render()
    {
        $users = User::where('year', 'like', '%' . $this->search . '%')
            ->where('student_name', 'like', '%' . $this->search_name . '%')
            ->paginate($this->perPage);
        return view(
            'livewire.student.student-detail',
            [
                'students' => $users,
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
        $this->application_availability = '';
        $this->application_number = '';
        $this->year = '';
        $this->number = '';
        $this->uuid = '';
        $this->self_image = '';
        $this->aadhar_card_front = '';
        $this->aadhar_card_back = '';
        $this->prtc = '';
        $this->caste_certificate = '';
        $this->bonafide_nsp = '';
        $this->bonafide_college = '';
        $this->pre_year_mark = '';
        $this->income_certificate = '';
        $this->signature = '';
        $this->agent_name = '';
        $this->agent_mobile = '';
        $this->ten_path_year = '';
        $this->ten_total_mark = '';
        $this->ten_mark = '';
        $this->ten_percentage = '';
        $this->twelve_path_year = '';
        $this->twelve_total_mark = '';
        $this->twelve_mark = '';
        $this->twelve_percentage = '';
        $this->student_name = '';
        $this->father_name = '';
        $this->mother_name = '';
        $this->email_address = '';
        $this->dob = '';
        $this->gender = '';
        $this->phone_number = '';
        $this->family_income = '';
        $this->state = '';
        $this->district = '';
        $this->sub_division = '';
        $this->cast = '';
        $this->city = '';
        $this->pincode = '';
        $this->address_1 = '';
        $this->address_2 = '';
        $this->account_number = '';
        $this->IFSC_code = '';
        $this->bank_name = '';
        $this->branch_name = '';
        $this->college_name = '';
        $this->course_details = '';
        $this->collage_current_year = '';
        $this->collage_percentage = '';
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
            'application_availability' => 'required',
            'application_number' => 'required',
            'year' => 'required',
            'number' => 'required',
            'account_number' => 'required',
            'IFSC_code' => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'agent_name' => 'required',
            'agent_mobile' => 'required',
            'ten_path_year' => 'required',
            'ten_total_mark' => 'required',
            'ten_mark' => 'required',
            'ten_percentage' => 'required',
            'twelve_path_year' => 'required',
            'twelve_total_mark' => 'required',
            'twelve_mark' => 'required',
            'twelve_percentage' => 'required',
            'college_name' => 'required',
            'course_details' => 'required',
            'collage_current_year' => 'required',
            'collage_percentage' => 'required',
            'student_name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'family_income' => 'required',
            'state' => 'required',
            'district' => 'required',
            'sub_division' => 'required',
            'cast' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'address_1' => 'required',
            'address_2' => 'required',
        ]);


        $data = [
            'application_availability' => $this->application_availability,
            'application_number' => $this->application_number,
            'year' => $this->year,
            'number' => $this->number,
            'agent_name' => $this->agent_name,
            'agent_mobile' => $this->agent_mobile,
            'ten_path_year' => $this->ten_path_year,
            'ten_total_mark' => $this->ten_total_mark,
            'ten_mark' => $this->ten_mark,
            'ten_percentage' => $this->ten_percentage,
            'twelve_path_year' => $this->twelve_path_year,
            'twelve_total_mark' => $this->twelve_total_mark,
            'twelve_mark' => $this->twelve_mark,
            'twelve_percentage' => $this->twelve_percentage,
            'student_name' => $this->student_name,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'phone_number' => $this->phone_number,
            'family_income' => $this->family_income,
            'state' => $this->state,
            'district' => $this->district,
            'sub_division' => $this->sub_division,
            'cast' => $this->cast,
            'city' => $this->city,
            'pincode' => $this->pincode,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'account_number' => $this->account_number,
            'IFSC_code' => $this->IFSC_code,
            'bank_name' => $this->bank_name,
            'branch_name' => $this->branch_name,
            'college_name' => $this->college_name,
            'course_details' => $this->course_details,
            'collage_current_year' => $this->collage_current_year,
            'collage_percentage' => $this->collage_percentage,
        ];

        if ($this->uuid == null) {
            $data['uuid'] = $uuid;
            $data['email_address'] = $this->email_address;
            $data['created_by'] = Auth::id() ;
            $this->validate([
                'email_address' => 'required|string|email|max:255|unique:students',
                'self_image' => 'required',
                'aadhar_card_front' => 'required',
                'aadhar_card_back' => 'required',
                'prtc' => 'required',
                'caste_certificate' => 'required',
                'bonafide_nsp' => 'required',
                'bonafide_college' => 'required',
                'pre_year_mark' => 'required',
                'income_certificate' => 'required',
                'signature' => 'required',
            ]);
        } else {
            $this->validate([
                'email_address' => 'required|string|email|max:255|',
            ]);
        }
        if (is_object($this->self_image)) {
          $self_image =   $this->self_image->store('student/self_image');
            $data['self_image'] = $self_image;
        }

        if (is_object($this->aadhar_card_front)) {
         $aadhar_card_front =   $this->aadhar_card_front->store('student/aadhar_card_front');
            $data['aadhar_card_front'] = $aadhar_card_front;
        }

        if (is_object($this->aadhar_card_back)) {
         $aadhar_card_back =   $this->aadhar_card_back->store('student/aadhar_card_back');
            $data['aadhar_card_back'] = $aadhar_card_back;
        }

        if (is_object($this->prtc)) {
          $prtc =  $this->prtc->store('student/prtc');
            $data['prtc'] = $prtc;
        }

        if (is_object($this->caste_certificate)) {
          $caste_certificate =  $this->caste_certificate->store('student/caste_certificate');
            $data['caste_certificate'] = $caste_certificate;
        }

        if (is_object($this->bonafide_nsp)) {
          $bonafide_nsp =  $this->bonafide_nsp->store('student/bonafide_nsp');
            $data['bonafide_nsp'] = $bonafide_nsp;
        }

        if (is_object($this->bonafide_college)) {
         $bonafide_college = $this->bonafide_college->store('student/bonafide_college');
            $data['bonafide_college'] = $bonafide_college;
        }

        if (is_object($this->pre_year_mark)) {
           $pre_year_mark = $this->pre_year_mark->store('student/pre_year_mark');
            $data['pre_year_mark'] = $pre_year_mark;
        }

        if (is_object($this->income_certificate)) {
          $income_certificate =  $this->income_certificate->store('student/income_certificate');
            $data['income_certificate'] = $income_certificate;
        }

        if (is_object($this->signature)) {
           $signature =  $this->signature->store('student/signature');
            $data['signature'] = $signature;
        }

        
        User::updateOrCreate(['uuid' => $this->uuid], $data);
        session()->flash(
            'message',
            $this->uuid ? 'Student Updated Successfully.' : 'Student Created Successfully.'
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
        $student = User::where('uuid', $uuid)->first();
        if ($student) {
            $this->uuid = $student->uuid;
            $this->application_availability = $student->application_availability;
            $this->application_number = $student->application_number;
            $this->year = $student->year;
            $this->number = $student->number;
            $this->self_image = $student->self_image;
            $this->aadhar_card_front = $student->aadhar_card_front;
            $this->aadhar_card_back = $student->aadhar_card_back;
            $this->prtc = $student->prtc;
            $this->caste_certificate = $student->caste_certificate;
            $this->bonafide_nsp = $student->bonafide_nsp;
            $this->bonafide_college = $student->bonafide_college;
            $this->pre_year_mark = $student->pre_year_mark;
            $this->income_certificate = $student->income_certificate;
            $this->signature = $student->signature;
            $this->agent_name = $student->agent_name;
            $this->agent_mobile = $student->agent_mobile;
            $this->ten_path_year = $student->ten_path_year;
            $this->ten_total_mark = $student->ten_total_mark;
            $this->ten_mark = $student->ten_mark;
            $this->ten_percentage = $student->ten_percentage;
            $this->twelve_path_year = $student->twelve_path_year;
            $this->twelve_total_mark = $student->twelve_total_mark;
            $this->twelve_mark = $student->twelve_mark;
            $this->twelve_percentage = $student->twelve_percentage;
            $this->student_name = $student->student_name;
            $this->father_name = $student->father_name;
            $this->mother_name = $student->mother_name;
            $this->email_address = $student->email_address;
            $this->dob = $student->dob;
            $this->gender = $student->gender;
            $this->phone_number = $student->phone_number;
            $this->family_income = $student->family_income;
            $this->state = $student->state;
            $this->district = $student->district;
            $this->sub_division = $student->sub_division;
            $this->cast = $student->cast;
            $this->city = $student->city;
            $this->pincode = $student->pincode;
            $this->address_1 = $student->address_1;
            $this->address_2 = $student->address_2;
            $this->account_number = $student->account_number;
            $this->IFSC_code = $student->IFSC_code;
            $this->bank_name = $student->bank_name;
            $this->branch_name = $student->branch_name;
            $this->college_name = $student->college_name;
            $this->course_details = $student->course_details;
            $this->collage_current_year = $student->collage_current_year;
            $this->collage_percentage = $student->collage_percentage;
           
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
        $student = User::where('uuid', $uuid)->first();
        if ($student) {
            $student->delete();
            session()->flash('delete', 'Student Deleted Successfully.');
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
