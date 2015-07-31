
/**********************************
 * Router
 * using jQuery Router plugin
 *  require jQuery 1.2
 *  (c) Hideaki Tanabe <http://blog.kaihatsubu.com>
 *  reference http://tech.kayac.com/archive/javascript-url-dispatcher.html
 *  Licensed under the MIT License.
 **********************************/
(function($) {
	var pathname = location.pathname;
	$.route = function() {
		$.each(arguments, function(index) {
			var path = this["path"];
			var func = this["func"];
			if (path && func) {
				if (pathname.match(path)) {
					$(function() {
						func.apply(this);
					});
				}
			}
		});
	};
})(jQuery);

$.route(
	//common
	{path: /./,func: function() {
	}},
	
	//home(auth)
	{path: /.*\/home/,func: function() {
		initMap('#svg_map');
		setMap('#svg_map',arrOthers,'#f1c40f');
		setMap('#svg_map',arrMe,'#f73965');
	}},
	
	//my view(auth)
	{path: /.*\/users$/,func: function() {
		initMap('#svg_map');
		setMap('#svg_map',currentSet,'#f73965');
		EditMode('#UserIndexForm');
		resizeMapTitle();
	}},

	//friend view(auth)
	{path: /.*users\/view\/.*/,func: function() {
		initMap('#svg_map');
		setMap('#svg_map',arr,'#f73965');
		resizeMapTitle();
	}},
	
	//area list(auth)
	{path: /.*areas.*/,func: function() {
		fixAdsense();
	}}
);

var FirstCreateMap = 0;
$("#CreateButton").click(function() {
	if(FirstCreateMap++ == 0) {
		createMap();
	}
})

/**********************************
 * Define
 **********************************/ 
var Map = $("#Map");
var Edit = $("#Edit");
var Share = $("#Share");
var Cancel = $("#Cancel");
var Submit = $("#Submit");
var DefaultHead = $("#DefaultHead");
var EditHead = $("#EditHead");
var EditSum = $("#EditSum");
var MapMode = $("#MapMode");
var FlagMode = $("#FlagMode");

var Flag = $("#FlagSelect");
var FlagSelect = $("#FlagSelect ul li");

var Age = $("#Age");
var Sex = $("#Sex li");

/**********************************
 * Fix Adsense
 **********************************/ 
function fixAdsense() {	
	var Box = $('.ads_large');
	$(window).scroll(function () {
		if($(window).scrollTop() > 180) {
			Box.css('position','fixed').css('top','10px');
		} else {
			Box.css('position','inherit').css('top','75px');
		}
	})
}

/**********************************
 * Create Map
 **********************************/ 
function resizeMapTitle() {
	MapTitle = $("#MapTitle");
	
	var len = 0;
	strSrc = escape(MapTitle.text());
	for(i = 0; i < strSrc.length; i++, len++){
		if(strSrc.charAt(i) == "%"){
			if(strSrc.charAt(++i) == "u"){
				i += 3;
				len++;
			}
			i++;
		}
	}
	len = Math.ceil(len.toString() / 2) - 7;
	
	if(len <= 10) {
		MapTitle.css('font-size','48px');
	} else if(len <= 13) {
		MapTitle.css('font-size','42px');
	} else {
		MapTitle.css('font-size','36px');
	}
}

function createMap() {
	initMap('#svg_map');
	var newSet = [];
	
	//function call
	EditModeOn = 1;
	SelectFlag(newSet);
	ClickMap(newSet);
	
	//display
	Map.show();
	Flag.hide();
	MapMode.addClass('active');
	FlagMode.removeClass('active');
	
	MapMode.click(function() {
		Map.show();
		Flag.hide();
		MapMode.addClass('active');
		FlagMode.removeClass('active');
	})
	
	FlagMode.click(function() {
		Map.hide();
		Flag.show();
		MapMode.removeClass('active');
		FlagMode.addClass('active');
	})
	
	Sex.click(function() {
		Sex.removeClass('active');
		$(this).addClass('active');
		$(':hidden[name="data[User][sex]"]').val($(this).attr('name'));
	})
	
	Submit.click(function () {
		//add
		var max = newSet.length;
		for(var i=0; i<max; i++) {
			$(':hidden[name="data[User]['+newSet[i]+']"]').val(1);
		}
		$(':hidden[name="data[User][age]"]').val(Age.val());
		
		//validation
		if($(':hidden[name="data[User][age]"]').val() == '' || $(':hidden[name="data[User][sex]"]').val() == '') {
			alert('年齢、性別を入力して下さい');
			return;
		}
		
        $("#UserCreateForm").submit();
	})
}

/**********************************
 * Map
 * using jqvmap
 **********************************/ 
function initMap(target) {
	jQuery(target).vectorMap({
		map: 'world_ja',
		enableZoom: false,
		backgroundColor: '',
		color: '#fff',
		hoverColor: '#ddd',
		selectedColor: '#f73965',
		borderWidth : 0.1,
		borderOpacity : 0.1,
	});
}

function setMap(target,arr,color) {
	var max = arr.length;
	for(var i=0; i<max; i++) {
		var code = arr[i];
		jQuery(target).vectorMap('set', 'colors', hash(code, color));
	}
}

function hash(key, value) {
	var h = {};
	h[key] = value;
	return h;
}


/**********************************
 * Edit Mode
 **********************************/ 
var EditModeOn;
var currentSet;
var newSet;

function EditMode(form) {

	if(currentSet != null) {
		currentSet.slice(0);
	}

	Edit.click(function() {
		//new set
		newSet = currentSet.slice(0);
		EditSum.text(currentSet.length);
		
		//function call
		EditModeOn = 1;
		SelectFlag(newSet);
		ClickMap(newSet);
		
		//display
		Share.hide();
		Edit.hide();
		Cancel.show();
		Submit.show();
		DefaultHead.hide();
		EditHead.show();
		Map.show();
		Flag.hide();
		MapMode.addClass('active');
		FlagMode.removeClass('active');
		$(".header").stop().animate({ backgroundColor: "#23A8E4" }, 600);
		$(".map").stop().animate({ backgroundColor: "#23A8E4" }, 600);
	})
	
	MapMode.click(function() {
		Map.show();
		Flag.hide();
		MapMode.addClass('active');
		FlagMode.removeClass('active');
	})
	
	FlagMode.click(function() {
		Map.hide();
		Flag.show();
		MapMode.removeClass('active');
		FlagMode.addClass('active');
	})
	
	Cancel.click(function() {
		//invalid called function
		EditModeOn = 0;
				
		//display
		Share.show();
		Edit.show();
		Cancel.hide();
		Submit.hide();
		DefaultHead.show();
		EditHead.hide();
		Map.show();
		Flag.hide();
		$(".header").stop().animate({ backgroundColor: "#64C4F0" }, 600);
		$(".map").stop().animate({ backgroundColor: "#64C4F0" }, 600);
		
		Flag.removeClass('active');
		var max = currentSet.length;
		for(var i=0; i<max; i++) {
			$('[name='+currentSet[i]+']').addClass('active');
		}
		
		setMap('#svg_map',newSet,'#fff');
		setMap('#svg_map',currentSet,'#f73965');
	})
		
	Submit.click(function () {
		//reset
		var max = currentSet.length;
		for(var i=0; i<max; i++) {
			$(':hidden[name="data[User]['+currentSet[i]+']"]').val(0);
		}
		
		//add
		var max = newSet.length;
		for(var i=0; i<max; i++) {
			$(':hidden[name="data[User]['+newSet[i]+']"]').val(1);
		}
		
        $(form).submit();
	})
}


/**********************************
 * Select Flag
 **********************************/
function SelectFlag(newSet) {
	
	FlagSelect.click(function () {
	
		if(EditModeOn != 1) return;
	
		var code = $(this).attr('name');
		
		if(newSet.indexOf(code) == -1) {
			jQuery('#svg_map').vectorMap('set', 'colors', hash(code,'#f73965'));
			$(this).addClass('active');
			newSet.push(code);
		} else {
			jQuery('#svg_map').vectorMap('set', 'colors', hash(code,'#ffffff'));
			$(this).removeClass('active');
			newSet.some(function(v, i){
				if (v==code) newSet.splice(i,1);
			});
		}
		
		EditSum.text(newSet.length);
	})
}


/**********************************
 * Click Map
 **********************************/
function ClickMap(newSet) {

	jQuery('#svg_map').bind('regionClick.jqvmap', function (event,code,region) {
		
		if(EditModeOn != 1) return;

		if(newSet.indexOf(code) == -1) {
			jQuery('#svg_map').vectorMap('set', 'colors', hash(code,'#f73965'));
			$('[name='+code+']').addClass('active');
			newSet.push(code);
		} else {
			jQuery('#svg_map').vectorMap('set', 'colors', hash(code,'#fff'));
			$('[name='+code+']').removeClass('active');
			newSet.some(function(v, i){
				if (v==code) newSet.splice(i,1);    
			});
		}
		
		EditSum.text(newSet.length);
	})
	
	jQuery('#svg_map').bind('regionMouseOut.jqvmap', function (event,code,region) {
	
		if(EditModeOn != 1) return;
		
		if(newSet.indexOf(code) == -1) {
			jQuery('#svg_map').vectorMap('set', 'colors', hash(code,'#fff'));
		} else {
			jQuery('#svg_map').vectorMap('set', 'colors', hash(code,'#f73965'));
		}
	})

}