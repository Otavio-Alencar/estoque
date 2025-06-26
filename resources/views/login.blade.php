@extends('log.logLayout')
@section('title','Entrar')

@section('content')
        <div class="card-body">
            <p class="login-box-msg">Entre para iniciar sua sessão.</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
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
                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                </div>
                <div class="social-auth-links text-center col-12">
                    <a href="{{ url('/auth/google') }}" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Entrar via Google+
                    </a>
                </div>


            </form>





            <p class="mb-0">
                <a href="{{ route('logup')  }}" class="text-center">Cadastrar-se</a>
            </p>
        </div>

@endsection

