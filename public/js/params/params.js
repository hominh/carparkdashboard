$('document').ready(function() {
	$("#submit_param").click(function(e){
		e.preventDefault();
		var arrParamname = [];
		var arrParamvalue = [];
        
        $("#paramsConfig :input").each(function(e){
        	arrParamname.push(this.name);
        	arrParamvalue.push(this.value);
        });


        $.ajax({
        	type: "POST",
        	url: url_update_params,
        	data: {
        		 "_token": $('meta[name="_token"]').attr('content'),
        		 arrParamname: arrParamname,
        		 arrParamvalue: arrParamvalue
        	},
        	success: function(result) {
        		result = jQuery.parseJSON(result);
        		if(result == 1)
        			toastr.success("Cập nhật tham số thành công");
        	},
        	error: function(err) {
            	console.log(err);
        	}
        });
    });
});