@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">View All</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create New Role</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="col-ld-6 col-md-6 col-sm-6">
                                <label for="name">Role Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </form>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
@endsection
