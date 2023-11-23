<h2 class="centered-title">Exportálás PDF fájlba</h2>
<form name="tour_filter_form" onsubmit="return validateForm();" action="<?= SITE_ROOT ?>pdfquery" method="post">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6 col-lg-4">
            <fieldset class="framed-fieldset">
                <legend>Lakosság - 0-2.000.000</legend>
                <label for="min_lel" class="form-label">Legalább:</label>
                <input type="number" id="min_lel" name="min_lel" min="0" max="2000000"/>
                <br>
                <label for="max_lel" class="form-label">Legfeljebb:</label>
                <input type="number" id="max_lel" name="max_lel" min="0" max="2000000">
            </fieldset>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <fieldset class="framed-fieldset">
                <legend>Évszám - 2001-2019</legend>
                <label for="min_ev" class="form-label">Legalább:</label>
                <input type="number" id="min_ev" name="min_ev" min="2001" max="2019"/>
                <br>
                <label for="max_ev" class="form-label">Legfeljebb:</label>
                <input type="number" id="max_ev" name="max_ev" min="2001" max="2019"/>
            </fieldset>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <fieldset class="framed-fieldset">
                <legend>Megyejogú?</legend>
                <label for="megye_jog" class="form-label">Válasszon egy opciót!</label>
                <br>
                <select name="megye_jog" id="megye_jog" class="sel-y-n-e">
                    <option value="nem_megye" selected>Mindegy</option>
                    <option value="megye_jogu">Igen</option>
                    <option value="megye_nem">Nem</option>
                </select>
            </fieldset>
        </div>
    </div>
    <button id="sendform" class="btn btn-warning btn-lg btn-block" type="submit">
        Szűrés, és exportálás PDF fájlba
    </button>
</form>
