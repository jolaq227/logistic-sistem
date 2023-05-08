<?php
session_start();
$pageTitle = "Kategoriler";

if (isset($_SESSION['kullanici_adi'])) {
  include 'init.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ekle'])) {
      
      $kat_adi  = $_POST['kat-adi-ekle'];

      $stmt = $con->prepare("INSERT INTO kategoriler(kat_adi, ekleme_tarihi) VALUES(:name, now())");
      $stmt->execute(array('name' => $kat_adi));
      echo bildirim($stmt->rowCount(). lang('kategoriEklendi'));

      $kategoriler = getAllFrom('kategoriler');

    } elseif (isset($_POST['ara'])) {
      
        $kat = $_POST['kat-adi-ara'];

        $kategoriler = arama('kategoriler', 'id', 'kat_adi', $kat);

    } elseif (isset($_POST['deg'])) {

    $katid = $_POST['katid'];
    $katadi = $_POST['kat-adi-deg'];

    $stmt = $con->prepare("UPDATE kategoriler SET kat_adi = ? WHERE id = ?");
    $stmt->execute(array($katadi, $katid));

    bildirim($stmt->rowCount() . lang('katGuncellendi'));

    $kategoriler = getAllFrom('kategoriler');

    } else {
      $kategoriler = getAllFrom('kategoriler');
    }

  } else {
    $kategoriler = getAllFrom('kategoriler');
  }






  
  if (isset($_GET['d'])) {

    if ($_GET['d'] == 'sil') {

      $katid = isset($_GET['k']) && is_numeric($_GET['k']) ? intval($_GET['k']) : 0;

      $count = checkItem('kategoriler', 'id', $katid);

      if ($count > 0) {
        bildirim(delete('kategoriler', 'id', $katid) . lang('katSilindi'));
      } else {
        header('Location: kategoriler.php');
        exit();
      }

    } elseif ($_GET['d'] == 'deg') {

      $katid = isset($_GET['k']) && is_numeric($_GET['k']) ? intval($_GET['k']) : 0;

      $count = checkItem('kategoriler', 'id', $katid);

      if ($count > 0) {

        $kat = getItem('kategoriler', 'id', $katid);

        ?>

        <div class="cont-all">
          <div>
            <form class="degistir-kat" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <input disabled type="number" value="<?php echo $kat['id']; ?>">
              <input type="hidden" name="katid" value="<?php echo $kat['id']; ?>">
              <input name="kat-adi-deg" type="text" value="<?php echo $kat['kat_adi']; ?>">
              <input name="deg" type="submit" value="<?php echo lang('degistir') ?>">
            </form>
          </div>

        </div>

        <?php
      } else {
        header('Location: kategoriler.php');
        exit();
      }
    } else {
      header('Location: kategoriler.php');
      exit();
    }
  } else {


      ?>

      <div class="cont">
        <div class="cont-bas">
          <div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <input name="kat-adi-ekle" type="text" placeholder="<?php echo lang('KategoriEkle') ?>">
              <input name="ekle" type="submit" value="<?php echo lang('Ekle') ?>">
            </form>
          </div>
          <div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <input name="kat-adi-ara" type="text" placeholder="<?php echo lang('KategoriAra') ?>">
              <input name="ara" type="submit" value="<?php echo lang('Ara') ?>">
            </form>
          </div>
        </div>
        <div class="cont-alt">
          <table class="cont">
            <tr>
              <th><?php echo lang('KategoriNo') ?></th>
              <th><?php echo lang('KategoriAdi') ?></th>
              <th><?php echo lang('Kontrol') ?></th>
            </tr>

            <?php

              foreach($kategoriler as $kat) {
                echo '<tr>
                        <td>' .  $kat['id'] . '</td>
                        <td>' .  $kat['kat_adi'] . '</td>
                        <td>
                          <a class="a confirm" href="?d=sil&k=' . $kat['id'] .'">
                            <img class="kontrol" src="iconlar/trash.png" alt="">
                          </a>
                          <a class="a" href="?d=deg&k=' . $kat['id'] .'">
                            <img class="kontrol" src="iconlar/pencil.png" alt="">
                          </a>
                        </td>
                      </tr>';
              }

            ?>
          </table>
        </div>
      </div>



      <?php
  }
  



    include 'sablonlar/footer.php';
} else {
  header('Location: logout.php');
  exit();
}