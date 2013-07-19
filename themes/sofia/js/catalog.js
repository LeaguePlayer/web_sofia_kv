$(".rooms-count a").on("click", function(e){
	e.preventDefault();

	var links = $(this).parent().find("a");
	var index = links.index($(this));

	$(this).parent().find("a").removeClass("active");
	$(this).addClass("active");
	$(".checkbox-rooms :checkbox").attr("checked", false).eq(index).attr("checked", true);

	$("#catalog-filter").submit();
});