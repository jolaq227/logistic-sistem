<?php
function getTitle() {
    global $pageTitle;

    if (isset($pageTitle)) {
        echo $pageTitle;
    }
    else {
        echo 'Varsayılan';
    }
}

function getAllFrom($from) {
    global $con;
    $stmt = $con->prepare("SELECT * FROM $from");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}

function bildirim($mesaj) {
    ?>
            <div class="bildirim">
                    <?php echo $mesaj; ?>
            </div>
        <?php
}

function arama($from, $where, $or, $like) {
    global $con;
    $stmt = $con->prepare("SELECT 
                                    *
                            FROM 
                                $from
                            WHERE 
                                $where LIKE ?
                            OR
                              $or LIKE ?");

        $stmt->execute(array("%$like%", "%$like%"));
    return $stmt->fetchAll();
}

function checkItem($from, $where, $value) {
    global $con;
    $stmt = $con->prepare("SELECT * FROM $from WHERE $where = ? LIMIT 1");
    $stmt->execute(array($value));
    return $stmt->rowCount();
}

function delete($from, $where, $value) {
    global $con;
    $stmt = $con->prepare("DELETE FROM $from WHERE $where = :id");
    $stmt->bindParam(":id", $value);
    $stmt->execute();
    return $stmt->rowCount();
}

function getItem($from, $where, $value) {
    global $con;
    $stmt = $con->prepare("SELECT * FROM $from WHERE $where = ? LIMIT 1");
    $stmt->execute(array($value));
    return $stmt->fetch();
}

function aramaInnerJoin($like) {
    global $con;
    $stmt = $con->prepare("SELECT 
                                    urunler.urun_adi, satislar.*
                            FROM 
                                urunler
                            INNER JOIN 
                                satislar
                            ON
                                satislar.u_id = urunler.id
                            WHERE 
                                satislar.id LIKE ?
                            OR
                                urun_adi LIKE ?
                            OR
                                urunler.id LIKE ?");

        $stmt->execute(array("%$like%", "%$like%", "%$like%"));
        $satislar = $stmt->fetchAll();
    return $satislar;
}

function getRapor($baslama, $bitme) {
    global $con;

    // SELECT * FROM `satislar` WHERE tarihi BETWEEN '2023-05-01 22:37:13' AND '2023-05-04 00:37:13' GROUP BY DATE(tarihi) DESC
    $stmt = $con->prepare("SELECT 
                                    urunler.urun_adi, urunler.alim_fiyat, satislar.*
                            FROM 
                                urunler
                            INNER JOIN 
                                satislar
                            ON
                                satislar.u_id = urunler.id
                            WHERE 
                                satislar.tarihi 
                            BETWEEN 
                                ? 
                            AND 
                                ?
                            ORDER BY
                                satislar.id DESC");

        $stmt->execute(array("$baslama", "$bitme"));
        $satislar = $stmt->fetchAll();
    return $satislar;
}

function nokta($sayi) {
    if (strlen($sayi) > 3) {
        $sayis = substr_replace ($sayi , '.' , -3, 0 );
    } else {
        $sayis = $sayi;
    }
    if (strlen($sayis) > 7) {
        $sayis = substr_replace ($sayis , '.' , -7, 0 );
    }
    if (strlen($sayis) > 11) {
        $sayis = substr_replace ($sayis , '.' , -11, 0 );
    }
    return $sayis;
}