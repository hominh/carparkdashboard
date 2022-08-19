@extends('carparkdashboard-base::layout')
@section('title', 'Camera')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('page')
    <link rel="stylesheet" type="text/css" href="{{asset('css/camera/style.css')}}">
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
                                <div>Bạn muốn xóa bản ghi này?</div>
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
                                {!! $dataTable->table(['class' => 'table table-striped']) !!}
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
        {!! $dataTable->scripts() !!}
        <script src="/js/toastr/toastr.min.js"></script>
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
                $('#listCamera').on('click', '.deleteDialog', function (e) {
                    e.preventDefault();
                    var url = '{{ url("/camera/destroy", ":id") }}';
                    url = url.replace('%3Aid', $(this).attr('catid'));
                    $('#myModal').find('.modal-body #cat_id').val($(this).attr('catid'));
                    $('#myModal').find('.modal-content form').attr("action", url)
                    $('#myModal').modal('show');
                });
            })
        </script>
        <script>
            var htmlstr = '<input type="checkbox" id="checkAllCamera" class="table-check-all" data-set=".dataTable .checkboxes" /> ';
            $('.msg').html(htmlstr);
        </script>
        <script>
            $(function() {
                $('#checkAllCamera').change(function(){
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
                $(".deleteCamera").on("click", function(){
                    var ids = [];
                    $('#listCamera').find('tr').each(function () {
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
                            var url = '{{ url("/camera/multi-destroy") }}';
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                data: 'ids='+join_selected_values,
                                success: function (data) {
                                    if(data.status == 'success')
                                        toastr.success("Xóa camera thành công");
                                else
                                        toastr.error("Xóa camera thất bại");
                                window.LaravelDataTables["listCamera"].ajax.reload();
                                },
                                error: function (error) {
                                    if(error.status == 403)
                                        window.LaravelDataTables["listCamera"].ajax.reload();
                                        toastr.error("Error: 403. Xóa camera thất bại");
                                    }
                                });
                            }
                        }
                    });
                })
        </script>
@endsection
