
<!-- Fetch Query -->
<?php include("dbcon.php");
  //$query = $pdo->prepare("SELECT music.id, music.title, artists.name AS artist, albums.name AS album, genres.name AS genre, languages.language AS language, music.releaseDate, music.description, music.source FROM music INNER JOIN artists ON music.artistId = artists.id INNER JOIN albums ON music.albumId = albums.id INNER JOIN genres ON music.genreId = genres.id INNER JOIN languages ON music.languageId = languages.id WHERE music.albumId=:albumid");
  //$query = $pdo->prepare("SELECT * FROM music WHERE albumId=:albumid");

  $query_tracks = $pdo->prepare("SELECT music.title AS title, artists.name AS artist, music.releaseDate AS releaseDate, music.source AS source FROM music LEFT JOIN artists ON music.artistId=artists.id WHERE genreId=:genreId");
  $query_tracks->bindParam("genreId", $_GET['id'], PDO::PARAM_INT);
  $query_tracks->execute();
  $tracks = $query_tracks->fetchAll(PDO::FETCH_ASSOC);

  $query_videos = $pdo->prepare("SELECT videos.title AS title, artists.name AS artist, videos.releaseDate AS releaseDate, videos.source AS source FROM videos LEFT JOIN artists ON videos.artistId=artists.id WHERE genreId=:genreId");
  $query_videos->bindParam("genreId", $_GET['id'], PDO::PARAM_INT);
  $query_videos->execute();
  $videos = $query_videos->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- /Fetch Query -->

<?php include("_template.php");
head();
?>

<style>
.fa-play {
    line-height: 40px;
}
</style>
<section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Audio Tracks</h2>
                        <h1>Audio Tracks</h1>
                    </div>
                    <div class="row">
                        <?php foreach ($tracks as $item) { ?>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img src="template/img/blog/blog-5.jpg" alt="">
                                    </div>
                                    <div class="blog__item__text">
                                        <span>Audio Track</span>
                                        <h5><?php echo $item['title']; ?></h5>
                                        <ul>
                                            <li>By <span><?php echo $item['artist']; ?></span></li>
                                            <li><?php echo $item['releaseDate']; ?></li>
                                            <audio controls style="margin-top: 20px;">
                                                <source src="uploads/audio/<?php echo $item['source']; ?>">
                                            </audio>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="template/img/blog/blog-1.jpg" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <span>Music festival</span>
                                    <h5>World Music Festival | Free Events & Concerts in Chicago</h5>
                                    <ul>
                                        <li>By <span>Erna O’Conner</span></li>
                                        <li>Dec 17, 2019</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="template/img/blog/blog-2.jpg" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <span>Music festival</span>
                                    <h5>How ROQU Media and The Manual London staged Saudi…</h5>
                                    <ul>
                                        <li>By <span>Erna O’Conner</span></li>
                                        <li>Dec 17, 2019</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="template/img/blog/blog-3.jpg" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <span>Music festival</span>
                                    <h5>2019 Festival of the Sun music event, Port Macquarie</h5>
                                    <ul>
                                        <li>By <span>Erna O’Conner</span></li>
                                        <li>Dec 17, 2019</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="template/img/blog/blog-4.jpg" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <span>Music festival</span>
                                    <h5>Taylor Swift to Headline Glaston Music Festival</h5>
                                    <ul>
                                        <li>By <span>Erna O’Conner</span></li>
                                        <li>Dec 17, 2019</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="template/img/blog/blog-6.jpg" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <span>Music festival</span>
                                    <h5>Lost Paradise festival cancelled amid bushfire danger</h5>
                                    <ul>
                                        <li>By <span>Erna O’Conner</span></li>
                                        <li>Dec 17, 2019</li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-lg-12">
                            <div class="pagination__links blog__pagination">
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">Next</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
</section>


    <!-- Video Section Begin -->
    <section class="videos spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Videos</h2>
                        <h1>Latest videos</h1>
                    </div>
                    <div class="row">
                        <div class="videos__slider owl-carousel">
                            
                            <?php foreach ($videos as $item) { ?>
                                <div class="col-lg-3">
                                    <div class="videos__item">
                                        <div class="videos__item__pic set-bg" data-setbg="template/img/videos/videos-2.jpg">
                                            <a href="<?php echo $item['source']; ?>" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                                        </div>
                                        <div class="videos__item__text">
                                            <h5><?php echo ucwords($item['title']); ?></h5>
                                            <ul>
                                                <!-- <li>02:35:18</li> -->
                                                <li><?php echo $item['releaseDate']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- <div class="col-lg-3">
                                <div class="videos__item">
                                    <div class="videos__item__pic set-bg" data-setbg="template/img/videos/videos-1.jpg">
                                        <a href="https://www.youtube.com/watch?v=yJg-Y5byMMw?autoplay=1" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                                    </div>
                                    <div class="videos__item__text">
                                        <h5>Electric Love Festival 2019 - The Opening Ceremony</h5>
                                        <ul>
                                            <li>02:35:18</li>
                                            <li>Dec 17, 2019</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="videos__item">
                                    <div class="videos__item__pic set-bg" data-setbg="template/img/videos/videos-3.jpg">
                                        <a href="https://www.youtube.com/watch?v=3nQNiWdeH2Q?autoplay=1" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                                    </div>
                                    <div class="videos__item__text">
                                        <h5>Martin Garrix - Live @ Ultra Music Festival Miami 2019</h5>
                                        <ul>
                                            <li>02:35:18</li>
                                            <li>Dec 17, 2019</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="videos__item">
                                    <div class="videos__item__pic set-bg" data-setbg="template/img/videos/videos-4.jpg">
                                        <a href="https://www.youtube.com/watch?v=Srqs4CitU2U?autoplay=1" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                                    </div>
                                    <div class="videos__item__text">
                                        <h5>Armin van Buuren live at Tomorrowland 2019</h5>
                                        <ul>
                                            <li>02:35:18</li>
                                            <li>Dec 17, 2019</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="videos__item">
                                    <div class="videos__item__pic set-bg" data-setbg="template/img/videos/videos-3.jpg">
                                        <a href="https://www.youtube.com/watch?v=vBGiFtb8Rpw?autoplay=1" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                                    </div>
                                    <div class="videos__item__text">
                                        <h5>Martin Garrix - Live @ Ultra Music Festival Miami 2019</h5>
                                        <ul>
                                            <li>02:35:18</li>
                                            <li>Dec 17, 2019</li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Video Section End -->

<?php footer(); ?>


<!-- script for class "active" -->
<script>
    document.getElementById('nav_categories').classList.add('active');
</script>


<!-- script to pause all the audios except the one which is clicked -->
<script>
  $('audio').each(function () {
    var myAudio = this;
    this.addEventListener('play', function () {
      $('audio').each(function () {
        if (!(this === myAudio)) {
          this.pause();
        }
      });
    });
  });
</script>
<!-- /script to pause all the audios except the one which is clicked -->
