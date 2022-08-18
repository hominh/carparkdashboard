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
<div class="modal fade modal-confirm-delete" id="myModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title"><i class="til_img"></i><strong>Chi tiết vị trí</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span aria-hidden="true" style="color: white">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 detailLot">
                        <p id="detailLotName"></p>
                        <p id="detailLotStatus"></p>
                        <p id="detailLotPlate"></p>
                        <p id="detailLotUpdate"></p>
                        <p id="detailLotOverlap"></p>
                    </div>
                </div>
               <div class="row">
                    <div class="col-md-12">
                        <img src="" id="image_lot" class="img-responsive" />
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
        	<div class="col-md-4">
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
            
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <label for="plate" class="control-label" aria-required="true">Biển số</label>
                    </div>
                    <div class="box-body">
                        <select class="form-control" name="searchPlate2" id="searchPlate2" style="width:100%"></select>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <label for="plate" class="control-label" aria-required="true">Số chỗ trống</label>
                    </div>
                    <div class="box-body">
                        <input type="text" readonly name="countblank" id="countblank" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div id="drawingArea" style="position: relative;">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<link rel="stylesheet" type="text/css" href="/css/toastr/toastr.css">
<script src="/js/toastr/toastr.min.js"></script>
<script src="/js/konva/konva.min.js"></script>
<script src="/js/lot/lot.min.js"></script>
@endsection