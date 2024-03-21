<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App Using PHP-OOP, PDO-MYSQL & Ajax</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.datatables.net/v/bs4/dt-1.13.8/datatables.min.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><i class="fab fa-wolf-pack-battalion"></i>&nbsp; Tresor ELILA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
    </ul>
  </div>
</nav>
    

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="text-center text-danger font-weight-normal my-3">CRUD
                Application Using Bootstrap 4, PHP-OOP, PDO-MYSQL, Ajax, DataTable & 
                SweetAlert 2
            </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h4 class="mt-2 text-primary">All users in database!</h4>
        </div>
        <div class="col-lg-6">
            <button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal"><i 
            class="fas fa-user-plus fa-lg"></i>&nbsp;&nbsp;Add New User</button>
            <a href="action.php?export=excel" class="btn btn-success m-1 float-right"><i class="fas fa-table fa-lg"></i>&nbsp;&nbsp; Export to Excel</a>
        </div>
    </div>
    <hr class="my-1">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive" id="showUser">
                
                  
            </div>
        </div>
    </div>
</div>

<!-- Add New User Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4">
        <form action="" method="post" id="form-data">
            <div class="form-group">
                <input type="text" name="fname" class="form-control" placeholder="First Name" required>
            </div>
            <div class="form-group">
                <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="E-Mail" required>
            </div>
            <div class="form-group">
                <input type="tel" name="phone" class="form-control" placeholder="Phone" required>
            </div>
            <div class="form-group">
                <input type="submit" name="insert" id="insert" value="Add User" class="btn btn-danger btn-block">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
    

<!-- Edit  User Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4">
        <form action="" method="post" id="edit-form-data">
          <input type="hidden" name="id" id="id">
            <div class="form-group">
                <input type="text" name="fname" class="form-control" placeholder="First Name" required id="fname">
            </div>
            <div class="form-group">
                <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" placeholder="E-Mail" required>
            </div>
            <div class="form-group">
                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" required>
            </div>
            <div class="form-group">
                <input type="submit" name="update" id="update" value="Update User" class="btn btn-primary btn-block">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/bs4/dt-1.13.8/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {

        showAllUsers();
        
        function showAllUsers()
        {
            $.ajax({
                url: "action.php",
                type: "POST",
                data: {action:"view"},
                success:function(response)
                {
                    // console.log(response);
                    $("#showUser").html(response);
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }


        //insert ajax request
        $("#insert").click(function (e) {
            if ($("#form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: $("#form-data").serialize()+"&action=insert",
                    success:function(response)
                    {
                      // console.log(response);
                      
                       Swal.fire({
                        title: 'User added successfully!',
                        type: 'success'
                       })
                       $("#addModal").modal('hide');
                       $("#form-data")[0].reset();
                       showAllUsers();
                    }
                    
                });
                
            }
        })

        //Edit User
        $("body").on("click", ".editBtn", function (e) {
              e.preventDefault();
              edit_id = $(this).attr('id');
                  $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {edit_id:edit_id},
                    success:function(response)
                    {
                      data =JSON.parse(response);
                      $("#id").val(data.id);
                      $("#fname").val(data.first_name);
                      $("#lname").val(data.last_name);
                      $("#email").val(data.email);
                      $("#phone").val(data.phone);
                      
                    }
                    
                });
            
        });

         //update ajax request
         $("#update").click(function (e) {
            if ($("#edit-form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: $("#edit-form-data").serialize()+"&action=update",
                    success:function(response)
                    {
                      // console.log(response);
                      
                       Swal.fire({
                        title: 'User updated successfully!',
                        type: 'success'
                       })
                       $("#editModal").modal('hide');
                       $("#edit-form-data")[0].reset();
                       showAllUsers();
                    }
                    
                });
                
            }
        })

         //Delete User
         $("body").on("click", ".delBtn", function (e) {
              e.preventDefault();
              var tr = $(this).closest('tr');
              del_id = $(this).attr('id');
              Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {del_id:del_id},
                    success:function(response)
                    {
                      tr.css('background-color', '#ff6666');
                      Swal.fire(
                        'Deleted!',
                        'User deleted successfully!',
                        'success!',
                    )
                      showAllUsers();
                    }
                    
                });
                }
            });
                  
            
        // });
                            
          });

          //Show User Details
        $("body").on("click", ".infoBtn", function (e) {
              e.preventDefault();
              info_id = $(this).attr('id');             
                  $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {info_id:info_id},
                    success:function(response)
                    {
                      data = JSON.parse(response);
                      Swal.fire({
                        title: '<strong>User Info : ID('+data.id+')</strong>',
                        type: 'info',
                        html: '<b>First Name : </b>'+data.first_name+ 
                              '<br><b>Last Name : </b>'+data.last_name+
                              '<br><b>Email : </b>'+data.email+
                              '<br><b>Phone : </b>'+data.phone,
                              showCancelButton: true,
                      })

                    }
                   
                    
                });
                
            });
    });
</script>
</body>
</html>