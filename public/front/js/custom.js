$(document).ready(function () {
    $(".getPrice").change(function () {
        var size = $(this).val();
        var product_id = $(this).attr("product_id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/get-attribute-price",
            data: { size: size, product_id: product_id },
            type: "post",
            success: function (resp) {
                if(resp['discount'] > 0){
                    $(".getAttributePrice").html("<span class='FinalPrice'>"+resp['final_price']+"$</span> <span class='offerPercentage'>( "+resp['discount_percent']+" /% OFF)</span> <span class='dicPrice'>"+resp['product_price']+"$</span> ");
                }else{
                    $(".getAttributePrice").html(" <span class='FinalPrice'>"+resp['final_price']+"$</span> ");
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
});

