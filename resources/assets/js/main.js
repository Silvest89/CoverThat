$( document ).ready(function() {
    var protocol = location.protocol;
    var slashes = protocol.concat("//");
    var host = slashes.concat(window.location.hostname);

    $('a[href="' + host + this.location.pathname + '"]').parents('li,ul').addClass('active');
});