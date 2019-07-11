$(document).ready(function (e) {
    var audio = new Audio('static/gf.mp3');
    audio.play();
    afterCredit();
});
function afterCredit(){
    var maskHeight = $(document).height()+300;
    var maskWidth = $(window).width();

    $('#titles').css({
        'width': maskWidth,
        'height': maskHeight
    });

    $('#titles').fadeIn(1000);
    $('#titles').fadeTo("slow");
    $('#titles').fadeIn();
    $('#credits').css("left", (($('#credits').parent().width() - $('#credits').outerWidth()) / 2) + "px");
    $('#credits').css("bottom", "-" + (maskHeight * 2) + "px");
    $('#credits').show('slow');

    $('#credits').animate({
        bottom: maskHeight + "px"
    }, {
        duration: 60000,
        complete: function () {
            $('#titles').fadeOut();
            $('.window').fadeOut();
            $('#credits').css("bottom", "-" + (maskHeight * 2) + "px");
            $('#the-end').val('true');
        }
    });
}