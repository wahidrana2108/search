<?php
    include("db.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5">
    <form class="d-flex" role="search" method="post">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" id="search">
                <button class="btn btn-outline-success" type="submit" name="submit">Search</button>
            </form>
    </div>

    <div class="container" id="search_result"></div>


    <div class="container mt-5">
      <?php 
        if(isset($_POST['submit'])) {
          $search = $_POST['search'];
          $get_search = "select * from customers where customer_id like '%$search%' or customer_name like '%$search%'";
          $run_search = mysqli_query($con, $get_search);


          if($run_search){
            $num = mysqli_num_rows($run_search);

            if($num>0){
              echo"
              
              <table class='table'>
                <thead>
                  <tr>
                    <th scope='col'>ID</th>
                    <th scope='col'>Name</th>
                    <th scope='col'>Email</th>
                    <th scope='col'>Contact  NO</th>
                  </tr>
                </thead>
                <tbody>";


                while($row_search = mysqli_fetch_array($run_search)){
                

                $name = $row_search["customer_name"];
                $id = $row_search["customer_id"];
                $email = $row_search["customer_email"];
                $contract = $row_search["customer_contact"];

                echo"
                  <tr >
                    <td> <a href='result.php?data=$id'>$id</a></td>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$contract</td>
                  </tr>";
                }
                echo"
                </tbody>
              </table>
              
              ";
            }
            
            else{
              echo "No results found";
            }
          }
          else {
            echo "Something went wrong!";
          }
        }
      ?>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  
  <script type="text/javascript">
      $(document).ready(function(){
        $("#search").keyup(function(){
          var input = $(this).val();
            if(input != ""){
              $.ajax({
                url:"live_search.php",
                method:"POST",
                data:{input:input},

                success:function(data){
                  $("#search_result").html(data);
                }
              });
            }
            else{
              $("#search_result").css("display", "none");
            }
            
        });
      });
  </script>
</body>
</html>

