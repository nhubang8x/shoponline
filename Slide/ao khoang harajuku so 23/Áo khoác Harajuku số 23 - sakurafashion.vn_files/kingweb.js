//Load ảnh đưa vào slide
loadimage();
function loadimage(){var e="action=addslide";$.ajax({type:"POST",url:"action.php?do=addslide",data:e,success:function(e){$("#slider").append(e),$("#slider").bxSlider({auto:!0,pagerCustom:"#bx-pager",mode:"horizontal",speed:3000,pause:6000})}})}
loadtinhot();
function loadtinhot(){var e="action=addtinhot";$.ajax({type:"POST",url:"action.php?do=addtinhot",data:e,success:function(e){$("#tinnoibat").append(e),$("#tinnoibat").bxSlider({mode: 'vertical',auto: true,nextSelector: '#tinnoibat-next',prevSelector: '#tinnoibat-prev',nextText: '<img src="images/next01.png" alt="Next"/>',prevText: '<img src="images/prev01.png" alt="Prev"/>',minSlides: 3,maxSlides: 3,slideMargin: 0})}})}
function getlang(id)
{
	var y=0;
}
function getgiamgia(code)
{
	var dataString = "code=" + code +"&action=getgiamgia";
	$.ajax({  
		type: "POST",  
		url: "action.php",  
		data: dataString, 
		success: function(response)
		{
			alert(response);window.location.href="cart";
		}
	});
}
function getsapxep(pid,thuoctinh,url)
{
	var dataString = "pid=" + pid + "&thuoctinh="+ thuoctinh + "&action=getsapxep";
	$.ajax({  
		type: "POST",  
		url: "action.php",  
		data: dataString, 
		success: function(response)
		{
			window.location.href=url;
		}
	});
}

function updateads(id)
{
	var dataString = "pid=" + id +"&action=updateads";
	$.ajax({  
		type: "POST",  
		url: "action.php",  
		data: dataString, 
		success: function(response)
		{
			
		}
	});
}
$(document).ready(function(){
  $.getScript("template/addthis.js");
  	$('#marquee').bxSlider({
		minSlides: 4,
	  	maxSlides: 4,
		slideWidth: 300,
		useCSS: false,
	  	ticker: true,
		tickerHover: true,
	  	speed: 10000
	});
	$('#nhanxet').bxSlider({
		auto: true,
		nextSelector: '#nhanxet-next',
  		prevSelector: '#nhanxet-prev',
		nextText: '<img src="images/next01.png" alt="Next"/>',
  		prevText: '<img src="images/prev01.png" alt="Prev"/>',
		minSlides: 1,
		maxSlides: 1,
		slideMargin: 0
	});
	$('#logothuonghieu').bxSlider({
		auto: false,
		minSlides: 1,
		maxSlides: 6,
		slideWidth: 170,
		slideMargin: 36
	});
});



$(document).ready(function(){
	var a=$("div.listkey ul li").length;
	for(i=0;i<a;i++)
	{
		$("div.listkey ul li:eq("+i+")").addClass("keys tag" + i);
	}
});

/* Tab ul */
$(document).ready(function(){
	$(".tabs .tab_container .tab_content2").hide();
	$(".tabs li:first-child").addClass("active");
	$(".tabs").hover(function(){
		var a=$(".tabs").index(this);
		$(".tabs:eq("+a+") .num1").click(function(){
			$(".tabs:eq("+a+") .tab_content").show();
			$(".tabs:eq("+a+") li").removeClass("active");
			$(".tabs:eq("+a+") li:eq(0)").addClass("active");
			$(".tabs:eq("+a+") .tab_content2").hide();
        });
		$(".tabs:eq("+a+") .num2").click(function(){			
			$(".tabs:eq("+a+") .tab_content2").show();
			$(".tabs:eq("+a+") .tab_content").hide();
			$(".tabs:eq("+a+") li").removeClass("active");
			$(".tabs:eq("+a+") li:eq(1)").addClass("active");
		});
		
    });
});

/* Up down */
$(function(){var $elem=$('#content');$('#nav_up').fadeIn('slow');$('#nav_down').fadeIn('slow');$(window).bind('scrollstart',function(){$('#nav_up,#nav_down').stop().animate({'opacity':'0.2'});});$(window).bind('scrollstop',function(){$('#nav_up,#nav_down').stop().animate({'opacity':'1'});});$('#nav_down').click(function(e){$('html, body').animate({scrollTop:$elem.height()},800);});$('#nav_up').click(function(e){$('html, body').animate({scrollTop:'0px'},800);});});