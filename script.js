$ = jQuery;
$(document).ready(function() {
    var generateURL = function(){
        var paymentType;
        var fundingSourceName = "";
        var dataString = "";

        var paymentDetails = $("#payment-details").serializeArray();

        $.each(paymentDetails, function(index, value) {
            if (value.name == "type") {
              paymentType = value.value;
              fundingSourceName += paymentType;
            }
            if(value.name == "orientation") {
                fundingSourceName += " (" + value.value + ")";
            }
    
            dataString += "%" + value.name + "=" + value.value;
        });

        $('#nonAPIOutput').text("/pay/" + paymentType + "?" + dataString);
    };

    $("#submit-btn").click(generateURL());
});