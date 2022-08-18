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
			<div class="col-md-1">
				<div class="box">
					<div class="box-header with-border">
						<label for="lot" class="control-label required" aria-required="true">Lot</label>
					</div>
                    <div class="box-body">
                    	<select class="form-control" name="lot" id="lot">
                    		@foreach ($lots as $lot)
                    		<option value="{{ $lot->id }}">{{ $lot->name }}</option>
							@endforeach
						</select>
                    </div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="box">
					<div class="box-body">
						<label for="x1" class="control-label required" aria-required="true">x1:</label>
						<input type="text" class="form-control" id="x1" name="x1" placeholder="Enter x1">
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="box">
					<div class="box-body">
						<label for="y1" class="control-label required" aria-required="true">y1:</label>
						<input type="text" class="form-control" id="y1" name="y1" placeholder="Enter y1">
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="box">
					<div class="box-body">
						<label for="x2" class="control-label required" aria-required="true">x2:</label>
						<input type="text" class="form-control" id="x2" name="x2" placeholder="Enter x2">
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="box">
					<div class="box-body">
						<label for="y2" class="control-label required" aria-required="true">y2:</label>
						<input type="text" class="form-control" id="y2" name="y2" placeholder="Enter y2">
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="box">
					<div class="box-body">
						<label for="x3" class="control-label required" aria-required="true">x3:</label>
						<input type="text" class="form-control" id="x3" name="x3" placeholder="Enter x3">
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="box">
					<div class="box-body">
						<label for="y3" class="control-label required" aria-required="true">y3:</label>
						<input type="text" class="form-control" id="y3" name="y3" placeholder="Enter y3">
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="box">
					<div class="box-body">
						<label for="x4" class="control-label required" aria-required="true">x4:</label>
						<input type="text" class="form-control" id="x4" name="x4" placeholder="Enter x4">
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="box">
					<div class="box-body">
						<label for="y4" class="control-label required" aria-required="true">y4:</label>
						<input type="text" class="form-control" id="y4" name="y4" placeholder="Enter y4">
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<button type="button" name="save" id="savelot" value="save" class="btn btn-info">
					<i class="fa fa-save"></i> Save
				</button>
			</div>
			<!--<div class="col-md-1">
				<button type="button" name="reset" id="resetlot" value="reset" class="btn btn-warning">
					<i class="fa fa-save"></i> Reset
				</button>
			</div>!-->
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
<script>
	var url = "{{URL('lot/updateSettings/')}}";
	var urlLoadImage = "{{URL('basement/getdatabyid/')}}";
</script>
<script src="/js/lot/lot.setting.min.js"></script>
@endsection