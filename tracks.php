
<?php include("dbcon.php");

$query_tracks = $pdo->query("SELECT music.id AS id, music.title AS title, artists.name AS artist, music.releaseDate AS releaseDate, music.source AS source FROM music LEFT JOIN artists ON music.artistId=artists.id");
$tracks = $query_tracks->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("_template.php");
head();
?>

<style>
    .viewLink:hover {
        text-decoration: underline;
        color: #0056b3;
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
                                        <span><a class="viewLink" href="music_view.php?id=<?php echo $item['id']; ?>">View</a></span>
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

<?php footer(); ?>


<!-- script for class "active" -->
<script>
    document.getElementById('nav_tracks').classList.add('active');
</script>
