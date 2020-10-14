@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center row-principal">

        <div class="col-md-8 col-12">

            <h3 class="text-center mb-5">{{ __('Reset Password') }}</h3>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" id="resetEmailPasswordForm">
                @csrf

                <div class="form-group text-center">

                    <label for="email" class="">{{ __('E-Mail Address') }}</label>

                    <div class="col-12 col-md-8 m-auto">

                        <input id="emailInput" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        <span class="invalid-feedback" role="alert" id="emailError">
                            <strong></strong>
                        </span>

                    </div>

                </div>

                <div class="form-group text-center">

                    <button type="submit" class="btn btn-primary">
                        {{ __('Send Password Reset Link') }}
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
