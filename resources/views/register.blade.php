@extends('log.logLayout')
@section('title','Cadastro')
@section('content')
        <div class="card-body">
            <p class="login-box-msg">Cadastrar novo usuário</p>

            <form action="{{ route('logup')  }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Full name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control"  name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="retype_password" placeholder="Retype password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="image"  accept="image/png, image/jpeg" >
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-image"></span>
                        </div>
                    </div>

                </div>
                @if ($errors->any())
                    <div class="alert alert-danger text-left">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif



                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>

                    </div>
                <div class="social-auth-links text-center col-12">

                    <a href="{{ url('/auth/google') }}" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign up using Google+
                    </a>
                </div>
            </form>



            <a href="{{ route('login') }}" class="text-center">Eu já tenho uma conta</a>
        </div>
        <!-- /.form-box -->

<!-- /.register-box -->
@endsection
