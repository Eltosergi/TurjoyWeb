

const selectOrigin = document.getElementById('origins');
const selectDestination = document.getElementById('destinations');



const verifySeating = () => {
    const origin = selectOrigin.value;
    const destination = selectDestination.value;

    fetch(`/get/seating/${origin}/${destination}`)
        .then(response => response.json())
        .then(data => {
            const seating = data.seating;
            const seatingElement = document.getElementById('seating');
            seatingElement.innerHTML = seating;
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

const clearSelect = (select) => {
    while (selectDestination.firstChild) {
        selectDestination.removeChild(selectDestination.firstChild);
    };

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
