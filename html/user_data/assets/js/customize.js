/*スマホ横向き判定*/
$(function(){
    function isMobile() {
        const ua = navigator.userAgent;
        return ua.indexOf('iPhone') > 0 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0
    }
 
    // スマホのときにbodyタグにクラスをつける
    if (isMobile()) {
        document.body.classList.add('ls-mode');
    }
});


$(function () {
});






// スクロールのドラッグ有効化
$(function(){
jQuery.prototype.mousedragscrollable = function () {
    let target;
    $(this).each(function (i, e) {
        $(e).mousedown(function (event) {
            if(event.button === 0){ //左クリックのみ
                event.preventDefault();
                target = $(e);
                $(e).data({
                    "down": true,
                    "move": false,
                    "x": event.clientX,
                    "scrollleft": $(e).scrollLeft(),
                });
                return false
            }
        });
        $(e).click(function (event) {
            if(event.button === 0){
                if ($(e).data("move")) {
                    return false
                }
            }
        });
    });
    $(document).mousemove(function (event) {
        if(event.button === 0){
            if ($(target).data("down")) {
                event.preventDefault();
                let move_x = $(target).data("x") - event.clientX;
                if (move_x !== 0) {
                    $(target).data("move", true);
                } else { return; };
                $(target).scrollLeft($(target).data("scrollleft") + move_x);
                return false
            }
        }
    }).mouseup(function (event) {
        if(event.button === 0){
            $(target).data("down", false);
            return false;
        }
    });
}
$(".scrollmenu").mousedragscrollable();

	
/*詳細カテゴリーメニュー*/
$(function(){
 $(".openWrap").hide(); 
 $(".pt_plus").hide(); 
 var btn = $(".categorynav > ul > li .drop");
 //click
 $(btn).bind("click", "focus", function(event){
 $(".pt_plus").css({display:'block'});
  var shownav = $(this).next(".openWrap");
  
  $(btn).parent("li").removeClass("activenavi");
  $(btn).next(".openWrap").not(shownav).prev("button").removeClass("active");
  $(btn).next(".openWrap").not(shownav).fadeOut(200);
  $(shownav).slideToggle(200);
  $(this).toggleClass('active');
  
  if(!$(this).hasClass('active')){
     $(this).parent("li").removeClass("activenavi");
     $(".pt_plus").css({display:'none'});
  
     
  }else{
     $(this).parent("li").addClass("activenavi");
  }
  
  // すべて表示がクリックされたらサブメニューを消す
  $(".scrollmenu #all").click(function() {
     $(shownav).slideUp(200);
     $(".pt_plus").css({display:'none'});
     $(btn).removeClass('active');
     $(btn).parent("li").removeClass("activenavi");
     
  });
  
  
  return false;
 });

});

/*ハンバーガーメニュー*/
$('.burger-btn').on('click',function(){
  $('.burger-btn').toggleClass('close');
  $('.burger-menu').toggleClass('fade');
 });


/*TOPへ戻るボタン*/
$(function(){
  var pagetop = $('.totopfade');
  // ボタン非表示
  pagetop.hide();
  // 100px スクロールしたらボタン表示
  $(window).scroll(function () {
     if ($(this).scrollTop() > 100) {
          pagetop.fadeIn();
     } else {
          pagetop.fadeOut();
     }
  });
  pagetop.click(function () {
     $('body, html').animate({ scrollTop: 0 }, 300);
     return false;
  });
});
});


/*TOPカテゴリー　スライド*/
//$(function () {
//  $('.scrollmenu').slick({
//    arrows: true,
//    variableWidth: true,
//        touchMove: true,
//        infinite: false,
//        slidesToShow:12,
//    slidesToScroll:1
//  });
//});

 
/*TOPページ　スライド*/
$(function() {
  $('#top-slide').slick({
    arrows: true,
    autoplay: true,
    autoplaySpeed: 2000,
   variableWidth: true,
    centerMode: true,
    dots: true,
    slidesToShow: 1,
    speed: 1000,
     responsive: [
      {
        breakpoint: 768,
        settings: {
          centerPadding: "30",
          variableWidth: false,
        }
      },]
  });
});


/*お礼の品詳細ページ　スライド*/
$(function() {
  $('#thum-slide').sliderPro({
    width:535,
    height:535,
    buttons: false,//ナビゲーションボタン
    arrows: true,
    fadeArrows:false,
    thumbnailWidth: 80,//サムネイルの横幅
    thumbnailHeight: 80,//サムネイルの縦幅
    slideDistance:10,//スライド同士の距離
    thumbnailsPosition: 'bottom',
    thumbnailPointer: false,
    //autoplayDelay:3000,
    autoplay: false,
    responsive:true,
    loop: true,
    breakpoints: {
      992: {//表示方法を変えるサイズ
        thumbnailWidth: 60,
        thumbnailHeight:60,
        width:400,
            height:400,
},
      768: {//表示方法を変えるサイズ
        thumbnailWidth: 48,
        thumbnailHeight:48,
},
    
      576: {//表示方法を変えるサイズ
        thumbnailWidth: 48,
        thumbnailHeight:48,
        width:345,
            height:345,
}}
        
    });

});

	


/*アコーディオン*/
$(function() {
	$('#top .ac-open').hide();
    $("#top .ac-btn").on("click", function() {
        $(this).prev('#top .ac-open').slideToggle('slow','swing');
	   	$(this).toggleClass('active');
	   		if ($(this).text() === 'もっと見る') {
				$(this).text('閉じる');
			} else {
				$(this).text('もっと見る');
			}
    });
 });
$(function() {
	$('#gift .ac-open').hide();
    $("#gift .ac-btn").on("click", function() {
        $(this).prev('#gift .ac-open').slideToggle('slow','swing');
	   	$(this).toggleClass('active');
	   		if ($(this).text() === 'もっと詳しく') {
				$(this).text('閉じる');
			} else {
				$(this).text('もっと詳しく');
			}
    });
 });
//guide
$(function() {
	$('#howto .ac-open').hide();
    $("#howto .ac-btn").on("click", function() {
        $(this).prev('#howto .ac-open').slideToggle('slow','swing');
	   	$(this).toggleClass('active');
	   		if ($(this).text() === 'もっと詳しく') {
				$(this).text('閉じる');
			} else {
				$(this).text('もっと詳しく');
			}
    });
 });
//guide	
	
	


$(function(){
	$('.addition').hide();
	$(".go-cart").click(function(){
		$(this).parent("div").prev(".addition").fadeIn();
	});
});


/*ポップアップ*/
	$(function() {

    // show popupボタンクリック時の処理 見つける（PC / SP）
    $('#popupbtns, #popupbtns-sp').click(function(e) {
        $('#js-popup').show().addClass('is-open');
        $('body').addClass('popup-open');
    });

    // show popupボタンクリック時の処理 フィルター
    $('#popupbtnf').click(function(e) {
        $('#js-popup').show().addClass('is-open');
        $('body').addClass('popup-open');
    });

    // レイヤー/ポップアップのcloseボタンクリック時の処理
    $('#popup-close, #popup-bg').click(function(e) {
        $('#js-popup').hide().removeClass('is-open');
        $('body').removeClass('popup-open');
    });

});
 
 




/*
** Swiper top
*/
  new Swiper('.XX_gallery', {
    centeredSlides: true,
    loop: true,
    speed: 1000,
    slidesPerView: 3,
    spaceBetween: 20,
    navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
//    pagination: {
//          el: '.swiper-pagination',
//    },
    scrollbar: {
          el: '.swiper-scrollbar',
//          hide: true,
        },
    autoplay: {
      delay: 6000,
      disableOnInteraction: false,
      stopOnLastSlide: false,
    },
    breakpoints: {
      320: {
        slidesPerView: 1,//1.15
      },
      640: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 1,
      },
      820: {
        slidesPerView: 1,
      },
      1024: {
        slidesPerView: 1,
//        slidesPerView: 1.4,
      },
      1440: {
        slidesPerView: 1,//2.5
//        slidesPerView: 2.90,
      },
      1920: {
        slidesPerView: 1,//2.5
//      },
//      2560: {
//        slidesPerView: 3.35,
//      },
//      2880: {
//        slidesPerView: 3.75,
      }
    }
  });
  
  
/**
  * Swiper catelist
  */
new Swiper('.sw_catelist', {
  allowTouchMove: true,
  // freeMode: true,
  initialSlide: 0,
  touchRatio: 1,
  //spaceBetween: 30,
  pagination: {
    el: '.swiper-pagination',
    clickable: true
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
    320: {
      slidesPerView: 5.7,
    },
    640: {
      slidesPerView: 8.7,
    },
    768: {
      slidesPerView: 8.7,
    },
    820: {
      slidesPerView: 10.5,
    },
    1020: {
      slidesPerView: 12.5,
    },
    1440: {
      slidesPerView: 13.3,
    }
  }
});
  
  
  
/*
** desvg
*/  
(function() {
"use strict";

var desvg = function(selector, removeInlineCss) {
removeInlineCss = removeInlineCss || false;

var images,
imagesLength,
sortImages = {},

// load svg file
loadSvg = function (imgURL, replaceImages) {
// set up the AJAX request
var xhr = new XMLHttpRequest();
xhr.open('GET', imgURL, true);

xhr.onload = function() {
var xml,
svg,
paths,
replaceImagesLength;

// get the response in XML format
xml = xhr.responseXML;
replaceImagesLength = replaceImages.length;

// bail if no XML
if (!xml) {
return;
}

// this will be the <svg />
svg = xml.documentElement;

// get all the SVG paths
paths = svg.querySelectorAll('path');

if (removeInlineCss) {
// if `removeInlineCss` is true then remove the style attributes from the SVG paths
for (var i = 0; i < paths.length; i++) {
paths[i].removeAttribute('style');
}
}
svg.removeAttribute('xmlns:a');

while(replaceImagesLength--) {
replaceImgWithSvg(replaceImages[replaceImagesLength], svg.cloneNode(true));
}
};

xhr.send();
},

// replace the original <img /> with the new <svg />
replaceImgWithSvg = function (img, svg) {
var imgID = img.id,
imgClasses = img.getAttribute('class');

if (imgID) {
// re-assign the ID attribute from the <img />
svg.id = imgID;
}

if (imgClasses) {
// re-assign the class attribute from the <img />
svg.setAttribute('class', imgClasses + ' replaced-svg');
}

img.parentNode.replaceChild(svg, img);
};

// grab all the elements from the document matching the passed in selector
images = document.querySelectorAll(selector);
imagesLength = images.length;

// sort images array by image url
while (imagesLength--) {
var _img = images[imagesLength],
_imgURL;

if (_img.getAttribute('data-src')) {
_imgURL = _img.getAttribute('data-src')
} else {
_imgURL = _img.getAttribute('src')
}

if (sortImages[_imgURL]) {
sortImages[_imgURL].push(_img);
} else {
sortImages[_imgURL] = [_img];
}
}

// loops over the matched urls
for (var key in sortImages) {
if (sortImages.hasOwnProperty(key)) {
loadSvg(key, sortImages[key]);
}
}

};

window.deSVG = desvg;
})();


$(function(){
deSVG('.caticon',true);
});


//////トップ：スクロール後ヘッダー表示
window.addEventListener('load', ()=>{
   const mainElement = document.querySelector('main#top');
   if (mainElement) {
        //スクロール後ヘッター表示
        $(window).scroll(function () {           //scroll start
          //var pos = $('main').offset();        //Get the height of the main tag beyond mv and store it in the variable [pos]
          //if ($(this).scrollTop() > pos.top) { //If scrolled from the variable [pos] 
          if (window.pageYOffset > 250) {//スクロールタイミング
            $('header-cate').slideDown(400);//.fadeIn
          } else {
            $('header-cate').slideUp(400);//.fadeOut
          }
        }); 
       
 } else {
     /*ヘッダー分mainの高さ調整*/
    hsize = $('header-cate').outerHeight();//ヘッダーの高さを取得
    $("main").css("padding-top", hsize + "px");//取得したヘッダーの高さ分追加指定
    document.querySelector('header-cate').style.display = 'block';

 }

})

/*
** 控除額シミュレーター
*/
;(function($) {
  'use strict';

  function DeductionCalcSet() {
    this.deduction = [
      ['あなたの年収・あなたの家族構成を選択してください','あなたの年収を選択してください','あなたの年収を選択してください','あなたの年収を選択してください','あなたの年収を選択してください','あなたの年収を選択してください'],
      ['あなたの家族構成を選択してください','28,000円','19,000円','19,000円','15,000円','11,000円','7,000円','0円'],
      ['あなたの家族構成を選択してください','31,000円','23,000円','23,000円','18,000円','14,000円','10,000円','3,000円'],
      ['あなたの家族構成を選択してください','34,000円','26,000円','26,000円','22,000円','18,000円','13,000円','5,000円'],
      ['あなたの家族構成を選択してください','38,000円','29,000円','29,000円','25,000円','21,000円','17,000円','8,000円'],
      ['あなたの家族構成を選択してください','42,000円','33,000円','33,000円','29,000円','25,000円','21,000円','12,000円'],
      ['あなたの家族構成を選択してください','45,000円','37,000円','37,000円','33,000円','29,000円','24,000円','16,000円'],
      ['あなたの家族構成を選択してください','52,000円','41,000円','41,000円','37,000円','33,000円','28,000円','20,000円'],
      ['あなたの家族構成を選択してください','56,000円','45,000円','45,000円','40,000円','36,000円','32,000円','24,000円'],
      ['あなたの家族構成を選択してください','61,000円','49,000円','49,000円','44,000円','40,000円','36,000円','28,000円'],
      ['あなたの家族構成を選択してください','65,000円','56,000円','56,000円','49,000円','44,000円','40,000円','31,000円'],
      ['あなたの家族構成を選択してください','69,000円','60,000円','60,000円','57,000円','48,000円','44,000円','35,000円'],
      ['あなたの家族構成を選択してください','73,000円','64,000円','64,000円','61,000円','56,000円','48,000円','39,000円'],
      ['あなたの家族構成を選択してください','77,000円','69,000円','69,000円','66,000円','60,000円','57,000円','43,000円'],
      ['あなたの家族構成を選択してください','81,000円','73,000円','73,000円','70,000円','64,000円','61,000円','48,000円'],
      ['あなたの家族構成を選択してください','97,000円','77,000円','77,000円','74,000円','68,000円','65,000円','53,000円'],
      ['あなたの家族構成を選択してください','102,000円','81,000円','81,000円','78,000円','73,000円','70,000円','62,000円'],
      ['あなたの家族構成を選択してください','108,000円','86,000円','86,000円','83,000円','78,000円','75,000円','66,000円'],
      ['あなたの家族構成を選択してください','113,000円','104,000円','104,000円','88,000円','82,000円','79,000円','71,000円'],
      ['あなたの家族構成を選択してください','118,000円','109,000円','109,000円','106,000円','87,000円','84,000円','76,000円'],
      ['あなたの家族構成を選択してください','124,000円','114,000円','114,000円','111,000円','105,000円','89,000円','80,000円'],
      ['あなたの家族構成を選択してください','129,000円','120,000円','120,000円','116,000円','110,000円','107,000円','85,000円'],
      ['あなたの家族構成を選択してください','135,000円','125,000円','125,000円','122,000円','116,000円','112,000円','90,000円'],
      ['あなたの家族構成を選択してください','140,000円','131,000円','131,000円','127,000円','121,000円','118,000円','108,000円'],
      ['あなたの家族構成を選択してください','146,000円','137,000円','136,000円','132,000円','126,000円','123,000円','114,000円'],
      ['あなたの家族構成を選択してください','152,000円','143,000円','141,000円','138,000円','132,000円','128,000円','119,000円'],
      ['あなたの家族構成を選択してください','159,000円','150,000円','148,000円','144,000円','138,000円','135,000円','125,000円'],
      ['あなたの家族構成を選択してください','166,000円','157,000円','154,000円','150,000円','144,000円','141,000円','131,000円'],
      ['あなたの家族構成を選択してください','173,000円','164,000円','160,000円','157,000円','151,000円','147,000円','138,000円'],
      ['あなたの家族構成を選択してください','180,000円','171,000円','166,000円','163,000円','157,000円','153,000円','144,000円'],
      ['あなたの家族構成を選択してください','218,000円','202,000円','194,000円','191,000円','185,000円','181,000円','172,000円'],
      ['あなたの家族構成を選択してください','247,000円','247,000円','232,000円','229,000円','229,000円','219,000円','206,000円'],
      ['あなたの家族構成を選択してください','326,000円','326,000円','261,000円','258,000円','261,000円','248,000円','248,000円'],
      ['あなたの家族構成を選択してください','360,000円','360,000円','343,000円','339,000円','343,000円','277,000円','277,000円'],
      ['あなたの家族構成を選択してください','395,000円','395,000円','377,000円','373,000円','377,000円','361,000円','361,000円'],
      ['あなたの家族構成を選択してください','429,000円','429,000円','412,000円','408,000円','412,000円','396,000円','396,000円'],
      ['あなたの家族構成を選択してください','463,000円','463,000円','446,000円','442,000円','446,000円','430,000円','430,000円'],
      ['あなたの家族構成を選択してください','498,000円','498,000円','481,000円','477,000円','481,000円','465,000円','465,000円'],
      ['あなたの家族構成を選択してください','533,000円','533,000円','516,000円','512,000円','516,000円','500,000円','500,000円'],
      ['あなたの家族構成を選択してください','569,000円','569,000円','552,000円','548,000円','552,000円','536,000円','536,000円'],
      ['あなたの家族構成を選択してください','604,000円','604,000円','587,000円','583,000円','587,000円','571,000円','571,000円'],
      ['あなたの家族構成を選択してください','640,000円','640,000円','623,000円','619,000円','623,000円','607,000円','607,000円'],
      ['あなたの家族構成を選択してください','773,000円','773,000円','754,000円','749,000円','754,000円','642,000円','642,000円'],
      ['あなたの家族構成を選択してください','814,000円','814,000円','795,000円','790,000円','795,000円','776,000円','776,000円'],
      ['あなたの家族構成を選択してください','855,000円','855,000円','835,000円','830,000円','835,000円','817,000円','817,000円']
    ]
  }

  DeductionCalcSet.prototype = {
    init : function() {
      this.attachElement();
      this.resultSet();
      this.selectTrigger();
    },

    attachElement : function() {
      this.select1 = $('#select_income');
      this.select2 = $('#select_family');
      this.result = $('#result_value');
    },

    resultSet : function() {
      var self = this,
          num1 = self.select1.prop('selectedIndex'),
          num2 = self.select2.prop('selectedIndex'),
          simulatorResult = document.getElementById('bg-result');

      if (num1 === 0 || num2 === 0) {
        $('#result_value').addClass("bg-simulator-ta");
        simulatorResult.classList.remove("is-over");
      } else {
        $('#result_value').removeClass("bg-simulator-ta");
        simulatorResult.classList.add("is-over");
      }
      self.result.val(self.deduction[num1][num2]);
    },

    selectTrigger : function() {
      var self = this;
      $(self.select1).on('change', function() {
        self.resultSet();
      });
      $(self.select2).on('change', function() {
        self.resultSet();
      });
    }
  };

  (function() {
    window.deductioncalc = new DeductionCalcSet();
  })();

  $(function() {
    window.deductioncalc.init();
  })
})(jQuery);