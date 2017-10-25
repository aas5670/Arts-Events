<!DOCTYPE html>
<html lang="en" xmlns:http="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8">
        <!-- I know its more efficient to have it in one css file but the way I have done it requires
        an extra css file for the mobile, there is no way to change it without having to re write
        the whole website and there's no point in doing that -->

        <!-- When the screen size is above 1050px the global normal stylesheet will be applied -->
        <link media="screen and (min-width: 1050px)" href="../src/css/global.css" rel="stylesheet" type="text/css"/>
        <!-- When the screen size is below 1049 the global mobile stylesheet will be applied -->
        <link media="screen and (max-width: 1049px)" href="../src/css/globalMob.css" rel="stylesheet" type="text/css"/>

        <!-- When the screen size is above 1050px the page specific normal stylesheet will be applied -->
        <link media="screen and (min-width: 1050px)" href="../src/css/adminBody.css" rel="stylesheet" type="text/css"/>
        <!-- When the screen size is below 1049 the page specific mobile stylesheet will be applied -->
        <link media="screen and (max-width: 1049px)" href="../src/css/adminBodyMob.css" rel="stylesheet" type="text/css"/>

        <!-- Enables the javascript -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="../src/js/jscripts.js" ></script>

        <title>Events - Arts & Events</title>
        <?php
        // Store the name of the current page
        $thisPage = "adminIndex.php";
        // Store the name of the current sub page
        $thisSubPage = "editEventList.php";
        // Store the section of the site
        $thisSubSection = "admin";
        // Start an session
        session_start();?>
    </head>
    <body>
        <!-- Include the code for the header -->
        <?php include '../src/includes/header.php'; ?>
        <div id="main_container">
            <main>
                <div class="admin_cont">
                    <!-- Include the code for the admin navigation -->
                    <?php include '../src/includes/adminNav.php'; ?>
                    <div class="admin_content">
                        <div class="eventAddition">
                            <h2 class="eventConfirm">Event Changes Confirmation</h2>
                            <form class="eventForm" action="editEventList.php">
                                <?php
                                // Include the database connection script
                                include '../src/includes/database_conn.php';

                                // Check if an event has been created
                                // Check if the session is empty or if it doesn't exist
                                if(isset($_SESSION['cEditEventID']) && !empty($_SESSION['cEditEventID']))
                                {
                                    // Set the eventID to the session
                                    $eventID = $_SESSION['cEditEventID'];
                                }
                                else
                                {
                                    session_destroy();
                                    // Redirect to the events to edit page
                                    header("Location: http://unn-w15007083.newnumyspace.co.uk/assignments/Arts&Events_Part2/Version_06_FINAL/admin/editEventList.php");
                                }

                                // Destroy all the sessions that have been created
                                session_destroy();

                                // Create the SQL which finds the data related to the event created
                                $sql = "SELECT *
                FROM AE_category, AE_events, AE_venue
                WHERE AE_events.catID = AE_category.catID and
                AE_venue.venueID = AE_events.venueID and eventID = '$eventID'";

                                // Connect the query to the database
                                $queryResult = $dbConn->query($sql);

                                // Check if the query is correct
                                if($queryResult === false) {
                                    // Pass an error
                                    echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
                                    exit;
                                }
                                else {
                                    // While there is an object in the query run the contained code
                                    while ($rowObj = $queryResult->fetch_object()) {
                                        // Create an array of all the extensions
                                        $exts = array('png', 'gif', 'jpg', 'jpeg');
                                        // Create the location of the file and the name(eventID)
                                        $file = "../src/img/$rowObj->eventID";

                                        // The full file location
                                        $src = '';

                                        // For every item in the array run the contained code
                                        foreach ($exts as $ext) {
                                            // If the file exists with the name and the extension
                                            if (file_exists("$file.$ext")) {
                                                // Create the src
                                                $src = "$file.$ext";
                                                break;
                                            }
                                        }

                                        // Echo the html needed
                                        echo "<fieldset class=\"eventDetails\">
                                    <p class=\"head\">Event Details</p>
                                    <div class=\"inputCont\">
                                        <label class=\"field\">Event ID<b>*</b></label>
                                        <p>$eventID</p>
                                    </div>
                                    <div class=\"inputCont\">
                                        <label class=\"field\" for=\"eveTitle\">Event Title</label>
                                        <textarea  name=\"eveTitle\" class='text' disabled>$rowObj->eventTitle</textarea>
                                    </div>
                                    <div class=\"inputCont\">
                                        <label class=\"field\" for=\"eveDesc\">Event Description</label>
                                        <textarea name=\"eveDesc\" class='text' disabled/>$rowObj->eventDescription</textarea>
                                    </div>
                                    <div class=\"inputCont\">
                                        <label class=\"field\">Event Start Date</label>
                                        <p class='text'>$rowObj->eventStartDate</p>
                                    </div>
                                    <div class=\"inputCont\">
                                        <label class=\"field\">Event End Date</label>
                                        <p class='text'>$rowObj->eventEndDate</p>
                                    </div>
                                    <div class=\"inputCont\">
                                        <label class=\"field\">Event Price</label>
                                        <p class='text'>£$rowObj->eventPrice</p>
                                    </div>
                                    <div class=\"inputCont\">
                                        <label class=\"field\">Event Category</label>
                                        <p class='text'>$rowObj->catDesc</p>
                                    </div>
                                    <div class=\"inputCont\">
                                        <label class=\"field\" for=\"eveVen\">Event Venue</label>
                                        <p class='text'>$rowObj->venueName</p>
                                    </div>
                                </fieldset>
                                <fieldset class=\"eventOther\">
                                    <!-- upload form new form and submit all together -->
                                    <p class=\"head\">Event Image</p>
                                    <div class=\"inputCont\">
                                        <br>
                                    </div>
                                    <div class=\"img_cont\">
                                        <img class=\"eveUPImg\" src=\"$src\" alt=\"Event Thumbnail Preview\"/>
                                    </div>
                                    <button accesskey=\"M\" id=\"addNewEvent\" class=\"eventSubmit\">Edit another event</button>
                                </fieldset>\n";
                                    }
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <?php include '../src/includes/footer.php'; ?>
    </body>
</html>