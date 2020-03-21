
<?php

$message = "";
//Inputs
$fields = array("fullname","email","message");

//Array to keep track of fields that may not be filled
$empty_fields = array();

//Loop through the array
foreach ($fields as $field) {

    //Check to ensure that the field exists and it contains a value
    if(isset($_POST[$field]) && !empty($_POST[$field])){

        //Make the field a variable containing the value passed in from the form
        $$field = $_POST[$field];
    }else{

        //Add the field to list of empty arrays
        $empty_fields[] = $field;
    }
}

//If there are no empty fields
if(empty($empty_fields)){

    //Create a contact file based on the user's fullname, change all space characters to underscore though
    $contact_file = fopen(strtolower(str_replace(" ","_",$fullname)).".txt","w");

    //Loop through the fields
    foreach($fields as $field){

        //Add each field to the file line by line
        $line = $field.": ".$_POST[$field]."\n";
        fwrite($contact_file,$line);
    }

    //Close the file
    fclose($contact_file);
    $message =  "<h3>We got your message, we will reach out shortly</h3>";
}else{

    //Show an error of all the empty fields
    $message = "<h3>The following fields were empty</h3>";
    $message .= "<ul>";
    foreach($empty_fields as $empty_field){
        $message .= "<li>".strtoupper($empty_field)."</li>";
    }
    echo "</ul>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="website-wrapper">
        <a href='index.html'>Go back</a>
        <?php echo $message ?>
    </section>
</body>
</html>