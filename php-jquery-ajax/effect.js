$("document").ready(function(){
    $("#btn1").click(function(){
        $("#img1").hide(3000);
    })
    $("#btn2").click(function(){
        $("#img1").show(3000);
    })
    $("#btn3").click(function(){
        $("#img1").toggle(3000);
    })
    $("#btn4").click(function(){
        $("#img1").fadeIn(2000);
    })
    $("#btn5").click(function(){
        $("#img1").fadeOut(2000);
    })
    $("#btn6").click(function(){
        $("#img1").fadeToggle(2000);
    })
    $("#btn7").click(function(){
        $("#img1").slideUp(3000);
    })
    $("#btn8").click(function(){
        $("#img1").slideDown(3000);
    })
    $("#btn9").click(function(){
        $("#img1").slideToggle(3000);
    })
    $("#btn10").click(function(){
        $("#img1").stop();
    })
    $("#btn11").click(function(){
        $("#img1").animate({
            left: '150px',
            opacity: '0.5',
            height: '500px',
            width: '500px'
        },2000);
    })
});