<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Dashboard') - BizFlow AI
    </title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #111827;
        }

        /* =========================
           LAYOUT
        ========================= */

        .app {
            min-height: 100vh;
            display: flex;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 250px;
            background: #111827;
            color: #ffffff;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
        }

        .logo {
            padding: 25px 22px;
            font-size: 23px;
            font-weight: 700;
            border-bottom: 1px solid #1f2937;
        }

        .logo span {
            color: #6366f1;
        }

        .navigation {
            padding: 20px 12px;
            flex: 1;
        }

        .nav-title {
            color: #6b7280;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 10px;
            margin-top: 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 12px;
            margin-bottom: 4px;
            border-radius: 8px;
            color: #d1d5db;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
        }

        .nav-link:hover {
            background: #1f2937;
            color: #ffffff;
        }

        .nav-link.active {
            background: #4f46e5;
            color: #ffffff;
        }

        /* =========================
           SIDEBAR FOOTER
        ========================= */

        .sidebar-footer {
            padding: 15px;
            border-top: 1px solid #1f2937;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
        }

        .user-details {
            overflow: hidden;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            color: #9ca3af;
            font-size: 11px;
            margin-top: 2px;
        }

        .logout-btn {
            width: 100%;
            border: none;
            background: #1f2937;
            color: #d1d5db;
            padding: 10px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 13px;
        }

        .logout-btn:hover {
            background: #dc2626;
            color: #ffffff;
        }

        /* =========================
           MAIN CONTENT
        ========================= */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        .topbar {
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .page-title {
            font-size: 20px;
            font-weight: 700;
        }

        .company-name {
            color: #6b7280;
            font-size: 13px;
        }

        .content {
            padding: 30px;
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 800px) {

            .sidebar {
                width: 70px;
            }

            .logo {
                font-size: 0;
                text-align: center;
            }

            .logo span {
                font-size: 20px;
            }

            .nav-link span {
                display: none;
            }

            .nav-title {
                display: none;
            }

            .user-details {
                display: none;
            }

            .logout-btn {
                font-size: 0;
            }

            .logout-btn::after {
                content: "↪";
                font-size: 18px;
            }

            .main {
                margin-left: 70px;
                width: calc(100% - 70px);
            }

            .content {
                padding: 20px;
            }

        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .topbar-user {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        .logout-btn {
            border: none;
            background: #ef4444;
            color: #ffffff;
            padding: 9px 15px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background: #dc2626;
        }
        
        .alert {
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 7px;
            font-size: 14px;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
    </style>

</head>


<body>

<div class="app">


    <!-- =========================
         SIDEBAR
    ========================== -->

    <aside class="sidebar">

        <div class="logo">
            Biz<span>Flow</span> AI
        </div>


        <nav class="navigation">

            <div class="nav-title">
                Main
            </div>

            <a
                href="{{ route('dashboard') }}"
                class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >
                📊
                <span>Dashboard</span>
            </a>


            <div class="nav-title">
                CRM
            </div>

            <a href="{{ route('leads.index') }}" class="nav-link {{ request()->routeIs('leads.*') ? 'active':'' }}">
                👤
                <span>Leads</span>
            </a>

            <a href="{{ route('clients.index') }}" class="nav-link {{ request()->routeIs('clients.*') ? 'active':'' }}">
                🤝
                <span>Clients</span>
            </a>


            <div class="nav-title">
                Management
            </div>

            <a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.*') ? 'active':'' }}">
                📁
                <span>Projects</span>
            </a>

            <a href="#" class="nav-link">
                ✓
                <span>Tasks</span>
            </a>

            <a href="#" class="nav-link">
                👥
                <span>Team</span>
            </a>


            <div class="nav-title">
                Finance
            </div>

            <a href="#" class="nav-link">
                📝
                <span>Quotations</span>
            </a>

            <a href="#" class="nav-link">
                🧾
                <span>Invoices</span>
            </a>

            <a href="#" class="nav-link">
                💳
                <span>Payments</span>
            </a>


            <div class="nav-title">
                System
            </div>

            <a href="#" class="nav-link">
                📊
                <span>Reports</span>
            </a>

            <a href="#" class="nav-link">
                ⚙️
                <span>Settings</span>
            </a>

        </nav>


        <!-- SIDEBAR FOOTER -->

        <div class="sidebar-footer">

            <div class="user-info">

                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="user-details">

                    <div class="user-name">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="user-role">
                        {{ auth()->user()->role && auth()->user()->role->name ? auth()->user()->role->name : 'N/A' }}
                    </div>

                </div>

            </div>


            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-btn"
                >
                    Logout
                </button>

            </form>

        </div>

    </aside>


    <!-- =========================
         MAIN
    ========================== -->

    <main class="main">

        <header class="topbar">

            <div class="page-title">
                @yield('page-title', 'Dashboard')
            </div>

            <div class="topbar-right">

                <div class="company-name">
                    {{ auth()->user()->company->name }}
                </div>

                <div class="topbar-user">
                    {{ auth()->user()->name }}
                </div>

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button type="submit" class="logout-btn">
                        🚪 Logout
                    </button>

                </form>

            </div>

        </header>


        <section class="content">
            @if ($errors->any())
                <div style="background:#fee2e2; padding:15px; margin-bottom:20px;">
                    <strong>Validation Errors:</strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @yield('content')

        </section>

    </main>

</div>

</body>

</html>