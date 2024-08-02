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

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-up.html" />

    <title>Sign Up | Fresh Life</title>

    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">FreshLife</h1>
                            <p class="lead">
                                Register a free account.
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-3">
                                      <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Bussness Photo</label>
                                            <input class="form-control form-control-lg" type="file" name="bussnessPhoto"required />
                                            <x-input-error :messages="$errors->get('bussnessPhoto')" class="mt-2" />
                                        </div> 
                                        <div class="mb-3">
                                            <label class="form-label">First name</label>
                                            <input class="form-control form-control-lg" type="text" name="firstName" placeholder="Enter yourfirst name" required/>
                                             <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Last name</label>
                                            <input class="form-control form-control-lg" type="text" name="lastName" placeholder="Enter your last name" required/>
                                            <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Bussiness name</label>
                                            <input class="form-control form-control-lg" type="text" name="bussinessName" placeholder="Enter your Bussiness name" required/>
                                            <x-input-error :messages="$errors->get('bussinessName')" class="mt-2" />
                                        </div> 
                                        <div class="mb-3">
                                            <label class="form-label">Phone Number One (1)</label>
                                            <input class="form-control form-control-lg" type="number" name="mobileOne" placeholder="Enter your Bussiness name" required/>
                                            <x-input-error :messages="$errors->get('mobileOne')" class="mt-2" />
                                        </div>  
                                        <div class="mb-3">
                                            <label class="form-label">BPhone Number Two (2)</label>
                                            <input class="form-control form-control-lg" type="number" name="mobileTwo" placeholder="Enter your Phone Number 1" required/>
                                            <x-input-error :messages="$errors->get('mobileTwo')" class="mt-2" />
                                        </div> 
                                        <div class="mb-3">
                                            <label class="form-label">Location</label>
                                            <input class="form-control form-control-lg" type="text" name="location" placeholder="Enter your Phone Number 2" required/>
                                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                        </div>                                        
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" required/>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter password" />
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" required/>
                                        </div>
                                       <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password_confirmation" placeholder="Enter password" />
                                             <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" required/>
                                        </div>
                                        <div class="d-grid gap-2 mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Sign up</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mb-3">
                            Already have account? <a href="{{ route('login') }}">Log In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="js/app.js"></script>

</body>

</html>