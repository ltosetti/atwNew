<?php
$params = array();
$metas = array();
$params = $_GET;
// defaults
$params['url'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$params['type'] = (isset($_GET['type']) ? $_GET['type'] : 'article');
$params['c'] = (isset($_GET['c']) ? $_GET['c'] : '0'); //read querystring
if(isset($params['c']) && $params['c'] == "0"){
    $metas['image'] = "sample";
    $metas['score'] = isset($_GET['score']);
    $metas['name'] = isset($_GET['name']);
    $metas['title'] = "Around the Word";
    $metas['description'] = "share around the word";
} else {
    $metas['image'] = "sample";
    $metas['score'] = isset($_GET['score']);
    $metas['name'] = isset($_GET['name']);
    $metas['title'] = "Around the Word";
    //$metas['description'] = ucfirst($params['n'])." ha totalizzato ".ucfirst($params['n'])." punti";
    $metas['description'] = "ha totalizzato ".$params['c']." punti";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title></title>        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <!-- Open Graph meta tags -->       
        <meta property="og:url" content="<?php echo $params['url']; ?>" />
        <meta property="og:type" content="<?php echo $params['type']; ?>"/>        
        <meta property="og:title" content="<?php echo $metas['title']; ?>"/>
        <meta property="og:image" content="http://www.shaa.it/demo/luca/<?php echo $metas['image']; ?>.jpg"/>
        <meta property="og:description" content="<?php echo $metas['description']; ?>"/>       
        
        <meta itemprop="name" content="">        
        <meta itemprop="image" content="">
        <meta itemprop="description" content="<?php echo $metas['description']; ?>">
        <link type="text/css" rel="stylesheet" href="css/atwStyle.css" />
</head>
<body>
<?php
echo '<pre>';
    print_r($params);
    print_r($metas);
echo '</pre>';?>           
    <div id="wrapper" class="item html">
        <ul id="qWrap" style="position:absolute;padding:0; margin:0;">
            <li id="q0" class="a itemQ">A</li>            
            <li id="q1" class="b itemQ">B</li>
            <li id="q2" class="c itemQ">C</li>
            <li id="q3" class="d itemQ">D</li>
            <li id="q4" class="e itemQ">E</li>            
            <li id="q5" class="f itemQ">F</li>
            <li id="q6" class="g itemQ">G</li>
            <li id="q7" class="h itemQ">H</li>
            <li id="q8" class="i itemQ">I</li>            
            <li id="q9" class="l itemQ">L</li>
            <li id="q10" class="m itemQ">M</li>
            <li id="q11" class="n itemQ">N</li>
            <li id="q12" class="o itemQ">O</li>            
            <li id="q13" class="p itemQ">P</li>
            <li id="q14" class="q itemQ">Q</li>
            <li id="q15" class="r itemQ">R</li>
            <li id="q16" class="s itemQ">S</li>            
            <li id="q17" class="t itemQ">T</li>
            <li id="q18" class="u itemQ">U</li>
            <li id="q19" class="v itemQ">V</li>
            <li id="q20" class="z itemQ">Z</li>
        </ul>
        <div id="question" data-current="q0"></div>
        <br />
        <input id="answer" data-current="q0" type="text" />
        <svg width="600" height="600" xmlns="http://www.w3.org/2000/svg">
            <g>              
                <circle id="circle" class="circle_animation" r="125" cy="300" cx="300" stroke-width="8" stroke="#6fdb6f" fill="#73b7df"/>
            </g>
        </svg>
        </div>
        <div id="dataContainer">
            <div id="title">Dati di gioco</div>
            <div id="rightTitle">Corrette</div>
            <div id="right" style="">0</div>
            <div id="wrongTitle">Errate</div>
            <div id="wrong" style="">0</div>
        </div>
        <div id="timeContainer">
            <div id="timeTitle">Countdown</div>
            <h2 id="ppTimer"><span id="min"></span></h2> 
        </div>
        <div id="ModalGameOver">
            <div id="ModalGameOverHead">
                <div id="gameOver">GAME OVER</div>
            </div>
            <div id="ModalGameOverBody">
                <div id="labelRecapCorrect" class="recapLabel">Risposte corrette</div>
                <div id="RecapCorrect" class="recap" style="padding:0;position:relative; margin: 0 auto; width:165px; height:105px;">
                    <span id ="recapLeft" class="recapLeft point">0</span>
                    <span class="recapMiddle">/</span>
                    <span class="recapRight point">21</span>
                </div>                
                <hr style="width:75%;">
                <!--<div id="labelRecapWrong" class="recapLabel">Risposte Sbagliate</div>
                <div id="RecapWrong" class="recap">0</div>
                <hr style="width:75%;">-->
                <div id="labelRecapTime" class="recapLabel">Tempo rimanente</div>
                <div id="RecapTime" class="recap">
                    <h2 id="ppTimerRecap">
                        <span id="RecapMin">01:00</span>
                    </h2> 
                </div>                
                <hr style="width:75%;">
                <div id="labelRecapScore" class="recapLabel">Punteggio finale</div>
                <div id="RecapScore" class="recap" style="font-size:65px; font-weight: bold;">80</div>
                <div id="gameReplayBtn" class="modalBtn">Gioca ancora</div>
                <a class="shareFb btnShare modalBtn" href="" target="_blank"></a>
            </div>
        </div>
        <button id="btnStart" class="ribbon-outset border">start game</button>
        <div id="copyRight" style="position:absolute; bottom:1%; right:1%; color:#fff;">&copy; 2018 MadDog Media</div>   
        <input type="text" name="score" id="inputScore" value="10" style="position:absolute;bottom:0;">
        
        <script src="lib/fitText.js" type="text/javascript"></script>
        <script src="https://f219a823068d097e49db-b14287cf40d335cde5226be95ca3ee6b.ssl.cf3.rackcdn.com/TweenMax.min.js" ></script>
        <script src="js/questions.js"></script>
        <script src="js/app.js"></script>   
       
        <script>
            var fb_pre= "https://www.facebook.com/sharer/sharer.php?u=";          
            var url = "http://www.shaa.it/demo/luca/around.php?c=";
            document.querySelector(".shareFb").addEventListener("click",function(event){
                event.preventDefault();                
                prepend = fb_pre;              
                //window.open(prepend+escape(url+"&n="+document.querySelector("#"+" input").value));
                var d = new Date();
                window.open(prepend+escape(url+document.querySelector("#"+"inputScore").value)+"&t="+d.getTime());  
            });
        </script>        
      
       
    </body>    
    
</html>
