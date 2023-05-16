<?php

function lang($lang)
{
  static $arr = array(
    '2SaniyeBekleyin'           => 'يرجى الأنتظار ثانيتين',
    'LojistikOtomasyonu'        => 'نظام إدارة المخازن',
    // Ust
    'CikisYap'                  => 'تسجيل خروج',
    'Profil'                    => 'الملف الشخصي',
    // Sidebar
    'AnaSayfa'                  => 'الصفحة الرئيسية',
    'Kategoriler'               => 'التصنيفات',
    'Urunler'                   => 'المنتجات',
    'Satislar'                  => 'المبيعات',
    'Raporlar'                  => 'التقارير',
    'Kullanicilar'              => 'المستخدمين',
    // Giris
    'GirisYap'                  => 'تسجيل الدخول',
    'KullaniciAdi'              => 'اسم المستخدم',
    'Sifre'                     => 'كلمة السر',
    'SifremiUnuttum'            => 'نسيت كلمة السر',
    'kullaniciAdiYadaSifreHata' => 'اسم المستخدم أو السر خطأ',
    'GirisSayfasinaGit'         => 'الذهاب إلى صفحة تسجيل الدخول',
    'SifreSifirla'              => 'إعادة تعيين كلمة السر',
    'Ad'                        => 'الأسم',
    'SoyAd'                     => 'النسبة',
    'Departman'                 => 'القسم',
    // Kategoriler
    'KategoriEkle'              => 'إضافة تصنيف',
    'KategoriAra'               => 'البحث عن تصنيف',
    'KategoriAdi'               => 'اسم التصنيف',
    'KategoriNo'                => 'رقم التصنيف',
    'Kontrol'                   => 'إدارة',
    'Ekle'                      => 'إضافة',
    'Ara'                       => 'البحث',
    'kategoriEklendi'           => ' تصنيف تمت اضافته',
    'degistir'                  => 'تحديث',
    'katSilindi'                => ' تصنيف تم خذفه',
    'katGuncellendi'            => ' تصنيف تم تحديثه',
    // Urunler
    'urunAra'                   => 'البحث عن منتج',
    'urunAdi'                   => 'اسم المنتج',
    'urunNo'                    => 'رقم المنتج',
    'depodaAdet'                => 'عدد المنتج',
    'kategori'                  => 'التصنيف',
    'depoyaGirmeTarihi'         => 'تاريخ الدخول',
    'tedarikci'                 => 'المورد',
    'urunAdresi'                => 'عنوان المنتج',
    'adet'                      => 'العدد',
    'alimFiyati'                => 'سعر الشراء',
    'satimFiyati'               => 'سعر البيع',
    'rafNo'                     => 'رقم الرف',
    'sonucBulunmadi'            => 'لم يتم العثور على نتائج',
    'UrunEklendi'               => ' منتج تم اضافته',
    'urunSilindi'               => ' منتج تم حذفه',
    'bitti'                     => 'غير متوفر',
          // Urunler Hatalari
    'fotoYuklenmedi'            => 'لم يتم تحميل صورة',
    'fotoUzantiYok'             => 'إمتداد الصورة غير مدعوم',
    'fotoBoyut10mbBuyukYok'     => 'لا يمكن تحميل صورة بحجم أكبر من ١٠ ميغابايت',
    'urunAdiBosveya5tenfazlaYok'=> 'لايمكن أن يكون اسم المنتج فارغاً أو أقل من ٥ حروف',
    'katYok'                    => 'لا يمكن أن يكون التصنيف فارغاً',
    'tedarikciBosYok'           => 'لا يمكن أن يكون المورد فارغاً',
    'uAdresiBosYok'             => 'لايمكن أن يكون عنوان المنفج فارغاً',
    'uAdetBos0HarfYok'          => 'لا يمكن أن يكون العدد فارغاً أو ٠ أو يحتوي على أحرف',
    'uAlimBos0HarfYok'          => 'لا يمكن أن يكون سعر الشراء فارغاً أو ٠ أو يحتوي على أحرف',
    'uSatimBos0HarfAlimAzYok'   => 'لا يمكن أن يكون سعر البيع فارغاً أو ٠ أو يحتوي على  أحرف أو أقل من سعر الشراء',
    'rafNoYok'                  => 'لايمكن أن يكون رقم الرف فارغاَ',
    'urunGuncenlendi'           => ' منتج تم تحديثه',
    'eklemeTarihi'              => 'تارخ الإضافة',
    'ekleyen'                   => 'المُضيف',
    // Satislar
    'satisAra'                  => 'البحث في المييعات',
    'satisYap'                  => 'قم بالبيع',
    'satilacakUrunNoGiriniz'    => 'أدخل رقم المنتج الذي تريد بيعه',
    'urunBilgileri'             => 'معلومات المنتج',
    'satisBilgileri'            => 'معلومات البيع',
    'satilacakAdet'             => 'العدد الذي سيباع',
    'hesapla'                   => 'إحسب',
    'toplam'                    => 'المجموع',
    'fazlaSatilamaz'            => ' لا يمكن بيع أكثر من',
    'fiyattanDusukSatilamaz'    => ' هو سعر الشراء، لقد بيع بسعر أقل من سعر الشراء ( بيع خاسر )',
    'alici'                     => 'المشتري',
    'SatisYapildi'              => ' مبيعة تم حفظها',
    'aliciBos'                  => 'لا يمكن أن يكون المشتري فارغاً',
    'satisIptalEdildi'          => ' مبيعة تم إلغائها',
    'satisNo'                   => 'رقم المبيعة',
    'satilanAdet'               => 'العدد المباع',
    'satisTarihi'               => 'تاريخ البيع',
    'birineFiyat'               => 'سعر الواحدو',
    'satisiYapan'               => 'الشخص الذي باعه',
    // Raporlar 
    'suTarihten'                => 'من هذا التاريخ',
    'suTariheKadar'             => 'حتى هذا التاريخ',
    'satislar'                  => ' المبيعات',
    'tarihten'                  => ' من حتى ',
    'tariheKadar'               => ' المبيعات',
    'lutfenGecerliTarihGiriniz' => 'الرجاء إدخال تاريخ صالح',
    'toplamPara'                => 'مجموع الأموال',
    'toplamKar/Zarar'           => 'مجموع الربح/الخسائر',
    'Kar/Zarar'                 => 'الربح/الخسائر',
    'sonHafta'                  => 'آخر أسبوع',
    'sonAy'                     => 'آخر شهر',
    'son6Ay'                    => 'آخر ٦ أشهر',
    'sonYil'                    => 'آخر سنة',
    // kullanicilar
    'kullaniciAra'              => 'البحث عن مستخدم',
    'kNo'                       => 'رقم المستخدم',
    'kAdi'                      => 'أسم المستخدم',
    'kIsi'                      => 'القسم',
    'aktifPasif'                => 'نشط/غير نشط',
    'sonGirisTarihi'            => 'تاريخ آخر دخول',
    'aktif'                     => 'نشط',
    'pasif'                     => 'غير نشط',
    'ad'                        => 'الأسم',
    'soyAd'                     => 'النسبة',
    'isi'                       => 'القسم',
    'sifreTekrar'               => 'كلمة السر مرة إخرى',
    'kullaniciEklendi'          => ' مستخدم تم إضافته',
    'yonetici'                  => 'مشرف',
          // hatalar
    'AdiBosveya4tenfazlaYok'    => 'لا يمكن أن يكون الأسم فارغاً أو أقل من ٤ أحرف',
    'sAdiBosveya4tenfazlaYok'   => 'لا يمكن أن يكون النسبة فارغاً أو أقل من ٤ أحرف',
    'kAdiBosveya5tenfazlaYok'   => 'لا يمكن أن يكون الأسم فارغاً أو أقل من ٥ أحرف',
    'departmanBos'              => 'لايمكن أن يكون القسم فارغاً',
    'sifreEsitYok'              => 'يجب أن تكون كلمة السر متطابقة بينها',
    'buKDahaOnceKullanildi'     => 'أسم السمتخدم هذا تم إستعماله',
    'kullaniciSilindi'          => ' مستخدم تم خذفه',
    'kullaniciGuncellendi'      => ' مستخدم تم تحديثه',
    // Anasayfa
    'gununSatisToplamiTl'       => 'مجموع البيع اليوم بالليرة التركية',
    'depodaUrunSayisi'          => 'عدد المنتجات في المستودع',
    'satilanUrunSayisi'         => 'عدد المنتجات التي بيعت اليوم',
    'enCokSatilanlar'           => 'الأكثر مبيعاً',
    'sonSatislar'               => 'إخر المبيعات',
    'yeniEklenenUrunler'        => 'المنتجات المضافة مؤخراً',
  );
  return $arr[$lang];
}