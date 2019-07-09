$(document).ready(function (e) {
    afterCredit();
    // $('.window .close').click(function (e) {
    //     e.preventDefault();
    //     $('#credits').css("bottom", "-" + ($(document).height() * 2) + "px");
    //     $('#titles').hide();
    //     $('.window').hide();
    // });

    // $('#titles').click(function () {
    //     $(this).hide();
    //     $('#credits').css("bottom", "-" + ($(document).height() * 2) + "px");
    //     $('.window').hide();
    // });
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
        duration: 30000,
        complete: function () {
            $('#titles').fadeOut();
            $('.window').fadeOut();
            $('#credits').css("bottom", "-" + (maskHeight * 2) + "px");
            $('#the-end').val('true');
        }
    });
}