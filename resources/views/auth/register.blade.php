@inject('areas','App\Area')
@extends('layouts.app_default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4"><h4>{{ __('Register Account') }}</h4></div>
                        {{-- <div class="col-md-4">{{ __('Store') }}</div>
                        <div class="col-md-2">{{ __('Account') }}</div> --}}
                    </div>
                </div>

                <div class="card-body">
                    {{-- <form method="POST" action="{{ route('register') }}"> --}}
                    <form method="POST" id="registerForm">
                        @csrf
                        <div class="row d-flex align-items-center justify-content-center">
                            <div class="col-md-8">
                                <div>
                                    <p>
                                        <strong>Note:</strong> Once you register, please
                                        make sure you can
                                        submit your requirements
                                        within 3 days to the
                                        assigned staff in your
                                        area. Click <a href="javascript://;" id="client_area_modal">here</a> for more
                                        details.
                                        
                                    </p>
                                </div>
                                {{-- user account --}}
                                <div class="alert alert-danger" role="alert" id="error_message" style="display:none;"></div>
                                <div class="card-header bg-secondary mb-4">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-6">{{ __('Account') }}</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-3 col-form-label text-md-left">{{ __('Email Address') }}</label>

                                    <div class="col-md-9">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-3 col-form-label text-md-left">{{ __('Password') }}</label>

                                    <div class="col-md-9">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-3 col-form-label text-md-left">{{ __('Confirm') }}</label>

                                    <div class="col-md-9">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                {{-- end account --}}

                                <div class="card-header bg-secondary mb-4">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">{{ __('User Information') }}</div>
                                        {{-- <div class="col-md-4">{{ __('Store') }}</div>
                                        <div class="col-md-2">{{ __('Account') }}</div> --}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fname" class="col-md-3 col-form-label text-md-left">{{ __('First Name') }}</label>

                                    <div class="col-md-9">
                                        <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>

                                        @error('fname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mname" class="col-md-3 col-form-label text-md-left">{{ __('Middle Name') }}</label>

                                    <div class="col-md-9">
                                        <input id="mname" type="text" class="form-control @error('mname') is-invalid @enderror" name="mname" value="{{ old('mname') }}" required autocomplete="mname" autofocus>

                                        @error('mname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lname" class="col-md-3 col-form-label text-md-left">{{ __('Last Name') }}</label>

                                    <div class="col-md-9">
                                        <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>

                                        @error('lname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-md-3 col-form-label text-md-left">{{ __('Address') }}</label>

                                    <div class="col-md-9">
                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="contact_num" class="col-md-3 col-form-label text-md-left">{{ __('Contact Number') }}</label>

                                    <div class="col-md-9">
                                        <input id="contact_num" type="number" placeholder="09xxxxxxxxx" maxlength="11" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control @error('contact_num') is-invalid @enderror" name="contact_num" value="{{ old('contact_num') }}" required autocomplete="contact_num" autofocus>

                                        @error('contact_num')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- store name --}}
                                <div class="card-header bg-secondary mb-4">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">{{ __('Store') }}</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="area_id" class="col-md-3 col-form-label text-md-left">{{ __('Store Location') }}</label>

                                    <div class="col-md-9">
                                        <select class="form-control" id="area_id" name="area_id">
                                            @foreach($areas->all() as $area)
                                              <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="store_name" class="col-md-3 col-form-label text-md-left">{{ __('Store Name') }}</label>

                                    <div class="col-md-9">
                                        <input id="store_name" type="store_name" class="form-control @error('store_name') is-invalid @enderror" name="store_name" value="{{ old('store_name') }}" required autocomplete="store_name">

                                        @error('store_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="store_address" class="col-md-3 col-form-label text-md-left">{{ __('Store Address') }}</label>

                                    <div class="col-md-9">
                                        <input id="store_address" type="store_address" class="form-control @error('store_address') is-invalid @enderror" name="store_address" value="{{ old('store_address') }}" required autocomplete="store_address">

                                        @error('store_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- end store --}}
                                <div class="form-group">
                                    <div class="float-right">
                                        <button type="submit" id="btnRegister" class="btn btn-success full-width-button">{{ __('Register') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- update pending modal--}}
<div class="modal fade" id="storeListModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Staff / Requirements</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <h3>Please submit photocopies of these documents:</h3>
                    <ul class="list-group">
                        <li class="list-group-item">Barangay Business Permit</li>
                        <li class="list-group-item">BIR Certification (Form 2303)</li>
                        <li class="list-group-item">2 valid IDs</li>
                        <li class="list-group-item">Birth Certificate</li>
                    </ul>
                    <br/>
                    <h3>Sales Agent list with their contact numbers:</h3>
                    @if (count($areas->getStaff()) > 0)
                    <ul class="list-group">
                        @foreach ($areas->getStaff() as $data)
                        <li class="list-group-item">
                            {{$data->area_name}} <br>
                            {{$data->fullname}}<br>
                            {{$data->contact}}
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p>No records found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(function () {
        $(document).on('click', '#client_area_modal', function(){
            $("#storeListModal").modal('show')
        })
        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 

        $(document).on('submit', '#registerForm', function(e){
            e.preventDefault(); 
            $("#error_message").html("").hide()
            if(!(/^(09|\+639)\d{9}$/.test($("#contact_num").val()))){
                $("#error_message").html('Invalid Phone Number.').show()
                return;
            } else if($('#password').val() != $('#password-confirm').val()){
                $("#error_message").html('The password and confirmation password do not match.').show()
                return;
            } else if($('#password').val().length < 7){
                $("#error_message").html('Your password must be atleast 8 characters.').show()
                return;
            } else {
                $("#btnRegister").prop("disabled",true)
                $("#btnRegister").text("Processing, Please wait..")
                $.ajax({
                    type: "post",
                    url: "{{ url('register/user') }}",
                    data: $(this).serialize(),
                    cache: false,
                    success: function (data) {
                        if(data.status == 'exist'){
                            $("#btnRegister").prop("disabled",false)
                            $("#btnRegister").text("Register")
                            $("#error_message").html('Email Address Already Exist.').show()
                            return
                        } else {
                            $("#btnRegister").prop("disabled",true)
                            $("#btnRegister").text("Register")
                            window.location.replace('/pending')
                        }
                    },
                    error: function (data){
                        $("#btnRegister").prop("disabled",false)
                        $("#btnRegister").text("Register")
                        alert('Something went wrong.')
                        return
                    }
                });
            }
            
        }); 
    });
</script>
@endsection

