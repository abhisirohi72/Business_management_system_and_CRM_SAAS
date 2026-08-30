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
@vite(['resources/css/app.css', 'resources/js/app.js'])
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

            <a href="{{ route('tasks.index') }}" class="nav-link {{ request()->routeIs('tasks.*') ? 'active':'' }}">
                ✓
                <span>Tasks</span>
            </a>

            <a href="{{ route('teams.index') }}" class="nav-link {{ request()->routeIs('teams.*')  ? 'active':'' }}">
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
                <div class="validation-error">
                    <div class="validation-error-title">
                        <span class="error-icon">!</span>
                        <span>Please fix the following errors:</span>
                    </div>

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