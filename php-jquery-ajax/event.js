/*
    Selectors
    Events
    Effects
*/
/*
function func1(){
   document.getElementById("img1").style.width="500px";
}
function func2(){
    document.getElementById("img1").style.width="250px";
}
*/
/*
$("#btn1").click(func1);
$("#btn2").click(func2);
    function func1(){
        $("#img1").css('width','500px');
    }
    function func2(){
        $("#img1").css('width','250px');
    }
*/
//good practise of code is to use ready(function()), it will be fully loaded html page before user submitting
/*$("document").ready(function(){
$("#btn1").click(func1);
$("#btn2").click(func2);
    function func1(){
        $("#img1").css('width','500px');
    }
    function func2(){
        $("#img1").css('width','250px');
    }

});
*/
/*$("document").ready(function(){
$("#btn1").dblclick(func1); //double click to zoom
$("#btn2").dblclick(func2);
    function func1(){
        $("#img1").css('width','500px');
    }
    function func2(){
        $("#img1").css('width','250px');
    }

});
*/
/*$("document").ready(function(){
    $("#img1").mouseenter(function(){
        $("#img1").css('width','500px');
    });

    $("#img1").mouseleave(function(){
        $("#img1").css('width','250px');
    });
});
*/
$("#img1").hover(func1,func2) //hover() is replaceable for mouseenter and mouseleave function
function func1(){
    $("#img1").css('width','500px');
}
function func2(){
    $("#img1").css('width','250px');
}