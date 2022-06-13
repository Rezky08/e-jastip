@extends("layouts.general.index")
@section("navbar")
@endsection
@section("sidebar")
@endsection
@section("footer")
@endsection
@section("main")
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                </div>

                                <form class="user" method="POST">
                                    @csrf
                                    <div class="d-flex flex-column" style="gap:1rem">
                                        @section("additional-fields")
                                        @show
                                        <x-form.input name="name" placeholder="Nama Lengkap" rounded/>
                                        <x-form.input type="email" name="email" placeholder="Masukan Email" rounded/>
                                        <x-form.input type="password" name="password" placeholder="Masukan Password"
                                                      rounded/>
                                        <x-form.input type="password" name="password_confirmation"
                                                      placeholder="Konfirmasi Password"
                                                      rounded/>

                                        <x-form.button isSubmit fullWidth rounded>
                                            Register
                                        </x-form.button>
                                    </div>
                                    <hr>
                                    <a href="index.html" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i> Register with Google
                                    </a>
                                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                        <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                    </a>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{route('auth.login')}}">Have an Account?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
