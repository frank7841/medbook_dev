<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital Check-In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css"/>
</head>
  <body>
      <?php
        include_once 'con.php';
    
      #echo "Connected successfully";
      if(isset($_POST['submit'])){
        $name = $_POST['p_name'];
        $birthDate=$_POST['dob'];
        $comments = $_POST['comments'];
        $gender = $_POST['gender'];
        $service = $_POST['service'];
    
        $sql = "INSERT INTO tbl_patient (p_name, dob, comments) VALUES('$name','$birthDate','$comments')";
        $sql_gender = "INSERT INTO tbl_gender(g_type) VALUES('$gender')";
        $sql_service = "INSERT INTO tbl_service (s_type) VALUES('$service')"; 
        $message = "Success";
                
        if(mysqli_query($conn, $sql) ){
            echo "<script type='text/javascript'>alert('$message');</script>";
            
        }
        if(mysqli_query($conn, $sql_gender)){
            echo "<script type='text/javascript'>alert('$message');</script>";

        }
        if(mysqli_query($conn, $sql_service)){
            echo "<script type='text/javascript'>alert('$message');</script>";

        }
        header("Location: index.php");
    }
    //prepare select
        // $slect_patient = "SELECT * FROM  tbl _patient"
      
      ?>
   

    
    <div class='top text-center'>
        <h1>Receptionist - </h1>
    </div>
    <div class= "container">
        <div class="row">
        <div class='col'>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="p_name" class="form-label">Patient's Name</label>
                    <input type="text" class="form-control" name ="p_name" id="p_name" placeholder="John Doe">
                </div>

                <div class="mb-3">
                    <label for="dob" class="form-label">Date Of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" >
                </div>
                <div class="mb-3">
                    <select name="gender" id="gender" class="form-select" aria-label="Default select example" >
                        <option selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <select name="service" id = "service" class="form-select" aria-label="Default select example" >
                        <option selected>Select Type of service</option>
                        <option value="outpatient">Outpatient</option>
                        <option value="inpatient">Inpatient</option>
                    </select>
                </div>
                <div class = "mb-3">
                <label for="g_comments">Example textarea</label>
                <textarea class="form-control" id="g_comments" name ="comments" rows="3"></textarea>
                </div>
                <div class ="mb-3">
                <input class="btn btn-primary" type="submit" name = "submit" value="submit">
                </div>
            </form>
        </div>    
        

        <div class="table_display">
        <!-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.."> -->
            <?php
                #include_once 'con.php';
                $select_patient = 'SELECT *   FROM  `tbl_patient` INNER JOIN `tbl_service` ON tbl_patient.patient_id = tbl_service.patient_id INNER JOIN `tbl_gender` ON tbl_patient.patient_id = tbl_gender.patient_id   ';
                // $selct_service = 'SELECT gstype FROM `tbl_service`';
                // $select_gender ='SELECT g_type   FROM `tbl_gender';

                if(! ($selectquery = mysqli_query($conn, $select_patient))){
                    echo'data Retrieval failed';

                }
                else{

                }

            ?>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Date Of Birth</th>
      <th scope="col">Gender</th>
      <th scope="col">Type Of service</th>
      <th scope="col">General Comments</th>
    </tr>
  </thead>
  <tbody>
      <?php 
        if (mysqli_num_rows($selectquery)==0){
            echo '<tr><td colspan = "4">No Rows Returned</td></tr>';

        }
        else{
            while($row = mysqli_fetch_assoc($selectquery)){
                echo "<tr><td>{$row['p_name']}</td><td>{$row['dob']}</td><td>{$row['g_type']}</td><td>{$row['s_type']}</td><td>{$row['comments']}</td></tr>";
            }
        }
      ?>
   
    
  </tbody>
</table>

        </div>
    </div>
  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>