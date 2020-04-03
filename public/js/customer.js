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


$(".cart_delete").click(function(){
    var current_row = $(this);
    // $(this).closest('tr').hide();
    var id = $(this).data('product-id');
    
    $.ajax({
        url : '/cart/delete/'+id,
        type : 'post',
        data: {_method: 'delete'},
        success: function(data){
             $(current_row).closest('tr').hide();
             $("#lblCartCount").text(data.count);
        },
        error:function(data){
            alert(data.message);
        }

    })
});

$(".cart_quantity_up").click(function(){
    var closest_input = $(this).siblings(".cart_quantity_input");
    var product_id = $(this).siblings(".cart_product_id").val();
    var qunatity = parseInt($(closest_input).val());
    $(closest_input).empty();
    $(closest_input).val(qunatity+1);
    var price = $(this).data('product-price');
    var quant=($(closest_input).val());

    $(this).closest('tr').find(".cart_total_price").text(price*quant);
    var qty = $(closest_input).val();
    // Ajax calling to update quantity
    updateQuantity(product_id,qty);

});

$(".cart_quantity_down").click(function(){
    var closest_input = $(this).siblings(".cart_quantity_input");
    var product_id = $(this).siblings(".cart_product_id").val();
    var qunatity = parseInt($(closest_input).val());
    if(qunatity > 1){
    $(closest_input).empty();
    $(closest_input).val(qunatity-1);
    var price = $(this).data('product-price');
    var quant=($(closest_input).val());

    $(this).closest('tr').find(".cart_total_price").text(price*quant);
    var qty = $(closest_input).val();
    //Ajax call to update quantity
    updateQuantity(product_id,qty);
    }
});

$(".cart_quantity_input").on("input",function(){
    var quantity = $(this).val();
    var product_id = $(this).siblings(".cart_product_id").val();
    console.log(quantity);
    console.log(product_id);
    updateQuantity(product_id,quantity);
});

function updateQuantity(product_id,quantity)
{
    $.ajax({
            url: '/update-quantity',
            type: 'post',
            async: false,
            data: {product_id : product_id,quantity : quantity},
            success : function(data){
                if(data.status){
                    window.location.reload();
                }else{
                    bootbox.alert({
                        title: "Error",
                        message: data.message,
                        callback: function(){
                            window.location.reload();
                        }
                    });
                   
                }
            },
            error : function(data){
                bootbox.alert({
                    title: "Error",
                    message: data.message,
                    callback: function(){
                        window.location.reload();
                    }
                });
            }            
        });
}