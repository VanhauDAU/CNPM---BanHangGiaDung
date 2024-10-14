@extends('layouts.admin')
@section('stylesheet')
<style>

    .access-denied-container {
        background-color: white;
        padding: 40px;
        text-align: center;
    }

    .access-denied-container h1 {
        font-size: 2.5rem;
        color: #e74c3c;
        margin-bottom: 20px;
    }

    .access-denied-container p {
        font-size: 1.2rem;
        margin-bottom: 30px;
    }

    .access-denied-container a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #3498db;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    .access-denied-container a:hover {
        background-color: #2980b9;
    }
</style>
@endsection
    
@section('content-admin')
<div class="access-denied-container">
    <h1>Bạn không có quyền truy cập</h1>
    <p>Xin lỗi, bạn không có quyền để truy cập trang này.</p>
</div>
@endsection