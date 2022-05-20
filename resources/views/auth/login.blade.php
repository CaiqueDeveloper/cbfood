@extends('layouts.auth.based-auth')
@section('title', 'Login')
@section('title-form-auth', 'Bem Vindo de Volta !')
@section('forms-auth')
    <form class="user login">
        <div class="form-group">
            <input type="email" class="form-control form-control-user"
                id="exampleInputEmail" aria-describedby="emailHelp"
                placeholder="Enter Email Address..." name="email">
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user"
                id="exampleInputPassword" placeholder="Password" name="password">
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox small">
                <input type="checkbox"  name="remember" value="1" class="custom-control-input" id="customCheck">
                <label class="custom-control-label" for="customCheck">Remember
                    Me</label>
            </div>
        </div>
        <input type="submit" value="Login" class="btn btn-primary btn-user btn-block">
        <hr>
        <a href="index.html" class="btn btn-google btn-user btn-block d-none">
            <i class="fab fa-google fa-fw"></i> Login with Google
        </a>
        <a href="index.html" class="btn btn-facebook btn-user btn-block d-none">
            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
        </a>
    </form>
@endsection
<script src="{{url('panel/js/auth.js')}}"></script>
@section('scripts')
    <script type="text/javascript">
    
        $(document).ready(function() {
            Auth.construct();
        })
    </script>
@endsection
