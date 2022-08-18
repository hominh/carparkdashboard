$('document').ready(function() {

		var arr_x1_path = [];
		var arr_y1_path = [];
		var arr_x2_path = [];
		var arr_y2_path = [];

		var sceneWidth = $("#drawingArea").innerWidth();
	    var sceneHeight = $("#drawingArea").innerHeight();
	    var stage = new Konva.Stage({
	        container: 'drawingArea',
	        width: sceneWidth,
	        height: sceneHeight,
	   	});
	   	var layer = new Konva.Layer();

		var basement =  $("#basement :selected").val();
		loadDataByBasement(basement);
		loadPathByBasement(basement);
		$('#basement').change(function() {
	    	var id = $(this).val();
	    	loadDataByBasement(id);
	    	loadPathByBasement(id);
		});

		function loadPathByBasement(basement)
		{
			var arrows = layer.find('Arrow');
   			if(arrows.length > 0)
   			{
   				for(var i =0; i <arrows.length; i++)
   					arrows[i].remove();
   			}
   			var paths = layer.find('Path');
   			if(paths.length > 0)
   			{
   				for(var i =0; i <paths.length; i++)
   					paths[i].remove();
   			}
			
	    	url3 = url3 + "/" + basement;
	    	$.ajax({
	    		url: url3,
				method:"GET",
				success: function( data ) {
					$.each(JSON.parse(data), function(k, v) {
						var arr_x1_path_saved = arr_x2_path_saved = arr_y1_path_saved = arr_y2_path_saved = [];
						arr_x1_path_saved = v.x1_path.substr(0, v.x1_path.length - 1).split("-");
						arr_y1_path_saved = v.y1_path.substr(0, v.y1_path.length - 1).split("-");

						removeItem(arr_x1_path_saved, '');
			    	  	removeItem(arr_y1_path_saved, '');

			    	  	var length_saved = arr_x1_path_saved.length - 1;
    	  				var pathData_saved = "";
    	  				for(var i = 0; i < arr_x1_path_saved.length; i++)
			    	  	{
			    			if(i == 0)
			    			{
			    				pathData_saved += "M" + arr_x1_path_saved[i];
			    				pathData_saved += " " + arr_y1_path_saved[i];
			    			}
			    			else
			    			{
			    				pathData_saved += " L" + arr_x1_path_saved[i];
			    				pathData_saved += " " + arr_y1_path_saved[i];
			    			}
			    	  	}
			    	  	arrow = new Konva.Arrow({
							points: [arr_x1_path_saved[length], arr_y1_path_saved[length]],
							pointerLength: 5,
							pointerWidth: 5,
							fill: 'red',
							stroke: 'red',
							strokeWidth: 1,
						});
						path = new Konva.Path({
							data: pathData_saved,
							stroke: 'red'
						});
						
						layer.draw();
						//layer.add(arrow);
						layer.add(path)
					});
				}
	    	});
		}

		function removeItem(array, item){
		    for(var i in array){
		        if(array[i]==item)
		            array.splice(i,1);
		    }
		}

		function loadDataByBasement(basement)
		{
			var images = layer.find('Image');
			if(images.length > 0)
   			{
   				for(var i =0; i <images.length; i++)
   					images[i].remove();
   			}
   			var rects = layer.find('Rect');
   			if(rects.length > 0)
   			{
   				for(var i =0; i <rects.length; i++)
   					rects[i].remove();
   			}
   			var simpleTexts = layer.find('Text');
   			if(simpleTexts.length > 0)
   			{
   				for(var i =0; i <simpleTexts.length; i++)
   					simpleTexts[i].remove();
   			}
			var imageObj = new Image();
			imageObj.onload = function () {
			    var parking_img = new Konva.Image({
			        image: imageObj,
			    });
			    layer.add(parking_img);
			    parking_img.moveToBottom();
			    stage.add(layer);
			};
			$('#kiosk')
    			.find('option')
    			.remove();
    		$('#lot')
    			.find('option')
    			.remove();
	    	$.ajax({
				url: url,
				method:"POST",
				data: {
                	"_token": $('meta[name="_token"]').attr('content'),
                	basement: basement,
            	},
				success: function( data ) {
					imageObj.src = JSON.parse(data).image;
					$.each(JSON.parse(data).kiosk, function(k, v) {
						$('#kiosk')
         					.append($("<option></option>")
                    		.attr("value", v.id)
                    		.text(v.name));
                    		var height = v.y2 - v.y1;
							var width = v.x2 - v.x1;
							var x_text = (parseInt(v.x2) + parseInt(v.x1)) / 2;
							var y_text = (parseInt(v.y2) + parseInt(v.y1)) / 2;
							var simpleText = new Konva.Text({
						        x: x_text,
						        y: y_text,
						        text: v.name,
						        fontSize: 20,
						        fontFamily: 'Arial',
						        fill: 'black',
						   	});
						   	simpleText.offsetX(simpleText.width() / 2);
							simpleText.offsetY(simpleText.height() / 2);
							var rect = new Konva.Rect({
						        x: v.x1,
						        y: v.y1,
						        width: width,
						        height: height,
						        fill: 'cyan',
						        stroke: 'black',
						        strokeWidth: 1,
						   	});
						layer.add(rect);
						layer.add(simpleText);
					});
					$.each(JSON.parse(data).lot, function(k, v) {
						$('#lot')
         					.append($("<option></option>")
                    		.attr("value", v.id)
                    		.text(v.name)); 
					});
				},

			});
		}
		var x2_path = "";
		var y2_path = "";
		var x1 = null;
	    y1 = null;
	  	var offsetX = 0,
	    offsetY = 0;
	    var x2_draw = null;
	    var y2_draw = null;
	  	var moveLineId = "moveLine";

	  	var polyline,mouseDown=false,pts=[],lastPt=0,polyType='false',polyBtn,poly=false,bgColor,mouse;
	  	


	  	$('#drawingArea').on("mousedown", function(event) {
	  		
	  		if($('#is_drawing').prop('checked'))
		  	{
		  		var $this = $(this);
		  		var offset = $this.offset();
		  		var posX = offset.left;
			    var posY = offset.top;
			    var x = event.pageX,
	        	y = event.pageY;
		  		if(poly == false)
		  		{
		  			mouse = stage.getPointerPosition();
			  		if (pts.length > 1) { pts.splice(-2,2); }
			  		pts.push(mouse.x, mouse.y);
			  		arr_x1_path.push(x - posX);
	        		arr_y1_path.push(y - posY);
			  		polyline = new Konva.Line({points:pts,name:'temp',fill:bgColor,stroke:'black',strokeWidth:1,draggable:false});
			  		lastPt = (pts.length);
			  		mouseDown=true;
			  		layer.add(polyline);

			  		var circle = new Konva.Circle({
			  			x: mouse.x,
			  			y: mouse.y,
			  			radius: 5,
			  			fill: 'black',
				        stroke: 'black',
				        strokeWidth: 4,
			  		});
			  		layer.add(circle);
		  		}
		  	}
    	});
    	$('#drawingArea').on("dblclick", function(event) {
    		var polyObj = new Konva.Line({
    			points:pts,
    			name:'poly',
    			fill:bgColor,
    			stroke:'black',
    			strokeWidth:1,
    			draggable:true,
    			closed:false,
    			hitStrokeWidth:10
    		});
    		layer.add(polyObj); layer.draw();
    		poly=false; polyBtn=''; lastPt=0; mouseDown=false; pts=[];
    	});
	  	$('#drawingArea').mousemove(function(event) {
	  		if (poly == false && mouseDown==true) {
	  			mouse = stage.getPointerPosition();
	  			polyline.points()[lastPt] = mouse.x;
			    polyline.points()[lastPt+1] = mouse.y;
			    layer.draw();
	  		}
	  	});

	  	$("#savepath").click(function(){
	  		var x1_path_tmp = "";
	  		var y1_path_tmp = "";
	  		var x2_path_tmp = "";
	  		var y2_path_tmp = "";
	  		for(var i = 0; i < arr_x1_path.length; i++)
	  		{
	  			x1_path_tmp += arr_x1_path[i] + "-";
	  			y1_path_tmp += arr_y1_path[i] + "-";
	  		}
	  		var lot_id = $('#lot option:selected').val();
	  		var kiosk_id = $('#kiosk option:selected').val();
			
			url2 += '/';
			url2 += lot_id;
			url2 += '/';
			url2 += kiosk_id;
	  		$.ajax({
				url: url2,
				method:"POST",
				data:{
					"_token": $('meta[name="_token"]').attr('content'),
					lot_id: lot_id,
					kiosk_id: kiosk_id,
					x1_path: x1_path_tmp,
					y1_path: y1_path_tmp,
					x2_path: '0',
					y2_path: '0',
					success: function( data ) {
						toastr.success("Cập nhật đường đi thành công");
					}
				}
			});
			arr_x1_path.length = 0;
			arr_y1_path.length = 0;
	  	});
	});