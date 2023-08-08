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
              <button class="btn btn-lg rounded-pill btn-light mt-4 fw-bold buttonregist" data-aos="zoom-in" data-aos-delay="400" style="color: #444EFF">
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
                box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px"
        />
        </div>
      </div>
    </div>
  </section>
</div>
    
    <div class="row mt-5 mb-5">
      <div class="col-md-4 col-sm-12 mb-2">
        <div class="card aos-init aos-animate" style="border: none; background-color: transparent">
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
      <div class="card-body aos-init aos-animate" data-aos="fade-in" data-aos-delay="400" >
        <h5 class="text-light" style="text-decoration: underline">Produk Kami</h5>
        <h2 class="text-light">
          Sistem Pengelolaan Sumber Daya Manusia berbasis Website dan Mobile
          Apps Android
        </h2>
      </div>
    </div>
  </div>

    <div class="col-md-6 col-sm-12">
      <div class="card align-items-center aos-init aos-animate" data-aos="fade-left" data-aos-delay="400" style="border: none; background-color: transparent">
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

<section id="team" class="team">

  <div class="container aos-init aos-animate" data-aos="fade-up">

    <header class="section-header">
      <h2 class="text-light">Team</h2>
      <p>Our hard working team</p>
    </header>

    <div class="row gy-4 align-items-center">

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
        <div class="card" style="border-radius: 1rem">
          <div class="card-header p-0">
            <img src="{{ asset('assets/azka.jpg') }}" class="card-img-top" alt="" style="border-radius: 1rem 1rem 0 0">
          </div>
          <div class="card-body" style="background-color: #444EFF; border-color: transparent; border-radius: 0rem 0rem 1rem 1rem;">
            <h4 class="text-light">Azka Secio</h4>
            <span class="text-light"><i>Backend Developer</i></span>
            <p class="mt-1 text-light">Computer Science Student at Bina Nusantara University</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
        <div class="card" style="border-radius: 1rem">
          <div class="card-header p-0" style="border-bottom: transparent">
            <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#444EFF" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
          </div>
          <div class="card-body" style="background-color: #444EFF; border-color: transparent; border-radius: 0rem 0rem 1rem 1rem;">
            <h4 class="text-light">Azka Secio</h4>
            <span class="text-light"><i>Backend Developer</i></span>
            <p class="mt-1 text-light">Computer Science Student at Bina Nusantara University</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
        <div class="card" style="border-radius: 1rem">
          <div class="card-header p-0" style="border-bottom: transparent">
            <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#444EFF" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
          </div>
          <div class="card-body" style="background-color: #444EFF; border-color: transparent; border-radius: 0rem 0rem 1rem 1rem;">
            <h4 class="text-light">Azka Secio</h4>
            <span class="text-light"><i>Backend Developer</i></span>
            <p class="mt-1 text-light">Computer Science Student at Bina Nusantara University</p>
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
