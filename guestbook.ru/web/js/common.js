$(document).ready(function(){ 
    // Отображается 1 вкладка, 
    // т.к. отсчёт начинается с нуля
    $("#myTab2 li:eq(0) a").tab('show');

    $("input[name=filter_price]").bind('change',function() {
      $("#add_filter").attr("href","?filter=price&type=equal&val="+$(this).val());
    });

    $("body").on("keyup","#search_services",function(){
    	var query = $("#search_services").val();
  
    	$.ajax({
    		url: '/userprofile/default/list',
    		type: 'GET',
    		data: "query="+query
    	})
    	.done(function(res) {
    		$("#resSearch").empty().html(res);
    		$("#resSearch").show();
    		console.log("success");
    	})
    });
});
