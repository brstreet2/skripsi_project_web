@extends('layouts.layout')

@section('content')
    <link href="home.css" rel="stylesheet" />
    <div class="container-fluid">
      <div class="row mb-5">
      <section class="headline">
        <div class="row">
          <div class="col-md-6 align-self-center">
            <div class="card mb-4" style="border: none; background-color: transparent">
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
                <a href="/register">
                  <button class="btn btn-lg rounded-pill btn-light mt-4 fw-bold buttonregist" style="color: #444EFF">
                      Registrasi Sekarang!
                  </button>
                </a>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-sm-12">
            <div class="card align-items-center" style="border: none; background-color: transparent">
              <img
              alt="image"
              src="https://images.unsplash.com/photo-1600880292089-90a7e086ee0c?ixid=M3w5MTMyMXwwfDF8c2VhcmNofDN8fGJ1c2luZXNzJTIwdGVhbXxlbnwwfHx8fDE2ODc5NzM3Nzd8MA&ixlib=rb-4.0.3&w=1400"
              class="card-img-top"
              style="width: 60%;
                    height: auto;
                    object-fit: cover;
                    border-radius: 10px;
                    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px"
            />
            </div>
          </div>
        </div>
      </section>
    </div>
        
        <div class="row mt-5 mb-5">
          <div class="col-md-4 col-sm-12 mb-2">
            <div class="card" style="border: none; background-color: transparent">
              <div class="card-body text-center">
                <h5 class="text-light">
                  Kemudahan dalam mengelola Sumber Daya Manusia
                </h5>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-12 mb-2">
            <div class="card" style="border: none; background-color: transparent">
              <div class="card-body text-center">
                <h5 class="text-light">
                  Interaksi cepat antar sistem via Website dan Mobile App
                </h5>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-12 mb-2">
            <div class="card" style="border: none; background-color: transparent">
              <div class="card-body text-center">
                <h5 class="text-light">Opsi pilihan penggunaan yang terjangkau</h5>
              </div>
            </div>
          </div>
        </div>

      <section id="tentangkami">
      <div class="row mb-5">
        <div class="col-md-6 align-self-center">
          <div class="card"
          style="border: none;
                 background-color: transparent
                 ">
            <div class="card-body p-5">
              <h5 class="mb-3 text-light" style="text-decoration: underline">Solusi Kami</h5>
              <h2 class="text-light">
                Membantu anda mengelola Pegawai / Karyawan untuk meningkatkan
                produktivitas bisnis anda
              </h2>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12">
          <div class="card" style="border: none; background-color: transparent">
            <img
            alt="image"
            src="https://images.unsplash.com/photo-1671418285905-acc08f6c4b59?ixid=M3w5MTMyMXwwfDF8c2VhcmNofDcxfHxlbXBsb3llZSUyMHBob25lfGVufDB8fHx8MTY4Nzk3Mzg3Mnww&amp;ixlib=rb-4.0.3&amp;w=400"
            class="card-img-top"
            style="width: 80%;
                   height: auto;
                   object-fit: cover;
                   border-radius: 10px"
            />
          </div>
        </div>
      </div>
    </section>

    <section id="produkkami">
      <div class="row mb-5">
      <div class="col-md-6 align-self-center">
        <div class="card p-5"
        style="border: none;
        background-color: transparent
        ">
          <div class="card-body">
            <h5 class="text-light" style="text-decoration: underline">Produk Kami</h5>
            <h2 class="text-light">
              Sistem Pengelolaan Sumber Daya Manusia berbasis Website dan Mobile
              Apps Android
            </h2>
          </div>
        </div>
      </div>

        <div class="col-md-6 col-sm-12">
          <div class="card align-items-center" style="border: none; background-color: transparent">
            <img
            alt="image"
            src="https://images.unsplash.com/photo-1629697776809-f37ceac39e77?ixid=M3w5MTMyMXwwfDF8c2VhcmNofDI0fHxzbWFydHBob25lfGVufDB8fHx8MTY4Nzk3NDE0OXww&amp;ixlib=rb-4.0.3&amp;w=1400"
            class="card-img-top"
            style="width: 50%;
                  height: auto;
                  object-fit: cover;
                  border-radius: 10px"
                  />
          </div>
        </div>
      </div>
    </section>
      <div class="container">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
          <span class="mb-3 mb-md-0 text-light">2023, TimKerjaKu</span>
        </div>
      </footer>
    </div>
    </div>
  

@endsection
