<!-- Create a form with the following inputs (name, email, password, address, gender, linkedin url,CV) 
Validate inputs then return message to user . 
* validation rules ... 
name  = [required , string]
email = [required,email]
password = [required,min = 6]
address = [required,length = 10 chars]
gender = [required]  {male||female}
linkedin url = [reuired | url]
CV    = [required| PDF] -->





<?php
$Name     =  
$Email    = 
$password = 
$Address  =
$linkedin  = 
$gender = 
$CV = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name     = $_POST['Name'];
    $Email    = $_POST['Email'];
    $password = $_POST['password'];
    $Address  =$_POST['Address'];
    $gender =$_POST['Gender'];
    $CV = $_FILES["CV"];
    // var_dump($CV);
    $linkedin  =$_POST['linkedin'];
    if(empty($Name)){

        echo('<h3 class="alert-danger">Name is required </h3>');
        echo('<h3 class="text-primary">Gender is valid </h3>');
      }elseif (!is_string($Name)) {
        echo('<h3 class="alert-danger">Name is not valid </h3>');
        echo('<h3 class="text-primary">Gender is valid </h3>');
      } else{
        echo('<h3 class="text-primary">Name is valid </h3>');
        echo('<h3 class="text-primary">Gender is valid </h3>');
      }
      
      if(empty($Email)){
        echo('<h3 class="alert-danger">Email is required </h3>');
      }elseif (!filter_var($Email,FILTER_VALIDATE_EMAIL)) {
        echo('<h3 class="alert-danger">Email is not valid </h3>');
      } else{
        echo('<h3 class="text-primary">Email is valid </h3>');
      }
      if(empty($password)){
        echo('<h3 class="alert-danger">password is required </h3>');
      }elseif (strlen((string)$password)<6) {
        echo('<h3 class="alert-danger">password must be at least 6 digits </h3>');
      } else{
        echo('<h3 class="text-primary">password is valid </h3>');
      }
      if(empty($Address)){
        echo('<h3 class="alert-danger">Address is required </h3>');
      }elseif (strlen($Address)<10) {
        echo('<h3 class="alert-danger">Address must be at least 10 charcters </h3>');
      } else{
        echo('<h3 class="text-primary">Address is valid </h3>');
      }
      if(empty($linkedin)){
        echo('<h3 class="alert-danger">linkedin account is required </h3>');
      }elseif (!filter_var($linkedin,FILTER_SANITIZE_URL)) {
        echo('<h3 class="alert-danger">linkedin is not valid </h3>');
      } else{
        echo('<h3 class="text-primary">linkedin is valid </h3>');
      }

      ////////////////////////////////////////
    
        if (!empty($_FILES['CV']['name'])) {
    
            $name    = $_FILES['CV']['name'];
            $temPath = $_FILES['CV']['tmp_name'];
            $size    = $_FILES['CV']['size'];
            $type    = $_FILES['CV']['type'];
            // echo($name.$temPath.$size.$type);
    
            $types  =  explode('/', $type);  
            $extension  =  strtolower( end($types));      
            // echo $extension ;
            $allowedExtension = "pdf";   
            if ($extension==$allowedExtension) {
                if ($size < 1000000) {
                    $FinalName = time() . rand() . '.' . $extension;
    
                    $disPath = 'uploads/' . $FinalName;
        
                    if (move_uploaded_file($temPath, $disPath)) {
                        echo('<h3 class="text-primary">CV Uploaded </h3>');
                    } else {
                        echo('<h3 class="alert-danger">Error Try Again</h3>');
                    }
                } else {
                    echo('<h3 class="alert-danger">file must be less than 1MB </h3>');
                }   
            } else {
                echo('<h3 class="alert-danger">InValid Extension</h3>');
            }
        } else {
            echo('<h3 class="alert-danger">PDF Required</h3>');
        }
      

}
 

?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid" style="background-image: url(./H7Wg95.jpg);  height: 100%; ">
    <div class = "row text-center">
    <form style="background-color: rgba(95, 158, 160, 0.37); height: 100vh;"action="<?php echo $_SERVER['PHP_SELF'];?>"  method="post"  enctype="multipart/form-data">
        <label for="Name" class="form-group col-3  m-3">Name</label> <input class="col-6 m-1 px-2" type="text" name="Name" id="Name" placeholder="your name"> <br>
        <label for="Gender" class="form-group col-3 m-3">Gender</label>
        <select name="Gender" id="Gender" class="form-group col-6 m-1 px-2" >
            <option value="Male" >Male</option>
            <option value="Male">Female</option>
        </select><br>
        <label for="Email" class="form-group col-3  m-3">Email </label> <input class="col-6 m-1 px-2" type="text" name="Email" id="Email" placeholder="your E-mail"><br>
        <label for="password" class="form-group col-3 m-3">Password</label> <input class="col-6 m-1 px-2" type="password" name="password" id="password" placeholder="password"><br>
        <label for="Address" class="form-group col-3 m-3">Address</label> <input class="col-6 m-1 px-2" type="text" name="Address" id="Address" placeholder="your address"><br>
        <label for="linkedin" class="form-group col-3 m-3">linkedin</label> <input class="col-6 m-1 px-2" type="text" name="linkedin" id="linkedin" placeholder="your linkedin profile url"><br>
        <label for="CV" class="form-group col-3 m-3 " >CV</label> <input type="file"  class="col-6 m-1 px-2" name="CV" id="CV" placeholder="your CV"> <br>
        <button type="submit" class="btn rounded-pill px-5 btn-primary m-3">Submit</button>
    </form>
    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>