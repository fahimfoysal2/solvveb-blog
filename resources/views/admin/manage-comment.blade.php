@extends('layouts._adminLayout')
@section('title', 'Admin - Comments')

@section('main-content')

    {{-- Edit Data Modal --}}
    <div class="modal fade" id="updateComment" tabindex="-2" role="dialog"
         aria-labelledby="updateComment" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateComment_title">Comment Manager</h5>
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
                            <label for="comment_text" class="col col-form-label">Comment Text</label>
                            <div class="col-10">
                                <textarea class="form-control"
                                          id="update_comment_text"
                                          rows="3" name="comment_text" value="{{ old('comment_name') }}">
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comment_status" class="col col-form-label">comment Status</label>
                            <div class="col-10">
                                <select class="form-control custom-select"
                                        id="update_comment_status"
                                        name="comment_status">
                                    <option selected value="1">Published</option>
                                    <option value="0">In Review</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="updatecomment_submit" form="update-item">Save
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
                        <h3 class="mb-1 text-gray-800">Comments for Blog Post</h3>
                        <p class="mb-0">Approve or delete Comments.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col">
                        <h3>Submitted Comments</h3>
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
                            <table id="comments_dataTable"
                                   class="table table-bordered table-striped w-100 comments_dataTable"
                                   cellspacing="0">
                                <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Post</td>
                                    <td>Status</td>
                                    <td>Comment Text</td>
                                    <td>User</td>
                                    <td>Created</td>
                                    <td>Action</td>
                                </tr>
                                </thead>

                                <tbody>
                                </tbody>

                                <tfoot>
                                <tr>
                                    <td>No.</td>
                                    <td>Post</td>
                                    <td>Status</td>
                                    <td>Comment Text</td>
                                    <td>User</td>
                                    <td>Created</td>
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
            var table = $('#comments_dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('jsonComment') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'post', name: 'post'},
                    {data: 'comment_status', name: 'comment_status'},
                    {data: 'comment_text', name: 'comment_text'},
                    {data: 'user_email', name: 'user_email'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });
        });

        // delete data
        $(document).on('click', '.delete', function () {
            var id = $(this).data('id');

            var url = "{{ route('comments.destroy',':id') }}";
            url = url.replace(':id', id);

            var confirmation = confirm('Delete this Comment?');
            if (confirmation) {
                $.ajax({
                    url: url,
                    method: "Delete",
                    success: function (data) {
                        // alert(data);
                        make_alert('success');
                        $('.response_alert_list').append('<li>' + data + '</li>');
                        $('#comments_dataTable').DataTable().ajax.reload();
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
            let url = "{{route('comments.show', ':id')}}";
            url = url.replace(':id', id_toUpdate);

            $.ajax({
                url: url,
                method: 'get',
                dataType: 'json',
                success: function (data) {
                    $('#update_id').val(data.id);
                    $('#update_comment_text').val(data.comment_text);
                    if (data.comment_status === 'published') {
                        $('#update_comment_status option')[0].selected = true;
                    } else {
                        $('#update_comment_status option')[1].selected = true;
                    }
                },
                error: function (data) {
                    console.log(data);
                }

            })
            $('#updateComment').modal('show');
        });

        $('#update-item').on('submit', function (event) {
            event.preventDefault();

            var formData = $(this).serialize();

            let url = "{{route('comments.update', ':id')}}";
            url = url.replace(':id', id_toUpdate);

            $.ajax({
                url: url,
                method: 'Patch',
                data: formData,
                dataType: 'json',
                success: function (data) {
                    $('#updateComment').modal('hide');
                    make_alert('success');
                    $('.response_alert_list').append('<li>Data Updated.</li>');

                    $('#comments_dataTable').DataTable().ajax.reload();
                    $('#comments_dataTable').DataTable().ajax.reload();
                },
                error: function (data) {
                    console.log(data);
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
