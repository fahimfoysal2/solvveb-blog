@extends('layouts._adminLayout')
@section('title', 'Admin - Category')

@section('main-content')

    {{-- Edit Data Modal --}}
    <div class="modal fade" id="updateCategory" tabindex="-2" role="dialog"
         aria-labelledby="updateCategory" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCategory_title">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{--  modal body with form to submit  --}}
                <div class="modal-body">

                    <form id="update-item" autocomplete="off">
                        @csrf

                        <input type="hidden" id="update_id" name="id" value="">

                        <div class="form-group row">
                            <label for="category_name" class="col col-form-label">Category Name</label>
                            <div class="col-10">
                                <input type="text" required placeholder="Category Name" class="form-control"
                                       id="update_category_name"
                                       name="category_name" autocomplete="off"
                                       value="{{ old('category_name') }}"
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category_status" class="col col-form-label">Category Status</label>
                            <div class="col-10">
                                <select class="form-control custom-select"
                                        id="update_category_status"
                                        name="category_status">
                                    <option selected value="1">Active</option>
                                    <option value="0">Paused</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="updateCategory_submit" form="update-item">Save
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
            <div class="col-12 col-md-6">
                <div class="card mb-4 border-left-info">
                    <div class="card-body">
                        <h3 class="mb-1 text-gray-800">Blog Post Categories</h3>
                        <p class="mb-0">Manage or create blog post category here.</p>
                    </div>
                </div>
            </div>

            {{-- New Category Form --}}
            <div class="col-12 col-md-6">
                <div class="card mb-4 border-left-danger">
                    <div class="card-body py-3">
                        <h5 class="mb-1 text-primary">Create New Category</h5>

                        <form id="create-category" class="form-inline" autocomplete="off">
                            @csrf

                            <label class="sr-only" for="inlineFormInputName2">Category Name</label>
                            <input
                                required
                                type="text"
                                value="{{old('category_name')}}"
                                class="form-control mb-2 mr-sm-2"
                                id="category_name"
                                placeholder="Category Name"
                                name="category_name">

                            <label class="sr-only" for="inlineFormCustomSelectPref">Status</label>
                            <select class="form-control custom-select mr-sm-2 mb-2"
                                    id="inlineFormCustomSelectPref"
                                    name="category_status">
                                <option selected value="1">Active</option>
                                <option value="0">Paused</option>
                            </select>

                            <button type="submit" class="btn btn-primary mb-2">Create</button>
                        </form>
                        {{--or success messages--}}
                        <x-session-alert/>

                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col">
                        <h3>Available Categories</h3>
                    </div>

                    <div class="col">
                        {{-- show errors --}}
                        <div id="response_alert"></div>
                    </div>

                </div>

                {{-- Table to show data --}}
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="category_dataTable"
                                   class="table table-bordered table-striped w-100 category_dataTable"
                                   cellspacing="0">
                                <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Category Name</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                                </thead>

                                <tbody>
                                </tbody>

                                <tfoot>
                                <tr>
                                    <td>No.</td>
                                    <td>Category Name</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
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
            var table = $('#category_dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getCategories') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'category_name', name: 'category_name'},
                    {data: 'category_status', name: 'category_status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });
        });

        // create new data
        $('#create-category').on('submit', function (event) {
            event.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{route('categories.store')}}",
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    make_alert('success');
                    $('.response_alert_list').append('<li>' + data + '</li>');
                    $('#category_dataTable').DataTable().ajax.reload();
                },
                error: function (error_data) {
                    let errors = error_data.responseJSON;
                    make_alert('error');
                    $.each(errors['errors'], function (index, value) {
                        $('.response_alert_list').append('<li>' + value + '</li>');
                    });
                }
            });
        });

        // delete data
        $(document).on('click', '.delete', function () {
            var id = $(this).data('id');

            var url = "{{ route('categories.destroy',':id') }}";
            url = url.replace(':id', id);

            var confirmation = confirm('Delete this category?');
            if (confirmation) {
                $.ajax({
                    url: url,
                    method: "Delete",
                    success: function (data) {
                        // alert(data);
                        make_alert('success');
                        $('.response_alert_list').append('<li>' + data + '</li>');
                        $('#category_dataTable').DataTable().ajax.reload();
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
            let url = "{{route('categories.show', ':id')}}";
            url = url.replace(':id', id_toUpdate);

            $.ajax({
                url: url,
                method: 'get',
                dataType: 'json',
                success: function (data) {
                    $('#update_id').val(data.id);
                    $('#update_category_name').val(data.category_name);
                    if (data.category_status === 'active') {
                        $('#update_category_status option')[0].selected = true;
                    } else {
                        $('#update_category_status option')[1].selected = true;
                    }
                },
                error: function (data) {
                    console.log(data);
                }

            })
            $('#updateCategory').modal('show');
        });

        $('#update-item').on('submit', function (event) {
            event.preventDefault();

            var formData = $(this).serialize();

            let url = "{{route('categories.update', ':id')}}";
            url = url.replace(':id', id_toUpdate);

            $.ajax({
                url: url,
                method: 'Patch',
                data: formData,
                dataType: 'json',
                success: function (data) {
                    $('#updateCategory').modal('hide');
                    make_alert('success');
                    $('.response_alert_list').append('<li>Data Updated.</li>');

                    $('#category_dataTable').DataTable().ajax.reload();
                    $('#category_dataTable').DataTable().ajax.reload();
                },
                error: function (data) {
                    // console.log(data);
                    alert("Error updating data!")
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
