var arrows = document.querySelectorAll("#arrow");
    var panel_buttons = document.querySelectorAll("#panelCollapse");
    $(function() {
        $(panel_buttons).on('click', function() {
        $('#panel').toggleClass('active');
        $(arrows).toggleClass('active');
    });
});