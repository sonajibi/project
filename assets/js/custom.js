//highlight-menu
!function () {
    var href = location.href;
    var pgurl = href.substr(href.lastIndexOf('/') + 1);
    // match all the anchors on the page with the html file name
    $('a[href="' + pgurl + '"]').addClass('active-link');
}();

function validate_creditcardnumber() {
    var re16digit = /^\d{16}$/
    if (!re16digit.test(document.myform.CreditCardNumber.value)) {
        alert("Please enter your 16 digit credit card numbers");
        return false;
    }
}