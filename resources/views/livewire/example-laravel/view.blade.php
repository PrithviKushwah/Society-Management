<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
   <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 transition-opacity">
         <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>
      <!-- This element is to trick the browser into centering the modal contents. -->
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
      <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
         <form class="form-custom" enctype="multipart/form-data">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
               <div class="container add-user-form">
                  <h3 class="text-start">Personal Details</h3>
                  <div class="row">
                     <div class="mb-4 col-sm-12 col-md-4">
                        <label for="your-name" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Name:</label><br />
                        <input type="text" class="w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Name" wire:model="name">
                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-4">
                        <label for="father-name" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Father Name:</label><br />
                        <input type="text" class="w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Father Name" wire:model="father_name">
                        @error('father_name') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-4">
                        <label for="mother-name" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Mother Name:</label><br />
                        <input type="text" class="w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Mother Name" wire:model="mother_name">
                        @error('mother_name') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-4">
                        <label for="email" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Email Address:</label><br />
                        <input type="text" {{ $this->uuid != null ? 'readonly' : '' }} class="w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Email Address" wire:model="email">
                        @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-4">

                        <label for="password" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Password:</label><br />
                        <input type="password" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Password" wire:model="password">
                        @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-4">
                        <label for="confirm_password" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Confirm Password:</label><br />
                        <input type="password" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Confirm Password" wire:model="confirm_password">
                        @error('confirm_password') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>

                  </div>
                  <div class="row">
                     <div class="mb-4 col-sm-12 col-md-4">
                        <label for="dob" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Date Of Birth:</label><br />
                        <input class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="date" onfocus="focused(this)" onfocusout="defocused(this)" wire:model="date_of_birth">
                        @error('date_of_birth') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-4">
                        <label for="phone" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Phone Number:</label><br />
                        <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Phone Number" wire:model="phone_number" min="10" maxlength="10" pattern="\d*">
                        @error('phone_number') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-4">
                        <label for="alternate-phone" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Alternate Phone Number:</label><br />
                        <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Alternate Phone Number" wire:model="alternate_phone_number" min="10" maxlength="10" pattern="\d*">
                        @error('alternate_phone_number') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12  col-md-4">
                        <label for="role" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Role:</label><br />
                        <select wire:model="role" class="w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                           <option value="">-- Select --</option>
                           <option value="Admin">Admin</option>
                           <option value="Manager">Manager</option>
                           <option value="Team Leader">Team Leader</option>
                           <option value="Employee">Employee</option>
                           <option value="Other">Other</option>
                        </select>
                        @error('role') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                  </div>
                  <div class="row">
                     <h3 class="text-start">Qualification Details</h3>
                     <h6 class="text-start">10th</h6>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="board10-name" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Board Name:</label><br />
                        <input type="text" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Board Name" wire:model="tenth_board_name">
                        @error('tenth_board_name') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="q-year" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Year:</label><br />
                        <input type="text" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Qualification Year" wire:model="tenth_qua_year">
                        @error('tenth_qua_year') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="q-percentage" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Percentage:</label><br />
                        <input type="text" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Percentage" wire:model="tenth_percentage">
                        @error('tenth_percentage') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="r-number" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Roll No:</label><br />
                        <input type="text" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Roll Number" wire:model="tenth_roll_no">
                        @error('tenth_roll_no') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                  </div>
                  <div class="row">
                     <h6 class="text-start">12th</h6>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="board-name" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Board Name:</label><br />
                        <input type="text" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Board Name" wire:model="twelfth_board_name">
                        @error('twelfth_board_name') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="q-year" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Year:</label><br />
                        <input type="text" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Qualification Year" wire:model="twelfth_qua_year">
                        @error('twelfth_qua_year') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="q-percentage" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Percentage:</label><br />
                        <input type="text" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Percentage" wire:model="twelfth_percentage">
                        @error('twelfth_percentage') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="r-number" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Roll No:</label><br />
                        <input type="text" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Roll Number" wire:model="twelfth_roll_no">
                        @error('twelfth_roll_no') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                  </div>
                  <div class="row">
                     <h6 class="text-start">University Qualification </h6>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="uni-name" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">University Name:</label><br />
                        <input type="text" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="University" wire:model="university_name">
                        @error('university_name') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="q-year" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Year:</label><br />
                        <input type="text" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Qualification Year" wire:model="university_qua_year">
                        @error('university_qua_year') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="q-percentage" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Percentage:</label><br />
                        <input type="text" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Percentage" wire:model="university_percentage">
                        @error('university_percentage') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="r-number" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Roll No:</label><br />
                        <input type="text" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Roll Number" wire:model="university_roll_no">
                        @error('university_roll_no') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                  </div>
                  <div class="row">
                     <div class="mb-4 col-sm-12 col-md-12">
                        <label for="permanent-address" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Permanent Address:</label><br />
                        <textarea type="text" class="permanent_address w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-100" placeholder="Permanent Address" wire:model="permanent_address">
                         </textarea>
                        @error('permanent_address') <span class="text-danger">{{ $message }}</span>@enderror
                        <div class="form-group mt-2 mb-2">
                           <input type="checkbox" wire:click="copyFields"> Same as permanent address
                        </div>
                        <div class="col-sm-12 col-md-12">
                           <label for="current-address" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Current Address:</label><br />
                           <textarea type="text" class="current_address w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-100" placeholder="Current Address" wire:model="current_address">
                            </textarea>
                           @error('current_address') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <h3 class="text-start">Industry Experience</h3>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="industry-name" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Industry Name:</label><br />
                        <input type="text" wire:model="industry_name.0" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Industry Name">
                        @error('industry_name.0') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="indus-designation" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Designation:</label><br />
                        <input type="text" wire:model="industry_designation.0" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Designation">
                        @error('industry_designation.0') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="indus-salary" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Salary:</label><br />
                        <input type="text" wire:model="industry_salary.0" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Salary">
                        @error('industry_salary.0') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3 total-exp-field ">
                        <label for="indus-experience" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Total Year of Experience:</label><br />
                        <div class="d-flex">
                           <input type="button" value="-" class="qty-minus rounded border-0 bg-dark text-white w-25 mx-n1">
                           <input type="number" wire:model="industry_total_year.0" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Total Experience" value="1" class="qty" min="1">
                           <input type="button" value="+" class="qty-plus rounded border-0 bg-dark text-white w-25 mx-n1">
                        </div>
                        @error('industry_total_year.0') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                  </div>
                  @foreach($industry_details as $key => $field)
                  @if($key!=0)
                  <div class="row">
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="industry-name" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Industry Name:</label><br />
                        <input type="text" wire:model="industry_name.{{ $field }}" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Industry Name">
                        @error('industry_name.'.$field) <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="indus-designation" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Designation:</label><br />
                        <input type="text" wire:model="industry_designation.{{ $field }}" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Designation">
                        @error('industry_designation.'.$field) <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <label for="indus-salary" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Salary:</label><br />
                        <input type="text" wire:model="industry_salary.{{ $field }}" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Salary">
                        @error('industry_salary.'.$field) <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3 total-exp-field ">
                        <label for="indus-experience" class="w-100 block text-gray-700 text-sm font-bold mb-2 text-start">Total Year of Experience:</label><br />
                        <div class="d-flex">
                           <input type="button" value="-" class="qty-minus rounded border-0 bg-dark text-white w-25 mx-n1">
                           <input type="number" wire:model="industry_total_year.{{ $field }}" class="w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Total Experience" class="qty" min="1">
                           <input type="button" value="+" class="qty-plus rounded border-0 bg-dark text-white w-25 mx-n1">
                        </div>
                        @error('industry_total_year.'.$field) <span class="text-danger">{{ $message }}</span>@enderror
                     </div>

                  </div>
                  @endif
                  @endforeach
                  <div class="row">
                     <h3 class="text-start">Document Upload</h3>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <h6>10th Marksheet</h6>
                        @if(!is_object($tenth_marksheet)&& $tenth_marksheet!='')
                        <button wire:click.prevent="download('{{ $tenth_marksheet }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
                        @endif
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <h6>12th Marksheet</h6>
                        @if(!is_object($twelfth_marksheet)&& $twelfth_marksheet!='')
                        <button wire:click.prevent="download('{{ $twelfth_marksheet }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
                        @endif
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <h6>Aadhar Card</h6>
                        @if(!is_object($aadhar_card)&& $aadhar_card!='')
                        <button wire:click.prevent="download('{{ $aadhar_card }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
                        @endif
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <h6>Alternative Govt. ID Card</h6>
                        @if(!is_object($alternative_govt_id_card)&& $alternative_govt_id_card!='')
                        <button wire:click.prevent="download('{{ $alternative_govt_id_card }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
                        @endif
                     </div>
                  </div>
                  <div class="row gradu-title">
                     <div class="mb-4 col-sm-12 col-md-3">
                        <h6>Graduation / Diploma (Optional)</h6>
                        @if(!is_object($graduation_diploma)&& $graduation_diploma!='')
                        <button wire:click.prevent="download('{{ $graduation_diploma }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
                        @endif
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <h6>Post Graduation (Optional)</h6>
                        @if(!is_object($post_graduation)&& $post_graduation!='')
                        <button wire:click.prevent="download('{{ $post_graduation }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
                        @endif
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <h6>Experience Certificate (Optional)</h6>
                        @if(!is_object($experience_certificate)&& $experience_certificate!='')
                        <button wire:click.prevent="download('{{ $experience_certificate }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
                        @endif
                     </div>
                     <div class="mb-4 col-sm-12 col-md-3">
                        <h6>Salary Slip (Optional)</h6>
                        @if(!is_object($salary_slip)&& $salary_slip!='')
                        <button wire:click.prevent="download('{{ $salary_slip }}')" type="button" class="btn btn-success mb-0 text-white mt-3">Download</button>
                        @endif
                     </div>
                     <div>
                     </div>
                     <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                           <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5 cancel-btn">
                              Close
                           </button>
                        </span>
                     </div>
                  </div>
         </form>
      </div>
   </div>
</div>
</div>
