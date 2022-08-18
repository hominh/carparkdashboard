@extends('carparkdashboard-base::layout')
@section('title', 'Status')
<style type="text/css">
	#drawingArea {
	    width: 100%;
	    height: 100%;
	    background-size: 100% 100%;
	}
	div.line {
	  	transform-origin: 0 100%;
	  	height: 3px;
	  	background: #000;
	}
	/* The switch - the box around the slider */
	.switch {
	  	position: relative;
	  	display: inline-block;
	  	width: 60px;
	  	height: 34px;
	}

	/* Hide default HTML checkbox */
	.switch input {
	  	opacity: 0;
	  	width: 0;
	 	height: 0;
	}

	/* The slider */
	.slider {
	  	position: absolute;
	  	cursor: pointer;
	  	top: 0;
	  	left: 0;
	  	right: 0;
	  	bottom: 0;
	  	background-color: #ccc;
	  	-webkit-transition: .4s;
	  	transition: .4s;
	}

	.slider:before {
	  	position: absolute;
	  	content: "";
	  	height: 26px;
	  	width: 26px;
	  	left: 4px;
	  	bottom: 4px;
	  	background-color: white;
	  	-webkit-transition: .4s;
	  	transition: .4s;
	}

	input:checked + .slider {
  		background-color: #2196F3;
	}

	input:focus + .slider {
  		box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
	  	-webkit-transform: translateX(26px);
	  	-ms-transform: translateX(26px);
	  	transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
	  	border-radius: 34px;
	}

	.slider.round:before {
  		border-radius: 50%;
	}
</style>
@section('page')
<meta name="_token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="{{asset('css/lot/style.css')}}">
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-2">
				<div class="box">
					<div class="box-header with-border">
						<label for="basement" class="control-label required" aria-required="true">Bãi giữ xe</label>
					</div>
                    <div class="box-body">
                    	<select class="form-control" name="basement" id="basement">
                    		@foreach ($basements as $basement)
                    		<option value="{{ $basement->id }}">{{ $basement->name }}</option>
							@endforeach
						</select>
                    </div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="box">
					<div class="box-header with-border">
						<label for="basement" class="control-label required" aria-required="true">Kiosk</label>
					</div>
                    <div class="box-body">
                    	<select class="form-control" name="kiosk" id="kiosk">
						</select>
                    </div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="box">
					<div class="box-header with-border">
						<label for="lot" class="control-label required" aria-required="true">Vị trí</label>
					</div>
                    <div class="box-body">
                    	<select class="form-control" name="lot" id="lot">
						</select>
                    </div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="box">
					<div class="box-header with-border">
						<label for="lot" class="control-label">Cho phép vẽ</label>
					</div>
                    <div class="box-body">
						<label class="switch">
						  	<input type="checkbox" id="is_drawing">
						  	<span class="slider round"></span>
						</label>
                    </div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="box">
					<div class="box-header with-border">
						<label for="lot" class="control-label">Lưu</label>
					</div>
                    <div class="box-body">
						<button type="button" name="savepath" id="savepath" value="save" class="btn btn-info">
							<i class="fa fa-save"></i> Lưu đường đi
						</button>
						<input type="hidden" id="x1_path" name="x1_path" value="">
						<input type="hidden" id="y1_path" name="y1_path" value="">
						<input type="hidden" id="x2_path" name="x2_path" value="">
						<input type="hidden" id="y2_path" name="y2_path" value="">
                    </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div id="drawingArea" style="position: relative;">
						<img src="" class="responsive" style="max-width: 100%" id="image_preview">
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<link rel="stylesheet" type="text/css" href="/css/toastr/toastr.css">
<script src="/js/toastr/toastr.min.js"></script>
<script src="/js/konva/konva.min.js"></script>
<script>
	var url = "{{URL('basement/getdatabyid/')}}";
	var url2 = "{{URL('lot/updateSettingPath/')}}";
	var url3 = "{{URL('lot/getPathFromBasement')}}";
</script>
<script src="/js/lot/lot.setting.path.min.js"></script>
@endsection