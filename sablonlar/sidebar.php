<div class="content">
	<div class="sidebar">
		<div class="sticky">
			<div class="logo">
				<h1><?php echo lang('LojistikOtomasyonu'); ?></h1>
			</div>
			<ul class="sidebar-list">
				<a href="anasayfa.php">
					<li class="<?php if (basename($_SERVER['PHP_SELF']) == 'anasayfa.php') { echo 'aktif'; } ?>">
						<img src="iconlar/home.png" alt="">
						<span><?php echo lang('AnaSayfa'); ?></span>
					</li>
				</a>
				<a href="kategoriler.php">
					<li class="<?php if (basename($_SERVER['PHP_SELF']) == 'kategoriler.php') { echo 'aktif'; } ?>">
						<img src="iconlar/categories.png" alt="">
						<span><?php echo lang('Kategoriler'); ?></span>
					</li>
				</a>
				<a href="urunler.php">
					<li class="<?php if (basename($_SERVER['PHP_SELF']) == 'urunler.php') { echo 'aktif'; } ?>">
						<img src="iconlar/box.png" alt="">
						<span><?php echo lang('Urunler'); ?></span>
					</li>
				</a>
				<a href="satislar.php">
					<li class="<?php if (basename($_SERVER['PHP_SELF']) == 'satislar.php') { echo 'aktif'; } ?>">
						<img src="iconlar/increasing.png" alt="">
						<span><?php echo lang('Satislar'); ?></span>
					</li>
				</a>
				<?php
				
				 if (getItem('kullanicilar', 'id', $_SESSION['ID'])['aktif'] == 2) { ?>
				<a href="raporlar.php">
					<li class="<?php if (basename($_SERVER['PHP_SELF']) == 'raporlar.php') { echo 'aktif'; } ?>">
						<img src="iconlar/profit-report.png" alt="">
						<span><?php echo lang('Raporlar'); ?></span>
					</li>
				</a>
				<?php } ?>
				<a href="kdeg.php?i=<?php echo $_SESSION['ID']; ?>">
					<li class="<?php if (basename($_SERVER['PHP_SELF']) == 'kdeg.php') { echo 'aktif'; } ?>">
						<img src="iconlar/user.png" alt="">
						<span><?php echo lang('Profil'); ?></span>
					</li>
				</a>
				<?php
				
				 if (getItem('kullanicilar', 'id', $_SESSION['ID'])['aktif'] == 2) { ?>
				<a href="kullanicilar.php">
					<li class="<?php if (basename($_SERVER['PHP_SELF']) == 'kullanicilar.php') { echo 'aktif'; } ?>">
						<img src="iconlar/users.png" alt="">
						<?php echo lang('Kullanicilar'); ?>
					</li>
				</a>
				<?php } ?>
				
			</ul>
		</div>
	</div>
	<div class="icerik">
			<div class="bas">
				<div class="tarih">
					<?php $h = date('H') + 1; echo date('d.m.Y ' . $h . ':i'); ?>
				</div>
				<div></div>
				<div class="profil">
					<img src="iconlar/user.png" alt="user">
					<p class="pas"><?php echo $_SESSION['kullanici_adi']; ?></p>
					<p class="ok pas">></p>

					<div class="profil-ust">
						<ul class="profil">
							<li><img src="iconlar/lang.png" alt="">
								<a <?php if (isset($_COOKIE['lang'])) { if ($_COOKIE['lang'] == 'turkce') echo 'style="color: red"'; } ?> class="a" href="anasayfa.php?lang=turkce">Türkçe</a>
								<a <?php if (isset($_COOKIE['lang'])) { if ($_COOKIE['lang'] == 'arapca') echo 'style="color: green"'; } ?> class="a" href="anasayfa.php?lang=arapca">العربية</a>
							</li>
							<a class="a" href="kdeg.php?i=<?php echo $_SESSION['ID'] ?>"><li><img src="iconlar/user.png" alt=""><span><?php echo lang('Profil'); ?></span></li></a>
							<a class="a" href="logout.php"><li><img src="iconlar/logout.png" alt=""><span><?php echo lang('CikisYap'); ?></span></li></a>
						</ul>
					</div>
				</div>
			</div>