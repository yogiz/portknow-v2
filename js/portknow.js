jQuery(document).ready(function($) {

    // --------- menu topik klik---------
    	$('#nav-first-title').click(function(){
    		$('.menu-primary-container').fadeToggle('10');
    	});
    	
    // --------- icon header -------
    	var search_top_ico = $('.search-top-ico');
    	var close_top_ico = $('.close-top-ico');
    	var search_top_fm = $('#top-search');

    	var head_group = $('.nav-first > span, #top-ico');
    	var must_close = $('.menu-primary-container, #top-search');

    	search_top_ico.click(function(){
    		search_top_fm.show('slow');
    	});
    	close_top_ico.click(function(){
    		search_top_fm.hide('slow');
    	});

    var header = $('.bot-head');
    var range = 200;
    var bgtitle = $('#bg-top-head');
    var imgtitle = $('.site-branding > a > img');
    var x = $('body').offset().top;
    $(window).on('scroll', function () {
      	
        var scrollTop = $(this).scrollTop();
        var offset = header.offset().top;
        var height = header.outerHeight();
        offset = offset + height / 2;
        var calc = 1 - (scrollTop - offset + range) / range;
      
        header.css({ 'opacity': calc });
      
        if ( calc > '1' ) {
          header.css({ 'opacity': 1 });
        } else if ( calc < '0' ) {
          header.css({ 'opacity': 0 });
        }

        if ( scrollTop > 303) {
        	bgtitle.addClass('bg-aktif');
        	head_group.css({"display": "table-cell","vertical-align": "middle"});
        	$('.nav-head').hide();
            $('.menu-mob-top').show();


        } else if  ( scrollTop < 304) {
        	bgtitle.removeClass('bg-aktif');
        	head_group.hide();
        	$('.nav-head').show();  
        	must_close.hide();
            $('.menu-mob-top').hide();	
        }
    });


$('.search-field').attr("placeholder", "cari...");

});

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-43975084-2', 'auto');
  ga('send', 'pageview');
