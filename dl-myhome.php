<?php

$GIFT_FILE = "./data/igit-my-home.mp3";
$EMAIL_FILE = "./data/emails.json";

function baseurl(){
        $prot=stripos($_SERVER['SERVER_PROTOCOL'],'HTTPS')===false?'http://':'https://';
        $host=$_SERVER['HTTP_HOST'];
        $port=$_SERVER['SERVER_PORT']==80?'':':'.$_SERVER['SERVER_PORT'];
        $path=preg_replace('/[^\/]*$/', '', $_SERVER['REQUEST_URI']);
        return $prot.$host.$port.$path;
}

function jsonfile($fn, $data=null){
        return $data != null
                ? file_put_contents($fn, json_encode($data))
                : file_exists($fn)
                        ? json_decode(file_get_contents($fn),true)
                        : false;
}

function send_file($f,$inline=false){
        header('Content-Description: File Transfer');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: '.filesize($f));
        header('Content-Type: '.mime_content_type($f));
        if($inline){
                header('Content-Disposition: inline; filename='.basename($f));
        } else {
                header('Content-Disposition: attachment; filename='.basename($f));
        }
        readfile($f);
}

$error='';
if(!empty($_POST['email'])) {
        $email=strtolower($_POST['email']);
        if(preg_match('/^.+@.+\.\w+$/', $email)) {
                $f=jsonfile($EMAIL_FILE);
                if(!$f) $f=array();
                if(!array_key_exists($email,$f)) {
                        $f[$email]=date('Y-m-d H:i:s');
                        jsonfile($EMAIL_FILE,$f);
                        send_file($GIFT_FILE);
                } else {
                        $error='Email déjà connu ! ';
                }
        } else {
                $error='Email invalide !';
        }
}

?>
<html dir="ltr" lang="fr-FR">
<head>
<meta charset="UTF-8"/>
<title>IGIT - Télécharger gratuitement 'My Home'</title>
<meta name="description" content="Le site officiel du groupe Igit, Télécharger gratuitement le morceau 'My Home', free download"/>
<meta name="keywords" content="Igit, Antoine, Hugo, Paulo, musique, blues, indie, alternatif, the voice, tf1, bleu citron"/>
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" media="all" href="css/style.css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js"></script>


<!-- Tracking analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40769202-1', 'igitmusic.com');
  ga('send', 'pageview');
</script>


</head>
<body>

  <ul id="menu">
    <li class="tour"><a href="http://www.igitmusic.com/#tour">Tour</a></li>
    <li class="music"><a href="http://www.igitmusic.com/#music">Music</a></li> 
    <li class="home"><a href="http://www.igitmusic.com/#home"><img src="img/logo.png" /></a></li>
    <li class="video"><a href="http://www.igitmusic.com/#video">Vidéos</a></li>
    <li class="pros"><a href="http://www.igitmusic.com/#pros"></a>Pros</li>
  </ul>



<div id="content" class="myhome">
  <div class="section" id="home">
      <div class="sectionContent">
       <h1>Télécharger gratuitement "My Home"</h1>
        Laisser votre email pour télécharger gratuitement le titre !
       <?php if($error) { ?><div class="error"><?php echo $error ?></div><?php } ?>
       <form action="?" method="POST">
           <input type="text" name="email" placeholder="email..."/>
	   <input type="submit" value="Télécharger">
	</form>
       
       <div style="padding-left:150px;">
         <a href="https://itunes.apple.com/fr/album/like-angels-do-ep/id651657197" class="angels"><img src="./img/pochette-ep200x200.jpg"></a>
       <div class="desc">
        L'EP complet, "Like Angels Do", est disponible en téléchargement sur toutes les platformes digitales:        
        <ul>
           <li> Téléchagement: <a href="https://itunes.apple.com/fr/album/like-angels-do-ep/id651657197" class="igit sur itune" target="_blank">Itunes</a>,
            <a href="https://play.google.com/store/music/album/Igit_Like_Angels_Do?id=Bqoukgdxudnkwwksc23bd7zsskm" class="play" target="_blank">Google Play</a>.
           <li> Ecoute: <a href="http://www.deezer.com/fr/album/6617673" class="deezer" target="_blank">Deezer</a>,
             <a href="http://open.spotify.com/album/5yP5w28XZz3SR6k5Kqz0pq" class="spotify" target="_blank">Spotify</a>.
        </ul>
      </div>

   </div>
  </div>
</div>


<!-- Footer -->
  <div id="footer">
    <ul id="social">
      <li><a href="https://www.facebook.com/igitmusic" class="facebook" target="_blank">
          <img src="img/facebook.png" alt="Igit sur facebook" width="100%" height="100%"/></a></li>
      <li><a href="https://twitter.com/IGITOFFICIAL" class="twitter" target="_blank">
          <img src="img/twitter.png" alt="Igit sur twitter" width="100%" height="100%"/></a></li>
      <li><a href="http://www.youtube.com/user/igitesiomseihcag" class="youtube" target="_blank">
          <img src="img/youtube.png" alt="Igit sur youtube" width="100%" height="100%"/></a></li>
      <li><a href="mailto:florent@kalimaproductions.org" class="mail" target="_blank">
          <img src="img/mail.png" alt="mail" width="100%" height="100%"/></a></li>
      <li><a href="https://itunes.apple.com/fr/album/like-angels-do-ep/id651657197" class="igit sur itune" target="_blank">
          <img src="img/itune.png" alt="Igit sur Itune" width="100%"
          height="100%"/></a></li>
      <li><a href="http://www.deezer.com/fr/album/6617673" class="deezer" target="_blank">
          <img src="img/deezer.png" alt="Igit sur Deezer" width="100%" height="100%"/></a></li>
      <li><a href="http://open.spotify.com/album/5yP5w28XZz3SR6k5Kqz0pq" class="spotify" target="_blank">
          <img src="img/spotify.png" alt="spotify" width="100%"
               height="100%"/></a></li>
      <li><a href="https://play.google.com/store/music/album/Igit_Like_Angels_Do?id=Bqoukgdxudnkwwksc23bd7zsskm"
             class="play" target="_blank"><img src="img/play.png"
      alt="Igit sur Play" width="100%" height="100%"/></a></li>
    </ul>
  </div>
</div>

</body>
</html>
