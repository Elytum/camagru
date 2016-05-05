<title>Camagru</title>
<link rel="stylesheet" type="text/css" href="style.css">
<ul>
  <li><a id="account.php" href="account.php">Mon compte</a></li>
  <li><a id="montage.php" href="montage.php">Montage</a></li>
  <li><a id="galerie.php" href="galerie.php">Galerie</a></li>
  <li><a href="disconnect.php">Deconnection</a></li>

<script>
	function basename(path) {
		return path.split(/[\\/]/).pop();
	}

	function getPage() {
		return basename(window.location.href)
	}

	function highlight() {
		page = document.getElementById(getPage());
		if (page != undefined)
			page.className = "active";
	}

	highlight();
</script>

</ul>