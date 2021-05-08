@extends('layouts._adminLayout')
@section('title', 'Admin - Blog Posts')

@section('page-level-stylesheets')
    <!-- Custom styles for this page -->
    <link href="{{Asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('main-content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-2 text-gray-800">Manage Blog Posts</h1>
                <p class="mb-4">All blog posts are listed here.</p>
            </div>

            <div class="col">
                {{-- show errors --}}
                <div id="response_alert"></div>
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Blog Post Listing -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Blog Post from database</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="posts_dataTable"
                           class="table table-bordered table-striped posts_dataTable" width="100%"
                           cellspacing="0">
                        <thead>
                        <tr>
                            <th>NO.</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Posted</th>
                            <th>Author</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                        <tr>
                            <th>NO.</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Posted</th>
                            <th>Author</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
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
            var table = $('#posts_dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('jsonPostList') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'title', name: 'title'},
                    {data: 'category', name: 'category'},
                    {data: 'status', name: 'status'},
                    {data: 'posted', name: 'posted'},
                    {data: 'author', name: 'author'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });
        });

        // delete data
        $(document).on('click', '.delete', function () {
            var id = $(this).data('id');

            var url = "{{ route('posts.destroy',':id') }}";
            url = url.replace(':id', id);

            var confirmation = confirm('Really Delete this Post?');
            if (confirmation) {
                $.ajax({
                    url: url,
                    method: "Delete",
                    success: function (data) {
                        // alert(data);
                        make_alert('success');
                        $('.response_alert_list').append('<li>' + data + '</li>');
                        $('#posts_dataTable').DataTable().ajax.reload();
                    },
                    error: function (data) {
                        make_alert('error');
                        $('.response_alert_list').append('<li>' + data + '</li>');
                    }
                });
            }
            // console.log(id);
        });

        // make alert
        function make_alert(type) {
            type = (type === 'error') ? 'danger' : 'success';
            $('#response_alert').append(`<div class="alert alert-${type} alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><ul class="p-0 m-0 response_alert_list" style="list-style: none;"></ul></div>`);
        }

    </script>
@endsection
