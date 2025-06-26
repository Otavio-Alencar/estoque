<div class="content-wrapper">
    <!-- Content Header -->
    @include('extraComponents.headerWrapper', [
    'titlePage' => 'Perfil',
    'page' => 'Perfil'
        ])

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- Profile Image -->
                    <form method="POST" action="{{ route('editProfile') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <!-- Imagem -->
                                <div class="d-flex justify-content-center align-items-center position-relative" style="width: 100%; margin-bottom: 10px;">
                                    <img class="profile-user-img img-fluid img-circle"
                                         id="profileImagePreview"
                                         src="{{ $image }}"
                                         alt="User profile picture"
                                         style="width: 128px; height: 128px; object-fit: cover;">

                                    <div onclick="document.getElementById('photoInput').click();"
                                         style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0; transition: opacity 0.3s; cursor: pointer; background-color: rgba(0, 0, 0, 0.6); padding: 10px; border-radius: 50%;"
                                         onmouseover="this.style.opacity=1"
                                         onmouseout="this.style.opacity=0">
                                        <i class="fas fa-camera text-white"></i>
                                    </div>

                                    <input type="file" id="photoInput" name="photo" style="display: none;" onchange="previewImage(event)">
                                </div>

                                <!-- Nome editável com ícone -->
                                <div class="d-flex justify-content-center align-items-center" style="gap: 8px; margin-bottom: 10px;">
                                    <input type="text" name="name" value="{{ $name }}"
                                           class="form-control text-center" style="max-width: 300px;">
                                    <i class="fas fa-pencil-alt text-secondary"></i>
                                </div>

                                <p class="text-muted text-center">Administrador</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Vendas</b> <a class="float-right">{{ $quantitySold }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Produtos</b> <a class="float-right">{{ $itensQuantity }}</a>
                                    </li>
                                </ul>

                                <button type="submit" class="btn btn-primary btn-block"><b>Salvar</b></button>
                            </div>
                        </div>
                    </form>

                </div>


            </div>
        </div>
    </section>
</div>


