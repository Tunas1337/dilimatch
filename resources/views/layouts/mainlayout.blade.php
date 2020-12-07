<!DOCTYPE html>
<html lang="en">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Dilimatch</title>
        <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli">
        <link rel="stylesheet" href="/assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/fonts/simple-line-icons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/assets/css/Icon-Bar-Horizontal--inesp2000-1.css">
        <link rel="stylesheet" href="/assets/css/Icon-Bar-Horizontal--inesp2000.css">
        <link rel="stylesheet" href="/assets/css/main.css">
    </head>

    <body>
        <div class="alert alert-danger" role="alert">
            <b>The site is still under active development!</b> Expect breakage, changes, unpleasantness, but hopefully no security issues. Treat it as experimental until its official release.
          </div>
        <div data-bs-parallax-bg="true" style="height: 92%;background-image: url(https://picsum.photos/1280/720);background-position: center;background-size: cover;">
            <div class="ip-icon-bar"><a class="ip-active" href="/app"><i class="fa fa-home"></i></a><a href="/app/matches/"><i class="fa fa-envelope"></i></a><a href="/app/profile"><i class="fa fa-globe"></i></a><a href="/logout"><i class="fa fa-sign-out"></i></a></div>
            @yield('content')
        </div>
        </div>
        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="/assets/js/bs-init.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script src="/assets/js/new-age.js"></script>
    </body>

    </html>
