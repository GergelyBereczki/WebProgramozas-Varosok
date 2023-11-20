<!DOCTYPE html>
<!--Az oldal hátterének beállítása.-->
<html lang="hu-hu">

<head>
    <meta charset="utf-8">
    <title>Városok</title>
    <link rel="icon" type="image/x-icon" href="./images/icon.png">
    <!--Az oldal megjelenéséhez használt scriptek meghívása.-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT ?>/css/main_style.css">
    <script type="text/javascript" src="<?php echo SITE_ROOT ?>/js/form_validator.js"></script>
	<?php // if ($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="' . $viewData['style'] . '">';
	?>

</head>

<body style=" overflow: auto; background-image: url('<?php echo SITE_ROOT ?>/images/bg.jpg');">



</header>
<div>
    <!--Reszponzív menüsor létrehozása.-->
    <nav>
		<?php echo Menu::getMenu($viewData['selectedItems']); ?>
        <p class="logged-user">
			<?= ($_SESSION['userid'] != 0 && isset($_SESSION['userid'])) ?
				"Bejelentkezett: " . $_SESSION['userlastname'] . " " . $_SESSION['userfirstname'] . " (" . $_SESSION['userid'] . ")." : "" ?>
			<?= ($_SESSION['userlevel'] == '__1') ? " (adminisztrátor)" : "" ?>
        </p>
    </nav>
    <br><br><br>
    <!--Szekció az oldalak kinézetének megjelenítéséhez..-->
    <div class="tartalom">
        <section>
			<?php if ($viewData['render']) include($viewData['render']); ?>
        </section>
    </div>
    <br><br><br>

    <!--Footer megjelenítése.-->
    <div class="jumbotron text-center" style="margin-bottom:0; margin-top:0;  ">
        <footer id="lab">
            &copy; Bagó Bence, Bereczki Gergely <?= date("Y") ?>
        </footer>
    </div>
</div>
</body>