$ = jQuery;
$(document).ready(function() {
    generateNonAPIURL();
    generateCustomAPIURL();

    $('#nonapi-payment-details :input').change(function(){
        generateNonAPIURL();
    });

    $('#customapi-payment-details :input').change(function(){
        generateCustomAPIURL();
    });
});

// $("#customapi-submit-btn").click(generateNonAPIURL());

var generateNonAPIURL = function(){
    var paymentType;
    var fundingSourceName = "";
    var dataString = "";
    var nonAPIUrl;

    var paymentDetails = $("#nonapi-payment-details").serializeArray();

    $.each(paymentDetails, function(index, value) {
        if (index == 2) {
            dataString += value.name + "=" + value.value;
        } else if (value.name == "type") {
            paymentType = value.value;
            fundingSourceName += value.text;
        } else if(value.name == "orientation") {
            fundingSourceName += " (" + value.value + ")";
        } else {
            dataString += "%" + value.name + "=" + value.value;
        }
    });

    dataString += "%funding_source_name=" + fundingSourceName;

    dataString = encodeURI(dataString);

    nonAPIUrl = "http://localhost/immfx-payments/pay/" + paymentType + "?" + dataString;

    $('a#nonAPILink').attr('href', nonAPIUrl)
    $('#nonAPIOutput').text(nonAPIUrl);
};

var generateCustomAPIURL = function(){
    var customapi_paymentType;

    var customapi_paymentDetails = $("#customapi-payment-details").serializeArray();

    $.each(customapi_paymentDetails, function(index, value) {
        if (value.name == "type") {
            customapi_paymentType = value.value;
        }
    });

    $('#customApiOutput').text("localhost/immfx-payments/pay/" + customapi_paymentType);
    $('#customapi-payment-details').attr("action", "http://localhost/immfx-payments/pay/" + customapi_paymentType);
};