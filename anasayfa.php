<?php
session_start();
$pageTitle = "Anasayfa";

if (isset($_SESSION['kullanici_adi'])) {
    include 'init.php';
    
    if (isset($_GET['lang'])) {
        if ($_GET['lang'] == 'turkce' || $_GET['lang'] == 'arapca') {
            setcookie("lang", $_GET['lang']);
            header("refresh:2;url=anasayfa.php");
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


    $baslad = date('Y-m-d 00:00:00', time());
    $bitisd = date('Y-m-d 23:59:59', time());
    $satislar = getRapor($baslad, $bitisd);
    foreach($satislar as $satis) {
        @$toplam += $satis['toplam_tl'];
        @$toplamUrun += $satis['satilan_adet'];
    }

    $urunler = getAllFrom('urunler ORDER BY id DESC');
    foreach($urunler as $urun) {
        @$uSayisi += $urun['adet'];
    }


    ?>
    <div class="anasayfa-icerik">
        <div class="buyuk-anasayfa">
            <div>
                <img src="iconlar/tl.png" alt="">
                <div>
                    <p><?php echo lang('gununSatisToplamiTl'); ?></p>
                    <span><?php echo isset($toplam) ? nokta($toplam) : '0'; ?> TL</span>
                </div>
            </div>
            <div>
                <img src="iconlar/card.png" alt="">
                <div>
                    <p><?php echo lang('depodaUrunSayisi'); ?></p>
                    <span><?php echo isset($uSayisi) ? nokta($uSayisi) : '0'; ?></span>
                </div>
            </div>
            <div>
                <img src="iconlar/urun.png" alt="">
                <div>
                    <p><?php echo lang('satilanUrunSayisi'); ?></p>
                    <span><?php echo isset($toplamUrun) ? nokta($toplamUrun) : '0'; ?></span>
                </div>
            </div>
            <div>
                <h4><center><?php echo lang('enCokSatilanlar'); ?></center></h4>
                <table>
                    <tr>
                        <th><?php echo lang('urunNo'); ?></th>
                        <th><?php echo lang('urunAdi'); ?></th>
                        <th><?php echo lang('satilanAdet'); ?></th>
                    </tr>
                    <?php 
                        $urunlerl = getAllFrom('satislar ORDER BY satilan_adet DESC LIMIT 5');
                        foreach($urunlerl as $urun) {
                            $urunAdi = getItem('urunler', 'id', $urun['u_id']);
                            echo '<tr>
                                    <td>' . $urunAdi['id'] . '</td>
                                    <td><a class="a" href="urunler.php?d=gos&k=' . $urunAdi['id'] . '">' . $urunAdi['urun_adi'] . '</a></td>
                                    <td>' . nokta($urun['satilan_adet']) . '</td>
                                </tr>';
                        }
                    ?>
                </table>
            </div>
            <div>
                <h4><center><?php echo lang('sonSatislar'); ?></center></h4>
                <table>
                    <tr>
                        <th><?php echo lang('satisNo'); ?></th>
                        <th><?php echo lang('satisTarihi'); ?></th>
                        <th><?php echo lang('toplam') . ' (TL)'; ?></th>
                    </tr>
                    <?php 
                        $urunlerl = getAllFrom('satislar ORDER BY id DESC LIMIT 5');
                        foreach($urunlerl as $urun) {
                            echo '<tr>
                                    <td>' . $urun['id'] . '</td>
                                    <td><a class="a" href="satislar.php?d=gos&k=' . $urun['id'] . '">' . $urun['tarihi'] . '</a></td>
                                    <td>' . nokta($urun['toplam_tl']) . '</td>
                                </tr>';
                        }
                    ?>
                </table>
            </div>
            <div>
                <h4><center><?php echo lang('yeniEklenenUrunler'); ?></center></h4>
                <table>
                    <tr>
                        <th><?php echo lang('urunNo'); ?></th>
                        <th><?php echo lang('urunAdi'); ?></th>
                        <th><?php echo lang('depoyaGirmeTarihi') ?></th>
                    </tr>

                    <?php 
                        $urunlerl = getAllFrom('urunler ORDER BY id DESC LIMIT 5');
                        foreach($urunlerl as $urun) {
                            echo '<tr>
                                    <td>' . $urun['id'] . '</td>
                                    <td><a class="a" href="urunler.php?d=gos&k=' . $urun['id'] . '">' . $urun['urun_adi'] . '</a></td>
                                    <td>' . substr($urun['tarihi'], 0, -3) . '</td>
                                </tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php



    
    include 'sablonlar/footer.php';
} else {
    header('Location: logout.php');
    exit();
}