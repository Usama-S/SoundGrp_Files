
<?php include("dbcon.php");

$query_tracks = $pdo->query("SELECT videos.id AS id, videos.title AS title, artists.name AS artist, videos.releaseDate AS releaseDate, videos.source AS source FROM videos LEFT JOIN artists ON videos.artistId=artists.id");
$tracks = $query_tracks->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("_template.php");
head(); ?>

<style>
    .viewLink:hover {
        text-decoration: underline;
        color: #0056b3;
    }
</style>
    <!-- Video Section Begin -->
    <section class="videos spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title center-title">
                        <h2>Videos</h2>
                        <h1>Latest videos</h1>
                    </div>
                    <!-- <div class="videos__large__item set-bg" data-setbg="template/img/videos/large-item.jpg">
                        <a href="https://www.youtube.com/watch?v=yJg-Y5byMMw?autoplay=1" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                        <div class="videos__large__item__text">
                            <h4>Martin Garrix & Pierce Fulton feat. Mike Shinoda - Waiting For Tomorrow (Official Video)
                            </h4>
                            <ul>
                                <li>02:35:18</li>
                                <li>Dec 17, 2019</li>
                            </ul>
                        </div>
                    </div> -->
                    <div class="row">
                    <?php foreach ($tracks as $item) { ?>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="blog__item">
                            <div class="videos__item__pic set-bg" data-setbg="template/img/videos/videos-1.jpg">
                                        <a href="https://www.youtube.com/watch?v=yJg-Y5byMMw?autoplay=1" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                                    </div>
                                <div class="blog__item__text">
                                    <span><a class="viewLink" href="video_view.php?id=<?php echo $item['id']; ?>">View</a></span>
                                    <h5><?php echo ucwords($item['title']); ?></h5>
                                    <ul>
                                        <li>By <span><?php echo $item['artist']; ?></span></li>
                                        <li><?php echo $item['releaseDate']; ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <!-- <div class="videos__slider owl-carousel">
                            <div class="col-lg-3">
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
                                    <div class="videos__item__pic set-bg" data-setbg="template/img/videos/videos-2.jpg">
                                        <a href="https://www.youtube.com/watch?v=K4DyBUG242c?autoplay=1" class="play-btn video-popup"><i class="fa fa-play"></i></a>
                                    </div>
                                    <div class="videos__item__text">
                                        <h5>Tiësto - Live Electric Daisy Carnival Las Vegas 2019</h5>
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
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Video Section End -->

    <?php footer(); ?>

    <!-- script for class "active" -->
<script>
    document.getElementById('nav_videos').classList.add('active');
</script>
