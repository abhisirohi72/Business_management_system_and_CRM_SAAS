@extends('layouts.app')

@section('content')

<div style="padding: 60px; text-align: center;">

    <h1 style="font-size: 60px; margin: 0;">
        404
    </h1>

    <h2>Page Not Found</h2>

    <p>
        The page or resource you are looking for could not be found.
    </p>

    <a
        href="{{ route('dashboard') }}"
        style="
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            background: #2563eb;
            color: #fff;
            border-radius: 7px;
            text-decoration: none;
        "
    >
        Go to Dashboard
    </a>

</div>

@endsection