$('document').ready(function() {
	var l = 1;
	var isDraw = 0;
	var pathLen = 0;
	var sceneWidth = $("#drawingArea").innerWidth();
    var sceneHeight = $("#drawingArea").innerHeight();
    var arrow;
	var path;
	
	setInterval(function(){
		if(isDraw == 1)
			drawPath();
	},1);
	
    var stage = new Konva.Stage({
        container: 'drawingArea',
        width: sceneWidth,
        height: sceneHeight,
   	});

	var layer = new Konva.Layer();
   	var imageObj = new Image();
	imageObj.onload = function () {
	    var parking_img = new Konva.Image({
	        image: imageObj,
	    });
	    layer.add(parking_img);
	    parking_img.moveToBottom();
	    stage.add(layer);
	};

	var basement =  $("#basement :selected").val();
	loadDataByBasement(basement);
	initStatus(basement);
	$('#basement').change(function() {
    	var id = $(this).val();
    	loadDataByBasement(id);
    	basement = id;
    	initStatus(id);
	});

	function init()
	{
		var arrows = layer.find('Arrow');
		var paths = layer.find('Path');
		if(arrows.length > 0)
		{
			for(var i =0; i <arrows.length; i++)
				arrows[i].remove();
		}
		if(paths.length > 0)
		{
			for(var i =0; i <paths.length; i++)
				paths[i].remove();
		}
		var images = layer.find('Image');
		if(images.length > 0)
			{
				for(var i =0; i <images.length; i++)
					images[i].remove();
			}
	}

	function loadDataByBasement(basement)
	{
		init();
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
		
		var url = "basement/getdatabyid";
    	
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
			},

		});
	}
	function drawPath()
	{
		var dashLen = pathLen - l;
		path.dashOffset(dashLen);
		layer.draw();
		l = l + 3;
		if(dashLen <= 0) {
			isDraw = 0;
			l = 0;
			layer.add(arrow);
		}
	}

	var plate = $('#plate').val();
	var urlSearchPlate = "status/getbyplate";
   	$('#searchPlate2').select2({
        minimumInputLength: 1,
        ajax: {
            url: urlSearchPlate,
            dataType: 'json',
            data: function (params) {
                return {
       				plate: params.term,
       				page: params.page
     			};
            },
            processResults: function (data,params) {
            	params.page = params.page || 1;
     			return {
       				results: data,
       				pagination: {
         				more: (params.page * 30) < data.total_count
       				}
    			 };
           	},
           	cache: true
        },
       	templateResult: formatRepo,
 		templateSelection: formatRepoSelection
    });
    function formatRepo (repo) {
 		if (repo.loading)
   			return repo.text;
 		var $container = $(
   			"<div class='select2-result-repository clearfix'>" +
     		"<div class='select2-result-repository__meta'>" +
       		"<div class='select2-result-repository__basement'></div>" +
       		"</div>" +
     		"</div>" +
   			"</div>"
 		);
 		var content = repo.basement_name + "-" + repo.kiosk_name + "-" + repo.plate;
		$container.find(".select2-result-repository__basement").text(content);
	 	return $container;
	}
	$("#searchPlate2").on('select2:select', function(selection){
		init()
			var imageObj = new Image();
		imageObj.onload = function () {
		    var parking_img = new Konva.Image({
		        image: imageObj,
		    });
		    layer.add(parking_img);
		    parking_img.moveToBottom();
		    stage.add(layer);
		};
		
		imageObj.src = selection.params.data.basement_image;
       	var x1_path = selection.params.data.x1_path.substr(0, selection.params.data.x1_path.length - 1);
	    var y1_path = selection.params.data.y1_path.substr(0, selection.params.data.y1_path.length - 1);
	    var x2_path = selection.params.data.x2_path.substr(0, selection.params.data.x2_path.length - 1);
	    var y2_path = selection.params.data.y2_path.substr(0, selection.params.data.y2_path.length - 1);
	    var arr_x1_path = x1_path.split("-");
	  	var arr_y1_path = y1_path.split("-");
	  	removeItem(arr_x1_path, '');
	  	removeItem(arr_y1_path, '');
	  	
	  	var length = arr_x1_path.length - 1;
	  	var pathData = "";
	  	for(var i = 0; i < arr_x1_path.length; i++)
	  	{
			if(i == 0)
			{
				pathData += "M" + arr_x1_path[i];
				pathData += " " + arr_y1_path[i];
			}
			else
			{
				pathData += " L" + arr_x1_path[i];
				pathData += " " + arr_y1_path[i];
			}
	  	}
	  	arrow = new Konva.Arrow({
			points: [arr_x1_path[length - 2], arr_y1_path[length - 2],arr_x1_path[length], arr_y1_path[length]],
			pointerLength: 10,
			pointerWidth: 10,
			fill: 'red',
			stroke: 'red',
			strokeWidth: 1,
		});
		path = new Konva.Path({
			data: pathData,
			stroke: 'red'
		});
		pathLen= path.getLength();
		path.dashOffset(pathLen);
		path.dash([pathLen]);
		
		layer.add(path)
		stage.draw();

	  	isDraw = 1;
	});
	function formatRepoSelection (repo) {
 		return repo.basement_name + "-" + repo.kiosk_name + "-" + repo.plate;
	}
	
	function removeItem(array, item){
	    for(var i in array){
	        if(array[i]==item)
	            array.splice(i,1);
	    }
	}

	function initStatus(basement)
	{
		var url = "status/initdata";
    	url = url + "/" + basement;
   		$.ajax({
   			method : 'GET',
			url  : url,
			success: function(res){
				$('#countblank').val(res["countEnableLot"][0][""]);
				$.each(res, function(index, element) {

					var height = element.y4_web - element.y1_web;
					var width = element.x2_web - element.x1_web;
					var x_text = (parseInt(element.x3_web) + parseInt(element.x1_web)) / 2;
					var y_text = (parseInt(element.y3_web) + parseInt(element.y1_web)) / 2;
					var color;
					var simpleText = new Konva.Text({
				        x: x_text,
				        y: y_text,
				        text: element.plate,
				        fontSize: 20,
				        fontFamily: 'Arial',
				        fill: 'white',
				      });
					simpleText.offsetX(simpleText.width() / 2);
					simpleText.offsetY(simpleText.height() / 2);
					if(element.status == 1)
						color = 'red';
					if(element.status == 0)
						color = 'green';
					if(element.status == 2)
						color = 'yellow';
					var rect = new Konva.Rect({
				        x: element.x1_web,
				        y: element.y1_web,
				        width: width,
				        height: height,
				        fill: color,
				        stroke: 'black',
				        strokeWidth: 1,
				   	});
				   	layer.add(rect);
				   	layer.add(simpleText);
				});
			}
   		});
	}
   	
   	
   	setInterval(function(){
		getStatus(basement);
	}, 10000);
   	function getStatus(basement)
   	{
   		var url = "status/getdata";
    	url = url + "/" + basement;
   		$.ajax({
   			method : 'GET',
			url  : url,
			success: function(res){
				$('#countblank').val(res["countEnableLot"][0][""]);
				$.each(res, function(index, element) {
					var height = element.y4_web - element.y1_web;
					var width = element.x2_web - element.x1_web;
					var x_text = (parseInt(element.x3_web) + parseInt(element.x1_web)) / 2;
					var y_text = (parseInt(element.y3_web) + parseInt(element.y1_web)) / 2;
					var color;
					var simpleText = new Konva.Text({
				        x: x_text,
				        y: y_text,
				        text: element.plate,
				        fontSize: 20,
				        fontFamily: 'Arial',
				        fill: 'white',
				      });
					simpleText.offsetX(simpleText.width() / 2);
					simpleText.offsetY(simpleText.height() / 2);
					if(element.status == 1)
						color = 'red';
					if(element.status == 0)
						color = 'green';
					if(element.status == 2)
						color = 'yellow';
					var rect = new Konva.Rect({
				        x: element.x1_web,
				        y: element.y1_web,
				        width: width,
				        height: height,
				        fill: color,
				        stroke: 'black',
				        strokeWidth: 1,
				   	});
				   	layer.add(rect);
				   	layer.add(simpleText);
				});
			}
   		});
   	}
   	function fitStageIntoParentContainer() {
        var container = document.querySelector('#drawingArea');
        var containerWidth = container.offsetWidth;
        var scale = containerWidth / sceneWidth;
        stage.width(sceneWidth * scale);
        stage.height(sceneHeight * scale);
        stage.scale({ x: scale, y: scale });
     }

     $('#drawingArea').click(function (e){
        var $this = $(this);
        var offset = $this.offset();
        var posX = offset.left;
        var posY = offset.top;
        var x = e.pageX-posX;
        var y = e.pageY-posY;
        $.ajax({
            method: "POST",
            url: "lot/findLotByCoordinate",
            data:{
                "_token": $('meta[name="_token"]').attr('content'),
                x: x,
                y: y,
                basement: $("#basement :selected").val(),
            },
            success: function( data ) {
                var result = $.parseJSON(data);
                if(result.length == 1)
                {
                    var detailLotName = detailLotStatus = detailLotPlate = detailUpdated_at = detailLotOverlap =  "";
                    var dataSrcImage = "data:image/png;base64,";
                    dataSrcImage = dataSrcImage + result[0]["image"];
                    detailUpdated_at = detailUpdated_at +  result[0]["updated_at"];
                    detailLotOverlap = detailLotOverlap +  result[0]["overlap_calc"];
                    detailLotName = result[0]["basment_name"] + " - " + result[0]["lotname"];
                    $("#detailLotName").text(detailLotName);
                    if(result[0]["status"] == "1")
                        detailLotStatus = "Có xe";
                    if(result[0]["status"] == "0")
                        detailLotStatus = "Không có xe";
                    if(result[0]["status"] == "2")
                        detailLotStatus = "Khởi tạo";
                    detailLotStatus = "Trạng thái: " + detailLotStatus;
                    detailLotPlate = "Biển số: " + result[0]["plate"];
                    detailUpdated_at = "Cập nhật lúc: " + detailUpdated_at;
                    detailLotOverlap = "Overlap : " + detailLotOverlap;
                    $("#detailLotStatus").text(detailLotStatus);
                    $("#detailLotPlate").text(detailLotPlate);
                    $('#myModal').modal('show');
                    $("#image_lot").attr("src", dataSrcImage);
                    $("#detailLotUpdate").text(detailUpdated_at);
                    $("#detailLotOverlap").text(detailLotOverlap);
                }
            }
        });
     });
});