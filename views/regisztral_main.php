<h2>Regisztráció</h2>
<form action="<?= SITE_ROOT ?>regisztral" method="post">
        <input type="text" name="vezeteknev" placeholder="vezetéknév" required><br><br>
        <input type="text" name="utonev" placeholder="utónév" required><br><br>
        <input type="text" name="felhasznalo" placeholder="felhasználói név" required><br><br>
        <input type="password" name="jelszo" placeholder="jelszó" required><br><br>
        <input type="submit" name="regisztracio" value="Regisztráció">
</form>
<h2><br><?= (isset($viewData['uzenet']) ? $viewData['uzenet'] : "") ?><br></h2>
