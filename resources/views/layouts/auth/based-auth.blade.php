<!DOCTYPE html>
<html lang="pt-br">
{{-- inlcude head --}}
@include('layouts.include.panel.head')

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-flex align-items-center justify-content-center ">
                                <img src="{{ url('panel/img/logo/icon-page.svg') }}" alt="" width="200px">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">@yield('title-form-auth')</h1>
                                    </div>
                                        <div class="alert alert-danger alert-error-login alert-solid d-none" role="alert">This is a solid, danger alert!</div>
                                        @yield('forms-auth')
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="">Esqueci minha senha !?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{route('register')}}">Solicitar Demonstração Gratuita</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- inlcude footer --}}
   @include('layouts.include.panel.footer')
</body>

</html>