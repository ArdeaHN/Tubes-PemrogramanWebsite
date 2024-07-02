@extends('layouts.app')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-4">
                    <h1 class="display-4 fw-bold mb-4 text-primary">About Us</h1>
                </div>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-md-4 text-center mb-4">
                    <img src="{{ asset('assets/images/background/about.JPG') }}" alt="About Us Image" class="img-fluid"
                        style="max-width: 100%; height: auto;">
                </div>
                <div class="col-12 col-md-6">

                    <h1 class="fs-1 primary-hover">Puas <span class="text-danger">Nikmatnya </span>,<br> Pas <span
                            class="hover-primary">harganya</span></h1>
                </div>
                <div class="col-md-8 col-lg-12" style="word-wrap: break-word">
                    <ul class="list-unstyled text-dark">
                        <li>
                            <p class="larger-font"><span class="badge-dot bg-warning me-2"></span>Keripik baso goreng adalah
                                makanan ringan asli dari Indonesia.</p>
                        </li>
                        <li>
                            <p class="larger-font">
                                <span class="badge-dot bg-warning me-2"></span> Dibuat dengan baso yang
                                berkualitas tinggi dan bumbu rempah
                                pilihan.
                            </p>
                        </li>
                        <li>
                            <p class="larger-font">
                                <span class="badge-dot bg-warning me-2 "></span>
                                Memiliki cita rasa menggoda dan tekstur yang renyah.
                            </p>
                        </li>
                        <li>
                            <p class="larger-font">
                                <span class="badge-dot bg-warning me-2"></span>Kami berkomitmen untuk memberikan pengalaman
                                terbaik dalam menikmati
                                makanan khas Indonesia ini.
                            </p>
                        </li>
                        <li>
                            <p class="larger-font"><span class="badge-dot bg-warning me-2"></span>
                                Kami menghadirkan kepada Anda keripik baso goreng berkualitas tinggi
                                yang siap memanjakan lidah Anda.</p>
                        </li>
                        <li>
                            <p class="larger-font">
                                <span class="badge-dot bg-warning me-2"></span>
                                Selamat menikmati kelezatan yang hanya bisa ditemukan dalam setiap
                                gigitan keripik baso goreng kami.
                            </p>
                        </li>
                    </ul>
                    <div class="mb-11 col-12">

                        <p class="larger-font text-dark">
                            <span class="text-primary fw-semibold"><i class="fe fe-map-pin fs-3"></i></span>: Jagapura wetan
                            kecamatan Gegesik
                            kabupaten
                            Cirebon
                        </p>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31709.971136002496!2d108.41655969841263!3d-6.553667844396749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ee81a28608e51%3A0x614d47355105362d!2sJagapura%20Wetan%2C%20Gegesik%2C%20Cirebon%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1699001099667!5m2!1sen!2sid"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <h3 class=" text-primary fs-2 font-bold">
                        Mengapa harus belanja di Zemilan?
                    </h3>
                    <ul class="list-unstyled text-dark">
                        <li>
                            <p class="larger-font">
                                <span class="badge-dot bg-warning me-2"></span>
                                Kualitas tinggi dalam setiap produk kami.
                            </p>
                        </li>
                        <li>
                            <p class="larger-font">
                                <span class="badge-dot bg-warning me-2"></span>
                                Penggunaan bahan-bahan terbaik untuk kelezatan sejati.
                            </p>
                        </li>
                        <li>
                            <p class="larger-font">
                                <span class="badge-dot bg-warning me-2"></span>
                                Pengalaman belanja yang aman dan nyaman.
                            </p>
                        </li>
                        <li>
                            <p class="larger-font">
                                <span class="badge-dot bg-warning me-2"></span>
                                Pelanggan kami adalah prioritas utama.
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
