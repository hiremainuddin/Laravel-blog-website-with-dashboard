
$(document).ready(function(){

    // Blogs table 
    var table = $('#userAwaitingBlogs').DataTable({
      processing: true,
      serverSide: true,
      resonsive: true,
      autoWidth: true,
      pageLength: 10,
      order: [0, 'desc'],
      "ajax" :{
        'url' : baseUrl+'/user/getAwaitingUserBlogs',
        'type' : 'GET',
      },
      columns: [
      {data: 'id', name: 'id'},
      {data: 'image', name: 'image'},
      {data: 'user_id', name: 'user_id'},
      {data: 'category_id', name: 'category_id'},
      {data: 'title', name: 'title'},
      {data: 'short_description', name: 'short_description'},
      {data: 'active', name: 'active'},
      {data: 'action', name: 'action', orderable: false, searchable: false},
      {data: 'action1', name: 'action1', orderable: false, searchable: false}
      ],
      "columnDefs" :[
      {
        "width" : "5%", "targets" : 1
      },
      {
        "render" : function (data, type, row, meta)
        {
          return `<img src="${baseUrl}/images/blogsImages/${row.image}" class="img-thumbnail rounded">`;
        },
        "targets" : 1
      },

      {
        "render" : function (data, type, row, meta)
        {
          return `<a href="${baseUrl}/user/editBlog/${row.id}" class="btn btn-primary btn-sm btn-circle"><i class='fas fa-pencil-alt'></i></a>`;
        },
        "targets" : 7
      },

      {
        "render" : function (data, type, row, meta)
        {
          return `<a href="#" class="btn btn-danger btn-sm btn-circle deleteBlog" id="${row.id}"><i class='far fa-trash-alt'></i></a>`;
        },
        "targets" : 8
      },
      ]
    });

  $(document).on('click', '.deleteBlog', function(e){
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
              url : baseUrl+'/user/deleteBlog'+id,
              type : 'GET',
              processData : false,
              contentType : false,
              success: function(data)
              {
                 Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: 'Blog deleted successfully',
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

    });

});