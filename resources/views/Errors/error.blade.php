<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laravel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- CSS --}}
    <link rel="stylesheet" href="error.css">

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    {{-- icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

</head>

<body>
    <div class="container">
        {{-- Section --}}
        <div class="row" style="margin-bottom: 9rem"></div>
        <div class="row">
            <div class="col-1">

            </div>

            <div class="col-10  justify-content-center align-center">
                <div class="row  ">

                    <div class="col-5 d-flex justify-content-center align-items-center">
                        <div class="card border-0  text-center justify-content-center"
                            style="background-color: #444EFF">
                            <div class="card-body">
                                <h1 class="errortitle" style="font-size:2rem;color:#fcfcfc">ERROR</h1>
                                <h2 class="number" style="font-size:2.5rem;color:#fcfcfc">@yield('code', __('Oh no'))</h2>
                                <p class="errortext" style="font-size:1rem;color:#fcfcfc">@yield('message')</p>
                                <a href="{{ route('home') }}">
                                    <button type="submit" id="backBtn" class="btn btn-block btnprimary rounded-pill"
                                        style="font-weight: 700; height: 3rem;">Homepage</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-1 d-flex justify-content-center align-items-center" style="height:25rem">
                        <div class="vr" style="width:5px; color:#fcfcfc; opacity:0.8; border-radius: 10 rem"></div>
                    </div>

                    <div class="col-6 d-flex justify-content-center">
                        <h1><iframe src="https://embed.lottiefiles.com/animation/90569" width="400rem"
                                height="400rem"></iframe></h1>
                    </div>

                </div>
            </div>

            <div class="col-1">

            </div>

        </div>
        <div class="row" style="margin-top: 8rem"></div>
    </div>
</body>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

</html>
