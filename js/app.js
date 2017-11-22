function GameSettings(options){
    this.letters = options;                        
    this.lettersEl = document.querySelectorAll("li");                    
    this.newGameLetter = [];
    this.questionsArray = [];
    this.questions = [];
    this.correctAnswer = [];
    this.questionAssign(this.letters);
    this.activeQuestionEl();
    this.cd;
    this.gp;
    this.gameStarted = false;
    this.gameFinished = false;           
    this.start();
};
GameSettings.prototype.questionAssign = function(obj){
    Object.keys(obj).forEach(function(key) {
        this.newGameLetter.push(key);
        this.questionsArray.push(obj[key]);                    
    }.bind(this));

    for (var i=0; this.questionsArray.length > i; i++){                
        var random = [Math.floor(Math.random()*this.questionsArray[i].length)]
        this.questions[i] = this.questionsArray[i][random]
        //this.lettersEl[i].innerHTML = this.questions[i][1];
        this.correctAnswer[i] = this.questions[i][0]
        console.log(this.questions[i][1], "-------------  " + this.questions[i][0]);
    }            
};
GameSettings.prototype.countDown = function(obj){

};       
GameSettings.prototype.activeQuestionEl = function(obj){
    for (var i=0; this.lettersEl.length >i; i++){
        this.lettersEl[i].setAttribute("data-active","false"); 
        this.lettersEl[0].setAttribute("data-active","true"); 
        this.lettersEl[i].setAttribute("data-answered","false");
        this.lettersEl[i].setAttribute("data-correct","");
        this.lettersEl[i].setAttribute("data-passed","false");
    }           
};
GameSettings.prototype.start = function(obj){
    this.gameStarted = true;
    this.gp = new GamePlay(this.lettersEl, this);
    this.cd = new CircularCntdwn(this);            
};
GameSettings.prototype.finish = function(obj){
    this.gameFinished = true;
    return true;
};

function GamePlay(el,gs){
    this.input = document.getElementById("answer");
    this.inputQ = document.getElementById("question");
    this.currentQ;
    this.activeL = [];
    this.answeredL = [];
    this.correctL = [];
    this.passedL = [];
    for(var i=0; el.length > i; i++){
        this.activeL[i] = el[i].getAttribute("data-active");
        this.answeredL[i] = el[i].getAttribute("data-answered");
        this.correctL[i] = el[i].getAttribute("data-correct");
        this.passedL[i] = el[i].getAttribute("data-passed");
    }            
    console.log(this.activeL,this.answeredL,this.correctL);
    this.toResponde = [];
    this.firstPlayComplete = false;
    this.gamedataArray;
    this.letterArray;
    //this.interaction(gs);
    this.interaction2(gs);
    this.keyListener(gs);
    this.view = new Views("qWrap",".itemQ");
    this.rightA = 0;
    this.wrongA = 0;
    //this.view.circularShow();
};
GamePlay.prototype.interaction2 = function(gs){
    //start new game settings 
    // *** question/answer to start
    var currentAnswer, currentQuestionAssociated;

    // *** element in the view
    var currentEl, prevEl, nextEl;

    this.gamedataArray = []; 
    //if (this.firstPlayComplete){

      //  var letterArray = this.toResponde;
    //}
    this.letterArray = this.firstPlayComplete?this.toResponde:gs.lettersEl;
    for (var i=0; this.letterArray.length > i; i++){                
        var passed = this.letterArray[i].getAttribute("data-passed") == "false";
        if (this.letterArray[i].getAttribute("data-answered") == "false" && passed){
            console.log("not passed");
            var index = parseInt(this.letterArray[i].id.replace("q",""));                     
            currentEl = this.letterArray[i];                     
            currentEl.setAttribute("data-active","true");
            currentEl.classList.remove("passed");
            //TweenMax.to(currentEl,0.3,{className:"+=active"});
            currentEl.classList.add("active");
            //currentEl.style.background = "#999";

            currentAnswer = gs.questions[index][0];                     
            currentQuestionAssociated = "<strong>"+gs.questions[index][1]+"</strong>";                    
            this.inputQ.innerHTML = currentQuestionAssociated;

            this.gamedataArray.push(i);
            this.gamedataArray.push(currentEl);
            this.gamedataArray.push(currentQuestionAssociated);
            this.gamedataArray.push(currentAnswer);                   

            break;
        } 
        /*if (this.gamedataArray ==[]){
            console.log("gioco finito");
        }*/
    }           
    console.log(this.gamedataArray);    
};       
GamePlay.prototype.checkAnswer = function(gs){
    if (this.gamedataArray[3] != undefined){  
        console.log(this.letterArray.length);
        if (this.input.value.toLowerCase() == this.gamedataArray[3].toLowerCase() && this.input.value.toLowerCase() != ""){  
            console.log("giustoooo!!!");
            document.getElementById("right").innerHTML = "Giuste: "+(this.rightA + 1);
            this.wrongA = this.rightA + 1;
            this.gamedataArray[1].setAttribute("data-active","false");
            this.gamedataArray[1].setAttribute("data-answered","true");
            this.gamedataArray[1].setAttribute("data-correct","true");
            this.gamedataArray[1].classList.remove("active");
            this.gamedataArray[1].classList.remove("passed");
            this.gamedataArray[1].classList.add("right");
            //this.gamedataArray[1].style.background = "green";
        } else if (this.input.value.toLowerCase() != this.gamedataArray[3].toLowerCase() && this.input.value.toLowerCase() != "")  {
            console.log("sbagliatoooo!!!");
            document.getElementById("wrong").innerHTML = "Sbagliate: " + (this.wrongA + 1);
            this.wrongA = this.wrongA + 1;
            this.gamedataArray[1].setAttribute("data-active","false");
            this.gamedataArray[1].setAttribute("data-answered","true");
            this.gamedataArray[1].setAttribute("data-correct","false");
            //this.gamedataArray[1].style.background = "red";
            this.gamedataArray[1].classList.remove("active");
            this.gamedataArray[1].classList.remove("passed");
            this.gamedataArray[1].classList.add("wrong");
        } else if (this.input.value.toLowerCase() == "")  {
           this.passed();
        }
    }    
    if (this.gamedataArray[0] == (this.letterArray.length-1)){ 
        this.firstPlayComplete = true;
        console.log("giro finito");
        this.checkNotAnswered(gs);
        this.finish(gs);                
    }
    this.input.value = ""; 
    setTimeout(function(){
        this.view.wheeling();
    }.bind(this),500);
    
};
GamePlay.prototype.passed = function(gs){
    console.log("passaparola");
    this.gamedataArray[1].setAttribute("data-active","false");
    this.gamedataArray[1].setAttribute("data-answered","false");
    this.gamedataArray[1].setAttribute("data-correct","false");            
    this.gamedataArray[1].setAttribute("data-passed","true");    
    this.gamedataArray[1].classList.remove("active");
    this.gamedataArray[1].classList.add("passed");  
    //this.gamedataArray[1].style.background = "yellow";   
};
GamePlay.prototype.keyListener = function(gs){
    this.input.addEventListener('keyup', function (e) {
        if (e.keyCode == 13) {                    
            this.checkAnswer(gs);                   
            this.interaction2(gs);                   
         }
    }.bind(this));
    this.input.addEventListener('keyup', function (e) {
        if (e.keyCode == 40) {
            this.passed(gs);
            this.interaction2(gs);   
        }
    }.bind(this));
};
GamePlay.prototype.checkNotAnswered = function(gs){
    this.toResponde = [];
    for (var i=0; gs.lettersEl.length > i; i++){
        if (gs.lettersEl[i].getAttribute("data-answered") == "false"){
            this.toResponde.push(gs.lettersEl[i]);
            gs.lettersEl[i].setAttribute("data-passed","false");
        }                
    }
    console.log(this.toResponde);            
};
GamePlay.prototype.finish = function(gs){
    var right = 0;
    var wrong = 0;
    if (this.toResponde.length == 0){
        this.input.disabled = true;
        clearInterval(gs.cd.interval);
        for (var i=0; gs.lettersEl.length > i; i++){
            console.log("gioco finito");
            gs.lettersEl[i].setAttribute("data-answered","true");                    
            if (gs.lettersEl[i].getAttribute("data-correct") == "true"){
                right++                       
            } else {
                wrong++
                gs.lettersEl[i].classList.remove("active");
                gs.lettersEl[i].classList.remove("passed");
                gs.lettersEl[i].classList.add("wrong");
                //gs.lettersEl[i].style.background = "red";
            }
        }               
    }
    console.log("giuste","---------------",right);
    console.log("sbagliate","---------------",wrong);
};
GamePlay.prototype.timeout = function(gs){
    var right = 0;
    var wrong = 0;
    if (gs.cd.stop){
        this.input.disabled = true;
        for (var i=0; gs.lettersEl.length > i; i++){
            console.log("gioco finito");
            gs.lettersEl[i].setAttribute("data-answered","true");                    
            if (gs.lettersEl[i].getAttribute("data-correct") == "true"){
                right++                       
            } else {
                wrong++
                gs.lettersEl[i].classList.remove("active");
                gs.lettersEl[i].classList.remove("passed");
                gs.lettersEl[i].classList.add("wrong");
                //gs.lettersEl[i].style.background = "red";                
            }
        }       
    }
    console.log("giuste","---------------",right);
    console.log("sbagliate","---------------",wrong);    
};

function CircularCntdwn(gs){            
    this.time = 120;           
    this.svg = document.querySelector('.circle_animation');
    //this.svg.style.strokeDasharray = ((Views.ratioW.dimensions[0]*3.14)) //"1337";
    //this.svg.style.strokeDashoffset = "1337";
    this.timeMin = document.querySelector('h2 span#min');
    this.timeSec = document.querySelector('h2 span#sec');
    this.timeField = document.querySelector('h2');            
    this.initialOffset = (this.svg.getAttribute("r")*2)*3.14;//'785'//'440';
    console.log(this.svg.getAttribute("r"))
    this.stop = false;
    i = 1
    this.interval = setInterval(function() {                
        this.svg.style.strokeDashoffset = this.initialOffset-(i*(this.initialOffset/this.time));                     
        this.timeMin.innerHTML = this.formatSeconds(this.time-i);                  
        if (i >= (this.time / 2)*1 && i <= ((this.time / 2)*1)+2) { 
            this.svg.style.stroke = "#ffd000";
            console.log("quartile1");                   
        } else if (i >= (this.time / 3)*2 && i <= ((this.time / 3)*2)+2) {
            this.svg.style.stroke = "#ff9d00";
            console.log("quartile2")
        } else if (i >= (this.time / 4)*3 && i <= ((this.time / 4)*3)+2) {
            this.svg.style.stroke = "#ff0000";
            console.log("quartile3")
        } 
        if (i == this.time) {
            clearInterval(this.interval);
            this.stop = true;
            setTimeout(function(){
                //this.stop = true;
                gs.gp.timeout(gs);
            },1000);

        }
        i++;  
    }.bind(this), 1000);            
};
CircularCntdwn.prototype.formatSeconds = function(secs) {
    function pad(n) {
        return (n < 10 ? "0" + n : n);
    }                          
    var m = Math.floor(secs / 60);
    var s = Math.floor(secs - m * 60);
    return pad(m) + ":" + pad(s);
};

//circle placement
function Views(container, items){
    this.ratioW;
    this.svg = document.querySelector("svg");
    this.circle = document.querySelector("circle");
    this.parent = document.querySelectorAll("body")[0];
    this.wWrapper = document.getElementById("wrapper");
    this.setSize();
    this.radius = this.wWrapper.offsetWidth/2;//150;
    this.fields = document.querySelectorAll(items);
    this.container = document.getElementById(container);
    this.width = this.container.offsetWidth;
    this.height = this.container.offsetHeight;
    this.angle = 4.7;
    this.step = (2*Math.PI) / this.fields.length;
    this.tl = new TimelineMax();
    console.log(this.tl);
    this.circularShow();    
};
Views.prototype.setSize = function(){
    var d = this.parent;
    var e = this.wWrapper;    
    this.ratioW = new TosnelloObj(d,e, {   
        contentMaxWidth : window.innerWidth,// document.querySelectorAll("body")[0].offsetWidth-50,
        contentMaxHeight : window.innerHeight,//document.querySelectorAll("body")[0].offsetHeight-50,
        contentRatio: 1/1,
        top: 0.05,
        bottom: 0.05,
        left:0,
        right:0,
        margin:"auto"
    });   
    this.ratioW.init();
    this.svg.setAttribute("width", this.ratioW.dimensions[0]);
    this.svg.setAttribute("height", this.ratioW.dimensions[1]);
    this.svg.style.width = this.ratioW.dimensions[0]+"px";
    this.svg.style.height = this.ratioW.dimensions[1]+"px";
    this.circle.setAttribute("r",(this.ratioW.dimensions[0]/2)-76);
    this.circle.setAttribute("cy",(this.ratioW.dimensions[0]/2));
    this.circle.setAttribute("cx",(this.ratioW.dimensions[0]/2));
    this.circle.style.strokeWidth = 80//this.circle.getAttribute("cy");
    this.svg.style.zIndex = -1;
    this.svg.style.strokeDasharray = (this.circle.getAttribute("r")*2)*3.14; //"1337";
    this.svg.style.strokeDashoffset = (this.circle.getAttribute("r")*2)*3.14;
    
};
Views.prototype.circularShow = function(){
    TweenMax.set(".itemQ",{autoAlpha:0});
    for (var i=0;this.fields.length > i; i++){
        var x = Math.round(this.width/2 + this.radius * Math.cos(this.angle) - this.fields[i].offsetWidth/2);   
        var y = Math.round(this.height/2 + this.radius * Math.sin(this.angle) - this.fields[i].offsetHeight/2);      
        //this.fields[i].style.left=x+"px";
        //this.fields[i].style.top=y+"px";
        this.tl.to(this.fields[i],0.4,{autoAlpha:1,left:x+"px",top:y+"px"},"-=0.3").play();
        this.angle += this.step; 
    }
    
    document.getElementById("btn").onclick = function(){   
        //var l = (0.3)*delta;
        //this.angle = (this.angle - l);
        for (var i=0;this.fields.length > i; i++){
            var active = this.fields[i].getAttribute("data-active");
            if (active == "true"){
                console.log(this.fields[i]);
                var delta = parseInt(this.fields[i].id.replace("q",""));
                console.log(delta);
            }
        }
        this.angle = 4.7;
        var l = (0.3)*delta;
        this.angle = (this.angle - l);
        for (var i=0;this.fields.length > i; i++){           
            //this.angle = (this.angle - (0.3*delta));
            var x = Math.round(this.width/2 + this.radius * Math.cos(this.angle) - this.fields[i].offsetWidth/2);   
            var y = Math.round(this.height/2 + this.radius * Math.sin(this.angle) - this.fields[i].offsetHeight/2);
            if(window.console) {
                //console.log(x, y);
            }
            //this.tl.to(this.fields[i],0.2,{autoAlpha:1,left:x+"px",top:y+"px"}).play();
            TweenMax.to(this.fields[i],0.12,{autoAlpha:1,left:x+"px",top:y+"px"}).play();
            //this.fields[i].style.left=x+"px";
            //this.fields[i].style.top=y+"px";                
            this.angle += this.step; 
        } 
    }.bind(this);
};
Views.prototype.wheeling = function(){    
    //var l = (0.3)*delta;
    //this.angle = (this.angle - l);
    for (var i=0;this.fields.length > i; i++){
        var active = this.fields[i].getAttribute("data-active");
        if (active == "true"){
            console.log(this.fields[i]);
            var delta = parseInt(this.fields[i].id.replace("q",""));
            console.log(delta);
        }
    }
    this.angle = 4.7;
    var l = (0.3)*delta;
    this.angle = (this.angle - l);
    for (var i=0;this.fields.length > i; i++){           
        //this.angle = (this.angle - (0.3*delta));
        var x = Math.round(this.width/2 + this.radius * Math.cos(this.angle) - this.fields[i].offsetWidth/2);   
        var y = Math.round(this.height/2 + this.radius * Math.sin(this.angle) - this.fields[i].offsetHeight/2);
        if(window.console) {
            //console.log(x, y);
        }
        //this.tl.to(this.fields[i],0.2,{autoAlpha:1,left:x+"px",top:y+"px"}).play();
        TweenMax.to(this.fields[i],0.12,{autoAlpha:1,left:x+"px",top:y+"px"}).play();
        //this.fields[i].style.left=x+"px";
        //this.fields[i].style.top=y+"px";                
        this.angle += this.step; 
    }
};

/*
=================================================================================================================
TOSNELLO 2.0.1
authors: Nello Staibano, Luca Tosetti
last update: 2016/08/05
=================================================================================================================
*/
function TosnelloObj(parent, children, objSet){    
    this.wrapper = parent instanceof String?document.querySelector(parent):parent;
    this.content = children instanceof String?document.querySelector(children):children;

    this.objSet = (objSet === "undefined") ? null : objSet;
    if (this.objSet != null){    
        this.contentRatio = (this.objSet.contentRatio === undefined || isNaN(this.objSet.contentRatio)) ? 16/9 : this.objSet.contentRatio;        
        this.top = (this.objSet.top === undefined)? 0 : this.objSet.top;
        this.bottom = (this.objSet.bottom === undefined)? 0 : this.objSet.bottom;
        this.left = (this.objSet.left === undefined)? 0 : this.objSet.left;
        this.right = (this.objSet.right === undefined)? 0 : this.objSet.right;
        this.bottomBarFixedHeight = (this.objSet.bottomBarFixedHeight === undefined)? 0 : this.objSet.bottomBarFixedHeight;
        this.sideBarPercWidth = (this.objSet.sideBarPercWidth === undefined)? 0 : this.objSet.sideBarPercWidth;
        this.contentMaxWidth = (this.objSet.contentMaxWidth === undefined)? 1920 : this.objSet.contentMaxWidth;
        this.contentMaxHeight = (this.objSet.contentMaxHeight === undefined)? 1080 : this.objSet.contentMaxHeight;
        this.contentMinWidth = (this.objSet.contentMinWidth === undefined)? 20 : this.objSet.contentMinWidth;
        this.contentMinHeight = (this.objSet.contentMinWidth === undefined)? 20 : this.objSet.contentMinHeight;
        this.margin = (this.objSet.margin === undefined) ? "auto" : this.objSet.margin;
    } else {
        this.contentRatio = 16/9; //c;
        this.top = 0;//d;
        this.bottom = 0;//e;
        this.left = 0;//f;
        this.right = 0;//g;       
        this.bottomBarFixedHeight = 0;//h;    
        this.sideBarPercWidth = 0;//i;
        this.contentMaxWidth = 1920;
        this.contentMaxHeight = 1080;
        this.contentMinWidth = 20;
        this.contentMinHeight = 20;
        this.margin = "auto";

    }

    this.contentWidth;
    this.contentHeight;

    this.dimensions = [];
    this.reducePercentageH;
    this.reducePercentageW;
    this.reducePercentage;    
};
TosnelloObj.prototype.ratio = function(){

    this.containerWidth = this.wrapper.offsetWidth;
    this.containerHeight = this.wrapper.offsetHeight;  
    //this.containerHeight = (window.innerHeight < this.wrapper.offsetHeight)?window.innerHeight:this.wrapper.offsetHeight;  

    var totalHeightDelta = this.top + this.bottom;    
    var totalWidthDelta = this.left + this.right;  
    var containerAvailableHeight = this.containerHeight * (1 - totalHeightDelta);  
    var containerAvailableWidth = this.containerWidth * (1 - totalWidthDelta);  
    if (containerAvailableHeight > this.contentMaxHeight) {
        containerAvailableHeight = this.contentMaxHeight;
    } else if (containerAvailableHeight < this.contentMinHeight) {
        containerAvailableHeight = this.contentMinHeight;
    }
    if (containerAvailableWidth > this.contentMaxWidth) {
        containerAvailableWidth = this.contentMaxWidth;
    } else if (containerAvailableWidth < this.contentMinWidth) {
        containerAvailableWidth = this.contentMinWidth;
    }
    if (containerAvailableWidth > containerAvailableHeight) {
        this.contentHeight = containerAvailableHeight;
        this.contentWidth = (this.contentHeight * this.contentRatio);
        if (this.contentWidth >= containerAvailableWidth) {
            this.contentWidth = containerAvailableWidth;
            this.contentHeight = (this.contentWidth / this.contentRatio);
        }
    } else {
        this.contentWidth = containerAvailableWidth;
        this.contentHeight = (this.contentWidth / this.contentRatio);
        if (this.contentHeight >= containerAvailableHeight) {
            this.contentHeight = containerAvailableHeight;
            this.contentWidth = (this.contentHeight * this.contentRatio);
        }
    }
    this.reducePercentageH = 1 - (this.bottomBarFixedHeight / this.contentHeight);
    this.reducePercentageW = 1 / (1 + this.sideBarPercWidth);
    this.reducePercentage = Math.min(this.reducePercentageH, this.reducePercentageW);    
    this.dimensions[0] = this.contentWidth * this.reducePercentage;
    this.dimensions[1] = this.contentHeight * this.reducePercentage;   
    return this.dimensions;
};
TosnelloObj.prototype.setContentRatio = function(position){ 
    this.ratio();    
    this.content.style.position = "absolute";
    this.content.style.width = this.dimensions[0]  +"px";
    this.content.style.height = this.dimensions[1] + "px";
    this.content.style.top = isNaN(this.top)?"auto":this.top * 100 + "%";    
    this.content.style.bottom = isNaN(this.bottom)?"auto":this.bottom * 100 + "%"; 
    this.content.style.left = isNaN(this.left)?"auto":this.left * 100 + "%";    
    this.content.style.right = isNaN(this.right)?"auto":this.right * 100 + "%";             
    this.content.style.margin = this.margin;
};
TosnelloObj.prototype.init = function(position){
    this.setContentRatio(position);    
    //window.addEventListener("resize", this.setContentRatio.bind(this));    
};

var a = new GameSettings(qa);
//var circle = new Views("qWrap",".itemQ");