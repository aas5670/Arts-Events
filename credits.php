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

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"/>

    <!-- Enables the javascript -->
    <script type="text/javascript" src="src/js/jscripts.js" ></script>

    <title>Events - Arts & Events</title>
    <?php $thisPage = "credits.php"; $thisSubPage = ""; $thisSubSection = "main";?>
</head>
<body>
<?php include 'src/includes/header.php'; ?>
<div id="main_container">
    <main>
        <!-- Within the css for some reason the height would mess up so this page has a fixed height
         not that this should matter due to it being a extra page -->
        <div class="cred_cont">
            <div class="cred_content">
                <div class="cred_info">
                    <h1>Credits page</h1>
                    <div class="cred_section">
                        <section>
                            <h2>Student Details</h2>
                            <ul>
                                <li>Name: Adam Ayre-Storie</li>
                                <li>ID: w15007083</li>
                                <li>EMAIL: w15007083@northumbria.ac.uk</li>
                            </ul>
                        </section>
                        <section>
                            <h2>Security Considerations</h2>
                            <p>There are many security considerations to consider while creating and maintaining a fully functional website, some of these are SQL Injections, Cross Site Scripting, Email Form Header Injection, Malicious File Upload, User Authentication, Proper error suppression and logging errors. To avoid successful SQL Injections, you must trust no data that is received from any user and to properly validate all inputs. To avoid Cross Site Scripting, you must validate all user input and remove any malicious attempts to exploit a vulnerability. To avoid Email Form Header, you must screen user input and remove all malicious attempts to exploit. To avoid Malicious File Uploads, you must validate the file name and the nature of the file before storing it on your website. To ensure that information is showing to who you want it to show to you must use User Authentication this stops users from being able to see information they are not supposed to. It must be ensured that a user is properly validated and they cannot spoof their way into an area they are not supposed to get to and ensure that they cannot make there way round the authentication. You must make sure that users are responsible for whatever actions they take on the website so you will keep logs of what every user does within the website. To ensure that extra information is not passed to the user you must make sure that any errors you pass to the user must not contain any information on the inner workings of your website/system.</p>
                            <br>
                            <p>In order comply with the data protection act the data the website must make sure the information which will be stored from the users must follow these principles, it must be: used fairly and lawfully, used for limited and stated purposes, used in a way which is not excessive, not kept for longer than necessary, handled according to the data protection rights, kept safe and secure and not transferred out side of the <a accesskey="A" href=https://www.gov.uk/eu-eea>EEA</a> without necessary protection. <a accesskey="S" href=https://ico.org.uk/for-organisations/guide-to-data-protection/>Find out more click here</a>. To outline your methods of securing data, users access to the website and their data and many other things you must create a privacy policy this privacy policy is agreed by the user whenever they use the site whether they read it or not. There are many legal issues surrounding a website such as copyright concerns which is not limited to images that are used on the website and text that is used within the website. Another issue is the domain you need to have a domain that is not taken or like another domain that is trademarked. Trademark concerns this can be related to a word, image and slogan. Defeminisation this refers to a false statement that is made by someone or some organisation this cannot be displayed on your website.</p>
                        </section>
                        <section>
                            <h2>Security Considerations Sources</h2>
                            <ul>
                                <li>Bitlaw.com. (n.d.). Web Site Legal Issues (BitLaw). [online] Available at: http://www.bitlaw.com/internet/webpage.html [Accessed 30 Apr. 2017].</li>
                                <li>Gov.uk. (n.d.). Data protection - GOV.UK. [online] Available at: https://www.gov.uk/data-protection/the-data-protection-act [Accessed 30 Apr. 2017].</li>
                                <li>Ico.org.uk. (n.d.). Guide to data protection. [online] Available at: https://ico.org.uk/for-organisations/guide-to-data-protection/ [Accessed 30 Apr. 2017].</li>
                                <li>Ltd, W. (n.d.). Most common website security issues and prevention | Custom Development. [online] Wubbleyou.co.uk. Available at: https://www.wubbleyou.co.uk/blog/articles/most-common-website-security-issues-and-prevention [Accessed 30 Apr. 2017].</li>
                            </ul>
                        </section>
                        <section>
                            <h2>Image Sources</h2>
                            <ul>
                                <li>A Christmas Carol. (n.d.). [image] Available at: http://www.intrepidshakespeare.com/staged-readings/a-christmas-carol/ [Accessed 30 Apr. 2017].</li>
                                <li>Ashley Jackson. (n.d.). [image] Available at: http://wdfr.info/addzthis-moorland.htm [Accessed 30 Apr. 2017].</li>
                                <li>Banff Mountain Film Festival. (n.d.). [image] Available at: http://groupspaces.com/climbliverpool/item/232534 [Accessed 30 Apr. 2017].</li>
                                <li>Carmen presented by Russian State Ballet and Opera House. (n.d.). [image] Available at: http://soundslikesydney.com.au/admin/wp-content/uploads/2015/08/carmen-2016-325x2501-312x240.jpg [Accessed 30 Apr. 2017].</li>
                                <li>CBeebies Live!. (2015). [image] Available at: http://cardiffmummysays.com/cardiff/review-of-cbeebies-live-justin-and-friends-mr-tumbles-circus/ [Accessed 30 Apr. 2017].</li>
                                <li>Dirty Dancing. (n.d.). [image] Available at: https://katandherblog.wordpress.com/tag/movies-2/ [Accessed 30 Apr. 2017].</li>
                                <li>Diversity Genesis. (n.d.). [image] Available at: https://i.ytimg.com/vi/F8undFCp8ls/maxresdefault.jpg [Accessed 30 Apr. 2017].</li>
                                <li>Harlem Globetrotters. (n.d.). [image] Available at: http://www.tsxdzx.com/p/Fox-Sports.html [Accessed 30 Apr. 2017].</li>
                                <li>JLS Evolution Tour. (n.d.). [image] Available at: http://www.capitalfm.com/artists/jls/news/belfast-dublin-2013-tour/ [Accessed 30 Apr. 2017].</li>
                                <li>Laurel & Hardy. (n.d.). [image] Available at: http://www.rockmedia.de/assets/images/e/Rockmedia%20Werte%201-e766116e.jpg [Accessed 30 Apr. 2017].</li>
                                <li>Little Black Rose Musical Variety Show. (n.d.). [image] Available at: http://www.guoguiyan.com/black-rose.html [Accessed 30 Apr. 2017].</li>
                                <li>Mamma Mia!. (n.d.). [image] Available at: http://travelwithmikeanna.com/?p=7868 [Accessed 30 Apr. 2017].</li>
                                <li>Miranda Hart: My What I Call, Live Show. (n.d.). [image] Available at: http://www.livenation.co.uk/event/488522/miranda-hart-my-what-i-call-live-show-2014-tour-tickets [Accessed 30 Apr. 2017].</li>
                                <li>Permanent Displays at Discovery Museum. (2005). [image] Available at: https://media-cdn.tripadvisor.com/media/photo-s/0a/05/7f/ca/the-discovery-museum.jpg [Accessed 30 Apr. 2017].</li>
                                <li>Peter Pan - Never Ending Story. (n.d.). [image] Available at: http://www.yakevents.com/index-3.html [Accessed 30 Apr. 2017].</li>
                                <li>Premier League Darts 2017. (n.d.). [image] Available at: http://www.postadsuk.com/search-birmingham%20redditch%20tamworth%20sutton-England-77-1.html [Accessed 30 Apr. 2017].</li>
                                <li>Pride and Prejudice. (n.d.). [image] Available at: http://labs3.kentooz.com/agcsuper/read/pride-prejudice-2005-film-wikipedia-news.html [Accessed 30 Apr. 2017].</li>
                                <li>Punt & Dennis: Life on the Road. (n.d.). [image] Available at: http://www.yvonne-arnaud.co.uk/production/fascinating-aida-charm-offensive [Accessed 30 Apr. 2017].</li>
                                <li>Rhyme Around the World ? A Nursery Rhyme Exhibition. (2004). [image] Available at: https://sevenstories10years.files.wordpress.com/2015/04/2004-0016_jane-ray.jpg [Accessed 30 Apr. 2017].</li>
                                <li>Ruth Fettis: Tales from a Forgotten City. (n.d.). [image] Available at: https://wurbradford.wordpress.com/page/2/ [Accessed 30 Apr. 2017].</li>
                                <li>Sara Barker and Ryder Architecture. (n.d.). [image] Available at: http://www.thejournal.co.uk/culture/arts/subtle-work-art-opens-new-6315943 [Accessed 30 Apr. 2017].</li>
                                <li>Once in a Lifetime - The Final Tour. (n.d.). [image] Available at: http://www.ents24.com/uk/tour-dates/Showaddywaddy [Accessed 30 Apr. 2017].</li>
                                <li>The Newcastle Triathlon 2017. (n.d.). [image] Available at: http://www.startfitness.co.uk/prodtype.asp?CAT_ID=4600&numRecordPosition=1&strParents=4587%2C4589 [Accessed 30 Apr. 2017].</li>
                                <li>Thomas Bewick and His Apprentices. (n.d.). [image] Available at: https://tale-piecestheblogofthebewicksociety.blogspot.co.uk/2012/01/woodengraver-on-bewick.html [Accessed 30 Apr. 2017].</li>
                                <li>Winter Festival @ Discovery Museum. (n.d.). [image] Available at: http://www.walesonline.co.uk/whats-on/family-kids-news/ [Accessed 30 Apr. 2017].</li>
                                <li>html. (n.d.). [image] Available at: http://anons.zahodivse.ru/img/html.png [Accessed 1 May 2017].</li>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<?php include 'src/includes/footer.php'; echo"\n"?>
</body>
</html>