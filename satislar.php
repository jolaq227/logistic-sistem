<?php
session_start();
$pageTitle = "Satışlar";

if (isset($_SESSION['kullanici_adi'])) {
  include 'init.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['satis-yap'])) {

      $u_id      = $_POST['u-no'];
      $s_adet    = $_POST['s-adet'];
      $s_fiyat   = $_POST['s-fiyat'];
      $alici     = $_POST['alici'];

      $urun = getItem('urunler', 'id', $u_id);

      $hatalar = array();
      
      if (empty($s_adet) || $s_adet < 1 || $s_adet > $urun['adet'] || !is_numeric($s_adet)) {
        $hatalar[] = $urun['adet'] . lang('fazlaSatilamaz');
      }
      if (empty($s_fiyat) || $s_fiyat < $urun['alim_fiyat'] || !is_numeric($s_fiyat)) {
        bildirim($urun['alim_fiyat'] . lang('fiyattanDusukSatilamaz'));
      }
      if (empty($s_fiyat)) {
        $hatalar[] = lang('aliciBos');
      }

      if (!empty($hatalar)) {
        foreach ($hatalar as $hata) {
          echo bildirim($hata);
        }
      } else {

        $stmt = $con->prepare("INSERT INTO 
                                    satislar(u_id, satisi_yapan, satilan_adet, birine_fiyat, toplam_tl, alici, tarihi) 
                                    VALUES(:uid, :s_yapan, :s_adet, :b_fiyat, :toplam, :alici, now())");
        $stmt->execute(array(
          'uid'       => $u_id,
          's_yapan'   => $_SESSION['ID'],
          's_adet'    => $s_adet,
          'b_fiyat'   => $s_fiyat,
          'toplam'    => $s_adet * $s_fiyat,
          'alici'     => $alici,
        ));
        echo bildirim($stmt->rowCount(). lang('SatisYapildi'));

        $stmt = $con->prepare("UPDATE urunler SET adet = ? WHERE id = ?");
        $stmt->execute(array($urun['adet'] - $s_adet, $u_id));

        bildirim($stmt->rowCount() . lang('urunGuncenlendi'));

      }

      if (getItem('kullanicilar', 'id', $_SESSION['ID'])['aktif'] == 2) {
      $satislar = getAllFrom("satislar ORDER BY id DESC");
      } elseif (getItem('kullanicilar', 'id', $_SESSION['ID'])['aktif'] == 1) {
        $satislar = getAllFrom("satislar WHERE satisi_yapan = {$_SESSION['ID']} ORDER BY id DESC");
      }

    } elseif (isset($_POST['ara'])) {
      
        $satis = $_POST['satis-ara'];

        $satislar = aramaInnerJoin($satis, $_SESSION['ID']);

    } else {
      if (getItem('kullanicilar', 'id', $_SESSION['ID'])['aktif'] == 2) {
      $satislar = getAllFrom("satislar ORDER BY id DESC");
      }elseif (getItem('kullanicilar', 'id', $_SESSION['ID'])['aktif'] == 1) {
        $satislar = getAllFrom("satislar WHERE satisi_yapan = {$_SESSION['ID']} ORDER BY id DESC");
      }
    }

  } else {
    if (getItem('kullanicilar', 'id', $_SESSION['ID'])['aktif'] == 2) {
      $satislar = getAllFrom("satislar ORDER BY id DESC");
      } elseif (getItem('kullanicilar', 'id', $_SESSION['ID'])['aktif'] == 1) {
        $satislar = getAllFrom("satislar WHERE satisi_yapan = {$_SESSION['ID']} ORDER BY id DESC");
      }
  } // post end

  if (isset($satislar)) {
    foreach ($satislar as $key => $satis) {

      $urun_name = getItem('urunler', 'id', $satis['u_id']);
  
      $satislar[$key]['u_adi'] = $urun_name['urun_adi'];
  
    }
  }  

  if (isset($_GET['d'])) {

    if ($_GET['d'] == 'sy') {
      ?>

        <div class="cont">
          <div class="cont-bas-2 s-y">
            <div>
              <form action="<?php echo $_SERVER['PHP_SELF'] . '?d=sy'; ?>" method="POST">
                <label for="satis-ara"><?php echo lang('urunNo'); ?> :</label>
                <input id="satis-ara" name="satis-ara" type="number" placeholder="<?php echo lang('satilacakUrunNoGiriniz') ?>">
                <input name="ara-sy" type="submit" value="<?php echo lang('Ara') ?>">
              </form>
            </div>
          </div>
          <?php 
          if (isset($_POST['ara-sy'])) {

            $uid = $_POST['satis-ara'];

            $count = checkItem('urunler', 'id', $uid);
      
            if ($count > 0) {
      
              $urun = getItem('urunler', 'id', $uid);

              ?>
              <div class="cont-alt">
                <div class="urun-deg-buyuk">
                  <h4><center><?php echo lang('urunBilgileri'); ?></center></h4>
                  <div class="urun-deg div-satislar">
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
                    </div>
                    <!-- div 3 bitti -->
                  </div>
                </div>
                <h4><center><?php echo lang('satisBilgileri'); ?></center></h4>
                <form class="satis" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                  <div class="satis-bilgileri">
                    <!-- div 2 basla -->
                    <div class="div-2 s">
                      <label for="s-adet"><?php echo lang('satilacakAdet'); ?>:</label>
                      <input min="1" id="s-adet" name="s-adet" type="number" required>
                    </div>
                    <!-- div 2 bitti -->
                    <!-- div 3 basla -->
                    <div class="div-2 s">
                      <label for="s-fiyat"><?php echo lang('satimFiyati'); ?>:</label>
                      <input id="s-fiyat" name="s-fiyat" type="number" required>
                      <input id="u-no" name="u-no" type="hidden" value="<?php echo $urun['id']; ?>">
                    </div>
                    <!-- div 3 bitti -->
                    <div class="div-toplam">
                      <label for="toplam"><?php echo lang('toplam'); ?>:</label>
                      <input id="toplam" type="number" disabled class="toplam">
                      <input type="button" class="hesapla" value="<?php echo lang('hesapla'); ?>">
                    </div>
                    <div class="div-2 s">
                      <label for="alici"><?php echo lang('alici'); ?>:</label>
                      <input id="alici" name="alici" type="text" required>
                      <input id="u-no" name="u-no" type="hidden" value="<?php echo $urun['id']; ?>">
                    </div>
                  </div>
                  
                  <input type="submit" name="satis-yap" class="urun-ekleme" value="<?php echo lang('satisYap'); ?>">
                </form>
              </div>
            </div>

          <?php
        } else {
          echo '<div class="cont-alt"><b>' . lang('sonucBulunmadi') . '</b></div>';
        }
      }

    } elseif ($_GET['d'] == 'gos') {

      if (getItem('kullanicilar', 'id', $_SESSION['ID'])['aktif'] == 2 || getItem('satislar', 'id', $_GET['k'])['satisi_yapan'] == $_SESSION['ID']) {
        
        $sid = isset($_GET['k']) && is_numeric($_GET['k']) ? intval($_GET['k']) : 0;

        $count = checkItem('satislar', 'id', $sid);

        if ($count > 0) {
        
        $satis = getItem('satislar', 'id', $sid);
        $urun = getItem('urunler', 'id', $satis['u_id']);
        $kullanici = getItem('kullanicilar', 'id', $satis['satisi_yapan']);
          ?>

            <div class="cont-alt">
              <div class="urun-deg-buyuk">
                <h4><center><?php echo lang('satisBilgileri'); ?></center></h4>
                <div class="urun-deg div-satislar">
                  <!-- div 1 basla -->
                  <div>
                    <div class="foto">
                      <img class="fotog" src="fotograflar/urunler/<?php echo $urun['foto']; ?>" alt="">
                    </div>
                  </div>
                  <!-- div 1 Bitti -->
                  <!-- div 2 basla -->
                  <div class="div-2">
                      <label for="u-no"><?php echo lang('urunNo'); ?>:</label>
                      <input disabled id="u-no" type="text" value="<?php echo $urun['id']; ?>">

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
                      <label for="s-no"><?php echo lang('satisNo'); ?>:</label>
                      <input disabled id="s-no" type="text" value="<?php echo $satis['id']; ?>">

                      <label for="s-adet"><?php echo lang('satilanAdet'); ?>:</label>
                      <input id="s-adet" type="number" value="<?php echo $satis['satilan_adet']; ?>" disabled>

                      <label for="birine"><?php echo lang('birineFiyat'); ?>:</label>
                      <input id="birine" type="number" value="<?php echo $satis['birine_fiyat']; ?>" disabled>

                      <label for="toplam"><?php echo lang('toplam'); ?>:</label>
                      <input id="toplam" type="number" value="<?php echo $satis['toplam_tl']; ?>" disabled>

                      <label for="alici"><?php echo lang('alici'); ?>:</label>
                      <input id="alici" type="text" value="<?php echo $satis['alici']; ?>" disabled>

                      <label for="s-tarihi"><?php echo lang('satisTarihi'); ?>:</label>
                      <input id="s-tarihi" type="text" value="<?php echo $satis['tarihi']; ?>" disabled>

                      <label for="s-yapan"><?php echo lang('satisiYapan'); ?>:</label>
                      <input id="s-yapan" type="text" value="<?php echo $kullanici['kullanici_adi']; ?>" disabled>
                      
                  </div>
                  <!-- div 3 bitti -->
                </div>
              </div>
            </div>
          <?php
        } else {
          header('Location: satislar.php');
          exit();
        }
      } else {
        header('Location: satislar.php');
        exit();
      }
    } else {
      header('Location: satislar.php');
      exit();
    }
  } else {
    if (isset($_GET['s'])) {
      if ($_GET['s'] == 'sil') {

        if (getItem('kullanicilar', 'id', $_SESSION['ID'])['aktif'] == 2 || getItem('satislar', 'id', $_GET['k'])['satisi_yapan'] == $_SESSION['ID']) {

          $sid = isset($_GET['k']) && is_numeric($_GET['k']) ? intval($_GET['k']) : 0;

          $count = checkItem('satislar', 'id', $sid);

          if ($count > 0) {

          $satis = getItem('satislar', 'id', $sid);
          $urun  = getItem('urunler', 'id', $satis['u_id']);

          $stmt = $con->prepare("UPDATE urunler SET adet = ? WHERE id = ?");
          $stmt->execute(array($urun['adet'] + $satis['satilan_adet'], $satis['u_id']));

          bildirim($stmt->rowCount() . lang('urunGuncenlendi'));

          bildirim(delete('satislar', 'id', $sid) . lang('satisIptalEdildi'));
          header("refresh:3;url=satislar.php");
          } else {
            header('Location: satislar.php');
            exit();
          }
        }
      }
    }
      ?>

      <div class="cont">
        <div class="cont-bas-2">
          <div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <input value="<?php echo @$_POST['satis-ara']; ?>" name="satis-ara" type="text" placeholder="<?php echo lang('satisAra') ?>">
              <input name="ara" type="submit" value="<?php echo lang('Ara') ?>">
            </form>
          </div>
          <div>
              <a href="?d=sy" class="a ekle"><?php echo lang('satisYap') ?></a>
          </div>
        </div>
        <div class="cont-alt">
          <?php 
              if (empty($satislar)) {
                echo '<div style="font-weight: bold">' . lang('sonucBulunmadi') . '</div>';
              } else { ?>
                <table class="cont cont-2">
                  <tr>
                    <th><?php echo lang('satisNo') ?></th>
                    <th><?php echo lang('urunAdi') ?></th>
                    <th><?php echo lang('satilanAdet') ?></th>
                    <th><?php echo lang('toplam') ?></th>
                    <th><?php echo lang('satisTarihi') ?></th>
                    <th><?php echo lang('Kontrol') ?></th>
                  </tr>

                  <?php
                    foreach($satislar as $satis) {
                      echo '<tr>
                              <td>' .  str_pad($satis['id'], 7, 0, STR_PAD_LEFT) . '</td>
                              <td>' .  $satis['u_adi'] . '</td>
                              <td>' .  $satis['satilan_adet'] . '</td>
                              <td>' .  nokta($satis['toplam_tl']) . '</td>
                              <td>' .  $satis['tarihi'] . '</td>
                              <td>
                                <a class="a confirm" href="?s=sil&k=' . $satis['id'] .'">
                                  <img class="kontrol-2" src="iconlar/trash.png" alt="">
                                </a>
                                <a class="a" href="?d=gos&k=' . $satis['id'] .'">
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