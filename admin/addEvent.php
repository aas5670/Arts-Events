<!DOCTYPE html>
<html lang="en">
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
        $thisSubPage = "addEvent.php";
        // Store the section of the site
        $thisSubSection = "admin";
        // Start an session
        session_start();?></head>
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
                            <form class="eventForm" action="../src/action/action_adminAddEvent.php" method="post" enctype="multipart/form-data">
                                <fieldset class="eventDetails">
                                    <p class="head">Event Details</p>
                                    <div class="inputCont">
                                        <label class="field" >Event Title<b>*</b></label>
                                        <input accesskey="W" type="text"  name="eveTitle" class='text' placeholder="Enter event title..." <?php
                                        
                                                if(isset($_SESSION['post-data']['eveTitle']) && !empty($_SESSION['post-data']['eveTitle']))
                                                {
                                                    // echo the html which will set the default value by echoing the
                                                    // value from the session into the default value section
                                                    echo " value=\"";
                                                    echo $_SESSION['post-data']['eveTitle'];
                                                    echo "\"";
                                                    // Remove any data from the session
                                                    unset($_SESSION['post-data']['eveTitle']);
                                                }
                                                echo "/>";
                                            ?>
                                        <?php
                                            // Checks if there is a $_SESSION with the specific name and checks if it isn't empty
                                            if( isset($_SESSION['Error']['eventTitle']) && !empty($_SESSION['Error']['eventTitle']))
                                            {
                                                // echo the session with the error this session contains the html required
                                                echo $_SESSION['Error']['eventTitle'];
                                                // Remove any data from the session
                                                unset($_SESSION['Error']['eventTitle']);
                                            }
                                            // Create a new line
                                            echo "\n";
                                        ?>
                                    </div>
                                    <div class="inputCont">
                                        <label class="field">Event Description<b>*</b></label>
                                        <input accesskey="Q" type="text" name="eveDesc" class='text' placeholder="Enter event description..." <?php
                                            if(isset($_SESSION['post-data']['eveDesc']) && !empty($_SESSION['post-data']['eveDesc']))
                                            {
                                                echo " value=\"";
                                                echo $_SESSION['post-data']['eveDesc'];
                                                echo "\"";
                                                unset($_SESSION['post-data']['eveDesc']);
                                            }
                                            echo "/>";
                                            ?>
                                        <?php
                                            if( isset($_SESSION['Error']['eventDescription']) && !empty($_SESSION['Error']['eventDescription']))
                                            {
                                                echo $_SESSION['Error']['eventDescription'];
                                                unset($_SESSION['Error']['eventDescription']);
                                            }
                                            echo "\n";
                                        ?>
                                    </div>
                                    <div class="inputCont">
                                        <label class="field">Event Start Date<b>*</b></label>
                                        <input accesskey="S" type="text" name="eveSDate" class='text' placeholder="Enter start date in the format dd/mm/yyyy" <?php
                                            if(isset($_SESSION['post-data']['eveSDate']) && !empty($_SESSION['post-data']['eveSDate']))
                                            {
                                                echo " value=\"";
                                                echo $_SESSION['post-data']['eveSDate'];
                                                echo "\"";
                                                unset($_SESSION['post-data']['eveSDate']);
                                            }
                                            echo "/>";
                                            ?>
                                        <?php
                                            if( isset($_SESSION['Error']['eventStartDate']) && !empty($_SESSION['Error']['eventStartDate']))
                                            {
                                                echo $_SESSION['Error']['eventStartDate'];
                                                unset($_SESSION['Error']['eventStartDate']);
                                            }
                                            echo "\n";
                                        ?>
                                    </div>
                                    <div class="inputCont">
                                        <label class="field">Event End Date<b>*</b></label>
                                        <input accesskey="A" type="text" name="eveEDate" class='text' placeholder="Enter end date in the format dd/mm/yyyy" <?php
                                            if(isset($_SESSION['post-data']['eveEDate']) && !empty($_SESSION['post-data']['eveEDate']))
                                            {
                                                echo " value=\"";
                                                echo $_SESSION['post-data']['eveEDate'];
                                                echo "\"";
                                                unset($_SESSION['post-data']['eveEDate']);
                                            }
                                            echo "/>";
                                            ?>
                                        <?php
                                            if( isset($_SESSION['Error']['eventEndDate']) && !empty($_SESSION['Error']['eventEndDate']))
                                            {
                                                echo $_SESSION['Error']['eventEndDate'];
                                                unset($_SESSION['Error']['eventEndDate']);
                                            }
                                            echo "\n";
                                        ?>
                                    </div>
                                    <div class="inputCont">
                                        <label class="field">Event Price<b>*</b></label>
                                        <input accesskey="P" type="text" name="evePrice" class='text' placeholder="Enter event price..." <?php
                                            if(isset($_SESSION['post-data']['evePrice']) && !empty($_SESSION['post-data']['evePrice']))
                                            {
                                                echo " value=\"";
                                                echo $_SESSION['post-data']['evePrice'];
                                                echo "\"";
                                                unset($_SESSION['post-data']['evePrice']);
                                            }
                                            echo "/>";
                                            ?>
                                        <?php
                                            if( isset($_SESSION['Error']['eventPrice']) && !empty($_SESSION['Error']['eventPrice']))
                                            {
                                                echo $_SESSION['Error']['eventPrice'];
                                                unset($_SESSION['Error']['eventPrice']);
                                            }
                                            echo "\n";
                                        ?>
                                    </div>
                                    <div class="inputCont">
                                        <label class="field">Category<b>*</b></label>
                                        <select accesskey="C" name="eveCat">
                                            <?php
                                            // Include the database connection script
                                            include '../src/includes/database_conn.php';
                                            // Checks if there is a $_SESSION with the specific name and checks if it isn't empty
                                            if( isset($_SESSION['post-data']['eveCat']) &&
                                                !empty($_SESSION['post-data']['eveCat']))
                                            {
                                                // Assigns the sql code to ensure that the category previously selected
                                                // is not chosen in the list
                                                $sql = "SELECT catDesc FROM AE_category WHERE catDesc != '"
                                                    .$_SESSION['post-data']['eveCat']."'";

                                                // Echos the option with the default value of the previously selected
                                                echo "<option value=\"" . $_SESSION['post-data']['eveCat'] . "\">" .
                                                    $_SESSION['post-data']['eveCat'] . "</option>\n";

                                                // Remove any data from the session
                                                unset($_SESSION['post-data']['eveCat']);
                                            }
                                            else
                                            {
                                                $sql = "SELECT catDesc FROM AE_category ";
                                            }

                                            // Run the query on the database/make the connection
                                            $queryResult = $dbConn->query($sql);

                                            // Checks if the query result is false
                                            if($queryResult === false) {
                                                // Throw an error and exit
                                                echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
                                                exit;
                                            }
                                            else {
                                                // While there is an object in the query run the contained code
                                                while ($rowObj = $queryResult->fetch_object()) {
                                                    // Assign the catDesc from the row to a variable
                                                    $catDesc = $rowObj->catDesc;
                                                    // Echo an option html with the catDesc as the value and name
                                                    echo "<option value=\"" . $catDesc . "\">" . $catDesc . "</option>
                                            ";
                                                }
                                                // Create a new line
                                                echo "\n";
                                            }
                                            // Close the query and the dbConn
                                            $queryResult->close();
                                            $dbConn->close();
                                            echo "                                        </select>";
                                            ?>
                                        <?php
                                            // Checks if there is a $_SESSION with the specific name and checks if it isn't empty
                                            if(isset($_SESSION['Error']['eventCategory']) && !empty($_SESSION['Error']['eventCategory']))
                                            {
                                                // echo the session with the error this session contains the html required
                                                echo $_SESSION['Error']['eventCategory'];
                                                // Remove any data from the session
                                                unset($_SESSION['Error']['eventCategory']);
                                            }
                                            // Echo the end of the select and a new line

                                            echo "\n";
                                        ?>
                                    </div>
                                    <div class="inputCont">
                                        <label class="field">Venue<b>*</b></label>
                                        <select accesskey="V" name="eveVen">
                                            <?php
                                            include '../src/includes/database_conn.php';

                                            if( isset($_SESSION['post-data']['eveVen']) &&
                                            !empty($_SESSION['post-data']['eveVen']))
                                            {
                                                $sql = "SELECT venueName FROM AE_venue WHERE venueName != '"
                                                    .$_SESSION['post-data']['eveVen']."'";

                                                echo "<option value=\"" . $_SESSION['post-data']['eveVen'] . "\">" .
                                                    $_SESSION['post-data']['eveVen'] . "</option>\n";
                                                unset($_SESSION['post-data']['eveVen']);
                                            }
                                            else
                                            {
                                                $sql = "SELECT venueName FROM AE_venue";
                                            }


                                            $queryResult = $dbConn->query($sql);
                                            if($queryResult === false) {
                                                echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
                                                exit;
                                            }
                                            else {
                                                while ($rowObj = $queryResult->fetch_object()) {
                                                    $venueName = $rowObj->venueName;
                                                    echo "<option value=\"" . $venueName . "\">" . $venueName . "</option>
                                            ";
                                                }
                                                echo "\n";
                                            }
                                            $queryResult->close();
                                            $dbConn->close();
                                            echo "                                        </select>";
                                            ?>
                                        <?php
                                            if( isset($_SESSION['Error']['eventVenue']) && !empty($_SESSION['Error']['eventVenue']))
                                            {
                                                echo $_SESSION['Error']['eventVenue'];
                                                unset($_SESSION['Error']['eventVenue']);
                                            }
                                            echo "\n";
                                        ?>
                                    </div>
                                </fieldset>
                                <fieldset class="eventOther">
                                <!-- upload form new form and submit all together -->
                                    <p class="head">Event Image</p>
                                    <div class="inputCont">
                                        <label class="field">Please upload an event image<b>*</b></label>
                                        <div class="center">
                                            <input accesskey="O" type="file" name="eveImg" class="idEveImg" accept="image/*"/>
                                        </div>
                                        <?php
                                        if( isset($_SESSION['Error']['img']) && !empty($_SESSION['Error']['img']))
                                        {
                                            echo $_SESSION['Error']['img'];
                                            unset($_SESSION['Error']['img']);
                                        }
                                        ?></div>
                                    <div class="img_cont">
                                        <img class="eveUPImg" src="#" alt="Event Thumbnail Preview"/>
                                    </div>
                                    <button name="submit" accesskey="M" id="eventSubmitAll" class="eventSubmit">Add event</button>
                                </fieldset>
                                <!-- Script to preload the image thumbnail -->
                                <script type='text/javascript'>
                                    $(document).ready(function(){
                                        $(".idEveImg").change(function(){
                                            readURL(this);
                                            return false;
                                        });
                                    });
                                </script>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <!-- Include the footer -->
        <?php include '../src/includes/footer.php'; ?>

    </body>
</html>