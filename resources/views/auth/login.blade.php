<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - BizFlow AI</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1000px;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            display: grid;
            grid-template-columns: 45% 55%;
        }

        /* LEFT SIDE */

        .brand-section {
            background: #111827;
            color: #ffffff;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 35px;
        }

        .logo span {
            color: #6366f1;
        }

        .brand-section h1 {
            font-size: 38px;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .brand-section p {
            color: #cbd5e1;
            line-height: 1.7;
            font-size: 15px;
        }

        .features {
            margin-top: 35px;
        }

        .feature {
            display: flex;
            gap: 12px;
            margin-bottom: 18px;
            color: #e5e7eb;
            font-size: 14px;
        }

        .check {
            color: #818cf8;
            font-weight: bold;
        }

        /* RIGHT SIDE */

        .form-section {
            padding: 55px 50px;
        }

        .form-header {
            margin-bottom: 30px;
        }

        .form-header h2 {
            font-size: 28px;
            color: #111827;
            margin-bottom: 8px;
        }

        .form-header p {
            color: #6b7280;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .login-btn {
            width: 100%;
            border: none;
            padding: 14px;
            border-radius: 9px;
            background: #4f46e5;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 5px;
            transition: 0.2s;
        }

        .login-btn:hover {
            background: #4338ca;
        }

        .register-link {
            text-align: center;
            margin-top: 22px;
            font-size: 13px;
            color: #6b7280;
        }

        .register-link a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 800px) {
            .login-wrapper {
                grid-template-columns: 1fr;
            }

            .brand-section {
                display: none;
            }

            .form-section {
                padding: 35px 25px;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <!-- LEFT SIDE -->

    <div class="brand-section">

        <div class="logo">
            Biz<span>Flow</span> AI
        </div>

        <h1>
            Welcome back.
        </h1>

        <p>
            Manage your leads, clients, projects, invoices and
            business operations from one powerful platform.
        </p>

        <div class="features">

            <div class="feature">
                <span class="check">✓</span>
                <span>Manage your clients</span>
            </div>

            <div class="feature">
                <span class="check">✓</span>
                <span>Track projects and tasks</span>
            </div>

            <div class="feature">
                <span class="check">✓</span>
                <span>Manage invoices and payments</span>
            </div>

            <div class="feature">
                <span class="check">✓</span>
                <span>Get AI-powered business insights</span>
            </div>

        </div>

    </div>


    <!-- RIGHT SIDE -->

    <div class="form-section">

        <div class="form-header">
            <h2>Sign in</h2>

            <p>
                Enter your credentials to access your account.
            </p>
        </div>


        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif


        <form method="POST" action="{{ route('login.store') }}">

            @csrf

            <div class="form-group">

                <label for="email">
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="you@example.com"
                    required
                    value="abhisirohi72@gmail.com"
                >

            </div>


            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                    value="password123"
                >

            </div>


            <button
                type="submit"
                class="login-btn"
            >
                Sign In
            </button>

        </form>


        <div class="register-link">

            Don't have an account?

            <a href="{{ route('register') }}">
                Create Account
            </a>

        </div>

    </div>

</div>

</body>
</html>