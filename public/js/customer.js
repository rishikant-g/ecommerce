$(document).ready(function(){
    $(".add-to-cart").click(function(){
        var btn = $(this);
        var id = $(this).data('product-id');
        var quantity = 1;
        if(document.getElementById("quantity")){
            quantity = $("#quantity").val();
        }
        $.ajax({
            url: '/add-to-cart',
            type : 'post',
            data : {product_id: id , quantity: quantity},
            success :function(data){
                if(data.status){
                    btn.text('Added to cart');
                    $("#lblCartCount").text(data.count);
                }else{
                    bootbox.alert({
                        title: "Error",
                        message: data.message,
                    });
                }
               
            },
            error: function(data){
                bootbox.alert({
                    title: "Error",
                    message: data.message,
                });
            }
        });

    });
});


// ajax error and success messages
function ajaxMessage(data){
    if(data.status){
        bootbox.alert({
            title: "Success",
            message: data.message,  
        });
     }else{
        bootbox.alert({
            title: "Error",
            message: data.message,
        })
     }
}