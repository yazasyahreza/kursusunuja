@extends('administrator.layouts.app')

@section('this-page-style')
    <style>
        .modern-card {
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            margin-bottom: 25px;
        }

        .modern-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .card-header-img {
            position: relative;
            height: 150px;
            background: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .card-header-img img {
            max-height: 100%;
            max-width: 100%;
            object-fit: cover;
            border-radius: 0;
        }

        .course-title-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(180deg, transparent, rgba(0, 0, 0, 0.65));
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            padding: 10px;
            text-align: left;
        }

        .card-body-info {
            padding: 15px 18px;
            text-align: center;
        }

        .instructor-name {
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
            color: #333;
        }

        .instructor-field {
            font-size: 0.9rem;
            color: #777;
            margin-top: 4px;
            margin-bottom: 14px;
        }

        .btn-join {
            display: inline-block;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            font-weight: 500;
            padding: 8px 20px;
            border-radius: 50px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .btn-join:hover {
            background: linear-gradient(135deg, #5a67d8, #6b46c1);
            color: #fff;
            text-decoration-line: none;
        }
    </style>
@endsection

@section('this-page-content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Kursus</strong> View</h1>

        <div class="row" id="container-kursus">
            {{-- tampilan card kursus akan ada didalam ini --}}
        </div>
    </div>
@endsection

@section('this-page-scripts')
    @include('administrator.kursus.scripts.card')
@endsection
