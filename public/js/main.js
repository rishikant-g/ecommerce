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

    // Get user ajax 
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




// delete user

$(document).on('click','.delete-category',function(){
    var id = $(this).data('id');
    bootbox.confirm( "Are you sure , You want to delete ?", function(result){
        $.ajax({
                url : '/delete-category',
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