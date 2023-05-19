<?php
session_start();
$pageTitle = "Raporlar";

if (isset($_SESSION['kullanici_adi'])) {
  include 'init.php';

  if (getItem('kullanicilar', 'id', $_SESSION['ID'])['aktif'] !== 2) {
    header("Location: anasayfa.php");
    exit();
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $h = date('H') + 1;

    if (isset($_POST['ara'])) {

      if (empty($_POST['bitis']) || empty($_POST['basla'])) {
        $hizli  = $_POST['hizli'];

        if ($hizli == 1) {

          $baslad = date('Y-m-d ' . $h . ':i:s', time() - 60 * 60 * 24 * 7);
          $bitisd = date('Y-m-d ' . $h . ':i:s', time());
          
        } elseif ($hizli == 2) {

          $baslad = date('Y-m-d ' . $h . ':i:s', time() - 60 * 60 * 24 * 30);
          $bitisd = date('Y-m-d ' . $h . ':i:s', time());
          
        } elseif ($hizli == 3) {

          $baslad = date('Y-m-d ' . $h . ':i:s', time() - 60 * 60 * 24 * 30 * 6);
          $bitisd = date('Y-m-d ' . $h . ':i:s', time());
          
        } elseif ($hizli == 4) {

          $yil = date('Y') - 1;

          $baslad = date($yil . '-m-d ' . $h . ':i:s');
          $bitisd = date('Y-m-d ' . $h . ':i:s', time());
          
        }
      } elseif (!empty($_POST['bitis']) || !empty($_POST['basla'])) {
        $basla = $_POST['basla'];
        $bitis = $_POST['bitis'];

        $h = date('H') + 1;

        $baslad = $basla . ' 00:00:00';
        $bitisd = $bitis . date(' ' . $h . ':i:s');

      } else {
        bildirim(lang('lutfenGecerliTarihGiriniz'));
      }

        $satislar = getRapor($baslad, $bitisd);

    } else {
      $satislar = getAllFrom('satislar');
    }

  } else {
    $h = date('H') + 1;
    $baslad = date('Y-m-d 00:00:00', time());
    $bitisd = date('Y-m-d ' . $h . ':i:s', time());

    $satislar = getRapor($baslad, $bitisd);
  } // post end
      ?>

      <div class="cont">
        <div class="cont-bas-2 s-y">
          <div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <label for=""><?php echo lang('suTarihten') ?>:</label>
              <input value="<?php //echo substr(@$baslad, 0, -9); ?>" name="basla" type="date">

              <select name="hizli" id="">
                <option <?php echo @$hizli == 1 ? ' selected' : ''; ?> value="1"><?php echo lang('sonHafta'); ?></option>
                <option <?php echo @$hizli == 2 ? ' selected' : ''; ?> value="2"><?php echo lang('sonAy'); ?></option>
                <option <?php echo @$hizli == 3 ? ' selected' : ''; ?> value="3"><?php echo lang('son6Ay'); ?></option>
                <option <?php echo @$hizli == 4 ? ' selected' : ''; ?> value="4"><?php echo lang('sonYil'); ?></option>
              </select>

              <label for=""><?php echo lang('suTariheKadar') ?>:</label>
              <input value="<?php //echo substr(@$bitisd, 0, -9); ?>" name="bitis" type="date">
              <input name="ara" type="submit" value="<?php echo lang('Ara') ?>">
            </form>
          </div>
        </div>
        <div class="cont-alt">
          <?php 
              if (empty($satislar)) {
                echo '<div style="font-weight: bold">' . lang('sonucBulunmadi') . '</div>';
              } else { ?>
                <h4><center><?php echo isset($baslad) ? substr($baslad, 0, -3) . lang('tarihten') . substr($bitisd, 0, -3) . lang('tariheKadar') : lang('satislar'); ?></center></h4>
                <table class="cont cont-2">
                  <tr>
                    <th><?php echo lang('satisNo') ?></th>
                    <th><?php echo lang('urunAdi') ?></th>
                    <th><?php echo lang('satilanAdet') ?></th>
                    <th><?php echo lang('toplam') ?></th>
                    <th><?php echo lang('satisTarihi') ?></th>
                    <th><?php echo lang('Kar/Zarar') ?></th>
                  </tr>

                  <?php
                    foreach($satislar as $satis) {
                      $kz = $satis['toplam_tl'] - $satis['alim_fiyat'] * $satis['satilan_adet'];
                      @$tkz += $kz;
                      @$tPara += $satis['toplam_tl'];

                      if ($kz < 0) {
                        $gkz = '<span class="zarar">' . nokta($kz) . '</span>';
                      } elseif ($kz > 0) {
                        $gkz = '<span class="kar">+' . nokta($kz) . '</span>';
                      } else {
                        $gkz = '<span style="font-weight: bold; color: orange;">' . nokta($kz) . '</span>';
                      }

                      echo '<tr>
                              <td>' .  str_pad($satis['id'], 7, 0, STR_PAD_LEFT) . '</td>
                              <td>' .  $satis['urun_adi'] . '</td>
                              <td>' .  $satis['satilan_adet'] . '</td>
                              <td>' .  nokta($satis['toplam_tl']) . '</td>
                              <td>' .  $satis['tarihi'] . '</td>
                              <td>' . $gkz . '</td>
                            </tr>';
                    }

                    if ($tkz <= 0) {
                      $tkz = '<span class="zarar">' . nokta($tkz) . '</span>';
                    } else {
                      $tkz = '<span class="kar">+' . nokta($tkz) . '</span>';
                    }
                  ?>
                </table>

                <div class="kar-zarar">
                  <div>
                    
                  </div>
                  <table>
                    <tr>
                      <td><?php echo lang('toplamPara'); ?></td>
                      <td><?php echo '<b>' .  nokta($tPara) . '</b>'; ?></td>
                    </tr>
                    <tr>
                      <td><?php echo lang('toplamKar/Zarar'); ?></td>
                      <td><?php echo $tkz; ?></td>
                    </tr>
                  </table>
                </div>
          <?php } ?>
        </div>
      </div>

      <?php

    include 'sablonlar/footer.php';
} else {
  header('Location: logout.php');
  exit();
}