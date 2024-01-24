<div class="container-fluid py-4">
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
            
  <div class="row">
        <h3 class="text-start">EMAIL SETTING</h3>
    <form class="form-custom" enctype="multipart/form-data" action="{{route('EmailSettingStore')}}" method="POST">
    @csrf
    <input type="hidden" value="{{ $email->uuid }}" name="uuid"> 
      <div class="bg-white row">
      @if(isset($error_msg) && $error_msg!=null)
        <h6 class='text-danger'>{{$error_msg}}</h6> 
          @endif
      
          <div class="col-sm-3 ">
              <div class="form-group">
                <label>COMPANY NAME:</label>
                <input name="company_name" value="{{ $email->company_name }}" type="text" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Comment Here">
                @error('company_name') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="col-sm-3 ">
              <div class="form-group">
                <label>INSTA ID:</label>
                <input name="insta" value="{{ $email->insta }}" type="text" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Comment Here">
                @error('insta') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="col-sm-3 ">
              <div class="form-group">
                <label>WHATS APP:</label>
                <input name="whatsapp" value="{{ $email->whatsapp }}" type="text" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Comment Here">
                @error('whatsapp') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="mt-3">
            <div class="mb-4 col-sm-12 col-md-3">

              <h6>LOGO :</h6>
              <input class="demo1" type="file" name="logo" value="drage and drop file here or select files" />
              @error('logo') <span class="text-danger">{{ $message }}</span>@enderror   
              @if($email->logo)
              <img src="{{ asset('storage/logo/' . $email->logo) }}" alt="" height="100" >
              @endif          
            </div>
          </div>
          <div class="col-sm-6 ">
            <div class="form-group">
              <label>FOOTER:</label>
              <textarea name="footer" type="textarea"  id="editor" class="form-control w-100 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Comment Here">
                {{ $email->footer }}
              </textarea>
              @error('footer') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
          </div>
          
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
              <button  type="submit" class="btn bg-dark mb-0 text-white rounded-pill">
                Save
              </button>
            </span>
            
          </div>

        </div>
      </div>
    </form>
  </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
</script>