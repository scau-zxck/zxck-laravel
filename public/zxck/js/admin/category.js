var AdminCategory = function () {
	return {
		init: function() {
			$("#left-nav-category-manager").attr("class", $("#left-nav-category-manager").attr("class") + " active");
		},

		initIndex: function (pid) {

			$("#pid").val(pid);
			
			$("#batch_delete").click(function(){
				var _token = $("meta[name=csrf-token]").attr("content"); 
				//console.log(_token);
				var checkboxs = document.getElementsByName("checkbox[]");
		        //console.log(checkboxs);
		        var arr_checkbox = new Array();
		        var j = 0;
		        for(var i = 0; i < checkboxs.length; i++){
		        	//console.log(checkboxs[i].checked);
		        	if(checkboxs[i].checked == true){
		        		arr_checkbox[j] = checkboxs[i].getAttribute("data-id");
		        		j++;
		        	}
		        }
		        //console.log(arr_checkbox);

		          $.post("/admin/util/batch-delete/category",
		              {
		                  _token : _token,
		                  ids : arr_checkbox
		              },
		              function(data, status){
		                  if(data == "true"){
		                  		layer.msg('删除成功');
		                      window.location.reload();
		                  }else{
		                      //alert("删除失败");
		                  		layer.msg('删除失败');
		                  }
		              }
		          );
			});

		},

		initCreate: function () {
			$("#form-category").validate({
				rules: {
					pid: {
						digits: true,
						min: 0
					},
					name: {
						required: true,
						maxlength: 255
					},
					value: {
						required: true,
						maxlength: 255,
					},
					serial: {
						required: true,
						maxlength: 255,
						remote: {
							url: "/admin/util/check/category",
							type: "post",
							dataType: "json",
							data:{
								_token: function(){return $("meta[name=csrf-token]").attr("content");},
								field: function(){return $("#serial").attr("name");},
								value: function(){return $("#serial").val();}
			              	}
						}
					}
				}
			});
		},

		initEdit: function (pid) {
			$("#pid").val(pid);


			$("#form-category").validate({
				rules: {
					pid: {
						digits: true,
						min: 0
					},
					name: {
						required: true,
						maxlength: 255
					},
					value: {
						required: true,
						maxlength: 255,
					},
					serial: {
						required: true,
						maxlength: 255,
						remote: {
							url: "/admin/util/check/category",
							type: "post",
							dataType: "json",
							data:{
								_token: function(){return $("meta[name=csrf-token]").attr("content");},
								id: function(){return $("#id").val();},
								field: function(){return $("#serial").attr("name");},
								value: function(){return $("#serial").val();}
			              	}
						}
					}
				}
			});
		},

	};
}();