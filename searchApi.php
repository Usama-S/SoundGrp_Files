<?php

if (isset($_GET['method'])) {
  if ($_GET['method'] == 'searchAudio') {
    header('content-type: application/javascript; encoding:utf-8;');
    echo searchAudio($_GET['keyword']);
  }
}

function searchAudio($keyword)
{  
    
    include("dbcon.php");

  //$query = $pdo->prepare("SELECT * FROM music INNER JOIN artists ON music.artistId = artists.id LEFT JOIN albums ON music.albumId =albums.id INNER JOIN genres ON music.genreId = genres.id INNER JOIN languages ON music.languageId = languages.id where (music.title like '%:keyword%' or artists.name like '%:keyword%' or albums.name like '%:keyword%' or languages.language like '%:keyword%' or music.releaseDate like '%:keyword%' or music.description like '%:keyword%')");
  $query = $pdo->prepare("SELECT music.id as id, music.title as title, artists.name as artist, albums.name as album, genres.name as genre, languages.language as language, music.releaseDate as releaseDate, music.source as src FROM music INNER JOIN artists ON music.artistId = artists.id LEFT JOIN albums ON music.albumId =albums.id INNER JOIN genres ON music.genreId = genres.id INNER JOIN languages ON music.languageId = languages.id where (music.title like :keyword or artists.name like :keyword or albums.name like :keyword or languages.language like :keyword or music.releaseDate like :keyword or music.description like :keyword)");
  $str = '%'.$keyword.'%';
  $query->bindParam('keyword', $str, PDO::PARAM_STR);
  $query->execute();

  $music = $query->fetchAll(PDO::FETCH_ASSOC);

  return json_encode($music);
}

 ?>


<?php

if (isset($_GET['method'])) {
  if ($_GET['method'] == 'searchVideo') {
    header('content-type: application/javascript; encoding:utf-8;');
    echo searchVideo($_GET['keyword']);
  }
}

function searchVideo($keyword)
{  
    
    include("dbcon.php");

  //$query = $pdo->prepare("SELECT * FROM music INNER JOIN artists ON music.artistId = artists.id LEFT JOIN albums ON music.albumId =albums.id INNER JOIN genres ON music.genreId = genres.id INNER JOIN languages ON music.languageId = languages.id where (music.title like '%:keyword%' or artists.name like '%:keyword%' or albums.name like '%:keyword%' or languages.language like '%:keyword%' or music.releaseDate like '%:keyword%' or music.description like '%:keyword%')");
  $query = $pdo->prepare("SELECT videos.id as id, videos.title as title, artists.name as artist, albums.name as album, genres.name as genre, languages.language as language, videos.releaseDate as releaseDate, videos.source as src FROM videos INNER JOIN artists ON videos.artistId = artists.id LEFT JOIN albums ON videos.albumId =albums.id INNER JOIN genres ON videos.genreId = genres.id INNER JOIN languages ON videos.languageId = languages.id where (videos.title like :keyword or artists.name like :keyword or albums.name like :keyword or languages.language like :keyword or videos.releaseDate like :keyword or videos.description like :keyword)");
  $str = '%'.$keyword.'%';
  $query->bindParam('keyword', $str, PDO::PARAM_STR);
  $query->execute();

  $videos = $query->fetchAll(PDO::FETCH_ASSOC);

  return json_encode($videos);
}

 ?>