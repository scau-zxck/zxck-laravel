var AdminAlog = function() {
	return {
		init: function() {
			$("#left-nav-alog").attr("class", $("#left-nav-alog").attr("class") + " active");
		},

		initIndex: function(module, operate) {
			$("#module").val(module);
			$("#operate").val(operate);
		},

	};
}();