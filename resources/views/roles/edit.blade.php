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
                        <h1>Edit Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">View All</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <form action="{{ route('roles.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Role</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="col-ld-6 col-md-6 col-sm-6">
                                <label for="name">Role Name</label>
                                <input type="text" name="name" value="{{ old('name', $data->name) }}"
                                    class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </form>
        </section>
        <!-- /.content -->

        <!-- Permission content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <form action="{{ route('roles.update.permissions', $data->id) }}" method="POST"
                    id="permissionsForm">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Assign Permissions To This Role</h3>
                        </div>
                        <div class="card-body">
                            <table id="dataList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5%" class="text-center">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="selectAll">
                                                <label for="selectAll"></label>
                                            </div>
                                        </th>
                                        <th>Permission Name</th>
                                        <th style="width: 10%" class="text-center">Authentication</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td class="text-center">
                                                <div class="icheck-success d-inline">
                                                    <input type="checkbox"
                                                        id="permissionCheckBox-{{ $data->id }}-{{ $permission->name }}"
                                                        @if ($data->permissions->contains('name', $permission->name)) checked @endif>
                                                    <label
                                                        for="permissionCheckBox-{{ $data->id }}-{{ $permission->name }}"></label>
                                                </div>
                                            </td>
                                            <td>{{ $permission->name }}</td>
                                            <td class="text-center">{{ ucwords($permission->guard_name) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- /.card-body --}}
                        <div class="card-footer">
                            <button type="submit" name="savePermissions" class="btn btn-primary">Save Permissions</button>
                        </div>
                        {{-- /.card-footer --}}
                    </div>
                    <!-- /.card -->
                </form>
            </div>
            {{-- /.container-fluid --}}
        </section>
        <!-- /.Permission content -->

    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
    <script>
        // JavaScript to handle "Select All" functionality
        const selectAllCheckbox = document.getElementById('selectAll');
        const permissionCheckboxes = document.querySelectorAll('input[type="checkbox"][id^="permissionCheckBox"]');

        selectAllCheckbox.addEventListener('change', () => {
            const isChecked = selectAllCheckbox.checked;

            permissionCheckboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        // JavaScript to handle form submission
        const form = document.getElementById('permissionsForm');

        form.addEventListener('submit', (event) => {
            event.preventDefault();

            const selectedPermissions = [];

            permissionCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const permissionName = checkbox.id.split('-').slice(2).join(
                        '-'); // Extract permission name
                    selectedPermissions.push(permissionName);
                }
            });

            // Add selected permissions to a hidden input field for submission
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'permissions';
            hiddenInput.value = JSON.stringify(selectedPermissions);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        });
    </script>
@endsection
