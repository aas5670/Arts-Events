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
    <link media="screen and (min-width: 1050px)" href="src/css/indexBody.css" rel="stylesheet" type="text/css"/>
    <!-- When the screen size is below 1049 the page specific mobile stylesheet will be applied -->
    <link media="screen and (max-width: 1049px)" href="src/css/indexBodyMob.css" rel="stylesheet" type="text/css"/>

    <!-- Enables the javascript -->
    <script type="text/javascript" src="src/js/jscripts.js" ></script>

    <title>Home - Arts & Events</title>

    <?php $thisPage = "index.php"?>
    <?php $thisSubSection = "main"?>
    <?php $thisSubPage = ""?>
</head>
<body onload="loadShowLess();">
<?php include './src/includes/header.php'; ?>
<div id="main_container">
    <!-- Declares the main body itself -->
    <main>
        <!-- Declares the first box of the main body -->
        <div id="first_box">
            <!-- Declares the left column of the first box -->
            <div class="left_column" accesskey="r">
                <!-- Declares the first item (img) -->
                <div class="img_logo">
                    <img src="src/img/theclan.jpg" alt="The Clan Film" >
                </div>
                <!-- Declares the second item (news block) -->
                <div class="news">
                    <h1>News</h1>
                    <h2>The Clan - Case File</h2>
                    <p>Unlock the case files of the Puccio family and their shocking true story that inspired Pablo Trapero's new film The Clan.</p>
                    <a accesskey="R" href="http://curzonblob.blob.core.windows.net/media/5441/the-clan-production-notes.pdf" target="_blank">Continue Reading ></a>
                </div>
            </div>
            <div class="event_showcase_block"  accesskey="i">
                <?php
                include 'src/includes/database_conn.php';      // make db connection

                // Runs sql statement and sorts by date due to the events wanting to be listed by earliest date
                $sql = "SELECT eventID, eventTitle, eventDescription, eventStartDate, eventEndDate FROM AE_events
                        WHERE eventEndDate >= now() ORDER BY eventStartDate";
                // Makes the db connection and runs the query
                $queryResult = $dbConn->query($sql);

                // Makes a temp count of rows
                $tmpCount = 0;
                $runOnce = true;

                // If the query doesn't run return the error and stop the query
                if($queryResult === false) {
                    echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
                    exit;
                }
                else {
                    echo "<div class=\"img_cont\">";
                    while(($rowObj = $queryResult->fetch_object()) and ($tmpCount < 3)) {
                        $eventID = $rowObj->eventID;

                        $eventTitle = $rowObj->eventTitle;
                        // Changes the first character of the string to uppercase
                        $eventTitle = ucfirst($eventTitle);

                        // Creates an array of all the file formats that can be used
                        $exts = array('png', 'gif', 'jpg', 'jpeg');
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

                        if ($tmpCount === 0) {
                            echo "
                            <img src=\"$fileSrc\" alt=\"$eventTitle\" id=\"showcase_img_one\" />";
                        } elseif ($tmpCount === 1) {
                            echo "
                            <img src=\"$fileSrc\" alt=\"$eventTitle\" id=\"showcase_img_two\"/>";
                        } elseif ($tmpCount === 2) {
                            echo "
                            <img src=\"$fileSrc\" alt=\"$eventTitle\" id=\"showcase_img_three\"/>";
                            echo "<div id=\"img_right\" onclick = \"changeImageRight()\">
                                <a> &gt; </a>
                                </div>
                                <div id=\"img_left\" onclick = \"changeImageLeft()\">
                                    <a> &lt; </a>
                                </div>
                                <div id=\"img_num\">
                                    <a onclick=\"changeImageNumOne()\">1</a>
                                    <a onclick=\"changeImageNumTwo()\">2</a>
                                    <a onclick=\"changeImageNumThree()\">3</a>
                                </div>
                            </div>";
                            echo "
                            <div class=\"info\">
                                <div class=\"event_detail\">";
                            $runOnce = false;
                        }
                        $tmpCount += 1;
                    }
                    // Resets the count
                    $tmpCount = 0;
                    // Starts the seek to the start of the data set
                    mysqli_data_seek($queryResult,0);
                    while(($rowObj = $queryResult->fetch_object()) AND ($tmpCount < 3))
                    {
                        $eventID = $rowObj->eventID;

                        $eventTitle = $rowObj->eventTitle;
                        // Changes the first character of the string to uppercase
                        $eventTitle = ucfirst($eventTitle);

                        $eventStartDate = $rowObj->eventStartDate;
                        $eventEndDate = $rowObj->eventEndDate;

                        // Transfer the date into a time format
                        $startTime = strtotime($eventStartDate);
                        // Convert the time into specific date format
                        $startDate = date('dS M Y', $startTime);

                        // Transfer the date into a time format
                        $endTime = strtotime($eventEndDate);
                        // Convert the time into specific date format
                        $endDate = date('dS M Y', $endTime);

                        // Predefine the standard html format for a specific event page
                        $eventHTTP = "./events/event$eventID.php";
                        if ($tmpCount === 0) {
                            echo "
                                    <h2 id=\"event_one_h1\">$eventTitle</h2>
                                    <h3 id=\"event_one_h2\">$startDate until $endDate</h3>
                                    <p id=\"event_one_p\">$eventHTTP</p>";
                        }
                        elseif($tmpCount === 1) {
                            echo "
                                    <h2 id=\"event_two_h1\">$eventTitle</h2>
                                    <h3 id=\"event_two_h2\">$startDate until $endDate</h3>
                                    <p id=\"event_two_p\">$eventHTTP</p>";
                        }
                        elseif($tmpCount === 2) {
                            echo "
                                    <h2 id=\"event_three_h1\">$eventTitle</h2>
                                    <h3 id=\"event_three_h2\">$startDate until $endDate</h3>
                                    <p id=\"event_three_p\">$eventHTTP</p>";
                        }

                        $tmpCount += 1;
                    }
                    echo "
                                </div>
                            <a onclick='clickOnImg(urlSelector())'>More Info ></a>
                        </div>";
                }
                $queryResult->close();
                $dbConn->close();
                ?>
            </div>
        </div>

        <div id="third_box" accesskey="e">
            <div class="header">
                <h1>Events</h1>
            </div>
            <div class="box_container">
                <?php
                include 'src/includes/database_conn.php';      // make db connection

                // Runs sql statement and sorts by date due to the events wanting to be listed by earliest date
                $sql = "SELECT eventID, eventTitle, eventDescription, eventStartDate, eventEndDate, catDesc, venueName FROM AE_events, AE_category, AE_venue
                        WHERE eventEndDate >= now() AND AE_events.catID = AE_category.catID and AE_events.venueID = AE_venue.venueID ORDER BY eventStartDate";
                // Makes the db connection and runs the query
                $queryResult = $dbConn->query($sql);

                // Makes a temp count of rows
                $tmpCount = 0;

                // If the query doesn't run return the error and stop the query
                if($queryResult === false) {
                    echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
                    exit;
                }
                else {
                    // When there is an object to fetch from the query and the number of times the query has been ran
                    // is less than 9 run the following php, this is to ensure that the code is efficient
                        while(($rowObj = $queryResult->fetch_object())and ($tmpCount < 9)){
                        // Fetches the specific data from the object into a variable
                        $eventID = $rowObj->eventID;
                        $eventTitle = $rowObj->eventTitle;
                        // Changes the first character of the string to uppercase
                        $eventTitle = ucfirst($eventTitle);
                        $eventStartDate = $rowObj->eventStartDate;
                        $eventEndDate = $rowObj->eventEndDate;

                        // Predefine the standard html format for a specific event page
                        $eventHTTP = "./events/event$eventID.php";

                        $eventVenue = $rowObj->venueName;

                        $eventCatDesc = $rowObj->catDesc;

                        // Transfer the date into a time format
                        $startTime = strtotime($eventStartDate);
                        // Convert the time into specific date format
                        $startDate= date('dS M Y', $startTime);

                        // Transfer the date into a time format
                        $endTime = strtotime($eventEndDate);
                        // Convert the time into specific date format
                        $endDate = date('dS M Y', $endTime);

                        // Creates an array of all the file formats that can be used
                        $exts = array('png', 'gif', 'jpg', 'jpeg');


                        // Defines the location of the file and the name of the file
                        // but not the extension
                        $file = "./src/img/$eventID";

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

                        echo "<div onmouseenter='selectBox(this)' onmouseleave='normalBox(this)' 
                            onclick='clickOnImg(\"$eventHTTP\")' accesskey='1'>
                            <img src=\"$fileSrc\" class=\"event_img\" alt=\"$eventTitle\" />
                            <div class=\"events_description\">
                                <div class=\"event_info\">
                                    <p class=\"event_type\">$eventCatDesc</p>
                                    <p class=\"event_name\">$eventTitle</p>
                                    <p class=\"event_venue\">$eventVenue</p>
                                    <p class=\"event_date\">$startDate until $endDate</p>
                                </div>
                                <a href=$eventHTTP class='event_find_out'>Find out more ></a>
                            </div>
                        </div>";
                        // Add one to the temp count of rows
                        $tmpCount += 1;
                    }
                }
                $queryResult->close();
                $dbConn->close();
                ?>
            </div>
<!--             <div class="show_more" onclick="clickShowMore(this)" accesskey="m">
                <div class="plus_normal">
                    <img src="src/img/showmoreplusnormal.png" alt="Plus sign in a circle" onmouseenter="selectPlusImg(this)" onmouseleave="unselectPlusImg(this)"/>
                </div>
                <a>Show more ></a>
            </div>
            <div class="show_less" onclick="clickShowLess(this)" accesskey="l">
                <div class="minus_normal">
                    <img src="src/img/showlessminusnormal.png" alt="Plus sign in a circle" onmouseenter="selectMinusImg(this)" onmouseleave="unselectMinusImg(this)"/>
                </div>
                <a>Show less > </a>
            </div> -->
        </div>

        <div id="second_box" accesskey="s">
            <div class="box">
                <h2>Sign up for the latest news</h2>
                <form id="latest_news">
                    <input accesskey="M" type="email" id="lnEmail" placeholder="Email Address" >
                    <input accesskey="S" type="submit" id="lnSubmit" value="Submit">
                </form>
            </div>
        </div>
    </main>
</div>
<?php include './src/includes/footer.php'; ?>
</body>
</html>