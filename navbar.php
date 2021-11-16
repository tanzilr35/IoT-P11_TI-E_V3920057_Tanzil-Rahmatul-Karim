<style>
	.collapse a {
		text-indent: 10px;
	}
</style>

<nav id="sidebar" class='mx-lt-5 bg-light'>

	<div class="sidebar-list">
		<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-tachometer-alt "></i></span> Dashboard</a>
		<a href="index.php?page=kategori" class="nav-item nav-kategori"><span class='icon-field'><i class="fa fa-home "></i></span> Ruangan</a>
		<a href="index.php?page=ruangan" class="nav-item nav-ruangan"><span class='icon-field'><i class="fas fa-thermometer-half "></i></span> Suhu & Kelembaban</a>
		<?php if ($_SESSION['login_type'] == 1) : ?>
			<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users "></i></span> Manajemen User</a>
			<!-- <a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs text-danger"></i></span> System Settings</a> -->
		<?php endif; ?>
	</div>

</nav>
<script>
	$('.nav_collapse').click(function() {
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>