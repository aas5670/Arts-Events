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
        <?php $thisPage = "adminIndex.php";
        $thisSubPage = "editEventList.php";
        $thisSubSection = "admin";
        session_start();echo"\n";?>
    </head>
    <body>
        <?php include '../src/includes/header.php'; ?>

        <div id="main_container">
            <main>
                <div class="admin_cont" id="admin_cokk">
                    <?php include '../src/includes/adminNav.php'; ?>
                    <div class="admin_content">
                        <div class="eventAddition">
                            <form class="eventForm" action="../src/action/action_adminUpdateEvent.php" method="post" enctype="multipart/form-data">
                                <?php
                                include '../src/includes/database_conn.php';
                                $error = false;
                                if(empty($_POST['enterEventID']))
                                {
                                    if(empty($_SESSION['update-data']['eventID']))
                                    {
										$error = true;
                                        $_SESSION['Error'] = "<p id=\"errorMessage\"><b>*</b>Must enter an eventID<b>*</b></p>";
                                        header("Location: http://unn-w15007083.newnumyspace.co.uk/assignments/Arts&Events_Part2/Version_06_FINAL/admin/editEventList.php");
                                    }
                                    else
                                    {
                                        $postEventID = $_SESSION['update-data']['eventID'];
                                    }
                                }
                                else
                                {
                                    $postEventID = $_POST['enterEventID'];
                                }
								
								// Checks if the event ID that is entered is valid by getting a list of all the valid eventID's and comparing them
								$foundEveID = false;
								$SQLFIND = "SELECT eventID FROM AE_events";
								$findResult = $dbConn->query($SQLFIND);
								if($findResult === false) {
                                        echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
                                        exit;
								}
								else
								{
									while($rowObj = $findResult->fetch_object()){
										if($rowObj->eventID == $postEventID){
											$foundEveID = true;
										}
									}
								}
								
								if($foundEveID === false)
								{
									$error = true;
									$_SESSION['Error'] = "<p id=\"errorMessage\"><b>*</b>Must enter a valid eventID<b>*</b></p>";
									header("Location: http://unn-w15007083.newnumyspace.co.uk/assignments/Arts&Events_Part2/Version_06_FINAL/admin/editEventList.php");
								}

                                if(!$error)
                                {
                                    $SQL = "SELECT *
                                            FROM AE_category, AE_events, AE_venue
                                            WHERE AE_events.catID = AE_category.catID and
                                            AE_venue.venueID = AE_events.venueID and AE_events.eventID = '".$postEventID."'";
                                    $queryResult = $dbConn->query($SQL);

                                    if($queryResult === false) {
                                        echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
                                        exit;
                                    }
                                    else {
                                        while($rowObj = $queryResult->fetch_object()) {
                                            $eventID = $rowObj->eventID;
                                            $eventTitle = $rowObj->eventTitle;
                                            $eventDescription = $rowObj->eventDescription;
                                            $startDate = $rowObj->eventStartDate;
                                            $endDate = $rowObj->eventEndDate;
                                            $eventPrice = $rowObj->eventPrice;
                                            $eventCatID = $rowObj->catID;
                                            $eventCatDesc = $rowObj->catDesc;
                                            $eventVenueID = $rowObj->venueID;
                                            $eventVenueName = $rowObj->venueName;

                                            // Creates an array of all the file formats that can be used
                                            $exts = array('png', 'gif', 'jpg', 'jpeg');
                                            // Defines the location of the file and the name of the file
                                            // but not the extension
                                            $file = "../src/img/$eventID";

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

                                            $_SESSION['update-data-post']['fileExt'] = $ext;
                                            $_SESSION['update-data-post']['eventID'] = $eventID;

                                            $eventStartDate = str_replace('-','/',$startDate);
                                            $eventStartDate= date("d/m/Y", strtotime($eventStartDate));

                                            $eventEndDate = str_replace('-','/',$endDate);
                                            $eventEndDate= date("d/m/Y", strtotime($eventEndDate));

                                                echo "<fieldset class=\"eventDetails\">
                                    <p class=\"head\">Event Details</p>
                                    <div class=\"inputCont\">
                                        <label class=\"field\">Event ID<b>*</b></label>
                                        <p>$eventID</p>";
                                            // Checks if there is a $_SESSION with the specific name and checks if it isn't empty
                                            if( isset($_SESSION['Error']['eventID']) && !empty($_SESSION['Error']['eventID']))
                                            {
                                                // echo the session with the error this session contains the html required
                                                echo $_SESSION['Error']['eventID'];
                                                // Remove any data from the session
                                                unset($_SESSION['Error']['eventID']);
                                            }
                                            echo"
                                    </div>
                                    <div class=\"inputCont\">
                                        <label class=\"field\" for=\"eveTitle\">Event Title<b>*</b></label>
                                        <textarea accesskey=\"W\" name=\"eveTitle\" class=\"text\" id=\"title\">";
                                            if(isset($_SESSION['update-data']['eveTitle']) && !empty($_SESSION['update-data']['eveTitle']))
                                            {
                                                echo $_SESSION['update-data']['eveTitle'];
                                                unset ($_SESSION['update-data']['eveTitle']);
                                            }
                                            else
                                            {
                                                echo $eventTitle;
                                            }
                                            echo "</textarea>";
                                            // Checks if there is a $_SESSION with the specific name and checks if it isn't empty
                                            if( isset($_SESSION['Error']['eventTitle']) && !empty($_SESSION['Error']['eventTitle']))
                                            {
                                                // echo the session with the error this session contains the html required
                                                echo $_SESSION['Error']['eventTitle'];
                                                // Remove any data from the session
                                                unset($_SESSION['Error']['eventTitle']);
                                            }
                                            echo"
                                    </div>
                                    <div class=\"inputCont\">
                                        <label class=\"field\" for=\"eveDesc\">Event Description<b>*</b></label>
                                        <textarea accesskey=\"Q\" name=\"eveDesc\" class=\"text\" id=\"desc\">";
                                            if(isset($_SESSION['update-data']['eveDesc']) && !empty($_SESSION['update-data']['eveDesc']))
                                            {
                                                echo $_SESSION['update-data']['eveDesc'];
                                                unset ($_SESSION['update-data']['eveDesc']);
                                            }
                                            else
                                            {
                                                echo $eventDescription;
                                            }
                                            echo "</textarea>";
                                            // Checks if there is a $_SESSION with the specific name and checks if it isn't empty
                                            if( isset($_SESSION['Error']['eventDescription']) && !empty($_SESSION['Error']['eventDescription']))
                                            {
                                                // echo the session with the error this session contains the html required
                                                echo $_SESSION['Error']['eventDescription'];
                                                // Remove any data from the session
                                                unset($_SESSION['Error']['eventDescription']);
                                            }
                                            echo "
                                    </div>
                                    <div class=\"inputCont\">
                                        <label class=\"field\" for=\"eveSDate\">Event Start Date<b>*</b></label>
                                        <input accesskey=\"S\" type=\"text\" name=\"eveSDate\" class=\"text\" pattern=\"\d{1,2}/\d{1,2}/\d{4}\"";
                                            echo " value=\"";
                                            if(isset($_SESSION['update-data']['eveSDate']) && !empty($_SESSION['update-data']['eveSDate']))
                                            {
                                                echo $_SESSION['update-data']['eveSDate'];
                                                unset($_SESSION['update-data']['eveSDate']);
                                            }
                                            else
                                            {
                                                echo "$eventStartDate";
                                            }
                                            echo "\"";
                                            echo "/>";
                                            if( isset($_SESSION['Error']['eventStartDate']) && !empty($_SESSION['Error']['eventStartDate']))
                                            {
                                                echo $_SESSION['Error']['eventStartDate'];
                                                unset($_SESSION['Error']['eventStartDate']);
                                            }
                                            echo "
                                    </div>
                                    <div class=\"inputCont\">
                                        <label class=\"field\" for=\"eveEDate\">Event End Date<b>*</b></label>
                                        <input accesskey=\"A\" type=\"text\" name=\"eveEDate\" class=\"text\" pattern=\"\d{2}/\d{2}/\d{4}\"";
                                            echo " value=\"";
                                            if(isset($_SESSION['update-data']['eveEDate']) && !empty($_SESSION['update-data']['eveEDate']))
                                            {
                                                echo $_SESSION['update-data']['eveEDate'];
                                                unset($_SESSION['update-data']['eveEDate']);
                                            }
                                            else
                                            {
                                                echo "$eventEndDate";
                                            }
                                            echo "\"";
                                            echo "/>";
                                            if( isset($_SESSION['Error']['eventEndDate']) && !empty($_SESSION['Error']['eventEndDate']))
                                            {
                                                echo $_SESSION['Error']['eventEndDate'];
                                                unset($_SESSION['Error']['eventEndDate']);
                                            }
                                            echo "
                                    </div>
                                    <div class=\"inputCont\">
                                        <label class=\"field\" for=\"evePrice\">Event Price<b>*</b></label>
                                        <input accesskey=\"P\" type=\"text\" name=\"evePrice\" class=\"text\"";
                                            echo " value=\"";
                                            if(isset($_SESSION['update-data']['evePrice']) && !empty($_SESSION['update-data']['evePrice']))
                                            {
                                                echo $_SESSION['update-data']['evePrice'];
                                                unset($_SESSION['update-data']['evePrice']);
                                            }
                                            else
                                            {
                                                echo "$eventPrice";
                                            }
                                            echo "\"";
                                            echo "/>";
                                            if( isset($_SESSION['Error']['eventPrice']) && !empty($_SESSION['Error']['eventPrice']))
                                            {
                                                echo $_SESSION['Error']['eventPrice'];
                                                unset($_SESSION['Error']['eventPrice']);
                                            }
                                            echo "
                                    </div>
                                    <div class=\"inputCont\">
                                        <label class=\"field\" for=\"eveCat\">Category<b>*</b></label>
                                        <select accesskey=\"C\" name=\"eveCat\">";
                                            if(isset($_SESSION['update-data']['eveCat']) &&
                                                !empty($_SESSION['update-data']['eveCat']))
                                            {
                                                // Assigns the sql code to ensure that the category previously selected
                                                // is not chosen in the list
                                                $sql = "SELECT catDesc FROM AE_category WHERE catDesc != '"
                                                    .$_SESSION['update-data']['eveCat']."'";

                                                // Echos the option with the default value of the previously selected
                                                echo "<option value=\"" . $_SESSION['update-data']['eveCat'] . "\">" .
                                                    $_SESSION['update-data']['eveCat'] . "</option>\n";

                                                // Remove any data from the session
                                                unset($_SESSION['update-data']['eveCat']);
                                            }
                                            else
                                            {
                                                echo "\n                                            <option value=\"$eventCatDesc\">$eventCatDesc</option>";
                                                $sql = "SELECT catDesc FROM AE_category WHERE catID != '$eventCatID'";
                                            }

                                            $queryResultCat = $dbConn->query($sql);
                                            if ($queryResultCat === false) {
                                                echo "<p>Query failed: " . $dbConn->error . "</p>\n</body>\n</html>";
                                                exit;
                                            } else {
                                                while ($rowObj = $queryResultCat->fetch_object()) {
                                                    $catDesc = $rowObj->catDesc;
                                                    echo "\n                                            <option value=\"" . $catDesc . "\">" . $catDesc . "</option>";
                                                }
                                                echo "\n";
                                            }
                                            $queryResultCat->close();
                                            echo "                                        </select>";
                                            // Checks if there is a $_SESSION with the specific name and checks if it isn't empty
                                            if(isset($_SESSION['Error']['eventCategory']) && !empty($_SESSION['Error']['eventCategory']))
                                            {
                                                // echo the session with the error this session contains the html required
                                                echo $_SESSION['Error']['eventCategory'];
                                                // Remove any data from the session
                                                unset($_SESSION['Error']['eventCategory']);
                                            }
                                            echo "
                                    </div>
                                    <div class=\"inputCont\">
                                        <label class=\"field\" for=\"eveVen\">Venue<b>*</b></label>
                                        <select accesskey=\"V\" name=\"eveVen\">";
                                            if( isset($_SESSION['update-data']['eveVen']) &&
                                                !empty($_SESSION['update-data']['eveVen']))
                                            {
                                                $sql = "SELECT venueName FROM AE_venue WHERE venueName != '"
                                                    .$_SESSION['update-data']['eveVen']."'";

                                                echo "<option value=\"" . $_SESSION['update-data']['eveVen'] . "\">" .
                                                    $_SESSION['update-data']['eveVen'] . "</option>\n";
                                                unset($_SESSION['update-data']['eveVen']);
                                            }
                                            else
                                            {
                                                echo "\n                                            <option value=\"$eventVenueName\">$eventVenueName</option>";
                                                $sql = "SELECT venueName FROM AE_venue WHERE venueID != '$eventVenueID'";
                                            }


                                            $queryResult = $dbConn->query($sql);
                                            if ($queryResult === false) {
                                                echo "<p>Query failed: " . $dbConn->error . "</p>\n</body>\n</html>";
                                                exit;
                                            } else {
                                                while ($rowObj = $queryResult->fetch_object()) {
                                                    $venueName = $rowObj->venueName;
                                                    echo "\n                                            <option value=\"" . $venueName . "\">" . $venueName . "</option>";
                                                }
                                                echo "\n";
                                            }
                                            if( isset($_SESSION['Error']['eventVenue']) && !empty($_SESSION['Error']['eventVenue']))
                                            {
                                                echo $_SESSION['Error']['eventVenue'];
                                                unset($_SESSION['Error']['eventVenue']);
                                            }
                                            echo"                                        </select>
                                    </div>
                                </fieldset>
                                <fieldset class=\"eventOther\">
                                    <p class=\"head\">Event Image</p>
                                    <div class=\"inputCont\">
                                        <label class=\"field\" for=\"eveImg\">Event Thumbnail<b>*</b></label>
                                        <div class=\"center\">
                                            <input accesskey=\"O\" type=\"file\" name=\"eveImg\" class=\"idEveImg\"  accept=\"image/*\"/>
                                        </div>";
                                            if( isset($_SESSION['Error']['img']) && !empty($_SESSION['Error']['img']))
                                            {
                                                echo $_SESSION['Error']['img'];
                                                unset($_SESSION['Error']['img']);
                                            }
                                            echo "      
                                    </div>
                                    <div class=\"img_cont\">
                                        <img id=\"eveNotUp\" class=\"eveUPImg\" src=\"$fileSrc\" alt=\"Event Thumbnail Preview\"/>
                                    </div>
                                    <input type=\"reset\" name=\"reset\" id=\"resetSubmitAll\" class=\"eventSubmit\" value=\"Reset Changes\"/>
                                    <input type=\"submit\" accesskey=\"M\" name=\"submit\" id=\"updateSubmitAll\" class=\"eventSubmit\" value=\"Submit Changes\"/>
                                </fieldset>
                                <script type=\"text/javascript\">
                                    $(document).ready(function(){
                                        $(\".idEveImg\").change(function(){
                                             readURL(this);
                                             return false;
                                        });
                                        $(\"#resetSubmitAll\").click(function() {
                                            $('.eveUPImg').attr('src', '$fileSrc');
                                        });
                                    });
                                </script>";
                                        };
                                    };
                                };
                                echo "\n";
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <?php include '../src/includes/footer.php';
        echo "\n";
        ?>
    </body>
</html>