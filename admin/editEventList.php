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
        session_start();?>
    </head>
    <body>
        <?php include '../src/includes/header.php'; ?>

        <div id="main_container">
            <main>
                <div class="admin_cont">
                    <?php include '../src/includes/adminNav.php'; ?>
                    <div class="admin_content" id="admin_cokk">
                        <form action="editEvent.php" method="post">
                            <p>Enter the ID of the event you want to edit or click on one of the eventID's</p>
                            <label class="field" for="enterEventID">Event ID<b>*</b></label>
                            <input accesskey="I" type="text" name ="enterEventID" placeholder="Enter event ID..."/>
                            <input accesskey="S" type="submit" name="submitChanges" id="enterEventID" class="eventSubmit" value="Edit event"/>
                            <?php
                                if(isset($_SESSION['Error']) && !empty($_SESSION['Error']))
                                {
                                    echo $_SESSION['Error'];
                                    unset($_SESSION['Error']);
                                }
                                echo "\n";
                            ?>
                        </form>
                        <div class="list_events">
                            <?php
                            include '../src/includes/database_conn.php';

                            $sql = "SELECT *
                            FROM AE_category, AE_events, AE_venue
                            WHERE AE_events.catID = AE_category.catID and
                            AE_venue.venueID = AE_events.venueID";
                            $queryResult = $dbConn->query($sql);

                            if($queryResult === false) {
                                echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>";
                                exit;
                            }
                            else {
                                // echo the table headers
                                echo "<table>\n";
                                echo "                                <tr>\n";
                                echo "                                    <th>Event ID</th>\n";
                                echo "                                    <th>Event Title</th>\n";
                                echo "                                    <th>Event Venue</th>\n";
                                echo "                                    <th>Event Category</th>\n";
                                echo "                                    <th>Event Start Date</th>\n";
                                echo "                                    <th>Event End Date</th>\n";
                                echo "                                    <th>Event Price</th>\n";
                                echo "                                </tr>\n";
                                // While a row exists in the query result create a table entry for a event
                                while ($rowObj = $queryResult->fetch_object()) {
                                    echo "                                <tr>\n";
                                    echo "                                    <td>\n";
                                    echo "                                        <form action=\"editEvent.php\" method=\"post\">\n";
                                    echo "                                            <button type=\"submit\" name=\"enterEventID\" value=\"$rowObj->eventID\" class=\"eveButton\">$rowObj->eventID</button>\n";
                                    echo "                                        </form>\n";
                                    echo "                                    </td>\n";
                                    echo "                                    <td>$rowObj->eventTitle</td>\n";
                                    echo "                                    <td>$rowObj->venueName</td>\n";
                                    echo "                                    <td>$rowObj->catDesc</td>\n";
                                    echo "                                    <td>$rowObj->eventStartDate</td>\n";
                                    echo "                                    <td>$rowObj->eventEndDate</td>\n";
                                    echo "                                    <td>$rowObj->eventPrice</td>\n";
                                    echo "                                </tr>\n";
                                }
                                echo "                            </table>\n";
                            }
                            $queryResult->close();
                            $dbConn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <?php include '../src/includes/footer.php'; echo"\n"; ?>
    </body>
</html>