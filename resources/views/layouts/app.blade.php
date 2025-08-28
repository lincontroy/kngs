<!-- resources/views/layouts/app.blade.php -->
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .account-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            color: white;
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            overflow: hidden;
        }
        
        .account-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.4);
        }
        
        .balance-amount {
            font-size: 2.2rem;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .status-verified {
            background-color: #4CAF50;
            color: white;
        }
        
        .status-pending {
            background-color: #FF9800;
            color: white;
        }
        
        .status-rejected {
            background-color: #F44336;
            color: white;
        }
        
        .type-basic {
            background-color: #FF9800;
            color: white;
        }
        
        .type-premium {
            background-color: #2196F3;
            color: white;
        }
        
        .type-vip {
            background-color: #9C27B0;
            color: white;
        }
        
        .status-badge {
            padding: 6px 14px;
            border-radius: 25px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        
        .account-detail-row {
            padding: 8px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .account-detail-row:last-child {
            border-bottom: none;
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            border: none;
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }
        
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        }
        
        .empty-state {
            padding: 80px 20px;
            text-align: center;
        }
        
        .empty-state i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 20px;
        }
        
        .stats-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    <i class="fas fa-chart-line me-2"></i>{{ config('app.name', 'Account Manager') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('accounts.*') ? 'active' : '' }}" href="{{ route('accounts.index') }}">
                                    <i class="fas fa-wallet me-1"></i> Accounts
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>