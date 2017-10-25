<?php
//Start a session/cookie which stores information that needs passed back to other pages
//In this case it is errors
session_start();

//Include the database connection script
include '../includes/database_conn.php';

//Define the checks for the data/file
$uploadOk = 1;
$dataOk = 0;

$_SESSION['post-data']['eveTitle'] = $_POST['eveTitle'];
$_SESSION['post-data']['eveDesc'] = $_POST['eveDesc'];
$_SESSION['post-data']['eveSDate'] = $_POST['eveSDate'];
$_SESSION['post-data']['eveEDate'] = $_POST['eveEDate'];
$_SESSION['post-data']['evePrice'] = $_POST['evePrice'];

// Need to ensure that the data inputted is in a string format this
// prevents any sql or any code similar from being inputted into these fields
$eventTitle = mysqli_real_escape_string($dbConn, $_POST['eveTitle']);
$eventDescription = mysqli_real_escape_string($dbConn, $_POST['eveDesc']);
$eventStartDate = mysqli_real_escape_string($dbConn, $_POST['eveSDate']);
$eventEndDate = mysqli_real_escape_string($dbConn, $_POST['eveEDate']);
$eventPrice = mysqli_real_escape_string($dbConn, $_POST['evePrice']);
$eventCategory = mysqli_real_escape_string($dbConn, $_POST['eveCat']);
$eventVenue = mysqli_real_escape_string($dbConn, $_POST['eveVen']);

// Removes any html tags from the data inputted
$eventTitle = filter_var($eventTitle, FILTER_SANITIZE_STRING);
$eventDescription = filter_var($eventDescription, FILTER_SANITIZE_STRING);
$eventStartDate = filter_var($eventStartDate, FILTER_SANITIZE_STRING);
$eventEndDate = filter_var($eventEndDate, FILTER_SANITIZE_STRING);
$eventPrice = filter_var($eventPrice, FILTER_SANITIZE_STRING);
$eventCategory = filter_var($eventCategory, FILTER_SANITIZE_STRING);
$eventVenue = filter_var($eventVenue, FILTER_SANITIZE_STRING);



if(strlen($eventTitle)>255){
    $_SESSION['Error']['eventTitle'] = "<p class='errorMessage'><b>*</b>Needs to be less than 255 characters</p>";
    $dataOk = 1;
}
if(strlen($eventDescription)>255){
    $_SESSION['Error']['eventDescription'] = "<p class='errorMessage'><b>*</b>Needs to be less than 255 characters</p>";
    $dataOk = 1;
}

// Check the dates against the pre set format and if false return an error
if(preg_match("/\d{1,2}\/\d{1,2}\/\d{4}/", $eventStartDate) == false)
{
    $_SESSION['Error']['eventStartDate'] = "<p class='errorMessage'><b>*</b>Needs to be in the format dd/mm/yyyy</p>";
    $dataOk = 1;
}
else
{
    // remove any characters from the date and store the date into variables
    $eventStartDateNew = str_replace('/','',$eventStartDate);
    $day=substr($eventStartDateNew, 0,2);
    $month=substr($eventStartDateNew, 2,2);
    $year=substr($eventStartDateNew, 4, 4);

    // check if the date is a valid date
    if(checkdate($month, $day, $year) === false)
    {
        $_SESSION['Error']['eventStartDate'] = "<p class='errorMessage'><b>*</b>Needs to be a valid date</p>";
        $dataOk = 1;
    }
}



if(preg_match("/\d{1,2}\/\d{1,2}\/\d{4}/", $eventEndDate) == false)
{
    $_SESSION['Error']['eventEndDate'] = "<p class='errorMessage'><b>*</b>Needs to be in the format dd/mm/yyyy</p>";
    $dataOk = 1;
}
else
{
    // remove any characters from the date and store the date into variables
    $eventEndDateNew = str_replace('/','',$eventEndDate);
    $day=substr($eventEndDateNew, 0,2);
    $month=substr($eventEndDateNew, 2,2);
    $year=substr($eventEndDateNew, 4, 4);

    if(checkdate($month, $day, $year) === false)
    {
        $_SESSION['Error']['eventEndDate'] = "<p class='errorMessage'><b>*</b>Needs to be a valid date</p>";
        $dataOk = 1;
    }
}


// Checks if all the variables are strings
if(is_string($eventTitle) && is_string($eventDescription) && is_string($eventPrice)
    && is_string($eventCategory) && is_string($eventVenue))
{
    // Checks if each piece of data which has been inputted is empty and if it is
    // it will set a value to the specific session value
    if($eventTitle == ""){
        $_SESSION['Error']['eventTitle'] = "<p class='errorMessage'><b>*</b>Needs to contain a string value</p>";
        $dataOk = 1;
    }
    if($eventDescription == ""){
        $_SESSION['Error']['eventDescription'] = "<p class='errorMessage'><b>*</b>Needs to contain a string value</p>";
        $dataOk = 1;
    }

    if($eventPrice == "" || is_numeric($eventPrice) == false){
        $_SESSION['Error']['eventPrice'] = "<p class='errorMessage'><b>*</b>Needs to contain a number</p>";
        $dataOk = 1;
    }
    if($eventCategory == ""){
        $_SESSION['Error']['eventCategory'] = "<p class='errorMessage'><b>*</b>Needs to contain a value from the list</p>";
        $dataOk = 1;
    }
    if($eventVenue == ""){
        $_SESSION['Error']['eventVenue'] = "<p class='errorMessage'><b>*</b>Needs to contain a value from the list</p>";
        $dataOk = 1;
    }

    if($eventStartDate == ""){
        $_SESSION['Error']['eventStartDate'] = "<p class='errorMessage'><b>*</b>Needs to contain a date</p>";
    }

    if($eventEndDate == ""){
        $_SESSION['Error']['eventEndDate'] = "<p class='errorMessage'><b>*</b>Needs to contain a date</p>";
    }

}
else
{
    // Set a fatal error
    $_SESSION['FatalError'] = "<p class='errorMessage'><b>*</b>Not strings something in the php has fucked up no idea what<b>**</b></p>";
}
//Check if the category/venue inputted exists

//Create a sql statement that fetch the category/venue information
$catSQL = "SELECT catDesc, catID FROM AE_category";
$venSQL = "SELECT venueID, venueName FROM AE_venue";
//Connect the query
$queryResultCat = $dbConn->query($catSQL);
$queryResultVen = $dbConn->query($venSQL);

//Define the empty variables which will be used later on
$eventCatID;
$eventVenID;

// Set the found variables stop errors appearing after the cat/ven has been matched
$foundCat = false;
$foundVen = false;

//If the query generates an error create an error to user
if($queryResultCat === false || $queryResultVen === false) {
    echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
    exit;
} else {

    // Get each row of the query result
    while ($rowObj = $queryResultCat->fetch_object()) {
        //Get the category desc of the current row
        $queryCatDesc = $rowObj->catDesc;
        //Check if the user input is within the specified category's
        //else return an error to the user(session)
        if ($queryCatDesc === $eventCategory) {
            //Ensure that an error message doesn't appear
            $foundCat = true;
            //Get the cat ID that is related to the selected cat
            $eventCatID = $rowObj->catID;

        };
    };
    while($rowObj = $queryResultVen->fetch_object()){
        //Get the venue name
        $queryVeName = $rowObj->venueName;
        //Check if the user input is within the specified category's
        //else return an error to the user(session)

        if($queryVeName === $eventVenue){
            //Ensure that an error message doesn't appear
            $foundVen = true;
            //Get the ven ID that is related to the selected ven
            $eventVenID = $rowObj->venueID;
        };
    };
};
// Returns an error message if the value is not found in the list
if ($foundCat === false) {
    $_SESSION['Error']['eventCategory'] = "<p class='errorMessage'><b>*</b>Needs to contain a value from the list</p>";
    $dataOk = 1;
}
elseif ($foundCat === true) {
    $_SESSION['post-data']['eveCat'] = $_POST['eveCat'];
}

if($foundVen === false){
    $_SESSION['Error']['eventVenue'] = "<p class='errorMessage'><b>*</b>Needs to contain a value from the list</p>";
    $dataOk = 1;
}elseif ($foundVen === true){
    $_SESSION['post-data']['eveVen'] = $_POST['eveVen'];
}
//Close the query
$queryResultCat->close();
$queryResultVen->close();

//Sets a target directory
$target_dir = "../img/";
//Sets the target file by using the name provided in the file upload
$target_file = $target_dir . basename($_FILES["eveImg"]["name"]);

//Gets the path of the current file selected
$path = $_FILES["eveImg"]["name"];
//Gets the extension of the file provided
$ext = pathinfo($path, PATHINFO_EXTENSION);

//Sets the temp name of the file(original name)
$tmp_name = $_FILES["eveImg"]["tmp_name"];


// Check if image file is a actual image or fake image
if(isset($path) && $uploadOk == 1) {
    // Gets the file size
    $check = getimagesize($_FILES["eveImg"]["tmp_name"]);
    // If there is no file size don't upload the image and set a session
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $_SESSION['Error']['img'] = "<p class='errorMessage'><b>*</b>Please select an image</p>";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file) && $uploadOk == 1) {
    $_SESSION['Error']['img'] = "<p class='errorMessage'><b>*</b>This image already exists</p>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["eveImg"]["size"] > 500000 && $uploadOk == 1) {
    $_SESSION['Error']['img'] = "<p class='errorMessage'><b>*</b>This image is too large</p>";
    $uploadOk = 0;
}
// Allow certain file formats
if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $uploadOk == 1) {
    $_SESSION['Error']['img'] = "<p class='errorMessage'><b>*</b>only JPG, JPEG & PNG images are allowed</p>";
    $uploadOk = 0;
}

// If the data is okay and the upload is okay continue
if($dataOk === 0 && $uploadOk != 0)
{
    //Convert the timestamps into suitable date formats
    $eventStartDateSQL = str_replace('/','-',$eventStartDate);
    $eventStartDateSQL = date("Y-m-d", strtotime($eventStartDateSQL));

    $eventEndDateSQL = str_replace('/','-', $eventEndDate);
    $eventEndDateSQL = date("Y-m-d", strtotime($eventEndDateSQL));

    //Create the SQL that creates a new record in the AE_events table
    $sql = "INSERT INTO AE_events (eventTitle, eventDescription, venueID, catID, eventStartDate, eventEndDate, eventPrice)
VALUES ('".$eventTitle."','".$eventDescription."','".$eventVenID."','".$eventCatID."','".$eventStartDateSQL."','".$eventEndDateSQL."',".$eventPrice.")";

    //Get the result of the query
    $queryResult = $dbConn->query($sql);

    //If the query is false generate an error
    if($queryResult === false) {
        echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
        exit;
    } else {
        //Get the latest event which will be the event inserted
        $imSQL = "SELECT eventID FROM AE_events ORDER BY eventID DESC LIMIT 1";
        //Get the result of the query
        $imgQueryResult = $dbConn->query($imSQL);
        //Get the object line of the query
        $imgObj = $imgQueryResult->fetch_object();
        //Get the eventID of the object
        $imEventID = $imgObj->eventID;
        //Create the name of the file to be uploaded by getting the eventID
        //and the extension of the file to be uploaded
        $name = $imEventID.".".$ext;
        //Try and uploaded the file if it doesnt it will return false and do some stuff
        if (move_uploaded_file($tmp_name, $target_dir.$name)) {
            // Store the created event's ID
            $_SESSION['confirmEventID'] = $imEventID;
            //File has been uploaded
            //Close the db connection
            $dbConn->close();
            //Redirect the user to the confirmation page
            //Need to change to correct http address as this is standard use
            //Not doing it for now since different file versions
            header("Location: http://unn-w15007083.newnumyspace.co.uk/assignments/Arts&Events_Part2/Version_06_FINAL/admin/addEventConfirmation.php");
        } else {
            echo "<p>FATAL ERROR: UPLOAD CANNOT BE COMPLETED</p>";
            echo "<p>ROLLBACK COMMENCED</p>";
            $SQL = "DELETE FROM AE_events WHERE eventID = '$imEventID'";
            $queryResult = $dbConn->query($SQL);
            if($queryResult === false){
                echo "<p>ROLLBACK QUERY FAILED</p>";
                echo "<p>SOMETHING REALLY WENT WRONG</p>";
            }
            else
            {
                echo "<p>ROLLBACK COMPLETED</p>";
            }
        }
    }
    $queryResult->close();
    $dbConn->close();
}
else
{
    header("Location: http://unn-w15007083.newnumyspace.co.uk/assignments/Arts&Events_Part2/Version_06_FINAL/admin/addEvent.php");
}
?>