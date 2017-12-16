$(document).ready(function () {

    var isAuthenticated = $('.js-user-logged').data('is-authenticated');

    if (isAuthenticated) {

        $('#btn-play').on('click', function () {
            alert('fils de pute');
            console.log('fils de pute');
            player.play();
        });

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar, #content').toggleClass('active');
            $(this).toggleClass('active');
        });
    } else {
        $('#sidebar, #content').toggleClass('active');
    }

});
