<!-- Declares the container for the header -->
        <div id="header_container">
            <!-- Declares the header itself -->
            <header>
                <!-- Declares the wrapper for the mobile navigation and the logo -->
                <div id="header_wrapper">
                    <div id="logo">
                        <a accesskey="1" <?php if($thisSubSection === "admin"){
                            echo "href=\"../index.php\"";}else{
                            echo "href=\"./index.php\"";};?> >Arts & Events</a>
                    </div>
                    <div id="mob_drop_down" accesskey="n">
                        <img <?php if($thisSubSection === "admin"){echo "src=\"../src/img/menu-dropdown.png\"";}else{echo "src=\"./src/img/menu-dropdown.png\"";};?> alt="Vertical Lines" onclick="showMobNavMenu()"/>
                        <img <?php if($thisSubSection === "admin"){echo "src=\"../src/img/menu-close.png\"";}else{echo "src=\"./src/img/menu-close.png\"";};?> alt="An X" onclick="hideMobNavMenu()"/>
                    </div>
                </div>
                <!-- Declares the normal navigation outside the other wrapper -->
                <nav>
                    <ul>
                        <li><a accesskey="1" <?php if($thisPage === "index.php"){echo"class=\"currentPage\" ";} if($thisSubSection === "admin"){echo "href=\"../index.php\"";}else{echo "href=\"./index.php\"";};?>>Home</a></li>
                        <li><a accesskey="2" <?php if($thisPage === "events.php"){echo"class=\"currentPage\" ";} if($thisSubSection === "admin"){echo "href=\"../events.php\"";}else{echo "href=\"./events.php\"";};?>>View Events</a></li>
                        <li><a accesskey="3" <?php if($thisPage === "adminIndex.php"){echo"class=\"currentPage\" ";} if($thisSubSection === "admin"){echo "href=\"./index.php\"";}else{echo "href=\"./admin/index.php\"";};?>>Admin</a></li>
                        <li><a accesskey="4" <?php if($thisPage === "credits.php"){echo"class=\"currentPage\" ";} if($thisSubSection === "admin"){echo "href=\"../credits.php\"";}else{echo "href=\"./credits.php\"";};?>>Credit's</a></li>
                        <li><a accesskey="5" <?php if($thisSubSection === "admin"){echo "href=\"../src/pdf/Wireframe.pdf\"";}else{echo "href=\"./src/pdf/Wireframe.pdf\"";};?>>Wireframe</a></li>
                    </ul>
                </nav>
            </header>
        </div>