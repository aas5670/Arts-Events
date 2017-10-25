<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- I know its more efficient to have it in one css file but the way I have done it requires
        an extra css file for the mobile, there is no way to change it without having to re write
        the whole website and there's no point in doing that -->

        <!-- When the screen size is above 1050px the global normal stylesheet will be applied -->
        <link media="screen and (min-width: 1050px)" href="src/css/global.css" rel="stylesheet" type="text/css"/>
        <!-- When the screen size is below 1049 the global mobile stylesheet will be applied -->
        <link media="screen and (max-width: 1049px)" href="src/css/globalMob.css" rel="stylesheet" type="text/css"/>

        <!-- When the screen size is above 1050px the page specific normal stylesheet will be applied -->
        <link media="screen and (min-width: 1050px)" href="src/css/eventsBody.css" rel="stylesheet" type="text/css"/>
        <!-- When the screen size is below 1049 the page specific mobile stylesheet will be applied -->
        <link media="screen and (max-width: 1049px)" href="src/css/eventsBodyMob.css" rel="stylesheet" type="text/css"/>

        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"/>

        <!-- Enables the javascript -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="src/js/jscripts.js" ></script>

        <title>Events - Arts & Events</title>
        <?php $thisPage = "events.php"; $thisSubPage = ""; $thisSubSection = "main";?>

    </head>
    <body>
        <?php include './src/includes/header.php'; ?>
        <div id="main_container">
                <!-- Declares the main body itself -->
            <main>
                <!-- Declares the first box of the main body -->
                <div id="event_box" accesskey="e">
                    <div class="header">
                        <h1>Events</h1>
                    </div>
                    <div class="box_container" id="box_event_box">
                        <?php
                        include 'src/includes/database_conn.php';      // make db connection

                        $sql = "SELECT eventID, eventTitle, eventDescription, eventStartDate, eventEndDate, catDesc, venueName
         FROM AE_events, AE_category, AE_venue WHERE AE_events.catID = AE_category.catID and AE_events.venueID = AE_venue.venueID ORDER BY eventTitle";

                        // Makes the db connection and runs the query
                        $queryResult = $dbConn->query($sql);

                        // If the query doesn't run return the error and stop the query
                        if($queryResult === false) {
                            echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
                            exit;
                        }
                        else {
                            while ($rowObj = $queryResult->fetch_object()) {

                                // Fetches the specific data from the object into a variable
                                $eventID = $rowObj->eventID;
                                $eventTitle = $rowObj->eventTitle;
                                // Changes the first character of the string to uppercase
                                $eventTitle = ucfirst($eventTitle);
                                $eventVenue = $rowObj->venueName;
                                $eventStartDate = $rowObj->eventStartDate;
                                $eventEndDate = $rowObj->eventEndDate;

                                // Predefine the standard html format for a specific event page
                                $eventHTTP = "./events/event$eventID.php";

                                $eventCatDesc = $rowObj->catDesc;

                                // Transfer the date into a time format
                                $startTime = strtotime($eventStartDate);
                                // Convert the time into specific date format
                                $startDate = date('dS M Y', $startTime);

                                // Transfer the date into a time format
                                $endTime = strtotime($eventEndDate);
                                // Convert the time into specific date format
                                $endDate = date('dS M Y', $endTime);


                                // Creates an array of all the file formats that can be used
                                $exts = array('png', 'jpg', 'jpeg');
                                // Defines the location of the file and the name of the file
                                // but not the extension
                                $file = "src/img/$eventID";

                                // Creates a blank file extension
                                $fileExt = '';
                                // For every item in the array $exts as $ext
                                foreach ($exts as $ext) {
                                    // Joins the file name to the extension and checks if it exists if it does
                                    // set the $fileExt as $ext as a string;
                                    if (file_exists("$file.$ext")) {
                                        $fileExt = "$ext";
                                        break;
                                    }
                                }
                                // Create the file location by joining the location ($file) and the file extension
                                // ($fileExt)
                                $fileSrc = $file . "." . $fileExt;

                                echo "  <div class=\"event\" onmouseenter=\"selectBox(this)\" onmouseleave=\"normalBox(this)\" onclick='clickOnImg(\"$eventHTTP\")'>
                        <img src=\"$fileSrc\" class=\"event_img\" alt=\"$eventTitle\" />
                        <div class=\"events_description\">
                            <div class=\"event_info\">
                                <p class=\"event_type\">$eventCatDesc</p>
                                <p class=\"event_name\">$eventTitle</p>
                                <p class=\"event_venue\">$eventVenue</p>
                                <p class=\"event_date\">$startDate until $endDate</p>
                            </div>
                            <a href=\"$eventHTTP\" class=\"event_find_out\">Find out more ></a>
                        </div>
                    </div>
                    ";
                            }
                        }
                        $queryResult->close();
                        $dbConn->close();
                        ?>
                    </div>
                </div>
            </main>
        </div>
        <?php include './src/includes/footer.php'; ?>
    </body>
</html>