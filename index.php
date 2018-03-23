<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<style>
		html,
		body {
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
			background-color: #00bbe6;
		}
		
		#videoWrapper {
			background-repeat: no-repeat;
			background-position: top center;
			background-size: 100%;
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
			position: absolute;
			background-color: #00bbe6;
		}
		
		#container {
			width: 99%;
			max-width: 1014px;
			position: relative;
			top: 150px;
			margin: auto;
			border: 5px solid #fff;
			z-index: 10;
		}
		/*only for ipad*/
		
		#videoWrapper.mobile.tablet #container {
			max-width: 1014px;
			max-height: 570px;
		}
		
		#videoWrapper.mobile.tablet.landscape #container {
			top: auto;
		}
		
		#videoWrapper.mobile.tablet.portrait #container {
			top: auto;
			bottom: 20%;
		}
		
		#videoWrapper.mobile #container {
			max-width: 840px;
			max-height: 473px;
		}
		
		#videoWrapper.mobile.tablet.portrait {
			background-image: url(https://291ae7a900adfaef9e86-478050108f7e6bc6bd35da39eeb8a3d2.ssl.cf3.rackcdn.com/resources/images/eg_bgPage_portraitIpad.jpg);
			background-size: contain;
			background-repeat: no-repeat;
			background-position: top center;
		}
		/* ipad style end */
		/*iphone,android, ipad style*/
		
		#videoWrapper.mobile.portrait {
			background-image: url(images/uci_bgPage_portrait.jpg);
			background-size: contain;
			background-repeat: no-repeat;
			background-position: top center;
		}
		
		#videoWrapper.mobile.portrait #container,
		#videoWrapper.mobile.landscape #container {
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			margin: auto;
			position: absolute;
		}
		
		#videoWrapper.mobile.landscape {
			background-image: url(https://291ae7a900adfaef9e86-478050108f7e6bc6bd35da39eeb8a3d2.ssl.cf3.rackcdn.com/resources/images/eg_bgPage_landscape.jpg);
			background-size: cover;
			background-repeat: no-repeat;
			background-position: top center;
		}
		
		#videoWrapper.mobile .imgDesktop,
		#videoWrapper.mobile.tablet .imgDesktop {
			display: none;
		}
		
		#videoWrapper #btnAcquistaBiglietti {
			background: url(https://291ae7a900adfaef9e86-478050108f7e6bc6bd35da39eeb8a3d2.ssl.cf3.rackcdn.com/resources/images/eg_btnLandingBiglietti.png) no-repeat;
			background-size: contain;
			width: 20vw;
			height: 4vw;
			display: block;
			position: absolute;
			top: 0;
			left: 0;
			right: -480px;
			margin: auto;
			z-index: 1;
			-webkit-transition: all .2s ease;
			-moz-transition: all .2s ease;
			-ms-transition: all .2s ease;
			-o-transition: all .2s ease;
			transition: all .2s ease;
		}
		
		#videoWrapper #btnAcquistaBiglietti:hover {
			opacity: 0.7;
			filter: alpha(opcaity=70);
		}
		
		#videoWrapper.mobile #btnAcquistaBiglietti {
			display: none;
		}
		/*@media screen and (max-width: 940px) {
			#videoWrapper #btnAcquistaBiglietti {
				display: none;
			}
		}*/
	</style>
</head>

<body>
	<div id="videoWrapper">
		<a id="btnAcquistaBiglietti" href="https://www.ucicinemas.it/film/2016/l-era-glaciale-5-rotta-di-collisione/?utm_source=shaa&utm_medium=link&utm_term=acquisto&utm_campaign=iceage5" target="_blank"></a>
		<img class="imgDesktop" src="https://291ae7a900adfaef9e86-478050108f7e6bc6bd35da39eeb8a3d2.ssl.cf3.rackcdn.com/resources/images/eg_bgPage.jpg" style="width:100%; height:auto; position:absolute; top:0; left:0;" />
		<div id="container">
			<div>
				<video id="e_8za8pdo3" data-entryid="e_8za8pdo3" data-usecanvas="iphone" data-accountid="10075" data-configuiid="t_kzldx2i3_c_8wmyexmt" data-isspc="false" width="100%" height="100%" data-usecanvas="iphone"></video>
			</div>
		</div>
	</div>
	<script src="http://player.shaa.it/v3.0/si_player/shaa.min.js"></script>
	<script>
		var isIphone = /webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
		var ua = navigator.userAgent.toLowerCase();
		var isAndroid = ua.indexOf("android") > -1;
		var isIpad = navigator.userAgent.match(/iPad/i) != null;
		var wrapper = document.getElementById("videoWrapper");
		var shaa = new Shaa("prod", false);
		shaa.init();

		if (isIphone || isAndroid || isIpad) {
			wrapper.classList.add("mobile");
			if (window.innerHeight > window.innerWidth) {
				wrapper.classList.add("portrait");
			} else {
				wrapper.classList.add("landscape");
			}
			detectOrientation();
			if (isIpad) {
				wrapper.classList.add("tablet");
			}
		}

		function detectOrientation() {
			if (isIphone || isIpad) {
				window.addEventListener("orientationchange", function () {
					if (orientation == 0 && window.innerHeight > window.innerWidth) {
						wrapper.classList.toggle("landscape");
						wrapper.classList.toggle("portrait");
					} else if (orientation == 90 && window.innerHeight < window.innerWidth) {
						wrapper.classList.toggle("portrait");
						wrapper.classList.toggle("landscape");
					} else if (orientation == -90 && window.innerHeight < window.innerWidth) {
						wrapper.classList.toggle("portrait");
						wrapper.classList.toggle("landscape");
					} else if (orientation == 180 && window.innerHeight > window.innerWidth) {
						wrapper.classList.toggle("landscape");
						wrapper.classList.toggle("portrait");
					}
				});
			} else if (isAndroid) {
				window.addEventListener("resize", function () {
					if (window.innerHeight > window.innerWidth) {
						wrapper.classList.toggle("landscape");
						wrapper.classList.toggle("portrait");
					} else if (window.innerHeight < window.innerWidth) {
						wrapper.classList.toggle("portrait");
						wrapper.classList.toggle("landscape");
					} else if (window.innerHeight < window.innerWidth) {
						wrapper.classList.toggle("portrait");
						wrapper.classList.toggle("landscape");
					} else if (window.innerHeight > window.innerWidth) {
						wrapper.classList.toggle("landscape");
						wrapper.classList.toggle("portrait");
					}
				});
			}
		}
	</script>
	<script>
		(function (i, s, o, g, r, a, m) {
			i['GoogleAnalyticsObject'] = r;
			i[r] = i[r] || function () {
				(i[r].q = i[r].q || []).push(arguments)
			}, i[r].l = 1 * new Date();
			a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
			a.async = 1;
			a.src = g;
			m.parentNode.insertBefore(a, m)
		})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

		ga('create', 'UA-7094040-1', 'auto');
		ga('send', 'pageview');
	</script>
</body>

</html>