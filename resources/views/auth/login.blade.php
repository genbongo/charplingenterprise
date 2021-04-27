@extends('layouts.app_default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    {{-- <form method="POST" action="{{ route('login') }}"> --}}
                        <form method="POST" id="loginForm">
                        @csrf
                        <div class="alert alert-danger" role="alert" id="error_message" style="display:none;"></div>    
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-center">{{ __('E-Mail Addressadsfasdfs') }}</label>

                            <div class="col-md-6">
                                <input id="email" autofocus type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-center">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="btnLogin">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function LoginUser() {
            var token           = $("input[name=_token]").val();
            var email           = $("input[name=email]").val();
            var password        = $("input[name=password]").val();
            var remember_me     = $('#remember').is(':checked') ? 1 : 0; 
            var data = {
                _token      :   token,
                email       :   email,
                password    :   password,
                remember_me :   remember_me
            };

            $('#btnLogin').prop("disabled", true)
            
            $.ajax({
                type: "post",
                url: "{{ url('login/user') }}",
                data: data,
                cache: false,
                success: function (data) {
                    $('#btnLogin').prop("disabled", false)
                   if(data.status == "failed"){
                       $("#error_message").show()
                       $("#error_message").html(data.message)
                   }
                   else {
                    $("#error_message").hide()
                    if(data.user.user_role == 99){ //admin
                        window.location.herf = "{{url('/home')}}"
                    } else if(data.user.user_role == 2){ //staff 
                        window.location.herf = "{{url('/home')}}"
                    } else { //client
                        window.location.herf = "{{url('/main')}}"
                    }
                       window.location.reload(true)
                   }
                },
                error: function (data){
                    $('#btnLogin').prop("disabled", false)
                    $("#error_message").show()
                    $("#error_message").html('Something went wrong.')
                }
            });
            return false;
        }

        $(document).on('submit', '#loginForm', function(e){
            e.preventDefault(); 
            LoginUser()
        });
    })
</script>
@endsection
