@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center row-principal">

        <div class="col-md-8 col-12">

            <h3 class="text-center mb-5">{{ __('Reset Password') }}</h3>


            <form method="POST" action="{{ route('password.update') }}" id="resetEmailPasswordForm">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group text-center">

                    <label for="email" class="text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-12 col-md-8 m-auto">

                        <input id="emailInput" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        <span class="invalid-feedback" role="alert" id="emailError">
                            <strong></strong>
                        </span>

                    </div>

                </div>

                <div class="form-group text-center">

                    <label for="password" class="text-md-right">{{ __('Password') }}</label>

                    <div class="col-12 col-md-8 m-auto">

                        <input id="passwordInput" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        <span class="invalid-feedback" role="alert" id="passwordError">
                            <strong></strong>
                        </span>

                    </div>

                </div>

                <div class="form-group text-center">

                    <label for="password-confirm" class="text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-12 col-md-8 m-auto">

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                    </div>

                </div>

                <div class="form-group text-center">

                    <button type="submit" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

@section('scripts')
@parent

<script>

    document.addEventListener('DOMContentLoaded', () => {

        $('#resetEmailPasswordForm').submit(function (e) {


            e.preventDefault();

            let formData = $(this).serializeArray();

            $(".invalid-feedback").children("strong").text("");

            $("#resetEmailPasswordForm input").removeClass("is-invalid");

            $.ajax({
                method: "POST",
                headers: {
                    Accept: "application/json"
                },
                url: "{{ route('password.email') }}",
                data: formData,
                success: () => window.location.assign("{{ route('home') }}"),
                error: (response) => {
                    if(response.status === 422) {
                        console.log(response)
                        let errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(function (key) {
                            $("#" + key + "Input").addClass("is-invalid");
                            $("#" + key + "Error").children("strong").text(errors[key][0]);
                        });
                    } else {
                        window.location.reload();
                    }
                }
            })

        });

    });

</script>

@endsection
