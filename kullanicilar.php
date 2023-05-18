<?php
session_start();
$pageTitle = "Kullanıcılar";

if (isset($_SESSION['kullanici_adi'])) {
  include 'init.php';

  if (getItem('kullanicilar', 'id', $_SESSION['ID'])['aktif'] !== 2) {
    header("Location: kdeg.php?i={$_SESSION['ID']}");
    exit();
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ekle'])) {

      $adi      = $_POST['adi'];
      $soy      = $_POST['soy'];
      $isi      = $_POST['isi'];
      $k_adi    = $_POST['k-adi'];
      $sifre    = $_POST['sifre'];
      $sifre_2  = $_POST['sifre-2'];
      $ap       = $_POST['ap'];

      $fotoAdi  = $_FILES['foto']['name'];
      $tmpAdi   = $_FILES['foto']['tmp_name'];
      $fotoBoyutu = $_FILES['foto']['size'];
      $uzanti   = explode('.', $fotoAdi);
      $fotoUzantisi = strtolower(end($uzanti));

      $KullanilabilenUzantilar = array('jpg', 'png', 'jpeg');

      $hatalar = array();

      if (empty($fotoAdi)) {
        $hatalar[] = lang('fotoYuklenmedi');
      } else {
        if (!in_array($fotoUzantisi, $KullanilabilenUzantilar)) {
          $hatalar[] = lang('fotoUzantiYok');
        } else {
          if ($fotoBoyutu > 10 * 1024 * 1024) {
            $hatalar[] = lang('fotoBoyut10mbBuyukYok');
          }
        }
      }
      if (empty($adi) || strlen($adi) < 4) {
        $hatalar[] = lang('AdiBosveya4tenfazlaYok');
      }
      if (empty($soy) || strlen($soy) < 4) {
        $hatalar[] = lang('sAdiBosveya4tenfazlaYok');
      }
      if (empty($isi)) {
        $hatalar[] = lang('departmanBos');
      }
      if (empty($k_adi) || strlen($k_adi) < 5) {
        $hatalar[] = lang('kAdiBosveya5tenfazlaYok');
      }
      if ($sifre !== $sifre_2) {
        $hatalar[] = lang('sifreEsitYok');
      }

      if (checkItem('kullanicilar', 'kullanici_adi', $k_adi)) {
        $hatalar[] = lang('buKDahaOnceKullanildi');
      }


      if (!empty($hatalar)) {
        foreach ($hatalar as $hata) {
          echo bildirim($hata);
        }
      } else {

        $foto = rand(0, 10000000) . '_' . $fotoAdi;
        move_uploaded_file($tmpAdi, "fotograflar/kullanicilar/" . $foto);  

        $hashSifre = sha1($sifre);

        $stmt = $con->prepare("INSERT INTO 
                                    kullanicilar(ad, soyad, departman, sifre, aktif, kullanici_adi, foto) 
                                    VALUES(:adi, :soyadi, :isi, :sifre, :aktif, :k_adi, :foto)");
        $stmt->execute(array(
          'adi'       => $adi,
          'soyadi'    => $soy,
          'isi'       => $isi,
          'sifre'     => $hashSifre,
          'aktif'     => $ap,
          'k_adi'     => $k_adi,
          'foto'      => $foto
        ));
        echo bildirim($stmt->rowCount(). lang('kullaniciEklendi'));

      }

      $kullanicilar = getAllFrom('kullanicilar');

    } elseif (isset($_POST['ara'])) {
      
        $k = $_POST['k-ara'];

        $kullanicilar = arama('kullanicilar', 'id', 'kullanici_adi', $k);

        

    } else {
      $urunler = getAllFrom('urunler');
    }

  } else {
    $kullanicilar = getAllFrom('kullanicilar');
  } // post end

  if (isset($_GET['d'])) {

    if ($_GET['d'] == 'ekle') {

      ?>

        <div class="cont-alt">
          <form class="urun-deg-buyuk" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div class="urun-deg">
              <!-- div 1 basla -->
              <div>
                <div class="foto">
                  <img class="fotog" src="iconlar/user.png" alt="">
                </div>
                <input type="file" name="foto" required>
              </div>
              <!-- div 1 Bitti -->
              <!-- div 2 basla -->
              <div class="div-2">
                  <label for="adi"><?php echo lang('ad'); ?>:</label>
                  <input name="adi" id="adi" required>

                  <label for="soy"><?php echo lang('soyAd'); ?>:</label>
                  <input id="soy" name="soy" type="text" required>

                  <label for="isi"><?php echo lang('isi'); ?>:</label>
                  <input name="isi" id="isi" required>
              </div>
              <!-- div 2 bitti -->
              <!-- div 3 basla -->
              <div class="div-2">
                <label for="k-adi"><?php echo lang('kAdi'); ?>:</label>
                  <input id="k-adi" name="k-adi" type="text" required>

                  <label for="sifre"><?php echo lang('Sifre'); ?>:</label>
                  <input id="sifre" name="sifre" type="password" required>

                  <label for="sifre-2"><?php echo lang('sifreTekrar'); ?>:</label>
                  <input id="sifre-2" name="sifre-2" type="password" required>

                  <label for="ap"><?php echo lang('aktifPasif'); ?>:</label>
                  <select name="ap" id="ap">
                    <option value="1"><?php echo lang('aktif') ?></option>
                    <option value="0"><?php echo lang('pasif') ?></option>
                    <option value="2"><?php echo lang('yonetici') ?></option>
                  </select>

              </div>
              <!-- div 3 bitti -->
            </div>
            <input class="urun-ekleme" name="ekle" type="submit" value="<?php echo lang('Ekle'); ?>">
          </form>
        </div>
        



      <?php


    } elseif ($_GET['d'] == 'sil') {

      $kid = isset($_GET['i']) && is_numeric($_GET['i']) ? intval($_GET['i']) : 0;

      $count = checkItem('kullanicilar', 'id', $kid);

      if ($count > 0) {
        bildirim(delete('kullanicilar', 'id', $kid) . lang('kullaniciSilindi'));
      } else {
        header('Location: kullanicilar.php');
        exit();
      }

    } elseif ($_GET['d'] == 'gos') {
      
      $kid = isset($_GET['i']) && is_numeric($_GET['i']) ? intval($_GET['i']) : 0;

      $count = checkItem('kullanicilar', 'id', $kid);

      if ($count > 0) {

      $kullanici = getItem('kullanicilar', 'id', $kid);

        ?>

            <div class="cont-alt">
              <div class="urun-deg-buyuk">
                <div class="urun-deg">
                  <!-- div 1 basla -->
                  <div>
                    <div class="foto">
                      <img class="fotog" src="fotograflar/kullanicilar/<?php echo $kullanici['foto']; ?>" alt="">
                    </div>
                  </div>
                  <!-- div 1 Bitti -->
                  <!-- div 2 basla -->
                  <div class="div-2">
                      <label for="adi"><?php echo lang('ad'); ?>:</label>
                      <input value="<?php echo $kullanici['ad']; ?>" name="adi" id="adi" disabled>

                      <label for="soy"><?php echo lang('soyAd'); ?>:</label>
                      <input value="<?php echo $kullanici['soyad']; ?>" id="soy" name="soy" type="text" disabled>

                      <label for="isi"><?php echo lang('isi'); ?>:</label>
                      <input value="<?php echo $kullanici['departman']; ?>" name="isi" id="isi" disabled>
                  </div>
                  <!-- div 2 bitti -->
                  <!-- div 3 basla -->
                  <div class="div-2">
                    <label for="k-adi"><?php echo lang('kAdi'); ?>:</label>
                      <input value="<?php echo $kullanici['kullanici_adi']; ?>" id="k-adi" name="k-adi" type="text" disabled>

                      <label for="sifre"><?php echo lang('Sifre'); ?>:</label>
                      <input value="<?php echo $kullanici['sifre']; ?>" id="sifre" name="sifre" type="password" disabled>

                      <label for="sifre-2"><?php echo lang('sifreTekrar'); ?>:</label>
                      <input value="<?php echo $kullanici['sifre']; ?>" id="sifre-2" name="sifre-2" type="password" disabled>

                      <label for="ap"><?php echo lang('aktifPasif'); ?>:</label>
                      <select name="ap" id="ap" disabled>
                        <option <?php echo $kullanici['aktif'] >= 1 ? 'selected' : ''; ?> value="1"><?php echo lang('aktif') ?></option>
                        <option <?php echo $kullanici['aktif'] === 0 ? 'selected' : ''; ?> value="0"><?php echo lang('pasif') ?></option>
                      </select>

                      <label for="id"><?php echo lang('kNo'); ?>:</label>
                      <input value="<?php echo $kullanici['id']; ?>" id="id" name="id" disabled>
                      <input value="<?php echo $kullanici['id']; ?>" id="id" type="hidden" name="id">

                  </div>
                  <!-- div 3 bitti -->
                </div>
              </div>
            </div>

        <?php
      } else {
        header('Location: kullanicilar.php');
        exit();
      }
    } else {
      header('Location: kullanicilar.php');
      exit();
    }
  } else {


      ?>

      <div class="cont">
        <div class="cont-bas-2">
          <div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <input name="k-ara" type="text" placeholder="<?php echo lang('kullaniciAra') ?>">
              <input name="ara" type="submit" value="<?php echo lang('Ara') ?>">
            </form>
          </div>
          <div>
              <a href="?d=ekle" class="a ekle"><?php echo lang('Ekle') ?></a>
          </div>
        </div>
        <div class="cont-alt">
        <h4><center><?php echo lang('Kullanicilar'); ?></center></h4>
          <?php 
              if (empty($kullanicilar)) {
                echo '<div style="font-weight: bold">' . lang('sonucBulunmadi') . '</div>';
              } else { ?>
                <table class="cont cont-2">
                  <tr>
                    <th><?php echo lang('kNo') ?></th>
                    <th><?php echo lang('kAdi') ?></th>
                    <th><?php echo lang('kIsi') ?></th>
                    <th><?php echo lang('aktifPasif') ?></th>
                    <th><?php echo lang('sonGirisTarihi') ?></th>
                    <th><?php echo lang('Kontrol') ?></th>
                  </tr>

                  <?php
                    foreach($kullanicilar as $kullanici) {
                      $ap = $kullanici['aktif'] == 0 ? '<span style="color: red; font-weight: bold">' . lang('pasif') . '</span>' : '<span style="color: green; font-weight: bold">' . lang('aktif') . '</span>';
                      $stmt = $con->prepare("SELECT * FROM girisler WHERE k_id = ? ORDER BY id DESC LIMIT 1");
                      $stmt->execute(array($kullanici['id']));
                      $giris = $stmt->fetch();
                      echo '<tr>
                              <td>' .  str_pad($kullanici['id'], 7, 0, STR_PAD_LEFT) . '</td>
                              <td>' .  $kullanici['kullanici_adi'] . '</td>
                              <td>' .  $kullanici['departman'] . '</td>
                              <td>' .  $ap . '</td>
                              <td>' .  $giris['g_tarihi'] . '</td>
                              <td>
                                <a class="a confirm" href="?d=sil&i=' . $kullanici['id'] .'">
                                  <img class="kontrol-2" src="iconlar/trash.png" alt="">
                                </a>
                                <a class="a" href="kdeg.php?i=' . $kullanici['id'] .'">
                                  <img class="kontrol-2" src="iconlar/pencil.png" alt="">
                                </a>
                                <a class="a" href="?d=gos&i=' . $kullanici['id'] .'">
                                  <img class="kontrol-3" src="iconlar/eye.png" alt="">
                                </a>
                              </td>
                            </tr>';
                    }
                  ?>
                </table>
          <?php } ?>
        </div>
      </div>



      <?php
  }
  



    include 'sablonlar/footer.php';
} else {
  header('Location: logout.php');
  exit();
}