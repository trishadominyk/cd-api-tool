$ = jQuery;
$(document).ready(function() {
    var generateNonAPIURL = function(){
        var paymentType;
        var fundingSourceName = "";
        var dataString = "";

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

        $('#nonAPIOutput').text("localhost/immfx-payments/pay/" + paymentType + "?" + dataString);
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
        $('#customapi-payment-details').attr("action", "localhost/immfx-payments/pay/" + customapi_paymentType);
    };

    $("#nonapi-submit-btn").click(generateNonAPIURL());
    $("#customapi-submit-btn").click(generateCustomAPIURL());
});