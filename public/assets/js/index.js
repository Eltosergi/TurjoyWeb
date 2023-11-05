
const selectOrigin = document.getElementById('origins');
const selectDestination = document.getElementById('destinations');
const seatingElement = document.getElementById('seats');
const selectDate = document.getElementById('date');
var actualDate = new Date();
const dateErrorElement = document.getElementById('dateError');

const verifyDate = () => {
    const selectedDate = selectDate.value;
    var selectedDay = selectedDate.substring(8, 10);
    var selectedMonth = selectedDate.substring(5, 7);
    var selectedYear = selectedDate.substring(0, 4);
    var actualDay = actualDate.getDate();
    var actualMonth = actualDate.getMonth() + 1;
    var actualYear = actualDate.getFullYear();

    if (selectedYear == actualYear && selectedMonth == actualMonth && selectedDay < actualDay) {
        // Error: la fecha seleccionada es anterior a la fecha actual
        dateErrorElement.style.display = 'block';
        selectDate.value = '';
    } else if (selectedYear == actualYear && selectedMonth < actualMonth) {
        // Error: el mes seleccionado es anterior al mes actual en el mismo año
        dateErrorElement.style.display = 'block';
        selectDate.value = '';
    } else if (selectedYear < actualYear) {
        // Error: el año seleccionado es anterior al año actual
        dateErrorElement.style.display = 'block';
        selectDate.value = '';
    } else {
        // La fecha seleccionada es válida
        dateErrorElement.style.display = 'none';
    }



}



const verifySeating = () => {
    const origin = selectOrigin.value;
    const destination = selectDestination.value;

    fetch(`/seating/${origin}/${destination}`)
        .then(response => response.json())
        .then(data => {
            const seating = data.seats;
            addSeatsToSelect(seating);
        })
        .catch(error => {
            console.log('hay dramaA')
            console.error('Error:', error);
        });
}

const clearSelect = (select) => {
    while (selectDestination.firstChild) {
        selectDestination.removeChild(selectDestination.firstChild);
    };

}
const addSeatsToSelect = (seating) => {
    seatingElement.innerHTML = '';
    for (let i = 1; i <= seating; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.text = i;
        seatingElement.appendChild(option);
    }
}


const addDestinationsToSelect = (destinations) => {
    clearSelect();

    const option = document.createElement('option');
    option.value = '';
    option.text = 'Seleccione a destino';
    option.selected = true;
    selectDestination.appendChild(option);
    destinations.forEach(destinations => {
        const option = document.createElement('option');
        option.value = destinations;
        option.text = destinations;
        selectDestination.appendChild(option);

    });

}

const loadedDestinations = (e) => {

    const currentValue = selectOrigin.value;

    if(currentValue)
        fetch(`/get/destinations/${currentValue}`)
        .then(response => response.json())
        .then(data => {
            const destinations = data.destination;
            console.log(destinations);
            addDestinationsToSelect(destinations);
        })
        .catch(error => {
            console.error('Error:', error);
        });

}

const addOriginsToSelect = (origins) => {
    origins.forEach(origin => {
        const option = document.createElement('option');
        option.value = origin;
        option.text = origin;
        selectOrigin.appendChild(option);
    });
}

const loadedOrigins = (e) => {
    fetch('/get/origins')
        .then(response => response.json())
        .then(data => {

            const origins = data.origins;
            addOriginsToSelect(origins);
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });

}


document.addEventListener('DOMContentLoaded', loadedOrigins );
selectOrigin.addEventListener('change', loadedDestinations );
selectDestination.addEventListener('change', verifySeating );
selectDate.addEventListener('change', verifyDate );
