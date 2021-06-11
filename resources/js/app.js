require('./bootstrap');

require('alpinejs');

const AutoNumeric = require('autonumeric');

const currencyFormat = document.getElementById('salary_claim');

new AutoNumeric(currencyFormat, {
    allowDecimalPadding: "floats",
    alwaysAllowDecimalCharacter: true,
    caretPositionOnFocus: "start",
    createLocalList: false,
    currencySymbol: "R$",
    decimalCharacter: ",",
    digitGroupSeparator: ".",
    maximumValue: "100000",
    outputFormat: "number",
    selectNumberOnly: true,
    minimumValue: 0
});
