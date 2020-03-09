var checkboxes = document.querySelectorAll('#userDelate');
var userRows =  document.querySelectorAll('#userRow');
function UserMark(userNumber) {
    var User = '#userRow' + userNumber;
    $(User).toggleClass('bg-danger');
}