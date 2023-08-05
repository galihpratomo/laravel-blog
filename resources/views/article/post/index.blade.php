@extends('layouts.app')

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('theme/css/data-table/bootstrap-table.css') }}">
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
@endsection

@section('content')

<div class="data-table-area mg-tb-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1> <span class="table-project-n">{{ $title }}</span> </h1>
                            <div class="add-product">
                                <a href="#" onclick="create()">Add</a>
                            </div>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                                <ul class="nav nav-tabs custom-menu-wrap custon-tab-menu-style1">
                                    <li class="active">
                                        <a data-toggle="tab" data-id="All" id="status_tab" href="#TabProject" aria-expanded="true"><span class="adminpro-icon adminpro-analytics tab-custon-ic"></span>All</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" data-id="Publish" id="status_tab" href="#TabDetails" aria-expanded="false"><span class="adminpro-icon adminpro-analytics-arrow tab-custon-ic"></span>Publish</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" data-id="Draft" id="status_tab"  href="#TabDetails" aria-expanded="false"><span class="adminpro-icon adminpro-analytics-arrow tab-custon-ic"></span>Draft</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" data-id="Thrash" id="status_tab"  href="#TabPlan" aria-expanded="false"><span class="adminpro-icon adminpro-analytics-bridge tab-custon-ic"></span>Thrash</a>
                                    </li>
                                </ul>
                                <input type="hidden" name="status" id="status" value="All"/>
                                <br>
                                <table class="table table-hover" id="table-article-post">
                                    <thead>
                                        <tr>
                                            <th class='no-sort text-center' >No</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Category</th>
                                            <th class='no-sort text-center'>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    </tbody>
                                </table>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('script')
<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

<script> 
    $(function () {
        table      = $('#table-article-post').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        aaSorting : [[ 1, "desc" ]],
        ajax: {
            "url"       : "{{ route ('article-post.json') }}",
            'method'	: 'POST',
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "data" : function (d) {
                d.status    = $('#status').val();
            }
        },
        columns: [
            { "data": null,"sortable": false, 
                   render: function (data, type, row, meta) {
                             return meta.row + meta.settings._iDisplayStart + 1;
                            }  
            },
            {data:"title"},
            {data:"category"},
            {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
        ],
        columnDefs : [
            {
                "targets"       : '_all',
                "createdCell"   : function (td, cellData, rowData, row, col) {
                                        $(td).css('padding', '5px')
                                    }
            },
            {
                "targets"       : [3], // your case first column
                "className"     : "text-center",
            },
        ],

        });

        $(document).on("click", "#status_tab", function () {
            $('#status').val($(this).data('id'));
            table.draw();
        });

    });
</script>
<script type="text/javascript">
    function reload_table() {
        table.ajax.reload(null, false);
    }
    function create() {
        $("#modal_data").empty();
        $('.modal-title').text('Add {{ $title }}'); 

        $.ajax({
            type: 'GET',
            url : 'article-post/create',
            success: function (data) {
                $("#modal_data").html(data.html);
                $('#myModal').modal('show'); 
            },
            error: function (result) {
                $("#modal_data").html("Sorry Cannot Load Data");
            }
        });
    }

    $("#table-article-post").on("click", ".edit", function () {

        $("#modal_data").empty();
        $('.modal-title').text('Edit {{ $title }}'); 

        var id = $(this).attr('id');

        $.ajax({
            url: 'article-post/' + id + '/edit',
            type: 'get',
            success: function (data) {
                $("#modal_data").html(data.html);
                $('#myModal').modal('show'); 
            },
            error: function (result) {
                $("#modal_data").html("Sorry Cannot Load Data");
            }
        });
    });

    $("#table-article-post").on("click", ".delete", function () {
        var CSRF_TOKEN  = $('meta[name="csrf-token"]').attr('content');
        var id          = $(this).attr('id');
        
        swal({
            title   : "Are you sure",
            text    : "Deleted data cannot be recovered!!",
            type    : "warning",
            showCancelButton    : true,
            closeOnConfirm      : false,
            showLoaderOnConfirm : true,
            confirmButtonClass  : "btn-danger",
            confirmButtonText   : "Delete",
            cancelButtonText    : "Cancel"
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url     : 'article-post/' + id,
                    data    : {"_token": CSRF_TOKEN, _method: 'delete'},
                    type    : 'post',
                    dataType: 'json',
                    success : function (data) {

                        if (data.type === 'success') {
                            swal("Done!", "Successfully Deleted", "success");
                            reload_table();

                        } else if (data.type === 'error') {
                            swal("Error deleting!", "Try again", "error");
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error deleting!", "Try again", "error");
                    }
                });
            }
        });
    });
</script>
@endsection
