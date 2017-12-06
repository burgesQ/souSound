$(document).ready(function () {

    var isAuthenticated = $('.js-user-logged').data('is-authenticated');

    if (isAuthenticated) {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar, #content').toggleClass('active');
            $(this).toggleClass('active');
        });
    } else {
        $('#sidebar, #content').toggleClass('active');
    }

});
