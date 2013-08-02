$(".rooms-count a").on("click", function(e){
	e.preventDefault();

	var links = $(this).parent().find("a");
	var index = links.index($(this));

	if($(this).hasClass('active')){
		links.removeClass("active");
		$(".checkbox-rooms :checkbox").eq(index).attr("checked", false);
	}else{
		links.removeClass("active");
		$(this).addClass("active");
		$(".checkbox-rooms :checkbox").attr("checked", false).eq(index).attr("checked", true);
	}
	$("#catalog-filter").submit();
});