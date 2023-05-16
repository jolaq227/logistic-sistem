<?php
session_start();
$noSidebar = '';
$pageTitle = 'Giriş Yap';
if (isset($_SESSION['kullanici_adi'])) {
  header('Location: anasayfa.php');
}
include 'init.php';

if (isset($_GET['lang'])) {
  if ($_GET['lang'] == 'turkce' || $_GET['lang'] == 'arapca') {
      setcookie("lang", $_GET['lang']);
      header("refresh:2;url=index.php");
      $mesaj = lang('2SaniyeBekleyin');
  }
}

if (isset($mesaj)) {
  ?>
      <div class="bildirim">
              <?php echo @$mesaj; ?>
      </div>
  <?php
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['giris'])) {  

    $kullanici_adi = $_POST['kul-adi'];
    $sifre         = $_POST['sifre'];
    $hash_sifre    = sha1($sifre);

    $stmt = $con->prepare("SELECT * FROM kullanicilar WHERE kullanici_adi = ? AND sifre = ? AND aktif != 0");
    $stmt->execute(array($kullanici_adi, $hash_sifre));
    $kullanici = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
      $stmt = $con->prepare("INSERT INTO 
                                    girisler(k_id, g_tarihi) 
                                    VALUES(:k_id, now())");
        $stmt->execute(array(
          'k_id'       => $kullanici['id'],
        ));
      $_SESSION['kullanici_adi'] = $kullanici_adi;
      $_SESSION['ID']            = $kullanici['id'];
      header('Location: anasayfa.php');
      exit();
    } elseif ($count === 0) {
      $hata = lang('kullaniciAdiYadaSifreHata');
    }
  } elseif (isset($_POST['sifre'])) {
    
    
    $kullanici_adi = $_POST['kul-adi'];
    $ad            = $_POST['ad'];
    $soyad         = $_POST['soyad'];
    $dep           = $_POST['departman'];

    $stmt = $con->prepare("SELECT * FROM kullanicilar WHERE kullanici_adi = ? AND ad = ? AND soyad = ? AND departman = ? AND aktif != 0");
    $stmt->execute(array($kullanici_adi, $ad, $soyad, $dep));
    $kullanici = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
      $stmt = $con->prepare("INSERT INTO 
                                    girisler(k_id, g_tarihi) 
                                    VALUES(:k_id, now())");
        $stmt->execute(array(
          'k_id'       => $kullanici['id'],
        ));
      $_SESSION['kullanici_adi'] = $kullanici['kullanici_adi'];
      $_SESSION['ID']            = $kullanici['id'];
      header('Location: anasayfa.php');
      exit();
    } elseif ($count === 0) {
      $hata = lang('kullaniciAdiYadaSifreHata');
    }

  }
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <link href="css/style.css" rel="stylesheet" />
  <title>Giriş Yap</title>
</head>

<body>
  <div class="giris">

  <div class="dil">
  <a <?php if (isset($_COOKIE['lang'])) { if ($_COOKIE['lang'] == 'turkce') echo 'style="color: red"'; } ?> class="a" href="index.php?lang=turkce">Türkçe</a> - 
								<a <?php if (isset($_COOKIE['lang'])) { if ($_COOKIE['lang'] == 'arapca') echo 'style="color: green"'; } ?> class="a" href="index.php?lang=arapca">العربية</a>
  </div>

<?php

if (isset($_GET['s'])) {
  if ($_GET['s'] === 'su') {
    
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?s=su'; ?>" method="POST">
      <div class="bas-giris">
        <h1><?php echo lang('SifreSifirla'); ?></h1>
        <p><?php echo lang('LojistikOtomasyonu'); ?></p>
      </div>
      <div>
        <label for="kul-adi"><?php echo lang('KullaniciAdi'); ?>:</label>
        <input id="kul-adi" name="kul-adi" type="text" autocomplete="off">
      </div>
      <div>
        <label for="ad"><?php echo lang('Ad'); ?>:</label>
        <input id="ad" name="ad" type="text" autocomplete="off">
      </div>
      <div>
        <label for="soyad"><?php echo lang('SoyAd'); ?>:</label>
        <input id="soyad" name="soyad" type="text" autocomplete="off">
      </div>
      <div>
        <label for="departman"><?php echo lang('Departman'); ?>:</label>
        <input id="departman" name="departman" type="text" autocomplete="off">
      </div>
      <div class="hata">
        <?php echo @$hata; ?>
      </div>
      <a href="index.php"><?php echo lang('GirisSayfasinaGit'); ?></a>
      <input class="sub" type="submit" name="sifre" value="<?php echo lang('SifreSifirla'); ?>">

    <?php

  } else {
    header('Location: index.php');
  }
} else {

?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="bas-giris">
        <h1><?php echo lang('GirisYap'); ?></h1>
        <p><?php echo lang('LojistikOtomasyonu'); ?></p>
      </div>
      <div>
        <label for="kul-adi"><?php echo lang('KullaniciAdi'); ?>:</label>
        <input id="kul-adi" name="kul-adi" type="text" autocomplete="off">
      </div>
      <div>
        <label for="sifre"><?php echo lang('Sifre'); ?>:</label>
        <input id="sifre" name="sifre" type="password" autocomplete="off">
      </div>
      <div class="hata">
        <?php echo @$hata; ?>
      </div>
      <a href="?s=su"><?php echo lang('SifremiUnuttum'); ?></a>
      <input class="sub" type="submit" name="giris" value="<?php echo lang('GirisYap'); ?>">
    

<?php } ?>

    </form>
  </div>

</body>

</html>