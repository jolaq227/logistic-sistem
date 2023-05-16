<?php
session_start();
$pageTitle = "Kullanıcılar";

if (isset($_SESSION['kullanici_adi'])) {
  include 'init.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['deg'])) {

      $k_id     = $_POST['id'];
      $adi      = $_POST['adi'];
      $soy      = $_POST['soy'];
      $k_adi    = $_POST['k-adi'];
      $sifre    = $_POST['sifre'];
      $sifre_2  = $_POST['sifre-2'];

      $fotoAdi  = $_FILES['foto']['name'];
      $tmpAdi   = $_FILES['foto']['tmp_name'];
      $fotoBoyutu = $_FILES['foto']['size'];
      $uzanti   = explode('.', $fotoAdi);
      $fotoUzantisi = strtolower(end($uzanti));

      $KullanilabilenUzantilar = array('jpg', 'png', 'jpeg');

      $hatalar = array();

      if (empty($fotoAdi)) {

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

      //////////////////////////////////////
          if (!isset($_POST['a'])) {
            $ap       = @$_POST['ap'];
            $isi      = @$_POST['isi'];

            if (empty($isi)) {
              $hatalar[] = lang('departmanBos');
            }
          } else {
            $kullanici = getItem('kullanicilar', 'id', $k_id);
            $ap       = $kullanici['aktif'];
            $isi      = $kullanici['departman'];
          }
      if (empty($k_adi) || strlen($k_adi) < 5) {
        $hatalar[] = lang('kAdiBosveya5tenfazlaYok');
      }
      if ($sifre !== $sifre_2) {
        $hatalar[] = lang('sifreEsitYok');
      }

      $stmt = $con->prepare("SELECT * FROM kullanicilar WHERE kullanici_adi != ? LIMIT 1");
      $stmt->execute(array($k_adi));

      if (!$stmt->rowCount()) {
        $hatalar[] = lang('buKDahaOnceKullanildi');
      }


      if (!empty($hatalar)) {
        foreach ($hatalar as $hata) {
          echo bildirim($hata);
        }
      } else {

        $k = getItem('kullanicilar', 'id', $k_id);
        if ($sifre == $k['sifre']) {
          $hashSifre = $sifre;
        } else {
          $hashSifre = sha1($sifre);
        }

        if (!empty($fotoAdi)) {
          $foto = rand(0, 10000000) . '_' . $fotoAdi;
          move_uploaded_file($tmpAdi, "fotograflar/kullanicilar/" . $foto);  
        } else {
          $kullanici = getItem('kullanicilar', 'id', $k_id);
          $foto = $kullanici['foto'];
        }

        $stmt = $con->prepare("UPDATE kullanicilar SET ad = ?, soyad = ?, departman = ?, kullanici_adi = ?, sifre = ?, foto = ?, aktif = ? WHERE id = ?");
        $stmt->execute(array($adi, $soy, $isi, $k_adi, $hashSifre, $foto, $ap, $k_id));

        bildirim($stmt->rowCount() . lang('kullaniciGuncellendi'));
      }

    } 
  }

  if (isset($_GET['i'])) {

      $kid = isset($_GET['i']) && is_numeric($_GET['i']) ? intval($_GET['i']) : 0;

      $count = checkItem('kullanicilar', 'id', $kid);

      if ($count > 0) {

      $kullanici = getItem('kullanicilar', 'id', $kid);
      $kullaniciS = getItem('kullanicilar', 'id', $_SESSION['ID']);

      if ($kullaniciS['aktif'] === 2) {
        $isAdmin = true;
      } else {
        $isAdmin = false;
      }

        ?>

            <div class="cont-alt">
              <form class="urun-deg-buyuk" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <div class="urun-deg">
                  <!-- div 1 basla -->
                  <div>
                    <div class="foto">
                      <img class="fotog" src="fotograflar/kullanicilar/<?php echo $kullanici['foto']; ?>" alt="">
                    </div>
                    <input type="file" name="foto">
                  </div>
                  <!-- div 1 Bitti -->
                  <!-- div 2 basla -->
                  <div class="div-2">
                      <label for="adi"><?php echo lang('ad'); ?>:</label>
                      <input value="<?php echo $kullanici['ad']; ?>" name="adi" id="adi" required>

                      <label for="soy"><?php echo lang('soyAd'); ?>:</label>
                      <input value="<?php echo $kullanici['soyad']; ?>" id="soy" name="soy" type="text" required>

                      <label for="isi"><?php echo lang('isi'); ?>:</label>
                      <input <?php echo $isAdmin ? '' : 'disabled'; ?> value="<?php echo $kullanici['departman']; ?>" name="<?php echo $isAdmin ? 'isi' : 'a'; ?>" id="isi" required>
                  </div>
                  <!-- div 2 bitti -->
                  <!-- div 3 basla -->
                  <div class="div-2">
                    <label for="k-adi"><?php echo lang('kAdi'); ?>:</label>
                      <input value="<?php echo $kullanici['kullanici_adi']; ?>" id="k-adi" name="k-adi" type="text" required>

                      <label for="sifre"><?php echo lang('Sifre'); ?>:</label>
                      <input value="<?php echo $kullanici['sifre']; ?>" id="sifre" name="sifre" type="password" required>

                      <label for="sifre-2"><?php echo lang('sifreTekrar'); ?>:</label>
                      <input value="<?php echo $kullanici['sifre']; ?>" id="sifre-2" name="sifre-2" type="password" required>

                      <label for="ap"><?php echo lang('aktifPasif'); ?>:</label>
                      <select <?php echo $isAdmin ? '' : 'disabled'; ?> name="<?php echo $isAdmin ? 'ap' : 'a'; ?>" id="ap">
                        <option <?php echo $kullanici['aktif'] === 1 ? 'selected' : ''; ?> value="1"><?php echo lang('aktif') ?></option>
                        <option <?php echo $kullanici['aktif'] === 0 ? 'selected' : ''; ?> value="0"><?php echo lang('pasif') ?></option>
                        <option <?php echo $kullanici['aktif'] === 2 ? 'selected' : ''; ?> value="2"><?php echo lang('yonetici') ?></option>
                      </select>

                      <label for="id"><?php echo lang('kNo'); ?>:</label>
                      <input value="<?php echo $kullanici['id']; ?>" id="id" name="id" disabled>
                      <input value="<?php echo $kullanici['id']; ?>" id="id" type="hidden" name="id">

                      <input value="1" id="id" type="hidden" name="<?php echo $isAdmin ? '' : 'a'; ?>">

                  </div>
                  <!-- div 3 bitti -->
                </div>
                <input class="urun-ekleme" name="deg" type="submit" value="<?php echo lang('degistir'); ?>">
              </form>
            </div>

        <?php
      } else {
        header('Location: anasayfa.php');
        exit();
      }

  }




  include 'sablonlar/footer.php';
} else {
  header('Location: logout.php');
  exit();
}