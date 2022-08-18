$('document').ready(function() {
		var basement =  $("#basement :selected").val();
		loadImageByBasement(basement);
		var isUpdate = 0;
		$('#drawingArea').click(function (e){
			var isSetvalue = 0;
		    var $this = $(this);
		    var offset = $this.offset();
		    var width = $this.width();
		    var height = $this.height();
		    var posX = offset.left;
		    var posY = offset.top;
		    var x = e.pageX-posX;
		    var y = e.pageY-posY;
		  	if($('#x1').val() == "" && $('#y1').val() == "" && $('#x2').val() == "" && $('#y2').val() == "" && $('#x3').val() == "" && $('#y3').val() == "" && $('#x4').val() == "" && $('#y4').val() == "" && isSetvalue == 0 )
		  	{
		    	$('#x1').val(x);
		    	$('#y1').val(y);
		    	isSetvalue = 1;
		    }
		    if($('#x1').val() != "" && $('#y1').val() != "" && $('#x2').val() == "" && $('#y2').val() == "" && $('#x3').val() == "" && $('#y3').val() == "" && $('#x4').val() == "" && $('#y4').val() == "" && isSetvalue == 0 )
		  	{
		    	$('#x2').val(x);
		    	$('#y2').val(y);
		    	isSetvalue = 1;
		    }
		    if($('#x1').val() != "" && $('#y1').val() != "" && $('#x2').val() != "" && $('#y2').val() != "" && $('#x3').val() == "" && $('#y3').val() == "" && $('#x4').val() == "" && $('#y4').val() == "" && isSetvalue == 0 )
		  	{
		    	$('#x3').val(x);
		    	$('#y3').val(y);
		    	isSetvalue = 1;
		    }
		    if($('#x1').val() != "" && $('#y1').val() != "" && $('#x2').val() != "" && $('#y2').val() != "" && $('#x3').val() != "" && $('#y3').val() != "" && $('#x4').val() == "" && $('#y4').val() == "" && isSetvalue == 0 )
		  	{
		    	$('#x4').val(x);
		    	$('#y4').val(y);
		    	isSetvalue = 1;
		    }

		});
		$("#savelot").click(function(){
			var x1 = parseInt($('#x1').val());
			var y1 = parseInt($('#y1').val());
			var x2 = parseInt($('#x2').val());
			var y2 = parseInt($('#y2').val());
			var x3 = parseInt($('#x3').val());
			var y3 = parseInt($('#y3').val());
			var x4 = parseInt($('#x4').val());
			var y4 = parseInt($('#y4').val());
			var id = $('#lot option:selected').val();
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
	        tmp += ' style="fill:yellow;stroke:black;stroke-width:1" /></polygon></svg>';
			$('#drawingArea') .append($(tmp));
			//var url = "{{URL('lot/updateSettings/')}}";
			url += '/';
			url += id;
			$.ajax({
				url: url,
				method:"POST",
				data:{
					"_token": $('meta[name="_token"]').attr('content'),
					id: id,
					x1_web: x1,
					y1_web: y1,
					x2_web: x2,
					y2_web: y2,
					x3_web: x3,
					y3_web: y3,
					x4_web: x4,
					y4_web: y4
				},
				success: function( data ) {
        			if(data > 0)
        			{
        				toastr.success("Update success");
        				$('#x1').val("");
        				$('#y1').val("");
        				$('#x2').val("");
        				$('#y2').val("");
        				$('#x3').val("");
        				$('#y3').val("");
        				$('#x4').val("");
        				$('#y4').val("");
        				isUpdate = 1;
        			}
        			else
        				toastr.error("Update failed");
    			}
			});
	    });
	    $('#basement').change(function() {
	    	var id = $(this).val();
	    	loadImageByBasement(id);
		});

		function loadImageByBasement(basement)
		{
	    	$.ajax({
				url: urlLoadImage,
				method:"POST",
				data: {
					"_token": $('meta[name="_token"]').attr('content'),
					basement: basement,
				},
				success: function( data ) {
					$("#image_preview").attr("src", JSON.parse(data).image);
				},

			});
		}
	});