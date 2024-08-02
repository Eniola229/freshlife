<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="{{ asset('https://fonts.gstatic.com') }}">
    <link rel="shortcut icon" href="{{ asset('img/icons/icon-48x48.png') }}" />

    <link rel="canonical" href="{{ asset('https://demo-basic.adminkit.io/') }}" />

    <title>Cart - FreshLifeWaters</title>

   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

    <style>
        .product-detail {
            margin-top: 20px;
        }
        .product-detail .img-large {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
        }
        .product-detail .price {
            font-size: 1.5rem;
            color: #e53935;
            font-weight: bold;
        }
        .product-detail .discount {
            font-size: 1.2rem;
            color: #ff5722;
            text-decoration: line-through;
        }
        .product-detail .description {
            margin-top: 20px;
            font-size: 1rem;
            color: #555;
        }
        .product-detail .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .product-detail .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>

<body>
    <div class="wrapper">
        @include('components.sidenav')

        <div class="main">
             @include('components.header')

            <main class="content">
              <div class="container mt-5">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif  
                    <h1 class="mb-4">My Cart</h1>

                    @if($cartItems->isEmpty())
                    <div style="margin: auto; text-align: center; justify-content: center; align-items: center; ">
                        <h1 style="color: red;">Your cart is empty.</h1>
                       <a href="{{ url('product') }}"> <button class="btn btn-primary">Our Products</button></a>
                    </div>
                        
                    @else
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary fw-bold">Checkout</button>
                    </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td>{{ $item->product->product_name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>N{{ $item->product->product_price }}</td>
                                        <td>N{{ $item->quantity * $item->product->product_price }}</td>
                                        <th><form style="display: inline-block;" action="{{ route('cart.delete', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form></th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
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

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>