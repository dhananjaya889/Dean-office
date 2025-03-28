<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- styles --}}
    <link rel="stylesheet" href="https://unpkg.com/@webpixels/css@1.1.5/dist/index.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <!-- Vertical Navbar -->
        <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-warning border-bottom border-bottom-lg-0 border-end-lg"
            id="navbarVertical">
            <div class="container-fluid">
                <!-- Toggler -->
                <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Brand -->
                <div class="text-center w-100">
                <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0 logo_image" href="">
                    <img src="{{ asset('img/uni.png') }}" alt="logo" class="" width="40px" height="auto">
                    <h4>MIS Dean's Office</h4>
                </a>
                </div>

                <hr class="navbar-divider my-0 opacity-20">
                <!-- User menu (mobile) -->
                <div class="navbar-user d-lg-none">
                    <!-- Dropdown -->
                    <div class="dropdown">
                        <!-- Toggle -->
                        <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <div class="avatar-parent-child">
                                <img alt="Image Placeholder" src="{{ Auth::user()->profile_photo_url }}"
                                    class="avatar avatar- rounded-circle">
                                <span class="avatar-child avatar-badge bg-success"></span>
                            </div>
                        </a>
                        <!-- Menu -->
                        {{-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
                            <a href="#" class="dropdown-item">Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Billing</a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">Logout</a>
                        </div> --}}
                    </div>
                </div>
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidebarCollapse">
                    <!-- Navigation -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 rounded-pill text-white bg-dark shadow-sm d-flex align-items-center gap-2"
                                href="{{ url('/dashboard') }}" style="transition: all 0.3s ease;">
                                <i class="bi bi-house"></i> <span>User's Profile</span>
                            </a>
                        </li>


                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                            <li class="nav-item">
                                <a class="nav-link px-3 py-2 rounded-pill text-white bg-info shadow-sm d-flex align-items-center gap-2"
                                    href="{{ url('users') }}" style="transition: all 0.3s ease;">
                                    <i class="bi bi-people"></i> <span>Staff Members</span>
                                </a>
                            </li>

                            {{-- <li class="nav-item">
                                <a class="nav-link px-3 py-2 rounded-pill text-white bg-info shadow-sm d-flex align-items-center gap-2"
                                    href="{{ url('notices') }}" style="transition: all 0.3s ease;">
                                    <i class="bi bi-chat"></i> <span>Notices</span>
                                </a>
                            </li> --}}

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 px-3 py-2 rounded-pill text-white bg-dark shadow-sm"
                                    href="#" id="quartzDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" style="transition: all 0.3s ease;">
                                    <i class="bi bi-bookmarks"></i> <span>Quarters</span>
                                </a>
                                <ul class="dropdown-menu border-0 shadow-lg rounded-3 animate__animated animate__fadeIn"
                                    aria-labelledby="quartzDropdown">
                                    <li><a class="dropdown-item py-2 text-dark fw-semibold" href="{{ url('quartaz') }}">
                                            <i class="bi bi-gem text-primary"></i> Quarters Overview
                                        </a></li>
                                    <li><a class="dropdown-item py-2 text-dark fw-semibold" href="{{ url('items') }}">
                                            <i class="bi bi-box-seam text-success"></i> Quarters Items
                                        </a></li>
                                    <li><a class="dropdown-item py-2 text-dark fw-semibold"
                                            href="{{ url('check_list') }}">
                                            <i class="bi bi-list-check"></i> Quarters Check List
                                        </a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 px-3 py-2 rounded-pill text-white bg-info shadow-sm"
                                    href="#" id="quartzDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" style="transition: all 0.3s ease;">
                                    <i class="bi bi-credit-card-2-back-fill"></i> <span>Utility Bills</span>
                                </a>
                                <ul class="dropdown-menu border-0 shadow-lg rounded-3 animate__animated animate__fadeIn"
                                    aria-labelledby="quartzDropdown">
                                    <li><a class="dropdown-item py-2 text-dark fw-semibold" href="{{ url('bills') }}">
                                            <i class="bi bi-receipt-cutoff"></i> Bills Overview
                                        </a></li>
                                    <li><a class="dropdown-item py-2 text-dark fw-semibold"
                                            href="{{ url('paybills') }}">
                                            <i class="bi bi-cash"></i> Pay Bills
                                        </a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link px-3 py-2 rounded-pill text-white bg-dark shadow-sm d-flex align-items-center gap-2"
                                    href="{{ url('/maintenance') }}" style="transition: all 0.3s ease;">
                                    <i class="bi bi-hammer"></i> <span>Maintenance</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->role == 'lecturer' || Auth::user()->role == 'temporary-lecturer')
                            <li class="nav-item">
                                <a class="nav-link px-3 py-2 rounded-pill text-white bg-info shadow-sm d-flex align-items-center gap-2"
                                    href="{{ url('/quartaz/user/' . Auth::user()->id) }}"
                                    style="transition: all 0.3s ease;">
                                    <i class="bi bi-bookmarks"></i> <span>Quarters</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link px-3 py-2 rounded-pill text-white bg-dark shadow-sm d-flex align-items-center gap-2"
                                    href="{{ url('bills') }}" style="transition: all 0.3s ease;">
                                    <i class="bi bi-credit-card-2-back-fill"></i> <span>Utility Bills</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <li><a class="nav-link px-3 py-2 rounded-pill text-white bg-info shadow-sm d-flex align-items-center gap-2"
                                    href="{{ url('paybills') }}">
                                    <i class="bi bi-cash"></i> Pay Bills
                                </a></li>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3 py-2 rounded-pill text-white bg-dark shadow-sm d-flex align-items-center gap-2"
                                    href="{{ url('/maintenance') }}" style="transition: all 0.3s ease;">
                                    <i class="bi bi-hammer"></i> <span>Maintenance</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->role == 'temporary-demostrator' || Auth::user()->role == 'non-academic')
                            
                            <li class="nav-item">
                                <a class="nav-link px-3 py-2 rounded-pill text-white bg-info shadow-sm d-flex align-items-center gap-2"
                                    href="{{ url('/quartaz/user/' . Auth::user()->id) }}"
                                    style="transition: all 0.3s ease;">
                                    <i class="bi bi-bookmarks"></i> <span>Quarters</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link px-3 py-2 rounded-pill text-white bg-dark shadow-sm d-flex align-items-center gap-2"
                                    href="{{ url('bills') }}" style="transition: all 0.3s ease;">
                                    <i class="bi bi-credit-card-2-back-fill"></i> <span>Utility Bills</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <li><a class="nav-link px-3 py-2 rounded-pill text-white bg-info shadow-sm d-flex align-items-center gap-2"
                                    href="{{ url('paybills') }}">
                                    <i class="bi bi-cash"></i> Pay Bills
                                </a></li>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3 py-2 rounded-pill text-white bg-dark shadow-sm d-flex align-items-center gap-2"
                                    href="{{ url('/maintenance') }}" style="transition: all 0.3s ease;">
                                    <i class="bi bi-hammer"></i> <span>Maintenance</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->role == 'maintenance')
                            <li class="nav-item">
                                <a class="nav-link px-3 py-2 rounded-pill text-white bg-info shadow-sm d-flex align-items-center gap-2"
                                    href="{{ url('/maintenance') }}" style="transition: all 0.3s ease;">
                                    <i class="bi bi-hammer"></i> <span>Maintenance</span>
                                </a>
                            </li>
                        @endif

                    </ul>
                    <!-- Divider -->
                    <hr class="navbar-divider my-5 opacity-20">
                    <!-- Navigation -->

                    <!-- Push content down -->
                    <div class="mt-auto"></div>
                    <!-- User (md) -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 rounded-pill text-white bg-dark shadow-sm d-flex align-items-center gap-2 border-0"
                                href="{{ route('profile.show') }}" style="transition: all 0.3s ease;">
                                <i class="bi bi-file-person-fill"></i> <span>Account</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            {{-- <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                            <a class="nav-link" href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                <i class="bi bi-box-arrow-left"></i> Logout
                            </a>
                            </form> --}}

                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <button type="submit"
                                    class="nav-link px-3 py-2 rounded-pill text-dark bg-danger shadow-sm d-flex align-items-center gap-2 border-0"
                                    style="transition: all 0.3s ease;">
                                    <i class="bi bi-box-arrow-left"></i> <span>Log Out</span>
                                </button>


                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight">@yield('title')</h1>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-5 col-12 text-sm-end">
                                <div class="mx-n1">
                                    <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <div class="avatar-parent-child">
                                            <img alt="Image Placeholder" src="{{ Auth::user()->profile_photo_url }}"
                                                class="avatar avatar- rounded-circle">
                                            <span class="avatar-child avatar-badge bg-success"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">

                        </ul>
                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @yield('additinal-styles')
    <style>
        @media only screen and (max-width: 600px) {
            .logo-image {
                width: 60px !important;
            }
        }

        #paginationLinks nav {
            display: flex;
            justify-content: center;
        }

        #paginationLinks .pagination {
            display: flex;
            list-style: none;
            padding: 0;
        }

        #paginationLinks .pagination li {
            margin: 0 5px;
        }

        #paginationLinks .pagination li a,
        #paginationLinks .pagination li span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            text-decoration: none;
            color: #007bff;
            background: #f8f9fa;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: 1px solid #dee2e6;
        }

        #paginationLinks .pagination li a:hover {
            background: #007bff;
            color: white;
        }

        #paginationLinks .pagination .active span {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }

        #paginationLinks .pagination .disabled span {
            background: #e9ecef;
            color: #6c757d;
            cursor: not-allowed;
        }

        #paginationLinks .pagination li:first-child a,
        #paginationLinks .pagination li:last-child a {
            font-size: 18px;
            font-weight: bold;
        }

        #paginationLinks .pagination li:first-child a:hover,
        #paginationLinks .pagination li:last-child a:hover {
            background: #0056b3;
        }
    </style>

    @yield('additinal-script')

</body>

</html>
