@extends('carparkdashboard-base::layout')
@section('title', 'Lot')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('page')
    <link rel="stylesheet" type="text/css" href="{{asset('css/lot/style.css')}}">
        <div class="modal fade modal-confirm-delete" id="myModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title"><i class="til_img"></i><strong>Xóa bản ghi</strong></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <form action="" method="get">
                            <div class="modal-body with-padding">
                                <div>Bạn có muốn xóa bản ghi này?</div>
                            </div>
                        {{csrf_field()}}
                        <div class="modal-footer">
                                <button class="float-left btn btn-warning" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="float-right btn btn-danger delete-crud-entry">Delete</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <form class="form-inline">
                                        <div class="col-md-2 form-group">
                                            <label>Tên</label>
                                            <input type="text" class="form-control" id="namelot" name="namelot" value="">
                                         </div>
                                         <div class="col-md-2 form-group">
                                            <label>Phân loại</label>
                                            <select class="form-control" id="type" name="type">
                                                <option value="0">Tất cả</option>
                                                <option value="1">Camera</option>
                                                <option value="2">Cảm biến</option>
                                            </select>
                                         </div>
                                         <div class="col-md-3 form-group">
                                            <button type="button" class="btn btn-primary btn-flat btn-search" id="btnSearch"><i class="fa fa-search"></i>Lọc</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 form-group" style="margin-top: 15px;">
                                        <b id="sumLotNotAviable"></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <table class="table table-striped" id="listLot">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên</th>
                                            <th>Bãi giữ xe</th>
                                            <th>Camera</th>
                                            <th>Cảm biến</th>
                                            <th>Overlap</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <link rel="stylesheet" href="/css/datatable/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="/css/datatable/jquery.dataTables.min.css">
        <link rel="stylesheet" href="/css/datatable/buttons.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/css/toastr/toastr.css">
        <script src="/js/datatable/jquery.dataTables.min.js"></script>
        <script src="/js/datatable/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="/js/datatable/jszip.min.js"></script>
        <script src="/js/datatable/buttons.html5.min.js"></script>
        <script src="/js/datatable/dataTables.bootstrap.min.js"></script>
        <script src="/vendor/datatables/buttons.server-side.js"></script>
        <script src="/js/toastr/toastr.min.js"></script>
        <script type="text/javascript">
            $(function () {
                var table;
                loadLot();
            });

            function loadLot()
            {
                var countLotNotAviable = 0;
                table = $('#listLot').DataTable({
                    "destroy": true,
                    "bInfo" : true,
                    "bLengthChange": false,
                    "searching": false,
                    "paging": true,
                    "pageLength": 10,
                    processing: true,
                    serverSide: true,
                    "autoWidth": false,
                    keys: true,
                    select: true,
                    order: [[1, 'desc']],
                    "language": {
                        "info": '<span class="dt-length-records"><i class="fa fa-globe"></i><span class="d-none d-sm-inline">Hiển thị </span>_START_ đến _END_ trong<span class="badge badge-secondary bold badge-dt">_TOTAL_</span> bản ghi</span>'
                    },
                    "ajax":{
                        url: "http://localhost:8000/lot/filter",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "namelot": $('#namelot').val(),
                            "type" : $('#type').val(),
                        }
                    },
                    "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull
                ) {
                        if(aData[6] == "1")
                        {
                            $("td:eq(6)", nRow).html('<span class="label-danger status-label">Có xe</span>');
                            countLotNotAviable ++;
                        }
                        if(aData[6] == "2")
                            $("td:eq(6)", nRow).html('<span class="label-warning status-label">Khởi tạo</span>');
                        if(aData[6] == "0")
                            $("td:eq(6)", nRow).html('<span class="label-success status-label">Không có xe</span>');

                        var str = "Có " + countLotNotAviable + " vị trí có xe";
                        $("#sumLotNotAviable").text(str);
                    }
                });
            }
            $("#btnSearch").click(function(e) {
                loadLot();
            });
        </script>
        <script>
            @if(Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}";
                switch(type){
                    case 'info':
                        toastr.info("{{ Session::get('message') }}");
                        break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
                }
            @endif
        </script>
        <script>
            $(function() {
                $('#listLot').on('click', '.deleteDialog', function (e) {
                    e.preventDefault();
                    var url = '{{ url("/lot/destroy", ":id") }}';
                    url = url.replace('%3Aid', $(this).attr('catid'));
                    $('#myModal').find('.modal-body #cat_id').val($(this).attr('catid'));
                    $('#myModal').find('.modal-content form').attr("action", url)
                    $('#myModal').modal('show');
                });
            })
        </script>
        <script>
            var htmlstr = '<input type="checkbox" id="checkAllLot" class="table-check-all" data-set=".dataTable .checkboxes" /> ';
            $('.msg').html(htmlstr);
        </script>
        <script>
            $(function() {
                $('#checkAllLot').change(function(){
                    if($(this).prop('checked')){
                        $('tbody tr td input[type="checkbox"]').each(function(){
                            $(this).prop('checked', true);
                        })
                    }
                    else {
                            $('tbody tr td input[type="checkbox"]').each(function(){
                            $(this).prop('checked', false);
                        });
                    }
                })
                $(".deleteLot").on("click", function(){
                    var ids = [];
                    $('#listLot').find('tr').each(function () {
                        if ($(this).find(".group-checkable").is(":checked")) {
                            ids.push($(this).find('td').eq(1).text());
                        }
                    });
                    if(ids.length <= 0)
                    {
                        alert("Chưa chọn dòng cần xóa");
                    }
                    else
                    {
                        var check = confirm("Bạn có muốn xóa các bản ghi này");
                        if(check == true){
                            var join_selected_values = ids.join(",");
                            var url = '{{ url("/lot/multi-destroy") }}';
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                data: 'ids='+join_selected_values,
                                success: function (data) {
                                    if(data.status == 'success')
                                        toastr.success("Xóa vị trí thành công");
                                else
                                        toastr.error("Xóa vị trí thất bại");
                                window.LaravelDataTables["listLot"].ajax.reload();
                                },
                                error: function (error) {
                                    if(error.status == 403)
                                        window.LaravelDataTables["listLot"].ajax.reload();
                                        toastr.error("Xóa vị trí thất bại");
                                    }
                                });
                            }
                        }
                    });
                })
        </script>
@endsection
