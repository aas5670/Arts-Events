function selectBox(x) {
    x.style.backgroundColor = "rgba(89, 89, 89, .4)";
}

function normalBox(x) {
    x.style.backgroundColor = "#3d5f8f";
}

function selectPlusImg(x){
    x.src = "src/img/showmoreplushighlighted.png";
}

function unselectPlusImg(x){
    x.src = "src/img/showmoreplusnormal.png";
}

function selectMinusImg(x){
    x.src = "src/img/showlessminushighlighted.png";
}

function unselectMinusImg(x){
    x.src = "src/img/showlessminusnormal.png";
}

function clickOnImg(url){
    window.location = url;
}

function urlSelector() {
    var imgNumber = getCurrentImageNumber();
    if(imgNumber === 1){
        return document.querySelector('#first_box .event_showcase_block .info .event_detail #event_one_p').innerHTML;
    }
    else if(imgNumber === 2){
        return document.querySelector('#first_box .event_showcase_block .info .event_detail #event_two_p').innerHTML;
    }
    else if(imgNumber === 3){
        return document.querySelector('#first_box .event_showcase_block .info .event_detail #event_three_p').innerHTML;
    }
}

function clickShowMore(x){
    document.querySelector('#third_box .show_more').style.display = "none";
    document.querySelector('#third_box .show_less').style.display = "flex";
    if(window.innerWidth >= 1050){
        document.querySelector('#third_box .box_container div:nth-child(7)').style.display = "flex";
        document.querySelector('#third_box .box_container div:nth-child(8)').style.display = "flex";
        document.querySelector('#third_box .box_container div:nth-child(9)').style.display = "flex";
    }
    else if(window.innerWidth <= 1049){
        document.querySelector('#third_box .box_container div:nth-child(5)').style.display = "flex";
        document.querySelector('#third_box .box_container div:nth-child(6)').style.display = "flex";
        document.querySelector('#third_box .box_container div:nth-child(7)').style.display = "flex";
        document.querySelector('#third_box .box_container div:nth-child(8)').style.display = "flex";
    }
}

function clickShowLess(x){
    document.querySelector('#third_box .show_more').style.display = "flex";
    document.querySelector('#third_box .show_less').style.display = "none";
    if(window.innerWidth >= 1050){
        document.querySelector('#third_box .box_container div:nth-child(7)').style.display = "none";
        document.querySelector('#third_box .box_container div:nth-child(8)').style.display = "none";
        document.querySelector('#third_box .box_container div:nth-child(9)').style.display = "none";
    }
    else if(window.innerWidth <= 1049){
        document.querySelector('#third_box .box_container div:nth-child(5)').style.display = "none";
        document.querySelector('#third_box .box_container div:nth-child(6)').style.display = "none";
        document.querySelector('#third_box .box_container div:nth-child(7)').style.display = "none";
        document.querySelector('#third_box .box_container div:nth-child(8)').style.display = "none";
    }
}
function onPageLoadVariables(){
    var selector = document.getElementsByClassName('event');
    localStorage.setItem('totalEventElements', selector.length);
    localStorage.setItem('currentEventID', 6);
    var sPath = window.location.pathname;
    var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
    localStorage.setItem('currentPage', sPage);
}

function loadShowLess(){
    // if(localStorage.getItem('totalEventElements') < 6){
    //     document.querySelector('#third_box .show_more').style.display = "none";
    //     document.querySelector('#third_box .show_more').innerHTML = "";

    // }
}

function clickEventShowMore(){
    var i = +localStorage.getItem('currentEventID');
    var i6 = i+6;
    var finished = false;
    localStorage.setItem('showMoreCompleted', 'no');
    //alert(localStorage.getItem('totalEventElements'));
    //alert(i + " " + i6);
    if(localStorage.getItem('showMoreCompleted') == "no") {
        for (i; i <= i6; i++) {
            //alert(i + " " + i6);
            if(i==localStorage.getItem('totalEventElements'))
            {
                document.querySelector('#event_box .box_container div:nth-child(' + i + ')').style.display = "flex";
                finished = true;
                document.querySelector('#event_box .show_less').style.display = "flex";
                document.querySelector('#event_box .showML').style.display = "none";
                localStorage.setItem('currentEventID', 6);
            }
            else
            {
                document.querySelector('#event_box .box_container div:nth-child(' + i + ')').style.display = "flex";
                localStorage.setItem('currentEventID', i);
            }
        }

    }
    localStorage.setItem('showMoreCompleted', 'yes');
    document.querySelector('#event_box .show_more').style.display = "none";
    document.querySelector('#event_box .show_more').style.display = "none";
    document.querySelector('#event_box .showML').style.display = "flex";
}

function clickEventShowLess(){
    var i = localStorage.getItem('totalEventElements');
    for(i; i>6; i--)
    {
        document.querySelector('#event_box .box_container div:nth-child('+i+')').style.display = "none";
    }

    document.querySelector('#event_box .show_more').style.display = "flex";
    document.querySelector('#event_box .show_less').style.display = "none";
    document.querySelector('#event_box .showML').style.display = "none";
    localStorage.setItem('currentEventID', 6);
}

function getCurrentImageNumber() {
    var img_one = document.querySelector('#first_box .event_showcase_block #showcase_img_one');
    var img_two = document.querySelector('#first_box .event_showcase_block #showcase_img_two');
    var img_three = document.querySelector('#first_box .event_showcase_block #showcase_img_three');

    var computed_img_one = getComputedStyle(img_one, null);
    var computed_img_two = getComputedStyle(img_two, null);
    var computed_img_three = getComputedStyle(img_three, null);

    if (computed_img_one.display === 'block') {
        return 1;
    }
    else if (computed_img_two.display  === "block") {
        return 2;
    }
    else if (computed_img_three.display  === "block") {
        return 3;
    }
}

function changeImgDesText_one(hideshow){
    var text_one_h1 = document.querySelector('#first_box .event_showcase_block .info .event_detail #event_one_h1');
    var text_one_h2 = document.querySelector('#first_box .event_showcase_block .info .event_detail #event_one_h2');
    if (hideshow === 0){
        text_one_h1.style.display = "none";
        text_one_h2.style.display = "none";
    }
    else if(hideshow === 1){
        text_one_h1.style.display = "block";
        text_one_h2.style.display = "block";
    }
}

function changeImgDesText_two(hideshow){
    var text_two_h1 = document.querySelector('#first_box .event_showcase_block .info .event_detail #event_two_h1');
    var text_two_h2 = document.querySelector('#first_box .event_showcase_block .info .event_detail #event_two_h2');
    if (hideshow === 0){
        text_two_h1.style.display = "none";
        text_two_h2.style.display = "none";
    }
    else if(hideshow === 1){
        text_two_h1.style.display = "block";
        text_two_h2.style.display = "block";
    }
}

function changeImgDesText_three(hideshow){
    var text_three_h1 = document.querySelector('#first_box .event_showcase_block .info .event_detail #event_three_h1');
    var text_three_h2 = document.querySelector('#first_box .event_showcase_block .info .event_detail #event_three_h2');
    if (hideshow === 0){
        text_three_h1.style.display = "none";
        text_three_h2.style.display = "none";
    }
    else if(hideshow === 1){
        text_three_h1.style.display = "block";
        text_three_h2.style.display = "block";
    }
}


function changeImgDesText(){
    if (getCurrentImageNumber() === 1){
        changeImgDesText_one(1);
        changeImgDesText_two(0);
        changeImgDesText_three(0);
    }
    else if (getCurrentImageNumber() === 2){
        changeImgDesText_one(0);
        changeImgDesText_two(1);
        changeImgDesText_three(0);
    }
    else if (getCurrentImageNumber() === 3){
        changeImgDesText_one(0);
        changeImgDesText_two(0);
        changeImgDesText_three(1);
    }
}

function changeImageRight(){
    var img_one = document.querySelector('#first_box .event_showcase_block #showcase_img_one');
    var img_two = document.querySelector('#first_box .event_showcase_block #showcase_img_two');
    var img_three = document.querySelector('#first_box .event_showcase_block #showcase_img_three');

    if (getCurrentImageNumber() === 1){
        img_one.style.display = "none";
        img_two.style.display = "block";
        changeImgDesText();
    }
    else if (getCurrentImageNumber() === 2){
        img_two.style.display = "none";
        img_three.style.display = "block";
        changeImgDesText();
    }
    else if (getCurrentImageNumber() === 3){
        img_three.style.display = "none";
        img_one.style.display = "block";
        changeImgDesText();
    }
}

function changeImageLeft(){
    var img_one = document.querySelector('#first_box .event_showcase_block #showcase_img_one');
    var img_two = document.querySelector('#first_box .event_showcase_block #showcase_img_two');
    var img_three = document.querySelector('#first_box .event_showcase_block #showcase_img_three');

    if (getCurrentImageNumber() === 1){
        img_one.style.display = "none";
        img_three.style.display = "block";
        changeImgDesText();
    }
    else if (getCurrentImageNumber() === 2){
        img_two.style.display = "none";
        img_one.style.display = "block";
        changeImgDesText();
    }
    else if (getCurrentImageNumber() === 3){
        img_three.style.display = "none";
        img_two.style.display = "block";
        changeImgDesText();
    }
}

function changeImageNumOne(){
    var img_one = document.querySelector('#first_box .event_showcase_block #showcase_img_one');
    var img_two = document.querySelector('#first_box .event_showcase_block #showcase_img_two');
    var img_three = document.querySelector('#first_box .event_showcase_block #showcase_img_three');

    img_one.style.display = "block";
    img_two.style.display = "none";
    img_three.style.display = "none";
    changeImgDesText();
}

function changeImageNumTwo() {
    var img_one = document.querySelector('#first_box .event_showcase_block #showcase_img_one');
    var img_two = document.querySelector('#first_box .event_showcase_block #showcase_img_two');
    var img_three = document.querySelector('#first_box .event_showcase_block #showcase_img_three');

    img_one.style.display = "none";
    img_two.style.display = "block";
    img_three.style.display = "none";
    changeImgDesText();
}

function changeImageNumThree(){
    var img_one = document.querySelector('#first_box .event_showcase_block #showcase_img_one');
    var img_two = document.querySelector('#first_box .event_showcase_block #showcase_img_two');
    var img_three = document.querySelector('#first_box .event_showcase_block #showcase_img_three');

    img_one.style.display = "none";
    img_two.style.display = "none";
    img_three.style.display = "block";
    changeImgDesText();
}

function showMobNavMenu(){
    document.querySelector('nav').style.display = "block";
    document.querySelector('#mob_drop_down img:nth-child(1)').style.display = "none";
    document.querySelector('#mob_drop_down img:nth-child(2)').style.display = "block";
}

function hideMobNavMenu(){
    document.querySelector('nav').style.display = "none";
    document.querySelector('#mob_drop_down img:nth-child(1)').style.display = "block";
    document.querySelector('#mob_drop_down img:nth-child(2)').style.display = "none";
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.eveUPImg').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

// media query event handler
if (matchMedia) {
    var mq = window.matchMedia("(max-width: 1049px)");
    mq.addListener(WidthChangeMobile);
	WidthChangeMobile(mq);

	var mb = window.matchMedia("(min-width: 1050px");
	mb.addListener(WidthChangeNormal);
    WidthChangeNormal(mb);
}

// media query change
function WidthChangeMobile(mq) {
    if (mq.matches) {
        if (localStorage.getItem('currentPage') == "index.php") {
            document.querySelector('nav').style.display = "none";
            document.querySelector('#third_box .box_container div:nth-child(5)').style.display = "none";
            document.querySelector('#third_box .box_container div:nth-child(6)').style.display = "none";
            document.querySelector('#third_box .box_container div:nth-child(7)').style.display = "none";
            document.querySelector('#third_box .box_container div:nth-child(8)').style.display = "none";
            document.querySelector('#third_box .box_container div:nth-child(9)').style.display = "none";
            document.querySelector('#third_box .show_more').style.display = "flex";
            document.querySelector('#third_box .show_less').style.display = "none";
            document.querySelector('#mob_drop_down img:nth-child(2)').style.display = "none";
            document.querySelector('#mob_drop_down img:nth-child(1)').style.display = "block";
        }
        else if (localStorage.getItem('currentPage') == "events.php") {
            for (var i = localStorage.getItem('totalEventElements'); i > 6; i--) {
                document.querySelector('#event_box .box_container div:nth-child(' + i + ')').style.display = "none";
            }
        }
    }
}

function WidthChangeNormal(mb){
    if(mb.matches) {
        if (localStorage.getItem('currentPage') == "index.php") {
            document.querySelector('nav').style.display = "block";
            document.querySelector('#third_box .box_container div:nth-child(5)').style.display = "flex";
            document.querySelector('#third_box .box_container div:nth-child(6)').style.display = "flex";
            document.querySelector('#third_box .box_container div:nth-child(7)').style.display = "none";
            document.querySelector('#third_box .box_container div:nth-child(8)').style.display = "none";
            document.querySelector('#third_box .box_container div:nth-child(9)').style.display = "none";
            document.querySelector('#third_box .show_more').style.display = "flex";
            document.querySelector('#third_box .show_less').style.display = "none";
        }
        else if (localStorage.getItem('currentPage') == "events.php") {
            for (var i = 6; i <= localStorage.getItem('totalEventElements'); i++) {
                document.querySelector('#event_box .box_container div:nth-child(' + i + ')').style.display = "flex";
            }
        }
    }
}