@extends('layouts._adminLayout')
@section('title', 'Admin - Users')

@section('page-level-stylesheets')
    <!-- Custom styles for this page -->
    <link href="{{Asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('main-content')

    {{-- Edit Data Modal --}}
    <div class="modal fade" id="updateUser" tabindex="-2" role="dialog"
         aria-labelledby="updateUser" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUser_title">Update User Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--                modal body with form to submit  --}}
                <div class="modal-body">

                    <form id="update-item" autocomplete="off">
                        @csrf

                        <input type="hidden" id="update_id" name="id" value="">

                        <div class="form-group row">
                            <label for="name" class="col col-form-label">User Name</label>
                            <div class="col-10">
                                <input type="text" required placeholder="User Name" class="form-control"
                                       id="update_name"
                                       name="name" autocomplete="off"
                                       value="{{ old('name') }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col col-form-label">Email</label>
                            <div class="col-10">
                                <input type="email" required placeholder="Email" class="form-control"
                                       id="update_email"
                                       name="email" autocomplete="off"
                                       value="{{ old('email') }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_type" class="col col-form-label">User Role</label>
                            <div class="col-10">
                                <select class="form-control custom-select"
                                        id="update_user_type"
                                        name="user_type">
                                    <option selected value="1">Admin</option>
                                    <option value="0">Guest</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col col-form-label">Pass word</label>
                            <div class="col-10">
                                <input type="password" placeholder="Password" class="form-control"
                                       id="update_password"
                                       name="password" autocomplete="off"
                                >
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="updateUser_submit" form="update-item">Save
                        changes
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{--    modal end --}}


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">
            <!-- Page Heading -->
            <div class="col">
                <h1 class="h3 mb-2 text-gray-800">User Management</h1>
                <p class="mb-4">All users and their roles are listed here.</p>
            </div>

            <div class="col">
                {{-- show response messages --}}
                <div id="response_alert"></div>
            </div>
        </div>

        <!-- Users Listing -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="user_dataTable"
                           class="table table-bordered user_dataTable" width="100%"
                           cellspacing="0">
                        <thead>
                        <tr>
                            <th>NO.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>NO.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('page-level-scripts')
    <script type="text/javascript">
        // setup csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // initialize table
        $(function () {
            var table = $('#user_dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('jsonUserList') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'user_type', name: 'role'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });
        });

        // delete data
        $(document).on('click', '.delete', function () {
            var id = $(this).data('id');

            var url = "{{ route('users.destroy',':id') }}";
            url = url.replace(':id', id);

            var confirmation = confirm('Confirm if you really want to remove this user..');
            if (confirmation) {
                $.ajax({
                    url: url,
                    method: "Delete",
                    success: function (data) {
                        if (data.toString().includes('error')) {
                            make_alert('error');
                        } else {
                            make_alert('success');
                        }
                        // alert(data);
                        $('.response_alert_list').append('<li>' + data + '</li>');
                        $('#user_dataTable').DataTable().ajax.reload();
                    },
                    error: function (data) {
                        make_alert('error');
                        $('.response_alert_list').append('<li>' + data + '</li>');
                    }
                });
            }
            // console.log(id);
        });


        // edit data
        // Modal Creator for Data Update
        var id_toUpdate = '';
        $(document).on('click', '.edit', function () {
            id_toUpdate = $(this).data('id');
            let url = "{{route('users.show', ':id')}}";
            url = url.replace(':id', id_toUpdate);

            $.ajax({
                url: url,
                method: 'get',
                dataType: 'json',
                success: function (data) {
                    $('#update_id').val(data.id);
                    $('#update_name').val(data.name);
                    $('#update_email').val(data.email);
                    if (data.user_type === 'admin') {
                        $('#update_user_type option')[0].selected = true;
                    } else {
                        $('#update_user_type option')[1].selected = true;
                    }
                },
                error: function (data) {
                    console.log(data);
                }

            })
            $('#updateUser').modal('show');
        });
        // Now Update the data
        $('#update-item').on('submit', function (event) {
            event.preventDefault();

            var formData = $(this).serialize();

            let url = "{{route('users.update', ':id')}}";
            url = url.replace(':id', id_toUpdate);

            $.ajax({
                url: url,
                method: 'Patch',
                data: formData,
                dataType: 'json',
                success: function (data) {
                    if (data.toString().includes('error')) {
                        alert(data);
                    } else {
                        $('#updateUser').modal('hide');
                        make_alert('success');
                        $('.response_alert_list').append('<li>User Data Updated.</li>');
                        $('#user_dataTable').DataTable().ajax.reload();
                    }
                },
                error: function (data) {
                    alert(data.responseJSON.message);
                }
            });
        });

        // make alert
        function make_alert(type) {
            type = (type === 'error') ? 'danger' : 'success';
            $('#response_alert').append(`<div class="alert alert-${type} alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><ul class="p-0 m-0 response_alert_list" style="list-style: none;"></ul></div>`);
        }

    </script>
@endsection


