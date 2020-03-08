var menuToggle = document.querySelectorAll("#menu-toggle");
    $(function() {
            $(menuToggle).on('click', function() {
            $('#sidebar').toggleClass('active');
            $('#menu-toggle').toggleClass('active');
            $('#content').toggleClass('active');
        });
    });

var href = window.location.href;
var n = href.includes("admin_panel");
if (n !== true) {
    $(function() {
        $('#sidebar').toggleClass('active');
        $('#menu-toggle').toggleClass('active');
        $('#content').toggleClass('active');
    });
}
