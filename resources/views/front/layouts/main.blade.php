<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gardabani Kids</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/loader/docs/css/three-dots.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-graysh">
    <header class="w-100 d-flex justify-content-end">
       <nav class="navbar navbar-expand-lg  w-50">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item ">
                            <a onclick="Router('/home')" class="nav-link txt-bluish active" aria-current="page" href="#"><p class="mb-0">მთავარი</p></a>
                        </li>
                        <li class="nav-item ">
                            <a onclick="Router('/contact')" class="nav-link txt-bluish active" aria-current="page" href="#"><p class="mb-0">კონტაქტი</p></a>
                        </li>
                        <li class="nav-item ">
                            <a onclick="Router('/about')" class="nav-link txt-bluish active" aria-current="page" href="#"><p class="mb-0">ჩვენ შესახებ </p></a>
                        </li>
                          <li class="nav-item ">
                            <a class="nav-link txt-bluish active" aria-current="page" href="#"><p class="mb-0">ქარ</p></a>
                        </li>
                    </ul>
                </div>
            </div>
            </nav>
    </header>
    
    <div class="overlay">
        <div class="dot-windmill-big"></div>
    </div>
    <div class="container-fluid px-0">
        <div class="row px-0 w-100">
            <div class="col-12 px-0">
                <div class="content">
                    
                </div>
            </div>
        </div>
    </div>
    
    <script src="./assets/js/router.js"></script>

</body>
</html>