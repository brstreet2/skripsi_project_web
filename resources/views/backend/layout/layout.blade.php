<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TimKerjaKu @yield('title')</title>

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" />

    {{-- JQuery 3.6.4 --}}
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/dashboard.css') }}">

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    {{-- Additional CSS --}}
    @stack('css')

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>

<body id="body-pd" style="background-color: #f2f3ff ">
    <header class="header" id="header" style="background-color: #fcfcfc">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"><a href="{{ route('profile.index') }}">
                @if (Sentinel::getUser()->avatar != null)
                    <img src="{{ Sentinel::getUser()->avatar }}" alt="">
                @else
                    <img
                        src="https://s3-id-jkt-1.kilatstorage.id/timkerjaku/428-4287240_no-avatar-user-circle-icon-png.png" />
                @endif
            </a>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav_side">
            <div> <a href="{{ route('dashboard.index') }}" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">TimKerjaKu</span> </a>
                <div class="nav_list">
                    @if (isset(Sentinel::getUser()->company) && !Sentinel::getUser()->company->company_employees->isEmpty())
                        {{-- Free Account --}}
                        @if (Sentinel::getUser()->user_type == 0 || Sentinel::getUser()->user_type == 1)
                            <a href="{{ route('dashboard.index') }}"
                                class="nav_link {{ request()->route()->named('dashboard.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Beranda</span></a>
                            <a href="{{ route('company.index') }}"
                                class="nav_link {{ request()->route()->named('company.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-buildings nav-icon'></i> <span class="nav_name">Profil Bisnis</span>
                            </a>
                            <a href="{{ route('report.index') }}" class="nav_link"> <i class='bx bx-user nav_icon'></i>
                                <span class="nav_name">Laporan</span> </a>
                            <a href="{{ route('employee.index') }}"
                                class="nav_link {{ request()->route()->named('employee.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-user nav_icon'></i> <span class="nav_name">Karyawan</span> </a>
                            <a href="{{ route('attendance.index') }}"
                                class="nav_link {{ request()->route()->named('attendance.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-folder nav_icon'></i> <span class="nav_name">Persetujuan</span> </a>
                            <a href="{{ route('pricing.index') }}"
                                class="nav_link {{ request()->route()->named('pricing.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-dollar-circle nav_icon'></i> <span class="nav_name">Upgrade</span> </a>

                            {{-- Premium Account --}}
                        @elseif (Sentinel::getUser()->user_type == 2)
                            <a href="{{ route('dashboard.index') }}"
                                class="nav_link {{ request()->route()->named('dashboard.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Beranda</span></a>
                            <a href="{{ route('company.index') }}"
                                class="nav_link {{ request()->route()->named('company.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-buildings nav-icon'></i> <span class="nav_name">Profil Bisnis</span>
                            </a>
                            <a href="{{ route('report.index') }}" class="nav_link"> <i class='bx bx-user nav_icon'></i>
                                <span class="nav_name">Laporan</span> </a>
                            <a href="{{ route('employee.index') }}"
                                class="nav_link {{ request()->route()->named('employee.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-user nav_icon'></i> <span class="nav_name">Karyawan</span> </a>
                            <a href="{{ route('attendance.index') }}"
                                class="nav_link {{ request()->route()->named('attendance.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-folder nav_icon'></i> <span class="nav_name">Persetujuan</span> </a>
                            <a href="{{ route('payroll.index') }}"
                                class="nav_link {{ request()->route()->named('payroll.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Slip Gaji</span> </a>
                            <a href="{{ route('pricing.index') }}"
                                class="nav_link {{ request()->route()->named('pricing.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-dollar-circle nav_icon'></i> <span class="nav_name">Upgrade</span>
                            </a>

                            {{-- Pro Account --}}
                        @elseif (Sentinel::getUser()->user_type == 3)
                            <a href="{{ route('dashboard.index') }}"
                                class="nav_link {{ request()->route()->named('dashboard.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Beranda</span></a>
                            <a href="{{ route('company.index') }}"
                                class="nav_link {{ request()->route()->named('company.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-buildings nav-icon'></i> <span class="nav_name">Profil Bisnis</span>
                            </a>
                            <a href="{{ route('report.index') }}" class="nav_link"> <i
                                    class='bx bx-user nav_icon'></i>
                                <span class="nav_name">Laporan</span> </a>
                            <a href="{{ route('employee.index') }}"
                                class="nav_link {{ request()->route()->named('employee.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-user nav_icon'></i> <span class="nav_name">Karyawan</span> </a>
                            <a href="{{ route('attendance.index') }}"
                                class="nav_link {{ request()->route()->named('attendance.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-folder nav_icon'></i> <span class="nav_name">Persetujuan</span> </a>
                            <a href="{{ route('payroll.index') }}"
                                class="nav_link {{ request()->route()->named('payroll.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Slip Gaji</span> </a>
                            <a href="{{ route('document.index') }}"
                                class="nav_link {{ request()->route()->named('document.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-file nav_icon'></i> <span class="nav_name">Dokumen</span> </a>
                            <a href="/announcement" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                                <span class="nav_name">Pengumuman</span> </a>
                            <a href="{{ route('pricing.index') }}"
                                class="nav_link {{ request()->route()->named('pricing.*')? 'active-nav': '' }}"> <i
                                    class='bx bx-dollar-circle nav_icon'></i> <span class="nav_name">Upgrade</span>
                            </a>
                        @endif
                    @elseif (isset(Sentinel::getUser()->company) && Sentinel::getUser()->company->company_employees->isEmpty())
                        <a href="{{ route('dashboard.index') }}"
                            class="nav_link {{ request()->route()->named('dashboard.*')? 'active-nav': '' }}"> <i
                                class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Beranda</span></a>
                        <a href="{{ route('company.index') }}"
                            class="nav_link {{ request()->route()->named('company.*')? 'active-nav': '' }}"> <i
                                class='bx bx-buildings nav-icon'></i> <span class="nav_name">Profil Bisnis</span>
                        </a>
                        <a href="{{ route('employee.index') }}"
                            class="nav_link {{ request()->route()->named('employee.*')? 'active-nav': '' }}"> <i
                                class='bx bx-user nav_icon'></i> <span class="nav_name">Karyawan</span> </a>
                    @elseif (!isset(Sentinel::getUser()->company) && !isset(Sentinel::getUser()->company->company_employees))
                        <a href="{{ route('dashboard.index') }}"
                            class="nav_link {{ request()->route()->named('dashboard.*')? 'active-nav': '' }}"> <i
                                class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Beranda</span></a>
                        <a href="{{ route('company.index') }}"
                            class="nav_link {{ request()->route()->named('company.*')? 'active-nav': '' }}"> <i
                                class='bx bx-buildings nav-icon'></i> <span class="nav_name">Profil Bisnis</span>
                        </a>
                    @endif
                </div>
            </div>
            <a href="{{ route('auth.logout') }}" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                    class="nav_name">Keluar</span> </a>
        </nav>
    </div>
    {{--  --}}

    {{-- Section --}}
    <div class="container-fluid" style="margin-top: 5rem">
        @yield('content')
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId)

                nav.classList.toggle('show-nav')
                // change icon
                toggle.classList.toggle('bx-x')
                // add padding to body
                bodypd.classList.toggle('body-pd')
                // add padding to header
                headerpd.classList.toggle('body-pd')

                // Validate that all variables exist
                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        // show navbar
                        nav.classList.toggle('show-nav')
                        // change icon
                        toggle.classList.toggle('bx-x')
                        // add padding to body
                        bodypd.classList.toggle('body-pd')
                        // add padding to header
                        headerpd.classList.toggle('body-pd')
                    })
                }
            }

            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

            /*===== LINK ACTIVE =====*/
            const linkColor = document.querySelectorAll('.nav_link')

            function colorLink() {
                if (linkColor) {
                    linkColor.forEach(l => l.classList.remove('active'))
                    this.classList.add('active')
                }
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink))

            // Your code to run since DOM is loaded and ready
        });
    </script>

    @stack('scripts')

</body>

</html>
