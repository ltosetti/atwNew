<?php
$params = array();
$metas = array();
$params = $_GET;

// defaults
$params['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$params['type'] = (isset($_GET['type']) ? $_GET['type'] : 'article');
if($params['c'] == "ravenna"){
    $metas['image'] = "share_ravenna";
    $metas['title'] = "Il cacciatore e la regina di ghiaccio";
    $metas['description'] = ucfirst($params['n'])." sei come ".ucfirst($params['c']).", brillante ed appariscente, non ti piace passare inosservato/a. Guai a farti un torto, la vendetta è assicurata!";
    
} elseif  ($params['c'] == "eric"){
    $metas['image'] = "share_eric";
    $metas['title'] = "Il cacciatore e la regina di ghiaccio";
    $metas['description'] = ucfirst($params['n'])." sei come ".ucfirst($params['c']).", casual e pratico/a, sempre pronto/a ad aiutare gli altri. Meglio non dar fastidio alle persone che ami, perché ti scateni come una furia!";
    
} elseif ($params['c'] == "freya"){
    $metas['image'] = "share_freya";
    $metas['title'] = "Il cacciatore e la regina di ghiaccio";
    $metas['description'] = ucfirst($params['n'])." sei come ".ucfirst($params['c']).", elegante e raffinata/o, non hai mai un capello fuori posto. Ma se qualcuno ti fa arrabbiare, è guerra senza esclusione ti colpi!";
} else {
    $metas['image'] = "share_pagina";
    $metas['title'] = "Il cacciatore e la regina di ghiaccio";
    $metas['description'] = "Guarda il trailer interattivo, rispondi alle domande e scopri il personaggio a cui somigli di più!";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title></title>        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <!--  <meta name="viewport" content="width=device-width, initial-scale=1">-->
        <!-- Open Graph meta tags -->       
        <meta property="og:url" content="<?php echo $params['url']; ?>" />
        <meta property="og:type" content="<?php echo $params['type']; ?>"/>        
        <meta property="og:title" content="<?php echo $metas['title']; ?>"/>
        <meta property="og:image" content="http://ilcacciatoreelareginadighiaccio.ucicinemas.it/images/<?php echo $metas['image']; ?>.jpg"/>
        <meta property="og:description" content="<?php echo $metas['description']; ?><?php echo ' Guarda il trailer Interattivo: rompi lo specchio, rispondi alle domande e scopri anche tu il personaggio a cui somigli!'; ?>"/>
         <!-- twitter meta tags -->
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="<?php echo $params['url']; ?>" />
        <meta name="twitter:title" content="<?php echo $metas['title']; ?>" />
        <meta name="twitter:description" content="<?php echo $metas['description']; ?><?php echo ' Guarda il trailer Interattivo: rompi lo specchio, rispondi alle domande e scopri anche tu il personaggio a cui somigli!'; ?>" />
        <meta name="twitter:image" content="http://ilcacciatoreelareginadighiaccio.ucicinemas.it/images/<?php echo $metas['image']; ?>.jpg" />
        
        <meta name="description" content="<?php echo $metas['description']; ?><?php echo ' Guarda il trailer Interattivo: rompi lo specchio, rispondi alle domande e scopri anche tu il personaggio a cui somigli!'; ?>" />
        
        <meta itemprop="name" content="">        
        <meta itemprop="image" content="">
        <meta itemprop="description" content="<?php echo $metas['description']; ?><?php echo ' Guarda il trailer Interattivo: rompi lo specchio, rispondi alle domande e scopri anche tu il personaggio a cui somigli!'; ?>">
        <style>
           
            html, body {              
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
                background-color: #000;
            }
            #videoWrapper{
                background-image: url(images/uci_bgPage.jpg);
                background-repeat: no-repeat;
                background-position: top center;                
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
                position: absolute; 
                background-color: #000;
            }
            #container {
                max-width: 1280px;
                height: 720px;                
                margin: 130px auto;
            }          
            
            /*only for ipad*/
            #videoWrapper.mobile.tablet #container {
                    max-width: 1024px;
                    max-height: 576px;                     
            }            
            #videoWrapper.mobile.tablet.landscape #container{                   
                    top:auto; 
            }
            #videoWrapper.mobile.tablet.portrait #container{                   
                    top:auto; 
                    bottom:20%;
            }
            #videoWrapper.mobile #container {
                    max-width: 854px;
                    max-height: 480px;                    
            }
            #videoWrapper.mobile.tablet.portrait{
                background-image: url(images/uci_bgPage_portraitIpad.jpg);
                background-size: contain;
                background-repeat: no-repeat;
                background-position: top center;  
            }
            /* ipad style end */
            
            /*iphone,android, ipad style*/
            #videoWrapper.mobile.portrait{
                background-image: url(images/uci_bgPage_portrait.jpg);
                background-size: contain;
                background-repeat: no-repeat;
                background-position: top center; 
            }
            
            #videoWrapper.mobile.portrait #container, #videoWrapper.mobile.landscape #container {
                top:0; 
                bottom:0; 
                left:0; 
                right:0;
                margin: auto;
                position: absolute;
            }
            #videoWrapper.mobile.landscape{
                background-image: url(images/uci_bgPage_landscape.jpg);
                background-size: cover;
                background-repeat: no-repeat;
                background-position: top center; 
            }
        </style>
    </head>
    <body>
        <div id="videoWrapper">
        <div id="container">
            <div>               
                
                <video id="e_fjwdah6f" data-entryid="e_fjwdah6f" data-accountid="10075" data-configuiid="t_kzldx2i3_c_s3j6s728" data-isspc="false" width="100%" height="100%"></video>
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
            var shaa = new Shaa("local", false);
            shaa.init();            
            
            if (isIphone || isAndroid || isIpad){               
                wrapper.classList.add("mobile");
                if (window.innerHeight > window.innerWidth){
                    wrapper.classList.add("portrait");
                } else {
                    wrapper.classList.add("landscape");
                }                
                detectOrientation();
                if (isIpad){
                    wrapper.classList.add("tablet");
                }
            } 
            function detectOrientation(){
                if (isIphone || isIpad){
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
                } else if (isAndroid){
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
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-7094040-1', 'auto');
          ga('send', 'pageview');
        </script>        
    </body>   
</html>
