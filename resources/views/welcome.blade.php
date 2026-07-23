<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="CampStore - Sewa alat hiking terpercaya" />
        <title>CampStore - Sewa Alat Hiking Terpercaya</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/grayscale/favicon.ico') }}" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="{{ asset('assets/grayscale/css/styles.css') }}" rel="stylesheet" />
        <style>
            .btn-primary { background-color: #2f8f4e !important; border-color: #2f8f4e !important; }
            .text-primary { color: #2f8f4e !important; }
            #mainNav .navbar-brand { font-weight: 800; letter-spacing: .5px; }
        </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top"><i class="fas fa-tree me-2"></i>CampStore</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link" href="#kategori">Kategori Alat</a></li>
                        <li class="nav-item"><a class="nav-link" href="#cara-sewa">Cara Sewa</a></li>
                        <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('alat.index') }}">Masuk Admin</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="text-center">
                        <h1 class="mx-auto my-0 text-uppercase">CampStore</h1>
                        <h2 class="text-white-50 mx-auto mt-2 mb-5">Sewa alat hiking lengkap, terawat, dan siap dibawa naik gunung kapan saja.</h2>
                        <a class="btn btn-primary" href="#kategori">Lihat Alat</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Tentang-->
        <section class="about-section text-center" id="tentang">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="text-white mb-4">Persiapan Hiking Tanpa Ribet</h2>
                        <p class="text-white-50">
                            CampStore membantu para pendaki menyewa peralatan hiking berkualitas tanpa perlu membeli sendiri —
                            mulai dari tenda, carrier, sleeping bag, hingga kompor portable. Semua alat dicek kondisinya
                            sebelum dan sesudah disewakan, supaya perjalananmu ke gunung tetap aman dan nyaman.
                        </p>
                    </div>
                </div>
                <img class="img-fluid" src="{{ asset('assets/grayscale/img/ipad.png') }}" alt="Ilustrasi CampStore" />
            </div>
        </section>

        <!-- Kategori Alat-->
        <section class="projects-section bg-light" id="kategori">
            <div class="container px-4 px-lg-5">
                <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                    <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="{{ asset('assets/grayscale/img/bg-masthead.jpg') }}" alt="Alam pegunungan" /></div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h4>Tenda &amp; Sleeping Bag</h4>
                            <p class="text-black-50 mb-0">Tersedia berbagai ukuran tenda dan sleeping bag dengan kondisi terawat, cocok untuk pendakian solo maupun rombongan.</p>
                        </div>
                    </div>
                </div>

                <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                    <div class="col-lg-6"><img class="img-fluid" src="{{ asset('assets/grayscale/img/demo-image-01.jpg') }}" alt="Carrier dan perlengkapan" /></div>
                    <div class="col-lg-6">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-left">
                                    <h4 class="text-white">Carrier &amp; Trekking Pole</h4>
                                    <p class="mb-0 text-white-50">Pilihan carrier dari berbagai kapasitas liter, dilengkapi trekking pole untuk menopang perjalanan panjang.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gx-0 justify-content-center">
                    <div class="col-lg-6"><img class="img-fluid" src="{{ asset('assets/grayscale/img/demo-image-02.jpg') }}" alt="Peralatan masak outdoor" /></div>
                    <div class="col-lg-6 order-lg-first">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-right">
                                    <h4 class="text-white">Kompor &amp; Nesting</h4>
                                    <p class="mb-0 text-white-50">Kompor portable dan nesting cook set untuk masak di alam terbuka, ringan dan mudah dibawa.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cara Sewa-->
        <section class="signup-section" id="cara-sewa">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-10 col-lg-8 mx-auto text-center">
                        <i class="fas fa-route fa-2x mb-2 text-white"></i>
                        <h2 class="text-white mb-4">Cara Sewa di CampStore</h2>
                        <div class="row text-white-50 text-start">
                            <div class="col-md-4 mb-3">
                                <h5 class="text-white">1. Pilih Alat</h5>
                                <p class="small mb-0">Datang atau hubungi kami untuk cek ketersediaan alat yang kamu butuhkan.</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <h5 class="text-white">2. Ajukan Peminjaman</h5>
                                <p class="small mb-0">Tentukan tanggal pinjam dan rencana kembali, lalu tunggu konfirmasi dari pengelola.</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <h5 class="text-white">3. Ambil &amp; Kembalikan</h5>
                                <p class="small mb-0">Ambil alat sesuai jadwal, gunakan dengan baik, dan kembalikan tepat waktu.</p>
                            </div>
                        </div>
                        <a href="#kontak" class="btn btn-primary mt-4">Hubungi Kami Sekarang</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kontak-->
        <section class="contact-section bg-black" id="kontak">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Alamat</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50">Basecamp CampStore, Jl. Pendakian No. 1</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Email</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50"><a href="mailto:halo@campstore.id">halo@campstore.id</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Telepon / WA</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50">+62 812-0000-0000</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social d-flex justify-content-center">
                    <a class="mx-2" href="#!"><i class="fab fa-instagram"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-whatsapp"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </section>

        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50">
            <div class="container px-4 px-lg-5">Copyright &copy; CampStore {{ date('Y') }}</div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('assets/grayscale/js/scripts.js') }}"></script>
    </body>
</html>
