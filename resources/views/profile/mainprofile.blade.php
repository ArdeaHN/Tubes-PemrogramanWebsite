@extends('layouts.app')

@push('customCss')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endpush

@section('content')
    <div class="container-xl px-4 mt-4">

        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="{{ route('mainprofile') }}">Profil</a>
            <a class="nav-link" href="{{ route('alamatprofile') }}">Alamat</a>
            <a class="nav-link" href="#">Pembayaran</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Gambar Profil</div>
                    <div class="card-body text-center">
                        <div class="profile-image-container">
                            @if (Auth::user()->avatar == null)
                                <img class="img-account-profile rounded-circle mb-2" id="previewImage"
                                    src="{{ asset('assets/images/avatar/avatar-dummy.png') }}" alt>
                            @else
                                <img class="img-account-profile rounded-circle mb-2" id="previewImage"
                                    src="{{ asset('profile-pictures/' . Auth::user()->avatar) }}" alt>
                            @endif
                        </div>
                        <div class="small font-italic text-muted mb-4">JPG atau PNG tidak boleh melebihi 5 MB</div>
                        <button class="btn btn-primary" id="profileImage" type="button">Unggah Gambar</button>
                    </div>
                </div>

            </div>
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">Detail Akun</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profileSave') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="small mb-1">Email</label>
                                <input type="file" class="form-control" id="uploadImage" name="image" accept="image/*"
                                    hidden>
                                <input class="form-control" id="email" type="text" placeholder="Enter your username"
                                    value="{{ Auth::user()->email }}" disabled>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">Nama Awal</label>
                                    <input class="form-control" name="namaAwal" id="namaAwal" type="text"
                                        placeholder="Enter your first name" value="{{ Auth::user()->first_name }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Nama Akhir</label>
                                    <input class="form-control" name="namaAkhir" id="namaAkhir" type="text"
                                        placeholder="Enter your last name" value="{{ Auth::user()->last_name }}">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Nomor Telepon</label>
                                    <input class="form-control" name="no_telp" id="noTelp" type="text"
                                        placeholder="Enter your phone number" value="{{ Auth::user()->phone_number }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('profileImage').addEventListener('click', function() {
            document.getElementById('uploadImage').click();
        });

        document.getElementById('uploadImage').addEventListener('change', function() {
            var input = this;
            var image = document.getElementById('previewImage');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    image.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endsection


</html>
