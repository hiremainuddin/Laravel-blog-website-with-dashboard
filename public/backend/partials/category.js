
$(document).ready(function(){

    // category table 
    var table = $('#categories').DataTable({
      processing: true,
      serverSide: true,
      resonsive: true,
      autoWidth: true,
      order: [0, 'asc'],
      "ajax" :{
        'url' : baseUrl+'/getAllcategories',
        'type' : 'GET',
      },
      columns: [
      {data: 'id', name: 'id'},
      {data: 'name', name: 'name'},
      {data: 'created_at', name: 'created_at'},
      {data: 'updated_at', name: 'updated_at'},
      {data: 'action', name: 'action', orderable: false, searchable: false},
      {data: 'action1', name: 'action1', orderable: false, searchable: false}
      ],
      "columnDefs" :[
      {
        "render" : function (data, type, row, meta)
        {
          return `<a href="#" class="btn btn-primary btn-sm editCategory" id="${row.id}"><i class='fas fa-pencil-alt'></i></a>`;
        },
        "targets" : 4
      },
      {
        "render" : function (data, type, row, meta)
        {
          return `<a href="#" class="btn btn-danger btn-sm deleteCategory" id="${row.id}"><i class='far fa-trash-alt'></i></a>`;
        },
        "targets" : 5
      },
      ]
    });


    // Create category
    $('#addCategory').submit(function(event)
    {
     event.preventDefault();
     var form = $('#addCategory')[0];
     var formData = new FormData(form);

     $.ajax({
      url  : baseUrl+'/addCategory',
      type : 'POST',
      data : formData,
      contentType : false,
      processData : false,

      success: function(data)
      {
       $('#addCateModal').modal('hide');
       onSuccessRemoveErrors();
       Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Category successfully added',
        })
       table.ajax.reload();
      },

      error: function(reject)
       {
        if (reject.status = 422) {
          refreshErrors();
          var errors = $.parseJSON(reject.responseText);
          $.each(errors.errors, function(key, value){
            $('#'+key).addClass('is-invalid');
            $('#'+key+'_help').text(value[0]);
          })
        }
       } 

     });
    });

    // Get category id for edit
    $(document).on('click', '.editCategory', function(e){

      e.preventDefault();
      var id = $(this).attr('id');
      $.ajax({
        url : baseUrl+'/getCategory'+id,
        type: 'GET',
        processData : false,
        contentType : false,

        success: function(data)
        {
          $('#category_id').val(data.id);
          $('#edit_category_name').val(data.name);
          $('#editCateModal').modal('show');
        },
        error: function(data, textStatus, xhr)
        {

         Swal.fire({
          icon: 'error',
          title: 'Ops',
          text: 'Sorry we are unable to found this record',
         }) 

        }
      });
    });

    // Update category
    $('#editCategory').submit(function(e){
      e.preventDefault();
      var form = $('#editCategory')[0];
      var formData = new FormData(form);
      $.ajax({
        url : baseUrl+'/updateCategory',
        type : 'POST',
        data : formData,
        processData : false,
        contentType : false,
        success: function(data)
        {
          onSuccessRemoveEditErrors();
          $('#editCateModal').modal('hide');
               Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Category updated successfully',
              })
          table.ajax.reload();
        },
        error: function(reject)
        {
          if (reject.status = 422) {
            refreshEditeErrors();
            var errors = $.parseJSON(reject.responseText);
            $.each(errors.errors, function(key, value){
              $('#'+key).addClass('is-invalid');
              $('#'+key+'_help').text(value[0]);
            })
          }
        } 

      });

    });


    $(document).on('click', '.deleteCategory', function(e){
      e.preventDefault();
      var id = $(this).attr('id');
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url : baseUrl+'/deleteCategory'+id,
              type : 'GET',
              processData : false,
              contentType : false,
              success: function(data)
              {
                 Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: 'Category deleted successfully',
                })

                table.ajax.reload();
              },
              error: function(data, textStatus, xhr)
               {

                 Swal.fire({
                  icon: 'error',
                  title: 'Ops',
                  text: 'Sorry we are unable to found this record',
                }); 

               }
             });
          }
        })

    })


    function onSuccessRemoveEditErrors()
    {
     $('#edit_category_name').removeClass('is-invalid');
     $('#edit_category_name').val('');
     $('#edit_category_name_help').text('');
   }

   function refreshEditeErrors()
   {
     $('#edit_category_name').removeClass('is-invalid');
     $('#edit_category_name_help').text('');
   }

   $("#editCateModal").on('hidden.bs.modal', function(){
    onSuccessRemoveEditErrors();
  });


   function onSuccessRemoveErrors()
   {
     $('#category_name').removeClass('is-invalid');
     $('#category_name').val('');
     $('#category_name_help').text('');
   }

   function refreshErrors()
   {
     $('#category_name').removeClass('is-invalid');
     $('#category_name_help').text('');
   }

   $("#addCateModal").on('hidden.bs.modal', function(){
    onSuccessRemoveErrors();
  })

 });