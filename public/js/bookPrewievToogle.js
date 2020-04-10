$(document).ready(function () {
    $('#reserved').on('click', function() {
        $('#displaybook').toggleClass('unactive');
        $('#Reservation').toggleClass('active');
        $('#reserved').hide();
        $('#ConfirmReservation').toggleClass('active');
        $('#checkReservations').toggleClass('active');
    });
    $('#checkReservations').on('click', function() {
        $('#CheckReserv').toggleClass('active');
        $('#Reservation').toogleClass('active');
    });

    $('#close').on('click', function() {
        $('#reserved').show();
        $('#ConfirmReservation').removeClass('active');
        $('#displaybook').removeClass('unactive');
        $('#Reservation').removeClass('active');
        $('#CheckReserv').removeClass('active');
        $('#checkReservations').removeClass('active');
    });
});