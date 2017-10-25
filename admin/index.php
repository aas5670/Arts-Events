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

        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"/>

        <!-- Enables the javascript -->
        <script type="text/javascript" src="../src/js/jscripts.js" ></script>

        <title>Events - Arts & Events</title>
        <?php $thisPage = "adminIndex.php"; $thisSubPage = "admin.php"; $thisSubSection = "admin";?>
    </head>
    <body>
    <?php include '../src/includes/header.php'; ?>
    <div id="main_container">
        <main>
            <div class="admin_cont">
                <?php include '../src/includes/adminNav.php'; ?>
                <div class="admin_content">
                    <div class="admin_info">
                        <h1>Basic Admin Information</h1>
                            <div class="admin_section">
                                <section>
                                    <h2>Basic Input Requirements</h2>
                                    <ul>
                                        <li>All text inputs must be below 255 characters</li>
                                        <li>Date inputs must be in the format DD/MM/YYYY</li>
                                        <li>Price must be an integer and no greater than 4 digits before the decimal and 2 digits after the decimal</li>
                                        <li>Category and venue must be within the list</li>
                                        <li>No special characters allowed</li>
                                        <li>All fields with a red astrix (<b>*</b>) are required</li>
                                    </ul>
                                </section>
                                <section>
                                    <h2>Basic Image Requirements</h2>
                                    <ul>
                                        <li>An image must be of the following formats (jpg, png, jpeg)</li>
                                        <li>An image must be less than 500KB</li>
                                        <li>If an image is already selected in the thumbnail you do not need to upload a new image unless you wish to update the image</li>
                                        <li>In order to test the image I have provided an example image which can be used to test the image section. <a href="../src/img/test_image.png">Click here for the image.</a> You must download this image or use an image that meets the requirements in order to add/update an event since the image is a requried field</li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <?php include '../src/includes/footer.php'; echo"\n"?>
    </body>
</html>