<?php
session_start();
$pageTitle = "Ürünler";

if (isset($_SESSION['kullanici_adi'])) {
  include 'init.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ekle'])) {

      $u_adi      = $_POST['u-adi'];
      $u_kat      = $_POST['u-kat'];
      $tedarikci  = $_POST['tedarikci'];
      $u_adresi   = $_POST['u-adresi'];
      $u_adet     = $_POST['u-adet'];
      $u_alim     = $_POST['u-alim'];
      $u_satim    = $_POST['u-satim'];
      $u_raf      = $_POST['u-raf'];

      $fotoAdi = $_FILES['foto']['name'];
      $tmpAdi = $_FILES['foto']['tmp_name'];
      $fotoBoyutu = $_FILES['foto']['size'];
      $uzanti = explode('.', $fotoAdi);
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
      if (empty($u_adi) || strlen($u_adi) < 5) {
        $hatalar[] = lang('urunAdiBosveya5tenfazlaYok');
      }
      if ($u_kat == 0) {
        $hatalar[] = lang('katYok');
      }
      if (empty($tedarikci)) {
        $hatalar[] = lang('tedarikciBosYok');
      }
      if (empty($u_adresi)) {
        $hatalar[] = lang('uAdresiBosYok');
      }
      if (empty($u_adet) || $u_adet < 1 || !is_numeric($u_adet)) {
        $hatalar[] = lang('uAdetBos0HarfYok');
      }
      if (empty($u_alim) || $u_alim < 1 || !is_numeric($u_alim)) {
        $hatalar[] = lang('uAlimBos0HarfYok');
      }
      if (empty($u_satim) || $u_satim < 1 || !is_numeric($u_satim) || $u_alim > $u_satim) {
        $hatalar[] = lang('uSatimBos0HarfAlimAzYok');
      }
      if (empty($u_raf)) {
        $hatalar[] = lang('rafNoYok');
      }

      if (!empty($hatalar)) {
        foreach ($hatalar as $hata) {
          echo bildirim($hata);
        }
      } else {

        $foto = rand(0, 10000000) . '_' . $fotoAdi;
        move_uploaded_file($tmpAdi, "fotograflar/urunler/" . $foto);  

        $stmt = $con->prepare("INSERT INTO 
                                    urunler(urun_adi, adet, kat, ekleyen, alim_fiyat, satim_fiyat, tedarikci, urun_adresi, raf_no, foto, tarihi) 
                                    VALUES(:adi, :adet, :kat, :ekleyen, :alim, :satim, :tedarikci, :adres, :raf, :foto , now())");
        $stmt->execute(array(
          'adi'       => $u_adi,
          'adet'      => $u_adet,
          'kat'       => $u_kat,
          'ekleyen'   => $_SESSION['ID'],
          'alim'      => $u_alim,
          'satim'     => $u_satim,
          'tedarikci' => $tedarikci,
          'adres'     => $u_adresi,
          'raf'       => $u_raf,
          'foto'      => $foto
        ));
        echo bildirim($stmt->rowCount(). lang('UrunEklendi'));

      }

      $urunler = getAllFrom('urunler');

    } elseif (isset($_POST['ara'])) {
      
        $urun = $_POST['urun-adi-ara'];

        $urunler = arama('urunler', 'id', 'urun_adi', $urun);

        

    } elseif (isset($_POST['deg'])) {

      $u_id       = $_POST['u-no'];
      $u_adi      = $_POST['u-adi'];
      $u_kat      = $_POST['u-kat'];
      $tedarikci  = $_POST['tedarikci'];
      $u_adresi   = $_POST['u-adresi'];
      $u_adet     = $_POST['u-adet'];
      $u_alim     = $_POST['u-alim'];
      $u_satim    = $_POST['u-satim'];
      $u_raf      = $_POST['u-raf'];

      $fotoAdi = $_FILES['foto']['name'];
      $tmpAdi = $_FILES['foto']['tmp_name'];
      $fotoBoyutu = $_FILES['foto']['size'];
      $uzanti = explode('.', $fotoAdi);
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
      if (empty($u_adi) || strlen($u_adi) < 5) {
        $hatalar[] = lang('urunAdiBosveya5tenfazlaYok');
      }
      if ($u_kat == 0) {
        $hatalar[] = lang('katYok');
      }
      if (empty($tedarikci)) {
        $hatalar[] = lang('tedarikciBosYok');
      }
      if (empty($u_adresi)) {
        $hatalar[] = lang('uAdresiBosYok');
      }
      if (empty($u_adet) || $u_adet < 1 || !is_numeric($u_adet)) {
        $hatalar[] = lang('uAdetBos0HarfYok');
      }
      if (empty($u_alim) || $u_alim < 1 || !is_numeric($u_alim)) {
        $hatalar[] = lang('uAlimBos0HarfYok');
      }
      if (empty($u_satim) || $u_satim < 1 || !is_numeric($u_satim) || $u_alim > $u_satim) {
        $hatalar[] = lang('uSatimBos0HarfAlimAzYok');
      }
      if (empty($u_raf)) {
        $hatalar[] = lang('rafNoYok');
      }

      if (!empty($hatalar)) {
        foreach ($hatalar as $hata) {
          echo bildirim($hata);
        }
      } else {

        if (!empty($fotoAdi)) {
          $foto = rand(0, 10000000) . '_' . $fotoAdi;
          move_uploaded_file($tmpAdi, "fotograflar/urunler/" . $foto);  
        } else {
          $urun = getItem('urunler', 'id', $u_id);
          $foto = $urun['foto'];
        }

        $stmt = $con->prepare("UPDATE urunler SET urun_adi = ?, adet = ?, kat = ?, alim_fiyat = ?, satim_fiyat = ?, tedarikci = ?, urun_adresi = ?, raf_no = ?, foto = ? WHERE id = ?");
        $stmt->execute(array($u_adi, $u_adet, $u_kat, $u_alim, $u_satim, $tedarikci, $u_adresi, $u_raf, $foto, $u_id));

        bildirim($stmt->rowCount() . lang('urunGuncenlendi'));
      }

      $urunler = getAllFrom('urunler');

    } else {
      $urunler = getAllFrom('urunler');
    }

  } else {
    $urunler = getAllFrom('urunler');
  } // post end
    
  foreach ($urunler as $key => $urun) {

    $kat_name = getItem('kategoriler', 'id', $urun['kat']);

    $urunler[$key]['kat_adi'] = $kat_name['kat_adi'];

  }

  if (isset($_GET['d'])) {

    if ($_GET['d'] == 'ekle') {

      ?>

        <div class="cont-alt">
          <form class="urun-deg-buyuk" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div class="urun-deg">
              <!-- div 1 basla -->
              <div>
                <div class="foto">
                  <img class="fotog" src="iconlar/box.png" alt="">
                </div>
                <input type="file" name="foto" required>
              </div>
              <!-- div 1 Bitti -->
              <!-- div 2 basla -->
              <div class="div-2">
                  <label for="u-adi"><?php echo lang('urunAdi'); ?>:</label>
                  <textarea name="u-adi" id="u-adi" cols="30" rows="10" required></textarea>

                  <label for="u-kat"><?php echo lang('kategori'); ?>:</label>
                  <select name="u-kat" id="u-kat" required>
                    <option value="0">...</option>
                    <?php
                      $katlar = getAllFrom('kategoriler');
                      foreach ($katlar as $kat) {
                        echo '<option value="' . $kat['id'] . '">' . $kat['kat_adi'] . '</option>';
                      }
                    ?>
                  </select>

                  <label for="tedarikci"><?php echo lang('tedarikci'); ?>:</label>
                  <input id="tedarikci" name="tedarikci" type="text" required>

                  <label for="u-adresi"><?php echo lang('urunAdresi'); ?>:</label>
                  <textarea name="u-adresi" id="u-adresi" cols="30" rows="10" required></textarea>
              </div>
              <!-- div 2 bitti -->
              <!-- div 3 basla -->
              <div class="div-2">
                <label for="u-adet"><?php echo lang('adet'); ?>:</label>
                  <input id="u-adet" name="u-adet" type="number" required>

                  <label for="u-alim"><?php echo lang('alimFiyati'); ?>:</label>
                  <input id="u-alim" name="u-alim" type="number" required>

                  <label for="u-satim"><?php echo lang('satimFiyati'); ?>:</label>
                  <input id="u-satim" name="u-satim" type="number" required>

                  <label for="u-raf"><?php echo lang('rafNo'); ?>:</label>
                  <input id="u-raf" name="u-raf" type="text" required>

              </div>
              <!-- div 3 bitti -->
            </div>
            <input class="urun-ekleme" name="ekle" type="submit" value="<?php echo lang('Ekle'); ?>">
          </form>
        </div>
        



      <?php


    } elseif ($_GET['d'] == 'sil') {

      $uid = isset($_GET['k']) && is_numeric($_GET['k']) ? intval($_GET['k']) : 0;

      $count = checkItem('urunler', 'id', $uid);

      if ($count > 0) {
        bildirim(delete('urunler', 'id', $uid) . lang('urunSilindi'));
      } else {
        header('Location: urunler.php');
        exit();
      }

    } elseif ($_GET['d'] == 'deg') {

      $uid = isset($_GET['k']) && is_numeric($_GET['k']) ? intval($_GET['k']) : 0;

      $count = checkItem('urunler', 'id', $uid);

      if ($count > 0) {

      $urun = getItem('urunler', 'id', $uid);

        ?>

          <div class="cont-alt">
            <form class="urun-deg-buyuk" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
              <div class="urun-deg">
                <!-- div 1 basla -->
                <div>
                  <div class="foto">
                    <img class="fotog" src="fotograflar/urunler/<?php echo $urun['foto']; ?>" alt="">
                  </div>
                  <input type="file" name="foto">
                </div>
                <!-- div 1 Bitti -->
                <!-- div 2 basla -->
                <div class="div-2">
                    <label for="u-adi"><?php echo lang('urunAdi'); ?>:</label>
                    <textarea name="u-adi" id="u-adi" cols="30" rows="10" required><?php echo $urun['urun_adi']; ?></textarea>

                    <label for="u-kat"><?php echo lang('kategori'); ?>:</label>
                    <select name="u-kat" id="u-kat" required>
                      <option value="0">...</option>
                      <?php
                        $katlar = getAllFrom('kategoriler');
                        foreach ($katlar as $kat) {
                          $select = $urun['kat'] == $kat['id'] ? 'selected' : '';
                          echo '<option ' . $select . ' value="' . $kat['id'] . '">' . $kat['kat_adi'] . '</option>';
                        }
                      ?>
                    </select>

                    <label for="tedarikci"><?php echo lang('tedarikci'); ?>:</label>
                    <input id="tedarikci" name="tedarikci" type="text" value="<?php echo $urun['tedarikci']; ?>" required>

                    <label for="u-adresi"><?php echo lang('urunAdresi'); ?>:</label>
                    <textarea name="u-adresi" id="u-adresi" cols="30" rows="10" required><?php echo $urun['urun_adresi']; ?></textarea>
                </div>
                <!-- div 2 bitti -->
                <!-- div 3 basla -->
                <div class="div-2">
                  <label for="u-adet"><?php echo lang('adet'); ?>:</label>
                    <input id="u-adet" name="u-adet" type="number" value="<?php echo $urun['adet']; ?>" required>

                    <label for="u-alim"><?php echo lang('alimFiyati'); ?>:</label>
                    <input id="u-alim" name="u-alim" type="number" value="<?php echo $urun['alim_fiyat']; ?>" required>

                    <label for="u-satim"><?php echo lang('satimFiyati'); ?>:</label>
                    <input id="u-satim" name="u-satim" type="number" value="<?php echo $urun['satim_fiyat']; ?>" required>

                    <label for="u-raf"><?php echo lang('rafNo'); ?>:</label>
                    <input id="u-raf" name="u-raf" type="text" value="<?php echo $urun['raf_no']; ?>" required>
                    
                    <label for="u-no"><?php echo lang('urunNo'); ?>:</label>
                    <input disabled id="u-no" type="text" value="<?php echo $urun['id']; ?>">
                    <input id="u-no" name="u-no" type="hidden" value="<?php echo $urun['id']; ?>">
                </div>
                <!-- div 3 bitti -->
              </div>
              <input class="urun-ekleme" name="deg" type="submit" value="<?php echo lang('degistir'); ?>">
            </form>
          </div>

        <?php
      } else {
        header('Location: urunler.php');
        exit();
      }
    } elseif ($_GET['d'] == 'gos') {
      
      $uid = isset($_GET['k']) && is_numeric($_GET['k']) ? intval($_GET['k']) : 0;

      $count = checkItem('urunler', 'id', $uid);

      if ($count > 0) {

      $urun = getItem('urunler', 'id', $uid);
      $kullanici = getItem('kullanicilar', 'id', $urun['ekleyen']);


        ?>

          <div class="cont-alt">
            <div class="urun-deg-buyuk">
              <div class="urun-deg">
                <!-- div 1 basla -->
                <div>
                  <div class="foto">
                    <img class="fotog" src="fotograflar/urunler/<?php echo $urun['foto']; ?>" alt="">
                  </div>
                </div>
                <!-- div 1 Bitti -->
                <!-- div 2 basla -->
                <div class="div-2">
                    <label for="u-adi"><?php echo lang('urunAdi'); ?>:</label>
                    <textarea name="u-adi" id="u-adi" cols="30" rows="10" disabled><?php echo $urun['urun_adi']; ?></textarea>

                    <label for="u-kat"><?php echo lang('kategori'); ?>:</label>
                    <select name="u-kat" id="u-kat" disabled>
                      <option value="0">...</option>
                      <?php
                        $katlar = getAllFrom('kategoriler');
                        foreach ($katlar as $kat) {
                          $select = $urun['kat'] == $kat['id'] ? 'selected' : '';
                          echo '<option ' . $select . ' value="' . $kat['id'] . '">' . $kat['kat_adi'] . '</option>';
                        }
                      ?>
                    </select>

                    <label for="tedarikci"><?php echo lang('tedarikci'); ?>:</label>
                    <input id="tedarikci" name="tedarikci" type="text" value="<?php echo $urun['tedarikci']; ?>" disabled>

                    <label for="u-adresi"><?php echo lang('urunAdresi'); ?>:</label>
                    <textarea name="u-adresi" id="u-adresi" cols="30" rows="10" disabled><?php echo $urun['urun_adresi']; ?></textarea>
                </div>
                <!-- div 2 bitti -->
                <!-- div 3 basla -->
                <div class="div-2">
                  <label for="u-adet"><?php echo lang('adet'); ?>:</label>
                    <input id="u-adet" name="u-adet" type="number" value="<?php echo $urun['adet']; ?>" disabled>

                    <label for="u-alim"><?php echo lang('alimFiyati'); ?>:</label>
                    <input id="u-alim" name="u-alim" type="number" value="<?php echo $urun['alim_fiyat']; ?>" disabled>

                    <label for="u-satim"><?php echo lang('satimFiyati'); ?>:</label>
                    <input id="u-satim" name="u-satim" type="number" value="<?php echo $urun['satim_fiyat']; ?>" disabled>

                    <label for="u-raf"><?php echo lang('rafNo'); ?>:</label>
                    <input id="u-raf" name="u-raf" type="text" value="<?php echo $urun['raf_no']; ?>" disabled>
                    
                    <label for="u-no"><?php echo lang('urunNo'); ?>:</label>
                    <input disabled id="u-no" type="text" value="<?php echo $urun['id']; ?>">
                    <input id="u-no" name="u-no" type="hidden" value="<?php echo $urun['id']; ?>">

                    <label for="u-tarihi"><?php echo lang('eklemeTarihi'); ?>:</label>
                    <input id="u-tarihi" type="text" value="<?php echo $urun['tarihi']; ?>" disabled>

                    <label for="u-yapan"><?php echo lang('ekleyen'); ?>:</label>
                    <input id="u-yapan" type="text" value="<?php echo $kullanici['kullanici_adi']; ?>" disabled>
                </div>
                <!-- div 3 bitti -->
              </div>
              <a href="urunler.php?d=deg&k=<?php echo $_GET['k']; ?>" class="a urun-ekleme"><?php echo lang('degistir'); ?></a>
            </div>
          </div>

        <?php
      } else {
        header('Location: urunler.php');
        exit();
      }
    } else {
      header('Location: urunler.php');
      exit();
    }
  } else {


      ?>

      <div class="cont">
        <div class="cont-bas-2">
          <div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <input name="urun-adi-ara" type="text" placeholder="<?php echo lang('urunAra') ?>">
              <input name="ara" type="submit" value="<?php echo lang('Ara') ?>">
            </form>
          </div>
          <div>
              <a href="?d=ekle" class="a ekle"><?php echo lang('Ekle') ?></a>
          </div>
        </div>
        <div class="cont-alt">
          <?php 
              if (empty($urunler)) {
                echo '<div style="font-weight: bold">' . lang('sonucBulunmadi') . '</div>';
              } else { ?>
                <table class="cont cont-2">
                  <tr>
                    <th><?php echo lang('urunNo') ?></th>
                    <th><?php echo lang('urunAdi') ?></th>
                    <th><?php echo lang('depodaAdet') ?></th>
                    <th><?php echo lang('kategori') ?></th>
                    <th><?php echo lang('depoyaGirmeTarihi') ?></th>
                    <th><?php echo lang('Kontrol') ?></th>
                  </tr>

                  <?php
                    foreach($urunler as $urun) {
                      $adet = $urun['adet'] < 1 ? '<span style="color: red; font-weight: bold">' . lang('bitti') . '</span>' : $urun['adet'];
                      echo '<tr>
                              <td>' .  str_pad($urun['id'], 7, 0, STR_PAD_LEFT) . '</td>
                              <td>' .  $urun['urun_adi'] . '</td>
                              <td>' .  $adet . '</td>
                              <td>' .  $urun['kat_adi'] . '</td>
                              <td>' .  $urun['tarihi'] . '</td>
                              <td>
                                <a class="a confirm" href="?d=sil&k=' . $urun['id'] .'">
                                  <img class="kontrol-2" src="iconlar/trash.png" alt="">
                                </a>
                                <a class="a" href="?d=deg&k=' . $urun['id'] .'">
                                  <img class="kontrol-2" src="iconlar/pencil.png" alt="">
                                </a>
                                <a class="a" href="?d=gos&k=' . $urun['id'] .'">
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