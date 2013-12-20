$(document).ready(function(){
	BannerCoinSlider();
	LiveTile();
	
    $('.fancybox-thumbs').fancybox({
        prevEffect: 'none',
        nextEffect: 'none',

        closeBtn: true,
        arrows: true,
        nextClick: true,

        helpers: {
            thumbs: {
                width: 50,
                height: 50
            }
        }
    });
	
    if ($("a.tab")) {
        $("a.tab").click(function () {
            $(".active").removeClass("active");
            $(this).addClass("active");
            $(".content").hide();
            var content_show = $(this).attr("title");
            $("#" + content_show).fadeIn("slow");
            return false;
        });
    }
});

function BannerCoinSlider(){
	if($('#coin-slider')){
		$('#coin-slider').coinslider({ 
			width:$('#coin-slider').parent().width(),
			height:$('#coin-slider').parent().height(), 
			delay:  3000,
			navigation: true, 
			pause:200});
	}
}
function LiveTile(){
	if($("live-tile")){
	    $('.live-tile li').each(function (el) {
	        var selected = $(this).find("div").first().attr('id');
	        var url = $(this).find("div").first().attr('href');
	        $("#" + selected + " img").click(function () {
	            window.location = url;
	        });
	        $('#' + selected + ' img:gt(0)').hide();
	        setInterval(function () {
	            $('#' + selected + ' :first-child').fadeOut()
				.next('img').fadeIn()
				.end().appendTo($('#' + selected));
	        },
			Math.floor(randomBetween(2000, 10000)));
	    });
	}
}
function randomBetween(min, max) {
    if (min < 0) {
        return min + Math.random() * (Math.abs(min)+max);
    }else {
        return min + Math.random() * max;
    }
}