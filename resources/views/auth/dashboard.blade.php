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
            <h1 class="text-white" data-aos="zoom-in" >
              Sistem Pengelolaan Sumber Daya Manusia
            </h1>
            <p class="card-body text-white" data-aos="zoom-in" data-aos-delay="400">
              Sistem integrasi pengelolaan sumber daya manusia melalui website
              dan mobile untuk menunjang bisnis anda
            </p>
          </div>
          <div class="card-footer" data-aos="fade-right" style="background-color: transparent; border-top: 2px solid white">
            <a href="/register">
              <button class="btn btn-lg rounded-pill btn-light mt-4 fw-bold" id="buttonregist" data-aos="zoom-in" data-aos-delay="400" style="color: #444EFF">
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
          data-aos="fade-left"
          style="width: 60%;
                height: auto;
                object-fit: cover;
                border-radius: 10px;
                box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;"
        />
        </div>
      </div>
    </div>
  </section>
</div>
<div class="row mb-5">
</div>
    
    <div class="row mb-5">
      <div class="col-md-4 col-sm-12 mb-2">
        <div class="card aos-init aos-animate" data-aos="fade-in" data-aos-delay="100" style="border: none; background-color: transparent">
          <div class="card-body text-center">
            <img src="{{ asset('assets/ASSET3.png') }}" alt="" style="width: 30%; height: auto; margin-bottom: 1rem">
            <h5 class="text-light">
              Kemudahan dalam mengelola Sumber Daya Manusia
            </h5>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 mb-2">
        <div class="card aos-init aos-animate" data-aos="fade-in" data-aos-delay="200" style="border: none; background-color: transparent">
          <div class="card-body text-center">
            <img src="{{ asset('assets/ASSET1.png') }}" alt="" style="width: 30%; height: auto; margin-bottom: 1rem">
            <h5 class="text-light">
              Interaksi cepat antar sistem via Website dan Mobile App
            </h5>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 mb-2">
        <div class="card aos-init aos-animate" data-aos="fade-in" data-aos-delay="300" style="border: none; background-color: transparent">
          <div class="card-body text-center">
          <img src="{{ asset('assets/ASSET2.png') }}" alt="" style="width: 30%; height: auto; margin-bottom: 1rem">
            <h5 class="text-light">Opsi pilihan penggunaan yang terjangkau</h5>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row mb-5">
    </div>

  <section id="tentangkami">
  <div class="row mb-5">
    <div class="col-md-6 align-self-center">
      <div class="card"
      style="border: none;
             background-color: transparent
             ">
        <div class="card-body p-5 aos-init aos-animate" data-aos="fade-in" data-aos-delay="200">
          <h5 class="mb-3 text-light" style="text-decoration: underline">Solusi Kami</h5>
          <h2 class="text-light">
            Membantu anda mengelola Pegawai / Karyawan untuk meningkatkan
            produktivitas bisnis anda
          </h2>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-12">
      <div class="card aos-init aos-animate" data-aos="fade-left" data-aos-delay="200" style="border: none; background-color: transparent">
        <img
        alt="image"
        src="{{ asset('assets/laptop.png') }}"
        class="card-img-top"
        style="width: 80%;
               height: auto;
               object-fit: cover;
               border-radius: 10px;
               box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;"
        />
      </div>
    </div>
  </div>
</section>

<div class="row mt-5 mb-5"></div>

<section id="produkkami">
  <div class="row mb-5">
  <div class="col-md-6 align-self-center">
    <div class="card p-5"
    style="border: none;
    background-color: transparent
    ">
      <div class="card-body aos-init aos-animate" data-aos="fade-in" data-aos-delay="300" >
        <h5 class="text-light" style="text-decoration: underline">Produk Kami</h5>
        <h2 class="text-light">
          Sistem Pengelolaan Sumber Daya Manusia berbasis Website dan Mobile
          Apps Android
        </h2>
      </div>
    </div>
  </div>

    <div class="col-md-6 col-sm-12">
      <div class="card align-items-center aos-init aos-animate" data-aos="fade-left" data-aos-delay="300" style="border: none; background-color: transparent">
        <img
        alt="image"
        src="{{ asset('assets/phone image.png') }}"
        class="card-img-top"
        style="width: 50%;
              height: auto;
              object-fit: cover;
              border-radius: 10px;
              box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;"
              />
      </div>
    </div>
  </div>
</section>

<div class="row mt-5 mb-5"></div>

<section id="team" class="team">

  <div class="container aos-init aos-animate" data-aos="fade-up">

    <header class="section-header mb-2">
      <h2 class="text-light">Team</h2>
      <p class="text-light">Meet TimKerjaKu's Developers</p>
    </header>

    <div class="row gy-4 justify-content-center">

      <div class="col-lg-3 col-md-6 d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
        <div class="card" style="border-radius: 5rem 5rem 1rem 1rem;">
          <div class="card-header p-0" style="background-color: transparent">
            <img src="{{ asset('assets/azka.jpg') }}" class="card-img-top" alt="" style="border-radius: 5rem 5rem 0 0">
          </div>
          <div class="card-body" style="background-color: #444EFF; border-color: transparent; border-radius: 0rem 0rem 1rem 1rem;">
            <h4 class="text-light">Azka Secio</h4>
            <span class="text-light"><i>Backend Developer</i></span>
            <p class="mt-1 text-light">Computer Science Student at Bina Nusantara University</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
        <div class="card" style="border-radius: 5rem 5rem 1rem 1rem">
          <div class="card-header p-0" style="background-color: transparent">
            <img src="{{ asset('assets/siman.jpg') }}" class="card-img-top" alt="" style="border-radius: 5rem 5rem 0 0">
          </div>
          <div class="card-body" style="background-color: #444EFF; border-color: transparent; border-radius: 0rem 0rem 1rem 1rem;">
            <h4 class="text-light">Erick Siman</h4>
            <span class="text-light"><i>Frontend Developer</i></span>
            <p class="mt-1 text-light">Computer Science Student at Bina Nusantara University</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
        <div class="card" style="border-radius: 5rem 5rem 1rem 1rem">
          <div class="card-header p-0" style="background-color: transparent">
            <img src="{{ asset('assets/ernest.jpg') }}" class="card-img-top" alt="" style="border-radius: 5rem 5rem 0 0">
          </div>
          <div class="card-body" style="background-color: #444EFF; border-color: transparent; border-radius: 0rem 0rem 1rem 1rem;">
            <h4 class="text-light">Ernest Nathaniel</h4>
            <span class="text-light"><i>Mobile Developer</i></span>
            <p class="mt-1 text-light">Mobile App & Tech Student at <br>Bina Nusantara University</p>
          </div>
        </div>
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
