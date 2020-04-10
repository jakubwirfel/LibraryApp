$(document).ready(function () {
    $('.displaybtn').on('click', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $(".modal-title").html(data[0]);
        $("#title").html(data[0]);
        $("#author").html(data[1]);
        $("#year").html(data[4]);
        $("#description").html(data[5]);
        $("#pages").html(data[3]);
        $("#type").html(data[2]);
        $("#img").attr("alt",data[6])
        $("#img").attr("src",data[7])
        $("#book").val(data[8])
    });
});