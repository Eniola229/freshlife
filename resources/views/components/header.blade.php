<?php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Cart;
    use App\Models\Product;
    use App\Models\Category;
    //For cart items 
    // Get the ID of the authenticated user
    $userId = Auth::id();
        
    // Count the number of cart records for this user
    $cartItems = Cart::where('user_id', $userId)->with('product')->get();
    $cartCount = Cart::where('user_id', $userId)->count();
?>

<nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    4 New Notifications
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.8</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">Christina accepted your request.</div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="shopping-cart"></i>
                                    <span class="indicator">
                                        
                                        @if($cartCount > 0)
                                            <p>{{ $cartCount }}</p>
                                        @else
                                            <p>0</p>
                                        @endif

                                    </span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
                                <div class="dropdown-menu-header">
                                    <div class="position-relative">
                                        Your Cart's
                                    </div>
                                </div>
                                    <div class="list-group">
                                        @if($cartItems->isEmpty())
                                            <div class="text-center">
                                                <h1 class="text-danger">Your cart is empty.</h1>
                                                <a href="{{ url('product') }}">
                                                    <button class="btn btn-primary">Our Products</button>
                                                </a>
                                            </div>
                                        @else
                                            @foreach($cartItems as $cartItem)
                                                <a href="#" class="list-group-item list-group-item-action">
                                                    <div class="row g-0 align-items-center">
                                                        <div class="col-2">
                                                            <!-- Assuming `product` relationship is defined in Cart model -->
                                                            <img src="{{ $cartItem->product->main_image }}" class="img-fluid rounded" alt="{{ $cartItem->product->product_name }}">
                                                        </div>
                                                        <div class="col-10 ps-2">
                                                            <div class="fw-bold">{{ $cartItem->product->product_name }}</div>
                                                            <div class="text-muted small mt-1">Price: N{{ $cartItem->product->product_price }}</div>
                                                            <div class="text-muted small mt-1">Quantity: {{ $cartItem->quantity }}</div>
                                                            <!-- Optional: Additional details can be displayed here -->
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                <div class="dropdown-menu-footer">
                                    <a href="{{ url('cart') }}" class="text-muted">Show all Cart's</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <img src="{{ Auth::user()->image_url }}" class="avatar img-fluid rounded me-1" alt="{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}" /> <span class="text-dark">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
              </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ url('profile') }}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                                <div class="dropdown-divider"></div>
                                 <form method="POST" class="dropdown-item" action="{{ route('logout') }}">
                                 @csrf
                                  <x-responsive-nav-link :href="route('logout')"
                                     onclick="event.preventDefault();
                                     this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                  </x-responsive-nav-link>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>