<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax-Jquery-PHP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <div class="modal" tabindex="-1" role="dialog" id="modal_frm">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">User Detail</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="frm">
                <input type="hidden" name="action" id="action" value="Insert">
                <input type="hidden" name="id" id="uid" value="0">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" id="email" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" id="password" required class="form-control">
                </div>
                <div class="form-group">
                    <label>User Type</label>
                    <select name="user_type" id="user_type" required class="form-control">
                        <option value="">Select</option>
                        <option value="normal">normal</option>
                        <option value="admin">admin</option>
                    </select>
                </div>
                <input type="submit" value="Submit" class="btn btn-success">
              </form>
            </div>
          </div>
        </div>
        </div>  
    <div class="container mt-5">
        <p class="text-right"><a href="#" class="btn btn-success" id="add_record">Add Record</a><p>
    
    <table class="table table-bordered">
      <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>User Type</th>
        <th>Edit</th>
        <th>Delete</th>
      </thead>
      <tbody id="tbody">      
    <?php
      $conn=mysqli_connect("localhost","root","","test");
      $sql="select * from user_table";
      $res=$conn->query($sql);
      while($row=$res->fetch_assoc()){
        echo "
          <tr uid={$row["id"]}>
              <td>{$row["name"]}</td>
              <td>{$row["email"]}</td>
              <td>{$row["password"]}</td>
              <td>{$row["user_type"]}</td>
              <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
              <td><a href='#' class='btn btn-primary delete'>Delete</a></td>
          </tr>";
      }
    ?>
    </tbody>
    </table>
    <script>
        $(document).ready(function(){
                $current_row=null;
                $("#add_record").click(function(){   // Add or Insert Record to Database
                    $("#modal_frm").modal();
                    clear_input();
                });
                $("#frm").submit(function(event){
                  event.preventDefault();                 
                  $.ajax({
                    url:"<?php echo base_url(); ?>insert",
                    type:"post",
                    data:$("#frm").serialize(),
                    beforeSend:function(){
                      $("#frm").find("input[type='submit']").val("Loading");
                    },
                    success:function(res){
                      //alert("working");
                      if(res){                        
                        if(($("#uid").val())=="0"){                          
                          $("#tbody").append(res);
                        }else{
                          $current_row.html(res);
                        }
                      }else{
                        alert("Failed Try Again");
                      }
                      $("#frm").find("input[type='submit']").val("Submit");
                      clear_input();
                      $("#modal_frm").modal("hide");
                      location.reload();
                    }
                  });
                });

                $("body").on("click",".edit",function(event){ // Edit or Update Record to Database
                  event.preventDefault();
                  $current_row=$(this).closest("tr");
                  $("#modal_frm").modal();
                  var id=$(this).closest("tr").attr("uid");
                  var name=$(this).closest("tr").find("td:eq(0)").text();
                  var email=$(this).closest("tr").find("td:eq(1)").text();
                  var password=$(this).closest("tr").find("td:eq(2)").text();
                  var user_type=$(this).closest("tr").find("td:eq(3)").text();

                  $("#action").val("Update");
                  $("#uid").val(id);
                  $("#name").val(name);
                  $("#email").val(email);
                  $("#password").val(password);
                  $("#user_type").val(user_type);                                 
                });

                $("body").on("click",".delete",function(event){   //Delete Record from Database
                  event.preventDefault();
                  var id=$(this).closest("tr").attr("uid");
                  var cls=$(this);                 
                  if(confirm("Are you Sure?")){
                  $.ajax({
                    url:"ajax_action.php",
                    type:"POST",
                    data:{uid:id,action:'Delete'},
                    beforeSend:function(){
                      $(cls).text("Loading");
                    },
                    success:function(res){                      
                      if(res){
                        $(cls).closest("tr").remove();
                      }else{                        
                        alert("Not Deleted");
                        $(cls).text("Try Again");
                      }
                    }                    
                  });
                }
                });
                

                function clear_input(){
                  $("#frm").find(".form-control").val("");
                  $("#action").val("Insert");
                  $("#uid").val("0");
                }
        });
    </script>
  </div>
</body>
</html>