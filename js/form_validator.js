var fields = {};
var maxLimitLel = 0;
var maxLimitEv = 0;

$(function () {
    fields.minLel = $('#min_lel')[0];
    fields.maxLel = $('#max_lel')[0];
    maxLimitLel = $('#max_lel').attr("max");
    fields.minEv = $('#min_ev')[0];
    fields.maxEv = $('#max_ev')[0];
    maxLimitEv = $('#max_ev').attr("max");
    fields.megyeJog = $('#megye_jog')[0];
})

class TownsSearchParams {
    constructor(minLel, maxLel, minEv, maxEv, megyeJog) {
        this.minLel = minLel;
        this.maxLel = maxLel;
        this.minEv = minEv;
        this.maxEv = maxEv;
        this.megyeJog = megyeJog;
    }
}

function validateForm() {
    try {
        if (isValid()) {
            let townsSearchParams = new TownsSearchParams(
                min_lel.value, max_lel.value, min_ev.value, max_ev.value, megye_jog.value
            );
        } else {
            alert("Ervenytelen szuresi feltelek!");
            return false;
        }
    } catch (e) {
        alert(e);
        return false;
    }
}

function isValid() {
    let valid = true;

    if (fields.minLel.value === '') fields.minLel.value = 0;
    if (fields.maxLel.value === '') fields.maxLel.value = maxLimitLel;
    if (fields.minEv.value === '') fields.minEv.value = 0;
    if (fields.maxEv.value === '') fields.maxEv.value = maxLimitEv;

    valid &= fieldValidation(isNumberInRange, fields.minLel, null, maxLimitLel);
    valid &= fieldValidation(isNumberInRange, fields.maxLel, null, maxLimitLel);
    valid &= fieldValidation(isMinLowerThanMax, fields.minLel, fields.maxLel);
    valid &= fieldValidation(isNumberInRange, fields.minEv, null, maxLimitEv);
    valid &= fieldValidation(isNumberInRange, fields.maxEv, null, maxLimitEv);
    valid &= fieldValidation(isMinLowerThanMax, fields.minEv, fields.maxEv);
    valid &= fieldValidation(isYesNoEither, fields.megyeJog);

    return valid;
}

function fieldValidation(validationFunction, field, field2 = null, limit = 0) {
    if (field == null) return false;

    let isFieldValid;
    if (!(limit === 0) && (field2 === null)) {
        isFieldValid = validationFunction(field.value, limit)
    } else if (!(field2 === null)) {
        isFieldValid = validationFunction(field.value, field2.value)
    } else {
        isFieldValid = validationFunction(field.value)
    }

    if (!isFieldValid) {
        field.className = 'placeholderRed';
        field.focus();
    } else {
        field.className = '';
    }

    return isFieldValid;
}

function isNumberInRange(value, limit) {
    const parsedVal = parseInt(value, 10);
    const parsedLim = parseInt(limit, 10);
    if (isNaN(parsedVal) || isNaN(parsedLim)) return false;
    return !(parsedVal < 0 || parsedVal > parsedLim);
}

function isMinLowerThanMax(minValue, maxValue) {
    return parseInt(minValue, 10) <= parseInt(maxValue, 10);
}

function isYesNoEither(value) {
    return value === 'megye_jogu' || value === 'megye_nem' || value === 'mindegy';
}
