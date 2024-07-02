@extends('layouts.app')



@section('content')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <div class="container px-4 mt-4">
        <nav class="nav nav-borders">
            <a class="nav-link" href="{{ route('mainprofile') }}">Profil</a>
            <a class="nav-link active ms-0" href="{{ route('alamatprofile') }}">Alamat</a>
            <a class="nav-link" href="#">Pembayaran</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">

            <div class="col-xl-12 ">
                <div class="card mb-4">
                    <div class="card-header">Detail Alamat</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('alamatSave') }}">
                            @csrf

                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">Provinsi</label>
                                    <select class="form-control form-select pb-3 pt-3" name="provinsi" id="provinsi">
                                        <option value="{{ Auth::user()->address->province ?? null }}">
                                            {{ Auth::user()->address->province ?? null }}
                                        </option>
                                    </select>
                                    <input type="hidden" id="selectedProvinsiName" name="selectedProvinsiName"
                                        value="">


                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1">Kota</label>
                                    <select class="form-control form-select pb-3 pt-3" name="kota" id="kota">
                                        <option value="{{ Auth::user()->address->city ?? null }}">
                                            {{ Auth::user()->address->city ?? null }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">Kode Pos</label>
                                    <input class="form-control" name="kodePos" id="kodePos" type="text" placeholder=""
                                        value="{{ Auth::user()->address->post_code ?? null }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1">Detail Lainnya</label>
                                    <input class="form-control" name="detail" id="detail" type="text" placeholder=""
                                        value="{{ Auth::user()->address->detail ?? null }}">
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
        const provinsiDropdown = document.getElementById('provinsi');
        const kotaDropdown = document.getElementById('kota');
        var selectedProvinsiNameInput = document.getElementById('selectedProvinsiName');

        // Mengambil data provinsi dari rute yang telah Anda buat
        axios.get('/get-provinces')
            .then(function(response) {
                // Iterasi melalui data dan tambahkan setiap provinsi ke dropdown pertama
                response.data.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.id;
                    option.text = province.name;
                    provinsiDropdown.appendChild(option);
                });
                // selectedProvinsiNameInput.value = response.data[0].name;

                // console.log("ini "+selectedProvinsiNameInput);

                // Menambahkan event listener untuk perubahan pada dropdown provinsi
                provinsiDropdown.addEventListener('change', function() {
                    const selectedProvinsiId = provinsiDropdown.value;
                    selectedProvinsiNameInput.value = provinsiDropdown.options[provinsiDropdown.selectedIndex]
                        .text; // Ambil nama provinsi dari option yang terpilih


                    // Menghapus semua opsi sebelumnya dari dropdown kota
                    kotaDropdown.innerHTML = '<option value="" disabled selected>Loading...</option>';

                    // Mengambil data kota dari API berdasarkan ID provinsi yang dipilih
                    axios.get(`/get-regencies/${selectedProvinsiId}`)
                        .then(function(kotaResponse) {
                            // Menghapus opsi "Loading..."
                            kotaDropdown.removeChild(kotaDropdown.querySelector('option[disabled]'));

                            // Iterasi melalui data kota dan tambahkan setiap kota ke dropdown kedua
                            kotaResponse.data.forEach(regency => {
                                const option = document.createElement('option');
                                option.value = regency.name;
                                option.text = regency.name;
                                kotaDropdown.appendChild(option);
                            });
                        })
                        .catch(function(error) {
                            console.error('Error:', error);
                        });
                });
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
    </script>
@endsection
