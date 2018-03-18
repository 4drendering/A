$(document).ready(function () {
    adad = 0;
    $("#handllebar-color").click(function () {
        $("#list-color-handllebar").fadeIn();
        $("#list-color-body").fadeOut();
        $("#list-color-seat").fadeOut();
        $("#list-color-Wheel").fadeOut();

    });
    $("#body-color").click(function () {
        $("#list-color-body").fadeIn();
        $("#list-color-handllebar").fadeOut();
        $("#list-color-seat").fadeOut();
        $("#list-color-Wheel").fadeOut();
    });
    $("#seat-color").click(function () {
        $("#list-color-seat").fadeIn();
        $("#list-color-handllebar").fadeOut();
        $("#list-color-body").fadeOut();
        $("#list-color-Wheel").fadeOut();
    });
    $("#Wheel-color").click(function () {
        $("#list-color-Wheel").fadeIn();
        $("#list-color-handllebar").fadeOut();
        $("#list-color-seat").fadeOut();
        $("#list-color-body").fadeOut();
    });
    setTimeout(function () {
        $("#col").css('display', 'none');
        $("#textp").css('display', 'none');
    }, 4000);
    $("body").click(function () {
        //adad++;
        if (adad == 2) {
            $("#list-color-Wheel").fadeOut();
            $("#list-color-handllebar").fadeOut();
            $("#list-color-seat").fadeOut();
            $("#list-color-body").fadeOut();
            adad = 0;
        }
    });
    $("#list-color-body , #list-color-seat , #list-color-Wheel , #list-color-handllebar ").click(function () {
        $("#list-color-Wheel").fadeOut();
        $("#list-color-handllebar").fadeOut();
        $("#list-color-seat").fadeOut();
        $("#list-color-body").fadeOut();
    });
});
