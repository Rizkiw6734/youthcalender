@extends('layouts.admin')

@section('content')
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Dashboard Admin</span>
        <a href="{{ route('admin.logout') }}" class="btn btn-danger">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h3>Selamat Datang, {{ session('admin_username') }}</h3>
    <p>Ini dashboard admin untuk mengelola artikel kalender.</p>
</div>

@endsection


