$(document).ready(function () {
    setTimeout(function () {
        $('.loader').fadeOut(500).remove();
        $('.bodyActual').fadeIn(500).removeAttr("hidden");
    }, 1000);
});