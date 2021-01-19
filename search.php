<?php
include("dbcon.php");
include("_template.php");
head();
?>

<script id="template1" type="text/html">
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="blog__item">
            <div class="blog__item__pic">
                <img src="template/img/blog/blog-5.jpg" alt="">
            </div>
            <div class="blog__item__text">
                <span><a class="viewLink" href="music_view.php?id={{musicid}}">View</a></span>
                <h5>{{musicTitle}}</h5>
                <ul>
                    <li>By <span>{{musicArtist}}</span></li>
                    <li>{{musicRelease}}</li>
                    <audio controls style="margin-top: 20px;">
                        <source src="uploads/audio/{{source}}">
                    </audio>
                </ul>
            </div>
        </div>
    </div>
</script>

<script id="template2" type="text/html">
<div class="col-lg-4 col-md-4 col-sm-4">
    <div class="blog__item">
        <div class="videos__item__pic set-bg" data-setbg="template/img/videos/videos-1.jpg">
            <a href="{{source}}" class="play-btn video-popup"><i class="fa fa-play"></i></a>
        </div>
        <div class="blog__item__text">
            <span><a class="viewLink" href="video_view.php?id={{videoid}}">View</a></span>
            <h5>{{title}}</h5>
            <ul>
                <li>By <span>{{artists}}</span></li>
                <li>{{releaseDate}}</li>
            </ul>
        </div>
    </div>
</div>
</script>

<section class="spad">
    <div class="container">
<div class="form col-lg-8" style="margin: auto;">
    <input onkeyup="check(this.value)" class="form-control" placeholder="search..." type="text" name="" id="">
</div>
</div>
</section>

<section class="spad">
    <div class="container">
        <div id="audio" class="row" ></div>
    </div>
</section>

<section class="spad">
    <div class="container">
        <div id="video" class="row"></div>
    </div>
</section>

<?php footer(); ?>

<script>

function check(keyword) {
    if (keyword != "") {
        checkaudio(keyword);
        checkvideo(keyword);
    }
    else {
        document.getElementById('audio').innerHTML = '';
        document.getElementById('video').innerHTML = '';
    }
}


  function checkaudio(keyword) {
    //var user_emails = <?php //echo json_encode($user_emails); ?>;
    //var email = params;
    if (keyword != "") {
        var template = document.getElementById('template1').innerHTML;
        var url = "searchApi.php?method=searchAudio&keyword=" + keyword;
        var xhr = new XMLHttpRequest;
        xhr.open("get", url);
        xhr.onload = function () {
        if (xhr.response != '') {
            console.log(xhr.response);
            console.log(document.getElementById('audio').innerHTML);
            console.log(template);
            var music = JSON.parse(xhr.response);
            document.getElementById('audio').innerHTML = '';
        
            for (var i = 0; i < music.length; i++) {
                document.getElementById('audio').innerHTML += template.replace('{{musicid}}', music[i].id)
                .replace('{{musicTitle}}', music[i].title)
                .replace('{{musicArtist}}', music[i].artist)
                .replace('{{musicRelease}}', music[i].releaseDate)
                .replace('{{source}}', music[i].src);
            }
        } else {
            document.getElementById('audio').innerHTML += '<h3>No results found</h3>';
            }
        }
        xhr.send();
    }
}

    function checkvideo(keyword) {
    //var user_emails = <?php //echo json_encode($user_emails); ?>;
    //var email = params;
    if (keyword != "") {
        var template = document.getElementById('template2').innerHTML;
        var url = "searchApi.php?method=searchVideo&keyword=" + keyword;
        var xhr = new XMLHttpRequest;
        xhr.open("get", url);
        xhr.onload = function () {
        if (xhr.response != null) {
            console.log(xhr.response);
            console.log(document.getElementById('video').innerHTML);
            //console.log(template);
            var videos = JSON.parse(xhr.response);
            document.getElementById('video').innerHTML = '';
        
            for (var i = 0; i < videos.length; i++) {
                document.getElementById('video').innerHTML += template.replace('{{source}}', videos[i].source)
                .replace('{{videoid}}', videos[i].id)
                .replace('{{title}}', videos[i].title)
                .replace('{{artists}}', videos[i].artist)
                .replace('{{releaseDate}}', videos[i].releaseDate);
            }
        } else {
            document.getElementById('video').innerHTML += '<h3>No results found</h3>';
            }
        }
        xhr.send();
    }
}
</script>