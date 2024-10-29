const couriers_names = [
    'Азат',
    'Иван',
    'Рамиль',
    'Алексей',
    'Борис',
];

const couriers_surname = [
    'Миннегалиевич',
    'Рамилевич',
    'Николаевич',
    'Ильдарович',
    'Алексеевич',
];

const couriers_familyName = [
    'Гайнуллин',
    'Иванов',
    'Шарипов',
    'Сафин',
    'Смирнов',
];

function init() {
    initTable()
    initAddTrips()
    initAddCouriers()
    initCheckAllParams()
    initCheckSelectedDate()
}

const http = 'http://localhost:8080'



// =============== Selected Date

function initCheckSelectedDate() {
    let selectDate = document.getElementById('select-date')

    let selectedDateSelect = selectDate.querySelector('.selected-date-select')
    let checkDate = selectDate.querySelector('.check-date')


    selectedDateSelect.addEventListener('change', e => {
        let selectedDate = selectedDateSelect.options[selectedDateSelect.selectedIndex].textContent
        let selectDateInput  = selectDate.querySelector('.select-date-input')
        selectDateInput.classList.remove('warning')

        querySelectedDate(selectedDate)
    })

    checkDate.addEventListener('click', e => {
        let selectDate = document.getElementById('select-date')
        let selectDateInput  = selectDate.querySelector('.select-date-input')

        selectDateInput.value === '' && selectDateInput.classList.add('warning')
        !isValidDateFormatYMD(selectDateInput.value) && selectDateInput.classList.add('warning')
        selectDateInput.addEventListener('keydown', e => {
            selectDateInput.value !== '' &&  selectDateInput.classList.remove('warning')
        })
        selectDateInput.addEventListener('blur', e => {
            selectDateInput.value === '' &&  selectDateInput.classList.add('warning')
        })

        if (!selectDateInput.classList.contains('warning')) {
            querySelectedDate(selectDateInput.value)
        }
    })
}

function querySelectedDate(selectedDate) {
    fetchData(http + '/check-selected-date/' + selectedDate)
        .then(data => {
            drawTable(data.data)
        })
}



// =============== Couriers

function initAddCouriers() {
    let createCourier = document.getElementById('create-courier')

    let randomCourier  = createCourier.querySelector('.random-courier')
    let addCourier = createCourier.querySelector('.add-courier')

    randomCourier.addEventListener('click', e => {
        createRandomNSFCourier()

        let nsfInputArr = createCourier.querySelectorAll('.nsf-input')

        nsfInputArr.forEach((item) => {
            item.classList.remove('warning')
        })
    })

    addCourier.addEventListener('click', e => {
        let createCourier = document.getElementById('create-courier')

        let name  = createCourier.querySelector('.nsf-input-name')
        let surname  = createCourier.querySelector('.nsf-input-surname')
        let familyname  = createCourier.querySelector('.nsf-input-familyname')
        let nsfInputArr = createCourier.querySelectorAll('.nsf-input')

        nsfInputArr.forEach((item) => {
            item.value === '' && item.classList.add('warning')
            item.addEventListener('keydown', e => {
                item.value !== '' &&  item.classList.remove('warning')
            })
            item.addEventListener('blur', e => {
                item.value === '' &&  item.classList.add('warning')
            })
        })

        if (!name.classList.contains('warning') &&
            !surname.classList.contains('warning') &&
            !familyname.classList.contains('warning')) {
            let nsf = `${name.value} ${surname.value} ${familyname.value}`
            queryCreateCourier(nsf)
            nsfInputArr.forEach((item) => {
                item.value = ''
            })
        }

    })
}

function createRandomNSFCourier() {
    let createCourier = document.getElementById('create-courier')

    let name  = createCourier.querySelector('.nsf-input-name')
    let surname  = createCourier.querySelector('.nsf-input-surname')
    let familyname  = createCourier.querySelector('.nsf-input-familyname')

    name.value = getRandomIndex(couriers_names)
    surname.value = getRandomIndex(couriers_surname)
    familyname.value = getRandomIndex(couriers_familyName)
}

function queryCreateCourier(nsf) {
    fetchData(http + '/create-courier', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nsf: nsf })
    })
        .then(data => {
            checkAllCouriers()
        })
}

function  drawOptionCouriers(data) {
    let addTrip = document.getElementById('add-trip')
    let formCouriers = addTrip.querySelector('.form-couriers')
    let createTrip = addTrip.querySelector('.create-trip')
    let couriersAllBusy = addTrip.querySelector('.couriers-all-busy')

    formCouriers.innerHTML = ''

    let isBusyAll = true;

    data.forEach((item) => {
        let isBusy = item.is_busy;

        if (isBusyAll) {
            isBusyAll = isBusy;
        }

        addElement(formCouriers, newElementOption( item.id, item.name, isBusy))
    })

    if (isBusyAll) {
        formCouriers.disabled = true;
        createTrip.disabled = true;
        couriersAllBusy.classList.add('active')
    } else {
        formCouriers.disabled = false;
        createTrip.disabled = false;
        couriersAllBusy.classList.remove('active')
    }
}



// =============== Trips

function initAddTrips() {
    let addTrip = document.getElementById('add-trip')

    let formRegions = addTrip.querySelector('.form-regions')
    let createTrip = addTrip.querySelector('.create-trip')

    formRegions.addEventListener('change', e => {
        let regionId = formRegions.options[formRegions.selectedIndex].value

        queryTrips(regionId)
    })

    createTrip.addEventListener('click', e => {
        queryAddTrips()
    })
}

function queryAddTrips() {
    let table = document.getElementById('table')
    let activeTh = table.querySelector('.active')
    activeTh && activeTh.classList.remove('active')

    let addTrip = document.getElementById('add-trip')

    let formRegions = addTrip.querySelector('.form-regions')
    let formCouriers = addTrip.querySelector('.form-couriers')

    let regionId = formRegions.options[formRegions.selectedIndex].value
    let courierId = formCouriers.options[formCouriers.selectedIndex].value

    fetchData(http + '/add-trip', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ region: regionId, courier: courierId })
    })
        .then(data => {
            drawTable(data['dataAll'])
            drawOptionCouriers(data['dataCouriers'])
        })
}

function queryTrips(regionId) {
    fetchData(http + '/region/' + regionId)
        .then(data => {
            data = Object.entries(data)
            drawTripDate(data)
        })
}

function drawTripDate(region) {
    let addTrip = document.getElementById('add-trip')

    let travelDays = region[2][1]
    let travelDaysBack = region[3][1]

    let date = new Date();
    let departure_date = date.toISOString().slice(0, 10);

    date.setDate(date.getDate() + travelDays);
    let arrival_date = date.toISOString().slice(0, 10);

    date.setDate(date.getDate() + travelDaysBack);
    let return_date = date.toISOString().slice(0, 10);

    addTrip.querySelector('.form-departure').textContent = departure_date
    addTrip.querySelector('.form-arrival-a').textContent = arrival_date
    addTrip.querySelector('.form-arrival-b').textContent = arrival_date
    addTrip.querySelector('.form-return').textContent = return_date
}



// =============== Table

function initTable() {
    let table = document.getElementById('table')
    let thead = table.querySelector('thead')

    thead.addEventListener('click', e => {
        let target = e.target
        if (!target.classList.contains('sort')) return
        e.stopPropagation()

        let sortElements = Array.from(thead.querySelectorAll('th'));
        let thIndex = sortElements.indexOf(target);

        let up = target.classList.contains('up')

        removeAllClass('.sort', 'active', 'up')
        addClass(target, 'active', 'up')

        let attrParam = target.dataset.param;

        up && target.classList.remove('up')
        let attrSort = up ? 'DESC' : 'ASC'

        queryTableSort(attrParam, attrSort, thIndex)
    })
}

function queryTableSort(attrParam, attrSort, thIndex) {
    fetchData(http + '/sort/' + attrParam + '/' + attrSort)
        .then(data => {
            drawTable(data.data, thIndex)
        })
}

function drawTable(data, thIndex) {
    let table = document.getElementById('table')
    let tbody = table.querySelector('tbody')

    removeElement(table, tbody)

    createTbodyAddToTable(data, table, thIndex)
}



// =============== Helpers

function checkAllCouriers() {
    fetchData(http + '/get-all-couriers')
        .then(data => {
            drawOptionCouriers(data)
        })
}

async function fetchData(url, method = {}) {
    try {
        loader()
        const response = await fetch(url, method)

        if (!response.ok) throw new Error(`HTTP error ${response.status}`)

        let data = await response.json()
        loader()

        return data
    } catch (error) {
        console.error('Error fetching data:', error)
        throw error
    }
}

function createTbodyAddToTable(data, table, thIndex) {
    let tbody = newElement('tbody')

    let tableData = [
        'region',
        'departure_date',
        'arrival_date',
        'courier',
        'arrival_date',
        'return_date'
    ]
    let tableDataLength = tableData.length

    data.forEach( item => {
        let tr = newElement('tr')
        let selectedTd = 'selected_td'

        for (let i = 0; i < tableDataLength; i++) {
            addElement(tr, newElement(
                'td',
                (thIndex - 1 === i) && selectedTd,
                item[tableData[i]]
            ))
        }

        addElement(tbody, tr)
    })

    addElement(table, tbody)
}

function createElement(elem) {
    return document.createElement(elem)
}

function newElement(elem,
                    cssClass = '',
                    text = '',
                    attrParam = '') {
    elem = createElement(elem)
    elem.textContent = text
    if (cssClass !== '' && cssClass !== false) elem.className = cssClass
    if (attrParam !== '') elem.setAttribute('data-param', attrParam)

    return elem
}

function newElementOption(value, text, disabled) {
    let elem = createElement('option')
    elem.value = value
    elem.textContent = text
    if (disabled !== null) elem.disabled = true

    return elem
}

function initCheckAllParams() {
    checkAllCouriers();
}

function addElement(elem, add) {
    elem.appendChild(add)
}

function removeElement(elem, remove) {
    elem.removeChild(remove);
}

function removeAllClass(cls, ...clss) {
    cls = document.querySelectorAll(cls)
    cls.forEach(item => item.classList.remove(...clss))
}

function addClass(elem, ...clss) {
    elem.classList.add(...clss)
}

function findSelector(elem, css) {
    return elem.querySelector(css)
}

function loader() {
    let wrap = document.querySelector('.wrap-loader')

    let loader = findSelector(wrap, '.loader')

    if (loader === null)
        addElement(wrap, newElement('div', 'loader'))
    else
        removeElement(wrap, loader)
}

function getRandomIndex(arr) {
    let randomIndex = Math.floor(Math.random() * arr.length);
    return arr[randomIndex];
}

function isValidDateFormatYMD(date) {
    return /^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/.test(date);
}

init()

