<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account - VayuShek AI</title>

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

        .register-wrapper {
            width: 100%;
            max-width: 1050px;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            display: grid;
            grid-template-columns: 42% 58%;
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
            padding: 45px 50px;
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

        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #374151;
            margin: 25px 0 15px;
        }

        .form-group {
            margin-bottom: 18px;
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
            padding: 12px 14px;
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
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
        }

        .register-btn {
            width: 100%;
            border: none;
            padding: 14px;
            border-radius: 9px;
            background: #4f46e5;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.2s;
        }

        .register-btn:hover {
            background: #4338ca;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #6b7280;
        }

        .login-link a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 800px) {
            .register-wrapper {
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

<div class="register-wrapper">

    <!-- LEFT SIDE -->

    <div class="brand-section">

        <div class="logo">
            Vayu<span>Shek</span> AI
        </div>

        <h1>
            Manage your entire business in one place.
        </h1>

        <p>
            Manage leads, clients, projects, invoices and payments
            with one powerful business management platform.
        </p>

        <div class="features">

            <div class="feature">
                <span class="check">✓</span>
                <span>Manage leads and clients</span>
            </div>

            <div class="feature">
                <span class="check">✓</span>
                <span>Track projects and tasks</span>
            </div>

            <div class="feature">
                <span class="check">✓</span>
                <span>Create quotations and invoices</span>
            </div>

            <div class="feature">
                <span class="check">✓</span>
                <span>AI-powered business insights</span>
            </div>

        </div>

    </div>


    <!-- RIGHT SIDE -->

    <div class="form-section">

        <div class="form-header">
            <h2>Create your account</h2>
            <p>Start managing your business with BizFlow AI.</p>
        </div>


        <form method="POST" action="{{ route('register.store') }}">

            @csrf


            <div class="section-title">
                Personal Information
            </div>

            <div class="form-group">

                <label for="name">
                    Full Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter your full name"
                >

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


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
                >

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimum 8 characters"
                >

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            <div class="form-group">

                <label for="password_confirmation">
                    Confirm Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirm your password"
                >

            </div>


            <div class="section-title">
                Company Information
            </div>


            <div class="form-group">

                <label for="company_name">
                    Company Name
                </label>

                <input
                    type="text"
                    id="company_name"
                    name="company_name"
                    value="{{ old('company_name') }}"
                    placeholder="Enter your company name"
                >

                @error('company_name')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            <div class="form-group">

                <label for="company_email">
                    Company Email
                </label>

                <input
                    type="email"
                    id="company_email"
                    name="company_email"
                    value="{{ old('company_email') }}"
                    placeholder="company@example.com"
                >

                @error('company_email')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            <div class="form-group">

                <label for="company_phone">
                    Company Phone
                </label>

                <input
                    type="text"
                    id="company_phone"
                    name="company_phone"
                    value="{{ old('company_phone') }}"
                    placeholder="+91 XXXXX XXXXX"
                >

                @error('company_phone')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            <button type="submit" class="register-btn">
                Create Account
            </button>

        </form>


        <div class="login-link">
            Already have an account?
            <a href="{{ route('login') }}">Sign in</a>
        </div>

    </div>

</div>

</body>
</html>