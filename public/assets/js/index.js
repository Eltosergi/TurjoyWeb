
const selectOrigin = document.getElementById('origins');
const selectDestination = document.getElementById('destinations');
var dateSave = '';
const selectDate = document.getElementById('date');
const selectSeat = document.getElementById('seats');
const submitButton = document.getElementById('submit');
const form = document.getElementById('form');
const basePrice = document.getElementById('basePrice');
const dateErrorElement = document.getElementById('dateError');
const dateErrorElement2 = document.getElementById('dateErrorSelect');
const originErrorElement = document.getElementById('originError');
const destinationErrorElement = document.getElementById('destinationError');
const seatingErrorElement = document.getElementById('seatsError');
const seatingElement = document.getElementById('seats');
const seatingErrorElement2 = document.getElementById('noSeatsError');



/**
 * Funcion que verifica la cantidad de asientos disponibles para el viaje seleccionado
 */


const verifySeating = () => {
    const origin = selectOrigin.value;
    const destination = selectDestination.value;
    const date = selectDate.value;
    if(isNaN(Date.parse(date))){
        Swal.fire({
            icon: 'error',
            iconColor: '#fff',
            title: 'Oops...',
            text: 'La fecha seleccionada no es válida',
            confirmButtonColor: '#2ECC71',
            background: '#FF6B6B',
            color: '#fff',

        })
    }else{
        if(origin && destination && date){
            fetch(`/seating/${origin}/${destination}/${date}`)
            .then(response => response.json())
            .then(data => {
                const seating = data.seats;
                const trip = data.trip;
                if(seating <= 0){
                    seatingErrorElement2.style.display = 'block';
                    selectOrigin.value = '';
                    selectDestination.value = '';
                    selectDate.value = '';
                }else{
                addSeatsToSelect(seating, trip);
                }

            })
            .catch(error => {
                console.error('Error:', error);
            });

        }else{
            dateErrorElement2.style.display = 'block';
            selectOrigin.value = '';
            selectDestination.value = '';
            console.log('no hay datos');
        }

    }



}


const clearSelectSeat = () => {
    while (selectSeat.firstChild) {
        selectSeat.removeChild(selectSeat.firstChild);
    };

}

/**
 * función que limpia el select de destinos
 *
 */
const clearSelect = () => {

    while (selectDestination.firstChild) {
        selectDestination.removeChild(selectDestination.firstChild);
    };

}


/**
 * Función que agrega la cantidad de asientos disponibles para el viaje seleccionado
 * @param {number} seating
 */
const addSeatsToSelect = (seat, trip) => {
    clearSelectSeat();
    for (let i = 1; i<= seat; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.text = i;
        selectSeat.appendChild(option);
    }
    basePrice.value = trip.price;
}

/**
 * Función que agrega los destinos disponibles para el origen seleccionado en el select
 * @param {HTMLDivElement} destinations
 */
const addDestinationsToSelect = (destinations) => {
    clearSelect();
    const option = document.createElement('option');
    option.value = '';
    option.text = 'Seleccione un destino';
    option.selected = true;
    selectDestination.appendChild(option);
    destinations.forEach(destinations => {
        const option = document.createElement('option');
        option.value = destinations;
        option.text = destinations;
        selectDestination.appendChild(option);

    });

}



/**
 * Función que agrega los destinos disponibles para el origen seleccionado
 * @param {*} e
 */

const loadedDestinations = (e) => {

    const currentValue = selectOrigin.value;

    if(currentValue)
        fetch(`/get/destinations/${currentValue}`)
        .then(response => response.json())
        .then(data => {
            const destinations = data.destination;
            addDestinationsToSelect(destinations);
        })
        .catch(error => {
            console.error('Error:', error);
        });

}


/**
 *
 * @param {HTMLDivElement} origins
 */

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
        })
        .catch(error => {
            console.error('Error:', error);
        });

}


const verifySelects = () => {
    if (selectDate.value == '') {
        dateErrorElement2.style.display = 'block';
        selectOrigin.value = '';
        selectDestination.value = '';
        seatingElement.value = '';

    }
    if (selectOrigin.value == '') {
        originErrorElement.style.display = 'block';
        selectDestination.value = '';
        seatingElement.value = '';
        selectDate.value = '';

    }
    if (selectDestination.value == '') {
        destinationErrorElement.style.display = 'block';
        selectOrigin.value = '';
        seatingElement.value = '';
        selectDate.value = '';

    }
    if (seatingElement.value == '') {
        seatingErrorElement.style.display = 'block';
        selectOrigin.value = '';
        selectDestination.value = '';
        selectDate.value = '';

    }
}

const verifyDate = () => {
    var actualDate = new Date();
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
        dateSave = selectedDate;

    }


}

const dateChange = (dateChanged) => {

    if (dateChanged != dateSave) {
        selectDate.value = "";
        selectDestination.value = "";
        selectOrigin.value = "";
        seatingElement.value = "";
        return false

    }else{
        return true
    }
}
const emptySelects = ()=>{
    selectDestination.value = "";
    selectOrigin.value = "";
    seatingElement.value = "";


}

document.addEventListener('DOMContentLoaded', loadedOrigins );
selectDate.addEventListener('change', verifyDate);
selectDate.addEventListener('change', emptySelects);
selectOrigin.addEventListener('change', loadedDestinations );
selectDestination.addEventListener('change', verifySeating);
const button = document.getElementById("acceptButton");


button.addEventListener('click', (e) => {

    const selectedOrigin = document.getElementById('origins').value;
    const selectedDestination = document.getElementById('destinations').value;
    const selectedDate = document.getElementById('date').value;
    const selectedseats = document.getElementById('seats').value;
    const basePrice = document.getElementById('basePrice');
    const total = document.getElementById('basePrice').value * selectedseats;
    document.getElementById('total').value = total;
    const date = new Date(selectedDate);
    const dateChanged = date.toLocaleDateString();

    e.preventDefault();
    if (dateChange(selectedDate) == false) {
        Swal.fire({
            icon: 'error',
            iconColor: '#fff',
            title: 'Oops...',
            text: 'La fecha seleccionada no es válida',
            confirmButtonColor: '#2ECC71',
            background: '#FF6B6B',
            color: '#fff',

        })
    }

    if (selectedOrigin && selectedDestination && selectedDate  && selectedseats && basePrice) {

        Swal.fire({
            title: '¿Estas seguro de realizar la reserva?',
            text: `El total de la reserva entre ${selectedOrigin} y ${selectedDestination} para el día ${dateChanged} es de $${total.toLocaleString('es-ES')} (${selectedseats} asientos) . ¿Desea continuar?`,
            showCancelButton: true,
            confirmButtonColor: '#2ECC71',
            cancelButtonColor: '#FF6B6B',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Volver'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();

            }else{

            }
        });
    }else{
        verifySelects();
        console.log('no hay datos');
    }

});


