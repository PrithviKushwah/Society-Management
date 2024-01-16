<div class="container-fluid py-4">
  <div class="row">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="container add-user-form">
          <h3 class="text-start">Primary Details</h3>

          <div class="row">

            <div class="col-sm-3">
              <div class="form-group">
                <label>Application Number Availability</label>
                <select class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="application_availability">
                  <option value="">--- Select An Option---</option>
                  <option value="Pending">Pending</option>
                  <option value="Available">Available</option>
                </select>
                @error('application_availability') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3">
              <div class="form-group">
                <label>Application Number</label>
                <input wire:model="application_number" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter Application Number">
                @error('application_number') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3">
              <div class="form-group">
                <label>Year </label>
                <select wire:model="year" class=" w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                  <option value=""> --- Select An Year--- </option>
                  <option value="Pending">Pending</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                </select>
                @error('year') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>


            <div class="col-sm-3">
              <div class="form-group">
                <label>Please Enter Aadhar Number </label>
                <input wire:model="number" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter Aadhar Number">
                @error('number') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>


            <h3 class="card-title mt-3">Bank Details</h3>


            <div class="col-sm-3 ">
              <div class="form-group">
                <label>Account Number :</label>
                <input wire:model="account_number" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter Account Number">
                @error('account_number') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 ">
              <div class="form-group">
                <label>IFSC Code :</label>
                <input wire:model="IFSC_code" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter IFSC Code">
                @error('IFSC_code') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 ">
              <div class="form-group">
                <label>Bank Name :</label>
                <input wire:model="bank_name" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter Bank Name">
                @error('bank_name') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 ">
              <div class="form-group">
                <label>Branch Name :</label>
                <input wire:model="branch_name" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter Branch Name">
                @error('branch_name') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>





            <h3 class="card-title mt-3">Personal Details</h3>


            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Student Name</label>
                <input wire:model="student_name" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Please Student Name">
                @error('student_name') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Father Name</label>
                <input wire:model="father_name" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Please Father Name">
                @error('father_name') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group ">
                <label>Mother Name</label>
                <input wire:model="mother_name" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Please Mother Name">
                @error('mother_name') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="col-sm-3 mt-3">
              <div class="form-group ">
                <label>Email Address</label>
                <input wire:model="email_address" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" placeholder="Enter Email Address">
                @error('email_address') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="col-sm-3 mt-3">
              <div class="form-group ">
                <label>Date Of Birth</label>
                <input wire:model="dob" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="date">
                @error('dob') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group ">
                <label>Gender </label>
                <select wire:model="gender" class=" w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                  <option value="">--- Select An Option---</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
                @error('gender') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Phone Number </label>
                <input wire:model="phone_number" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" placeholder="Please Enter Phone Number">
                @error('phone_number') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Family Income </label>
                <input wire:model="family_income" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" placeholder="Please Enter Family Income">
                @error('family_income') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Select State </label>
                <select wire:model="state" class=" w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                  <option value="">--- Select An State---</option>
                  <option value="Asam">Asam</option>
                  <option value="Arunachal Pardesh">Arunachal Pardesh</option>
                </select>
                @error('state') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>


            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Select District </label>
                <input wire:model="district" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Please Enter Distic">
                @error('district') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Sub Divison</label>
                <input wire:model="sub_division" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Please Enter Sub Divison">
                @error('sub_division') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>


            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Cast </label>
                <select wire:model="cast" class=" w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                  <option value="">--- Select An Cast---</option>
                  <option value="SC">SC</option>
                  <option value="ST">ST</option>
                  <option value="OBC">OBC</option>
                  <option value="Genral">Genral</option>
                </select>
                @error('cast') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Village / City</label>
                <input wire:model="city" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Please Enter Village / City">
                @error('city') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>PinCode</label>
                <input wire:model="pincode" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="Number" placeholder="Please Enter PinCode">
                @error('pincode') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Address Line 1 </label>
                <input wire:model="address_1" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Please Enter Address Line 1">
                @error('address_1') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Address Line 2 </label>
                <input wire:model="address_2" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Please Enter Address Line 2">
                @error('address_2') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
          </div>


          <div class="row">
            <h3 class="card-title mt-3">Educational Details</h3>
            <h6 class="mt-3">School Details</h6>
            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>10th Passing Year</label>
                <input wire:model="ten_path_year" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter 10th Passing Year">
                @error('ten_path_year') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>


            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>10th Total Marks</label>
                <input wire:model="ten_total_mark" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter 10th Total Marks">
                @error('ten_total_mark') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>10th Marks</label>
                <input wire:model="ten_mark" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter 10th Marks">
                @error('ten_mark') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>10th Percentage</label>
                <input wire:model="ten_percentage" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter 10th Persentage">
                @error('ten_percentage') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>


            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>12th Passing Year</label>
                <input wire:model="twelve_path_year" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter 12th Passing Year">
                @error('twelve_path_year') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>12th Total Marks</label>
                <input wire:model="twelve_total_mark" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter 12th Total Marks">
                @error('twelve_total_mark') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>


            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>12th Marks</label>
                <input wire:model="twelve_mark" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter 12th Marks">
                @error('twelve_mark') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>



            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>12th Percentage</label>
                <input wire:model="twelve_percentage" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter 12th Persentage">
                @error('twelve_percentage') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>


          </div>

          <div class="row mt-3">
            <h6 class="mt-3">College Details</h6>
            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>College Name </label>
                <select wire:model="college_name" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                  <option>---Please Select College Name---</option>
                  <option>Sine Internation College UP</option>
                  <option>Jecrc College Jaipur</option>
                  <option>MNIT Jaipur</option>
                  <option>JECC College Jaipur</option>
                </select>
                @error('college_name') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Course Details</label>
                <select wire:model="course_details" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                  <option>---Please Select Course Name---</option>
                  <option>B.Tech</option>
                  <option>M.Tech</option>
                  <option>MBA</option>
                  <option>BBA</option>
                </select>
                @error('course_details') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Please Select Current Year</label>
                <select wire:model="collage_current_year" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                  <option>---Please Select Year---</option>
                  <option>1st Year</option>
                  <option>2nd Year</option>
                  <option>3rd Year</option>
                  <option>4th Year</option>
                </select>
                @error('collage_current_year') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-3 mt-3">
              <div class="form-group">
                <label>Percentage</label>
                <input wire:model="collage_percentage" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter Percentage">
                @error('collage_percentage') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

          </div>


          <div class="row">
            <h3 class="card-title mt-3">Agent Details</h3>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Agent Name</label>
                <input wire:model="agent_name" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter Agent Name">
                @error('agent_name') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Agent Mobile Name</label>
                <input wire:model="agent_mobile" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please Enter Agent Mobile Name">
                @error('agent_mobile') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>

          </div>
          <div class="row mt-3">
            <h3 class="text-start">Document Upload</h3>
            <div class="mb-4 col-sm-12 col-md-3 text-center">
              <h6>Self Image</h6>
              @if(!is_object($self_image)&& $self_image!='')
              <button wire:click.prevent="download('{{ $self_image }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
              @endif
            </div>
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>Aadhar Card Front</h6>
              @if(!is_object($aadhar_card_front)&& $aadhar_card_front!='')
              <button wire:click.prevent="download('{{ $aadhar_card_front }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
              @endif
            </div>
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>Aadhar Card Back</h6>
              @if(!is_object($aadhar_card_back)&& $aadhar_card_back!='')
              <button wire:click.prevent="download('{{ $aadhar_card_back }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
              @endif
            </div>
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>PRTC</h6>
              @if(!is_object($prtc)&& $prtc!='')
              <button wire:click.prevent="download('{{ $prtc }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
              @endif
            </div>
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>Caste Certificate</h6>
              @if(!is_object($caste_certificate)&& $caste_certificate!='')
              <button wire:click.prevent="download('{{ $caste_certificate }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
              @endif
            </div>
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>Bonafide Certificate Nsp</h6>
              @if(!is_object($bonafide_nsp)&& $bonafide_nsp!='')
              <button wire:click.prevent="download('{{ $bonafide_nsp }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
              @endif
            </div>
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>Bonafide Certificate College</h6>
              @if(!is_object($bonafide_college)&& $bonafide_college!='')
              <button wire:click.prevent="download('{{ $bonafide_college }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
              @endif
            </div>
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>Previous Year Marksheet</h6>
              @if(!is_object($pre_year_mark)&& $pre_year_mark!='')
              <button wire:click.prevent="download('{{ $pre_year_mark }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
              @endif
            </div>
            <div class="mb-4 col-sm-12 col-md-3">
              <h6>Income Certificate</h6>
              @if(!is_object($income_certificate)&& $income_certificate!='')
              <button wire:click.prevent="download('{{ $income_certificate }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
              @endif
            </div>
            <div class="mb-4 col-sm-12 col-md-3">
              <h6> Signature</h6>
              @if(!is_object($signature)&& $signature!='')
              <button wire:click.prevent="download('{{ $signature }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
              @endif
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
              <button wire:click="closeModal()" type="button" class=" rounded-pill inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5 cancel-btn">
                Close
              </button>
            </span>
          </div>

        </div>
      </div>
  </div>
</div>