const input = document.querySelector('input');
input.addEventListener('input', updateValue);

const select = document.querySelectorAll('select');
for (let i = 0; i < select.length; i++) {
    select[i].addEventListener('change', updateValue);
}

function updateValue(e) {

    switch (e.target.name) {
        case 'CompanyNumber':
            if (e.target.value.length === 8) {
                console.log('submit');
                form.submit();
            }
            break;

        case 'Temperature':
            document.getElementById('TemperatureRange').focus();
            break;

        case 'TemperatureRange':
            document.getElementById('HistoryOfFever').focus();
            break;

        case 'HistoryOfFever':
            document.getElementById('SoreThroat').focus();
            break;

        case 'SoreThroat':
            document.getElementById('Cough').focus();
            break;

        case 'Cough':
            document.getElementById('DifficultyInBreathing').focus();;
            break;

        case 'DifficultyInBreathing':
            document.getElementById('Diarrhea').focus();
            break;

        case 'Diarrhea':
            document.getElementById('Saved').click();
            break;

        default:
            console.log(e.target.name);
            break;


    }






}

function moveNext() {

}