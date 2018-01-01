$(function () {

    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $(this).toggleClass('is-active');
        $("#wrapper").toggleClass("toggled");
        $('.sidebar-nav-footer').animate({
            width:'toggle'
        }, 400);
    });
});
