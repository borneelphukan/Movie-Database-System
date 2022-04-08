<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Person</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php include 'dbConnect.php'?>
    </head>

<body>
<h1>CHANGE PERSON DATA</h1>
<div class="personSection">
    <fieldset style="border: 1px black dashed">
        <legend style="border: 1px black dashed;margin-left: 1em; padding: 0.2em 0.8em">CHANGE PERSON DATA</legend>
 
        <form method="post">
        <div id="formPerson"><br>
                    <label for="targetPerson">Who's data do you want to change ?</label>
                    <input type="text" id="targetPerson" name="targetPerson" size="30px" required><hr><br>
                    <label for="person">New Person Name</label>
                    <input type="text" name="newPersonName" size="30px" required>
                    <label for="DOB">New Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required><br><br>
                    <label class="gender">Male<input type="radio" name="gender" value="Male"><span class="checkmark"></span></label>
                    <label class="gender">Female<input type="radio" name="gender" value="Female"><span class="checkmark"></span></label><br><br>
                   <input type="submit"  name="changeData" value="UPDATE person"/>  
                </div>
        </form>
    </div>
    <?php 
    if(isset($_POST['changeData'])){
        $targetPerson = $_POST['targetPerson'];
        $updatedPerson = $_POST['newPersonName'];
        $updatedDob = $_POST['dob'];
        $updatedGender = $_POST["gender"];
       
      $updatePerson=pg_query("UPDATE person SET person_name='".$updatedPerson."',gender='".$updatedGender."',dob = '".$updatedDob."' WHERE person_name='".$targetPerson."'");
	}
    ?>
</body>
</html>