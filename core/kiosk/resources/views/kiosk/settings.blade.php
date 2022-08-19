@extends('carparkdashboard-base::layout')
@section('title', 'Kioks settings')
<style type="text/css">
	#drawingArea {
	    width: 100%;
	    height: 100%;
	    background-size: 100% 100%;
	}
</style>
@section('page')
<meta name="_token" content="{{ csrf_token() }}">
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
			<div class="col-md-2">
				<button type="button" name="save" id="savekiosk" value="save" class="btn btn-info">
					<i class="fa fa-save"></i> :Lưu
				</button>
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
<script type="text/javascript">
	$('document').ready(function() {
		$('#drawingArea').click(function (e){
			var isSetvalue = 0;
			var $this = $(this); // or use $(e.target) in some cases;
		    var offset = $this.offset();
		    var width = $this.width();
		    var height = $this.height();
		    var posX = offset.left;
		    var posY = offset.top;
		    var x = e.pageX-posX;
		    var y = e.pageY-posY;
		    if($('#x1').val() == "" && $('#y1').val() == "" && $('#x2').val() == "" && $('#y2').val() == "" && isSetvalue == 0 )
		  	{
		    	$('#x1').val(x);
		    	$('#y1').val(y);
		    	isSetvalue = 1;
		    }
		    if($('#x1').val() != "" && $('#y1').val() != "" && $('#x2').val() == "" && $('#y2').val() == ""  && isSetvalue == 0 )
		  	{
		    	$('#x2').val(x);
		    	$('#y2').val(y);
		    	isSetvalue = 1;
		    }
		});

		$("#savekiosk").click(function(){
			var x1 = parseInt($('#x1').val());
			var y1 = parseInt($('#y1').val());
			var x3 = parseInt($('#x2').val());
			var y3 = parseInt($('#y2').val());
			var x2 = x3;
			var y2 = y1;
			var x4 = x1;
			var y4 = y3;
			var id = $('#kiosk option:selected').val();
			var height = y4 - y1;
			var width = x2 - x1;
			var tmp = '<svg style="position: absolute;top: ';
			tmp += y1;
			tmp += '; left: ';
			tmp += x1;
			tmp += '" ';
			tmp += ' width="'
			tmp += width;
			tmp += '" '
			tmp += ' height="'
			tmp+= height;
			tmp += '" ';
			tmp += ' viewBox="';
			tmp += x1;
			tmp += ' ';
			tmp += y1;
			tmp += ' ';
			tmp += width;
			tmp += ' ';
			tmp += height;
			tmp+= '"><polygon points="';
	       	//var tmp = '<polygon points="';
	        tmp += x1;
	        tmp += ',';
	        tmp += y1;
	        tmp += ',';
	        tmp += x2;
	        tmp += ',';
	        tmp += y2;
	        tmp += ',';
	        tmp += x3;
	        tmp += ',';
	        tmp += y3;
	        tmp += ',';
	        tmp += x4;
	        tmp += ',';
	        tmp += y4;
	        tmp += '" ';
	        tmp += ' style="fill:cyan;stroke:black;stroke-width:1" /></polygon></svg>';
			$('#drawingArea') .append($(tmp));
			var url = "{{URL('kiosk/updateSettings/')}}";
			url += '/';
			url += id;
			$.ajax({
				url: url,
				method:"POST",
				data:{
					"_token": "{{ csrf_token() }}",
					id: id,
					x1: x1,
					y1: y1,
					x2: x3,
					y2: y3
				},
				success: function( data ) {
        			if(data > 0)
        			{
        				toastr.success("Update success");
        				$('#x1').val("");
        				$('#y1').val("");
        				$('#x2').val("");
        				$('#y2').val("");
        				isUpdate = 1;
        			}
        			else
        				toastr.error("Update failed");
    			}
			});
		});

		var basement =  $("#basement :selected").val();
		loadDataByBasement(basement);
		$('#basement').change(function() {
	    	var id = $(this).val();
	    	loadDataByBasement(id);
		});
		

		function loadDataByBasement(basement)
		{
			$('#kiosk')
    			.find('option')
    			.remove();
			var url = "{{URL('basement/getdatabyid/')}}";
	    	$.ajax({
				url: url,
				method:"POST",
				data: {
	                "_token": $('meta[name="_token"]').attr('content'),
	                basement: basement,
	            },
				success: function( data ) {
					$("#image_preview").attr("src", JSON.parse(data).image);
					$.each(JSON.parse(data).kiosk, function(k, v) {
						$('#kiosk')
         					.append($("<option></option>")
                    		.attr("value", v.id)
                    		.text(v.name)); 
					});
				},

			});
		}
	});
</script>
@endsection