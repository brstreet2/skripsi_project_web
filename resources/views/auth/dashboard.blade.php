@extends('layouts.layout')

@section('content')
    <link href="home.css" rel="stylesheet" />
    <div class="home-container container-fluid">

      <section class="home-hero">

        <div class="home-main row">
          <div class="col-md-6 align-self-center">
            <div class="card" style="border: none; background-color: transparent">
              <div class="card-header" style="background-color: transparent">
                <h1 class="text-white">
                  Sistem Pengelolaan Sumber Daya Manusia
                </h1>
                <p class="card-body text-white">
                  Sistem integrasi pengelolaan sumber daya manusia melalui website
                  dan mobile untuk menunjang bisnis anda
                </p>
              </div>
              <div class="card-footer" style="background-color: transparent; border-top: 2px solid white">
                <button class="btn btn-lg rounded-pill btn-light mt-4">
                    Resgistrasi Sekarang!
                </button>
              </div>
            </div>
          </div>

          <div class="home-image"></div>
        </div>

          <div class="row mt-5 mb-5">
            <div class="col-md-4 col-sm-12 mb-2">
              <div class="card">
                <div class="card-body text-center">
                  <p class="home-text3">
                    Kemudahan dalam mengelola Sumber Daya Manusia
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-12 mb-2">
              <div class="card">
                <div class="card-body text-center">
                  <p class="home-text4">
                    Interaksi cepat antar sistem via website dan mobile app
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-12 mb-2">
              <div class="card">
                <div class="card-body text-center">
                  <p class="home-text5">Opsi pilihan penggunaan yang terjangkau</p>
                </div>
              </div>
            </div>
          </div>

      </section>

      <div class="row mb-5" id="tentangkami">

        <div class="col-md-6 align-self-center">
          <div class="card">
            <div class="card-body p-5">
              <p>Solusi Kami</p>
              <h2>
                Membantu anda mengelola Pegawai / Karyawan untuk meningkatkan
                produktivitas bisnis anda
              </h2>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12">
          <div class="card" style="border: none; background-color: #444EFF">
            <img
            alt="image"
            src="https://images.unsplash.com/photo-1671418285905-acc08f6c4b59?ixid=M3w5MTMyMXwwfDF8c2VhcmNofDcxfHxlbXBsb3llZSUyMHBob25lfGVufDB8fHx8MTY4Nzk3Mzg3Mnww&amp;ixlib=rb-4.0.3&amp;w=400"
            class="card-img-top"
            />
          </div>
        </div>

      </div>

      <div class="row mb-5">
        <div class="col-md-6 col-sm-12 d-flex justify-content-end">
          <div class="card" style="border: none; background-color: #444EFF">
            <img
            alt="image"
            src="https://images.unsplash.com/photo-1629697776809-f37ceac39e77?ixid=M3w5MTMyMXwwfDF8c2VhcmNofDI0fHxzbWFydHBob25lfGVufDB8fHx8MTY4Nzk3NDE0OXww&amp;ixlib=rb-4.0.3&amp;w=1400"
            class="card-img-top"
            style="width: 350px;
                  height: 450px;
                  object-fit: cover;
                  border-radius: 10px"
          />
          </div>
        </div>
        <div class="col-md-6 align-self-center">
          <div class="card p-5">
            <div class="card-body">
              <p  id="produkkami">Produk Kami</p>
              <h2>
                Sistem Pengelolaan Sumber Daya Manusia berbasis Website dan Mobile
                Apps Android
              </h2>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
          <span class="mb-3 mb-md-0 text-light">2023, TimKerjaKu</span>
        </div>
      </footer>
    </div>
    </div>
  

@endsection