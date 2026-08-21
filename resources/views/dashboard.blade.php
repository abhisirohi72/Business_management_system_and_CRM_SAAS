@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('content')
<div class="welcome">

        <h1>
            Welcome, {{ auth()->user()->name }} 👋
        </h1>

        <p>
            Here's what's happening with your business today.
        </p>

    </div>


    <div class="cards">

        <div class="card">

            <div class="card-title">
                Company
            </div>

            <div class="card-value">
                {{ auth()->user()->company->name }}
            </div>

        </div>


        <div class="card">

            <div class="card-title">
                Your Role
            </div>

            <div class="card-value">
                {{ auth()->user()->role && auth()->user()->role->name  ? auth()->user()->role->name : 'N/A' }}
            </div>

        </div>


        <div class="card">

            <div class="card-title">
                Email
            </div>

            <div class="card-value">
                {{ auth()->user()->email }}
            </div>

        </div>

    </div>


    <style>

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h1 {
            font-size: 26px;
            margin-bottom: 8px;
        }

        .welcome p {
            color: #6b7280;
            font-size: 14px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .card-title {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .card-value {
            color: #111827;
            font-size: 20px;
            font-weight: 700;
        }

        @media (max-width: 800px) {

            .cards {
                grid-template-columns: 1fr;
            }

        }

    </style>
@endsection