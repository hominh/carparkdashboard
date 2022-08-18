@extends('carparkdashboard-base::layout')
@section('title', 'Params')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('page')
	<div class="content-wrapper">
		<section class="content-header">
			<h1>Dashboard<small>Control panel</small></h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Tham số cấu hình</li>
			</ol>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-md-9">
					<div class="box">
						<div class="box-body">
							<div class="row">
								<div class="col-md-12" id="paramsConfig">
									<div class="form-group">
										<label for="name" class="control-label required" aria-required="true">SỐ CHỖ TRỐNG:</label>
              							<input type="text" class="form-control" id="TOTAL_LOT" name="TOTAL_LOT" placeholder="Nhập số chỗ trống" value="{!! $params[3]->value !!}">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="box">
						<div class="box-header with-border">
							<h4 class="box-title">Công bố</h4>
						</div>
						<div class="box-body">
							<div class="btn-set">
                    			<button type="submit" name="submit" id="submit_param" value="save" class="btn btn-info">
            						<i class="fa fa-save"></i> Lưu
        						</button>
                			</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<link rel="stylesheet" type="text/css" href="/css/toastr/toastr.css">
	<script src="/js/toastr/toastr.min.js"></script>
	<script>
		var url_update_params = "{{URL('params/updateparams/')}}";
	</script>
	<script src="/js/params/params.min.js"></script>
@endsection