$('.radio-btn').click(function() {
    $(".user_row").each(isChecked)
})

function isChecked() {
    var checked = $(this).find(".radio-btn").is(":checked")
    $(this).toggleClass("bg-danger", checked)
}