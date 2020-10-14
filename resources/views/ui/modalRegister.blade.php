<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="row d-flex justify-content-center">

            <div class="col-xs-12 col-md-8">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title" id="registerModal">{{ __('Register') }}</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">×</span>

                        </button>

                    </div>

                    <div class="modal-body">

                        <form method="POST" id="registerForm">
                            @csrf

                            <div class="form-group">
                                <label for="nameInput" class="">{{ __('Name') }}</label>

                                <div class="">
                                    <input id="nameInput" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    <span class="invalid-feedback" role="alert" id="nameError">
                                        <strong></strong>
                                    </span>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="emailInput" class="">{{ __('E-Mail Address') }}</label>

                                <div class="">
                                    <input id="emailInput" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">


                                    <span class="invalid-feedback" role="alert" id="emailError">
                                        <strong></strong>
                                    </span>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="passwordInput" class="">{{ __('Password') }}</label>

                                <div class="">
                                    <input id="passwordInput" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">


                                    <span class="invalid-feedback" role="alert" id="passwordError">
                                        <strong></strong>
                                    </span>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>

                                <div class="">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <p class="subtitulo-modal text-center">Al registrarme acepto los terminos y condiciones establecidos por YoNecesito</p>

                            <div class="form-group mb-0">

                                <button type="submit" class="btn btn-primary boton-principal">
                                    Aceptar Y Registrarme
                                </button>

                            </div>

                            <hr>

                            <p class="subtitulo-modal text-center">O registrase con:</p>

                            <div class="form-group">

                                <button class="btn boton-modal-facebook"><i class="fab fa-facebook"></i> Facebook</button>

                                <button class="btn boton-modal-google"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M22 12.23c0-.707-.063-1.393-.183-2.045h-9.613v3.871h5.491c-.235 1.253-.957 2.31-2.035 3.017v2.511h3.296C20.888 17.837 22 15.275 22 12.23z" fill="#3E82F1"></path><path d="M12.204 22c2.757 0 5.067-.893 6.752-2.421l-3.296-2.512c-.911.602-2.08.956-3.456.956-2.66 0-4.907-1.759-5.71-4.124h-3.41v2.595C4.763 19.76 8.213 22 12.203 22z" fill="#32A753"></path><path d="M6.494 13.899A5.848 5.848 0 0 1 6.174 12c0-.657.114-1.298.32-1.899v-2.59h-3.41A9.863 9.863 0 0 0 2 12c0 1.612.396 3.14 1.083 4.489l3.411-2.59z" fill="#F9BB00"></path><path d="M12.204 5.978c1.496 0 2.843.505 3.898 1.494l2.929-2.87C17.265 2.988 14.955 2 12.204 2c-3.99 0-7.44 2.242-9.12 5.511l3.41 2.59c.803-2.365 3.05-4.123 5.71-4.123z" fill="#E74133"></path></svg> Google</button>

                                <button class="btn boton-modal-apple"><i class="fab fa-apple"></i> Apple</button>

                            </div>

                            <div class="modal-footer">

                                <p>¿Ya tienes una cuenta?</p>

                                <a href="#" data-toggle="modal" data-target="#loginModal" class="close" data-dismiss="modal">Iniciar sesión</a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@section('scripts')
@parent

<script>

    document.addEventListener('DOMContentLoaded', () => {

        $('#registerForm').submit(function (e) {


            e.preventDefault();

            let formData = $(this).serializeArray();

            $(".invalid-feedback").children("strong").text("");

            $("#registerForm input").removeClass("is-invalid");

            $.ajax({
                method: "POST",
                headers: {
                    Accept: "application/json"
                },
                url: "{{ route('register') }}",
                data: formData,
                success: () => window.location.assign("{{ route('inicio') }}"),
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
