$(document).ready(function(){

    // Get user ajax 
        var table = $('.user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/manage-users",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'role', name: 'role'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
});


// ajax error and success messages
function ajaxMessage(data){
    if(data.status){
        bootbox.alert({
            title: "Success",
            message: data.message,
            callback: function(){ 
                window.location.reload();
            }
        });
     }else{
        bootbox.alert({
            title: "Error",
            message: data.message,
        })
     }
}

// delete user

$(document).on('click','.delete-user',function(){
    var id = $(this).data('id');
    bootbox.confirm( "Are you sure , You want to delete ?", function(result){
        if(!result) return;
        $.ajax({
                url : '/delete-user',
                type : 'post',
                data : {id : id},
                success: function(data){
                    ajaxMessage(data); 
                },
                error: function(data){
                    bootbox.alert({
                        title: "Error",
                        message: "Something went wrong",
                    })
                }
            });
    });
  });


  $(document).ready(function(){

    // Get category ajax 
        var table = $('.category-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/manage-category",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'category_name', name: 'category_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
});






// delete Category

$(document).on('click','.delete-category',function(){
    var id = $(this).data('id');
    bootbox.confirm( "Are you sure , You want to delete ?", function(result){
        if(!result) return;
        $.ajax({
                url : '/delete-category/'+id,
                type : 'post',
                data: {_method: 'delete'},
                success: function(data){
                    ajaxMessage(data); 
                },
                error: function(data){
                    bootbox.alert({
                        title: "Error",
                        message: "Something went wrong",
                    })
                }
            });
    });
  });




  $(document).ready(function(){

    // Get banner ajax 
        var table = $('.banner-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/manage-banner",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'banner_name', name: 'banner_name'},
                {data: 'banner_preview', name: 'banner_preview'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
});




// delete banner

$(document).on('click','.delete-banner',function(){
    var id = $(this).data('id');
    bootbox.confirm( "Are you sure , You want to delete ?", function(result){
        if(!result) return;
        $.ajax({
                url : '/delete-banner',
                type : 'post',
                data : {id : id},
                success: function(data){
                    ajaxMessage(data); 
                },
                error: function(data){
                    bootbox.alert({
                        title: "Error",
                        message: "Something went wrong",
                    })
                }
            });
    });
  });


//Initializing select2 and custom file upload

$(document).ready(function(){
    $('.select2bs4').select2({
        theme: 'bootstrap4'
      });

      $(document).ready(function () {
        bsCustomFileInput.init();
      });
  
});


// Get product ajax 
$(document).ready(function(){
        var table = $('.product-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/products",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'product_title', name: 'product_title'},
                {data: 'product_description', name: 'product_description'},
                {data: 'product_price', name: 'product_price'},
                {data: 'product_quantity', name: 'product_quantity'},
                {data: 'product_category', name: 'product_category'},
                {data: 'image', name: 'image', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
});


// delete product

$(document).on('click','.delete-product',function(){
    var id = $(this).data('id');
    bootbox.confirm( "Are you sure , You want to delete ?", function(result){
        if(!result) return;
        $.ajax({
                url : '/delete-product/'+id,
                type : 'post',
                data: {_method: 'delete'},
                success: function(data){
                    ajaxMessage(data); 
                },
                error: function(data){
                    bootbox.alert({
                        title: "Error",
                        message: "Something went wrong",
                    })
                }
            });
    });
  });
