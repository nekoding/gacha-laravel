<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <title>SPIN LARAVEL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
          crossorigin="anonymous">

    <style>
        #wheel {
            background-image: url(./wheel_back.png);
            background-position: center;
            background-repeat: no-repeat;
            height: 500px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="text-center">SPIN</h1>
        <h4>Lucky Number : <span id="luckyNumber">?</span></h4>
        <div class="d-flex justify-content-center align-items-center"
             id="wheel">
            <button class="btn bg-dark position-absolute rounded-circle text-white fs-1 shadow-none"
                    style="width: 155px; height: 155px"
                    id="btnSpin">SPIN</button>
            <canvas id="canvas"
                    width="434"
                    height="434">
            </canvas>


        </div>
    </div>


    <script src="{{ asset('Winwheel.min.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
            integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
            crossorigin="anonymous"></script>
    @vite('resources/js/app.js')
</body>

</html>
