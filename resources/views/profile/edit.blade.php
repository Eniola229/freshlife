<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-profile.html" />

    <title>Profile | AdminKit Demo</title>

    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        @include('components.sidenav')

        <div class="main">
         @include('components.header')

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="mb-3">
                        <h1 class="h3 d-inline align-middle">Profile</h1>
                        <a class="badge bg-dark text-white ms-2" href="#">
                           <!-- Get to know more in our blog -->
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xl-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Profile Details</h5>
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ Auth::user()->image_url }} " alt="{ Auth::user()->firstName }} {{ Auth::user()->lastName }}" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                                    <h5 class="card-title mb-0">{{ Auth::user()->bussinessName }}</h5>
                                    <div class="text-muted mb-2">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</div>

                                    <div>
                                        <a class="btn btn-primary btn-sm" href="#"><span data-feather="message-square"></span> Message us</a>
                                    </div>
                                </div>
                                <hr class="my-0" />
                            <!--    <div class="card-body">
                                    <h5 class="h6 card-title">Skills</h5>
                                    <a href="#" class="badge bg-primary me-1 my-1">HTML</a>
                                    <a href="#" class="badge bg-primary me-1 my-1">JavaScript</a>
                                    <a href="#" class="badge bg-primary me-1 my-1">Sass</a>
                                    <a href="#" class="badge bg-primary me-1 my-1">Angular</a>
                                    <a href="#" class="badge bg-primary me-1 my-1">Vue</a>
                                    <a href="#" class="badge bg-primary me-1 my-1">React</a>
                                    <a href="#" class="badge bg-primary me-1 my-1">Redux</a>
                                    <a href="#" class="badge bg-primary me-1 my-1">UI</a>
                                    <a href="#" class="badge bg-primary me-1 my-1">UX</a>
                                </div> -->
                                <hr class="my-0" />
                                <div class="card-body">
                                    <h5 class="h6 card-title">About You</h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Unique Id <a href="#">{{ Auth::user()->uniqueID }}</a></li>

                                        <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span>Phone Number 1 <a href="#">{{ Auth::user()->mobileOne }}</a></li>
                                        <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span>Phone Number 2 <a href="#">{{ Auth::user()->mobileTwo }}</a></li>

                                        <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> Location <a href="#">{{ Auth::user()->location }}</a></li>   
                                    </ul>
                                </div>
                                <hr class="my-0" />
<!--                                 <div class="card-body">
                                    <h5 class="h6 card-title">Elsewhere</h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-1"><a href="#">staciehall.co</a></li>
                                        <li class="mb-1"><a href="#">Twitter</a></li>
                                        <li class="mb-1"><a href="#">Facebook</a></li>
                                        <li class="mb-1"><a href="#">Instagram</a></li>
                                        <li class="mb-1"><a href="#">LinkedIn</a></li>
                                    </ul>
                                </div> -->
                            </div>
                        </div>

                        <div class="col-md-8 col-xl-9">
                         ...............................................
                        </div>
                    </div>

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
<!--                         <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin Template</strong></a>                               &copy;
                            </p>
                        </div> -->
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="js/app.js"></script>

</body>

</html>