/*** GLOBAL VARIABLES ***/

let deptsEl = document.querySelectorAll('.dept');
let yearsFrom = document.querySelector('.year-from');
let yearsTo = document.querySelector('.year-to');
let depts = [];
let yearsAxis = [];
let ids;
let yearsFromValue = yearsFrom.value;
let okBtn = document.querySelector('.ok-btn');
let statsId = document.querySelector('.base-details').id;
let yearSelect = document.querySelector('.year-select');
let baseYearSelect = document.querySelector('.base-year-select');
window.chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)',
};
let colorNames = Object.keys(window.chartColors);
let typeSelect = document.querySelector('.type-select');
let showLegend = document.querySelector('.show-legend');
let deptCheckboxes;

/*** EVENT LISTENERS ***/

yearsFrom.addEventListener('change', () => {
    let yearsRange = Number(yearsTo.value) - Number(yearsFrom.value);
    if (yearsTo.value - yearsFrom.value > 0) {
        if (yearsRange >= yearsAxis.length) {
            yearsAxis.unshift(yearsFrom.value);
        } else {
            yearsAxis.shift();
        }
        window.myLine.update();
    } else {
        yearsFrom.value = Number(yearsFrom.value) - 1;
    }
    yearsFromValue = yearsFrom.value;
});

yearsTo.addEventListener('change', () => {
    let yearsRange = Number(yearsTo.value) - Number(yearsFrom.value);
    if (yearsTo.value - yearsFrom.value > 0) {
        if (yearsRange >= yearsAxis.length) {
            yearsAxis.push(yearsTo.value);
        } else {
            yearsAxis.pop();
        }
        window.myLine.update();
    } else {
        yearsTo.value = Number(yearsTo.value) + 1;
    }
});

window.addEventListener('load', () => {
    let ctx = document.getElementById('myChart');
    window.myLine = new Chart(ctx, config);
    let statsLeftCtx = document.getElementById('stats-left');
    window.myBarLeft = new Chart(statsLeftCtx, statsLeftConfig);
    let statsRightCtx = document.getElementById('stats-right');
    window.myBarRight = new Chart(statsRightCtx, statsRightConfig);
    for (let i = yearsFrom.value; i <= yearsTo.value; i++) {
        yearsAxis.push(i);
    }
    for(let i = 0; i <deptsEl.length; i++) {
        depts.push(deptsEl[i].innerHTML);
    }
    let removeDeptBtns = document.querySelectorAll('.remove-dept');
    for (let i = 0; i < removeDeptBtns.length; i++) {
        removeDeptBtns[i].addEventListener('click', (e) => removeDept(e,i));
    }
    let deptContainers = document.querySelectorAll('.dept-container');
    for (let i = 0; i < deptContainers.length; i++) {
        deptContainers[i].addEventListener('click', (e) => showDetails(e));
    }
    let firstDept = document.querySelector('.dept-container');
    firstDept.classList.add('selected');
    loadData(0);
});

okBtn.addEventListener('click', () => searchResult());

yearSelect.addEventListener('change', () => changeId());

baseYearSelect.addEventListener('change', () => changeBaseData());

typeSelect.addEventListener('change', () => changeType());

showLegend.addEventListener('change', () => toggleLegend());

/*** FUNCTIONS ***/

async function loadData(type) {
    let getParam = window.location.search.substr(1);
    ids = getParam.split('=');
    ids = ids[1].split(',');
    await workData(type);
    let maxYear = await fetchMinMaxStatYear(1, ids[0]);
    maxYear = maxYear["maxYear"];
    await loadStatsData(maxYear, ids[0], type);
}

/**
 * Loads base chart by providing the type of school.
 * @param type type of school
 * @returns {Promise<void>}
 */
async function workData(type) {
    let data;
    let yearsFirst;
    for (let i = 0; i < ids.length; i++) {
        let result = await fetchBases(ids[i], type);
        if(!("error" in result)) {
            result = result['records'];
            let bases = result.map(x => x['baseLast']);
            let years = result.map(x => x["year"]);
            if (i === 0) yearsFirst = years;
            let year = new Date;
            year = year.getFullYear();
            let earliestDataYear = Math.min(...years);
            if (earliestDataYear > 2013 && yearsAxis.length > years.length) {
                for (let y = earliestDataYear; y > yearsFrom.value; y--) {
                    bases.unshift(null);
                }
            }
            let dept = result[0]['deptName'];
            let color = window.chartColors[colorNames[config.data.datasets.length % colorNames.length]];
            data = {
                label: `Τμήμα ${dept}`,
                backgroundColor: color,
                borderColor: color,
                data: bases,
                fill: false,
                index: i,
                years: years
            }
            if (ids.length > 10) {
                config.options.legend.display = false;
                document.querySelector('.show-legend').checked = true;
            }
            config.data.datasets.push(data);
            config.data.labels = yearsAxis;
            window.myLine.update();
        }
    }
}

async function changeId() {
    statsId = document.querySelector('.base-details').id;
    let year = document.querySelector('.year-select').value;
    let selectValue = document.querySelector('.type-select').value;
    let type;
    if (selectValue === "ΓΕΛ") type = 0;
        else if (selectValue === "ΕΠΑΛ") type = 1;
    await loadStatsData(year, statsId, type);
}

/**
 * Loads stats charts.
 * @param maxYear year of data to fetch
 * @param code code of department
 * @param type type of school
 * @returns {Promise<void>}
 */
async function loadStatsData(maxYear, code, type) {
    let result = await fetchStats(maxYear, code, 0, type);
    let data = makeStatsData(result);
    statsRightConfig.data.datasets[0].data = data.data;
    window.myBarRight.update();
    result = await fetchStats(maxYear, code, 1, type);
    data = makeStatsData(result);
    statsLeftConfig.data.datasets[0].data = data.data;
    window.myBarLeft.update();
}

function compareBaseStatsData(minYear) {
    let selectedIndex;
    let deptContainers = document.querySelectorAll('.dept-container');
    if (deptContainers.length === 0) {
        return clearDetails();
    }
    for (let i = 0; i < deptContainers.length; i++) {
        if (deptContainers[i].classList.contains('selected')) {
            selectedIndex = i;
        }
    }
    let selectedData = config.data.datasets.filter(x => x.index === selectedIndex);
    let minBaseYear = Math.min(...selectedData[0].years);
    if (minYear < minBaseYear) {
        minYear = minBaseYear;
    }
    return minYear;
}

function clearDetails() {
    window.location.replace("https://vaseis.iee.ihu.gr");
    // document.body.scrollTop = 0;
    // document.documentElement.scrollTop = 0;
    // let url = window.location.href;
    // url = url.split('?');
    // url = url[0];
    // window.history.pushState('', 'Title', url);
    // document.querySelector('.details').style.display = "none";
    // return 0;
}

/**
 * Fetches min and max year of data for selected dept and builds option values
 * @param code Department code
 * @returns {Promise<*>}
 */
async function resetSelect(code) {
    let minYear = await fetchMinMaxStatYear(0, code);
    minYear = minYear['minYear'];
    let maxYear = await  fetchMinMaxStatYear(1, code);
    maxYear = maxYear['maxYear'];
    minYear = compareBaseStatsData(minYear);
    let yearSelect = document.querySelector('.year-select');
    buildSelect('year-select', minYear, maxYear);
    minYear = await fetchMinMaxBaseYearByDept(0, code);
    minYear = minYear['minYear'];
    maxYear = await fetchMinMaxBaseYearByDept(1, code);
    maxYear = maxYear['maxYear'];
    yearSelect = document.querySelector('.base-year-select');
    buildSelect('base-year-select', minYear, maxYear);
    return maxYear;
}

function buildSelect(select, minYear, maxYear) {
    while (document.querySelector(`.${select}`).firstChild) {
        document.querySelector(`.${select}`).removeChild(document.querySelector(`.${select}`).lastChild);
    }
    for (let i = minYear; i <= maxYear; i++) {
        let option = document.createElement('option');
        option.value = String(i);
        option.innerHTML = String(i);
        if (i === maxYear) {
            option.selected = true;
        }
        document.querySelector(`.${select}`).appendChild(option);
    }
}

function makeStatsData(result) {
    let data = {};
    if (result !== undefined) {
        if (!("error" in result)) {
            let preferences = {
                count: result.map(x => x['count']),
                preference:  result.map(x => x['preference']),
                year: result.map(x => x['year'])
            };
            let color = window.chartColors[colorNames[config.data.datasets.length % colorNames.length]];
            data = {
                backgroundColor: color,
                borderColor: color,
                data: preferences.count
            }
        }
    }
    return data;
}

function removeDept(e, i) {
    e.target.parentElement.remove();
    let code = e.target.parentElement.id;
    let url = window.location.href;
    url = url.replace(code, "");
    url = url.replace(',,', ',');
    url = url.replace('=,', '=');
    if (url.charAt(url.length-1) === ',') url = url.substr(0, url.length -1);
    window.history.pushState('', 'Title', url);
    for (let y = 0; y < config.data.datasets.length; y++) {
        if (config.data.datasets[y].index === i) {
            config.data.datasets = config.data.datasets.filter(data => data.index !== i);
        }
    }
    window.myLine.update();
    let deptContainers = document.querySelectorAll('.deptContainer');
    if (deptContainers.length === 0) {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
}

async function searchResult() {
    let deptCode = document.querySelector('.list').value.split('-');
    let typeValue = document.querySelector('.type-select').value;
    let type;
    if (typeValue === "ΓΕΛ") type = 0;
        else if (typeValue === "ΕΠΑΛ") type = 1;
    let result = await fetchBases(deptCode[0], type);
    let data = result['records'].map(x => x['baseLast']);
    let years = result['records'].map(x => x['year']);
    let earliestDataYear = Math.min(...years);
    if (earliestDataYear > 2013 ) {
        for (let y = earliestDataYear; y > 2013; y--) {
            data.unshift(null);
        }
    }
    let color = window.chartColors[colorNames[config.data.datasets.length % colorNames.length]];
    let indexes = config.data.datasets.map(x => x["index"]);
    let maxIndex = Math.max(...indexes);
    let newDataset = {
        label: `Τμήμα ${deptCode[1]}`,
        backgroundColor: color,
        borderColor: color,
        data: data,
        fill: false,
        index: Number(maxIndex) + 1,
        years: years
    };
    if (years.length > yearsAxis.length) {
        yearsAxis = years;
    }
    config.data.datasets.push(newDataset);
    config.data.labels = yearsAxis;
    window.myLine.update();
    window.history.pushState('', 'Title', window.location.href + ',' + deptCode[0]);
    createDeptContainer(result, newDataset.index, deptCode[0]);
    document.querySelector('.list').value = "";
}

function createDeptContainer(result, index, code) {
    let baseEl = document.querySelector('.dept-list');
    let anchor = document.createElement('a');
    anchor.href = '#details';
    let deptContainer = document.createElement('div');
    deptContainer.className = 'dept-container';
    deptContainer.id = code;
    let removeEl = document.createElement('span');
    removeEl.className = 'remove-dept';
    removeEl.innerHTML = 'X';
    let deptEl = document.createElement('div');
    deptEl.className = 'dept';
    deptEl.innerHTML = 'Τμήμα ' + result['records'][0]['deptName'];
    let uniEl = document.createElement('div');
    uniEl.className = 'uni';
    uniEl.innerHTML = result['records'][0]['uniTitle'];
    deptContainer.appendChild(removeEl);
    deptContainer.appendChild(deptEl);
    deptContainer.appendChild(uniEl);
    anchor.appendChild(deptContainer);
    baseEl.appendChild(anchor);
    removeEl.addEventListener('click', (e) => removeDept(e, index));
    deptContainer.addEventListener('click', (e) => showDetails(e));
}

/**
 * Event function for dept containers, toggles selected class and calls workDetails.
 * @param e
 * @returns {Promise<void>}
 */
async function showDetails(e) {
    let selectedEl = e.currentTarget;
    let deptContainers = document.querySelectorAll('.dept-container');
    for (let i = 0; i < deptContainers.length; i++) {
        if (deptContainers[i].classList.contains('selected'))
            deptContainers[i].classList.remove('selected');
    }
    selectedEl.classList.add('selected');
    await workDetails(selectedEl);
}

/**
 * Collects data about the selected elements and prints it.
 * @param selectedEl - the dept container that is selected
 * @returns {Promise<void>}
 */
async function workDetails(selectedEl) {
    let dept = selectedEl.children[1].innerHTML;
    let uni = selectedEl.children[2].innerHTML;
    let typeValue = document.querySelector('.type-select').value;
    let type;
    if (typeValue === "ΓΕΛ") type = 0;
    else if (typeValue === "ΕΠΑΛ") type = 1;
    let maxYear = await resetSelect(selectedEl.id);
    await loadBaseData(maxYear, selectedEl.id, type);
    await loadStatsData(maxYear, selectedEl.id, type);
    document.querySelector('.dept-title').innerHTML = dept;
    document.querySelector('.uni-title').innerHTML = uni;
}

// async function showChangedTypeDetails() {
//     let deptContainers = document.querySelectorAll('.dept-container');
//     deptContainers = Array.from(deptContainers);
//     let dept = deptContainers.filter(x => x.classList.contains('selected'));
//     //await workDetails(dept[0]);
//     let year = document.querySelector('.base-year-select').value;
//     let code = dept.id;
//
//     loadBaseData()
// }

/**
 * Event function preparing data and calling other functions to load new
 * data based on type of school selection
 * @returns {Promise<void>}
 */
async function changeType() {
    config.data.datasets = [];
    let getParam = window.location.search.substr(1);
    ids = getParam.split('=');
    ids = ids[1].split(',');
    let selectValue = document.querySelector('.type-select').value;
    let type;
    if (selectValue === "ΓΕΛ") type = 0;
        else type = 1;
    // loads base chart based on type selected
    await workData(type);
    let year = document.querySelector('.year-select').value;
    let deptContainers = document.querySelectorAll('.dept-container');
    deptContainers = Array.from(deptContainers);
    let dept = deptContainers.filter(x => x.classList.contains('selected'));
    let deptId = dept[0].id;
    await loadBaseData(year, deptId, type);
    //loads stats charts based on properties provided
    await loadStatsData(year, deptId, type);
}

function toggleLegend() {
    config.options.legend.display = !config.options.legend.display;
    window.myLine.update();
}

async function changeBaseData() {
    statsId = document.querySelector('.base-details').id;
    let year = document.querySelector('.base-year-select').value;
    let selectValue = document.querySelector('.type-select').value;
    let type;
    if (selectValue === "ΓΕΛ") type = 0;
    else if (selectValue === "ΕΠΑΛ") type = 1;
    await loadBaseData(year, statsId, type);
    if (type === 0) type = 2;
    else type = 3;
    await loadBaseData(year, statsId, type);
}

/**
 * Fetches and prints bases.
 * @param year year of data to fetch
 * @param code code of department
 * @param type type of school
 * @returns {Promise<void>}
 */
async function loadBaseData(year, code, type) {
    let result = await fetchBasesByYear(year, code, type);
    let baseEl = document.querySelector('.base-details');
    if (!("error" in result)) {
        let baseFirst = result['records'].map(x => x['baseFirst']);
        let baseLast = result['records'].map(x => x['baseLast']);
        let positions = result['records'].map(x => x['positions']);
        baseEl.id = code;
        baseEl.children[4].innerHTML = "";
        baseEl.children[4].innerHTML += `<span><span class="year">Βαθμός Πρώτου: </span>
            ${baseFirst}</span><span><span class="year">Βαθμός Τελευταίου: </span> ${baseLast}</span>
            <span><span class="year"> Εισακτέοι: </span>${positions}</span>`
    }
    if (type === 0) type = 2;
        else type = 3;
    result = await fetchBasesByYear(year, code, type);
    if (!("error" in result)) {
        let baseFirst = result['records'].map(x => x['baseFirst']);
        let baseLast = result['records'].map(x => x['baseLast']);
        let positions = result['records'].map(x => x['positions']);

        baseEl.children[6].innerHTML = "";
        baseEl.children[6].innerHTML += `<span>${year-2}: <span class="year">Βαθμός Πρώτου: </span> ${baseFirst[0]}
             </span><span><span class="year">Βαθμός Τελευταίου: </span> ${baseLast[0]}</span>
             </span><span><span class="year">Εισακτέοι: </span>${positions[0]}</span><br>
             <span>${year-1}: <span class="year">Βαθμός Πρώτου: </span> ${baseFirst[1]}
             </span><span><span class="year">Βαθμός Τελευταίου: </span> ${baseLast[1]}</span>
             </span><span><span class="year">Εισακτέοι: </span>${positions[1]}</span>`;
    }
}



/*** FETCH FUNCTIONS ***/
/**
 * @param year
 * @param code
 * @param type
 * @returns {Promise<any>}
 */
async function  fetchBasesByYear(year, code, type) {
    let url;
    if (type === 0) {
        url = `https://vaseis.iee.ihu.gr/api/index.php/bases/${year}/department/${code}?type=gel-ime-gen&details=full`;
    } else if (type === 1) {
        url = `https://vaseis.iee.ihu.gr/api/index.php/bases/${year}/department/${code}?type=epal-ime-gen&details=full`;
    } else if (type === 2) {
        url = `https://vaseis.iee.ihu.gr/api/index.php/bases/${year}/department/${code}?type=gel-ime-ten&details=full`;
    } else if (type === 3) {
        url = `https://vaseis.iee.ihu.gr/api/index.php/bases/${year}/department/${code}?type=epal-ime-ten&details=full`;
    }
    try {
        const response = await fetch(url, {
            method: 'GET'
        });
        return await response.json();
    } catch (error) {
        console.error(error)
    }
}

async function fetchBases(code, type) {
    let url;
    if (type === 0) {
        url = `https://vaseis.iee.ihu.gr/api/index.php/bases/department/${code}?type=gel-ime-gen&details=full`;
    } else if (type === 1) {
        url = `https://vaseis.iee.ihu.gr/api/index.php/bases/department/${code}?type=epal-ime-gen&details=full`;
    } else if (type === 2) {
        url = `https://vaseis.iee.ihu.gr/api/index.php/bases/department/${code}?type=gel-ime-ten&details=full`;
    } else if (type === 3) {
        url = `https://vaseis.iee.ihu.gr/api/index.php/bases/department/${code}?type=epal-ime-ten&details=full`;
    }
    try {
        const response = await fetch(url, {
            method: 'GET',
        });
        return await response.json();
    } catch (error) {
        console.error(error);
    }
}

async function  fetchStats(year, code, category, type) {
    let url;
    if (type === 0) {
        url = `https://vaseis.iee.ihu.gr/api/index.php/statistics/${year}/department/${code}/category/${category}?type=gel-ime-gen`;
    } else if (type === 1) {
        url = `https://vaseis.iee.ihu.gr/api/index.php/statistics/${year}/department/${code}/category/${category}?type=epal-ime-gen`;
    }
    try {
        const response = await fetch(url, {
            method: 'GET'
        });
        return await response.json();
    } catch (error) {
        console.error(error);
    }
}

async function fetchMinMaxBaseYear(type) {
    let url;
    if(type === 0) {
        url = `https://vaseis.iee.ihu.gr/api/index.php/bases/?year=min`;
    } else {
        url = `https://vaseis.iee.ihu.gr/api/index.php/bases/?year=max`;
    }
    try {
        const response = await fetch(url, {
            method: 'GET'
        });
        return await response.json();
    } catch (error) {
        console.error(error);
    }
}

async function fetchMinMaxBaseYearByDept(type, code) {
    let url;
    if (type === 0) {
        url = `https://vaseis.iee.ihu.gr/api/index.php/bases/department/${code}?year=min`;
    } else {
        url = `https://vaseis.iee.ihu.gr/api/index.php/bases/department/${code}?year=max`;
    }
    try {
        const response = await fetch(url, {
            method: 'GET'
        });
        return await response.json();
    } catch (error) {
        console.error(error);
    }
}

async  function fetchMinMaxStatYear(type, code) {
    let url;
    if(type === 0) {
        url = `https://vaseis.iee.ihu.gr/api/index.php/statistics/department/${code}?year=min`;
    } else {
        url = `https://vaseis.iee.ihu.gr/api/index.php/statistics/department/${code}?year=max`;
    }
    try {
        const response = await fetch(url, {
            method: 'GET'
        });
        return await response.json();
    } catch (error) {
        console.error(error);
    }
}

/*** CHART CONFIGS ***/

let config = {
    type: 'line',
    data: {
        labels: [],
        datasets: []
    },
    options: {
        maintainAspectRatio: true,
        legend: {
            display: true
        },
        responsive: true,
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Έτος'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Βάση'
                }
            }]
        }
    }
}

let statsLeftConfig = {
    type: 'bar',
    data: {
        labels: ['1η', '2η', '3η', '4η', '5η', '6η', 'Άλλη'],
        datasets: [{
            label: 'Προτιμήσεις Επιτυχόντων',
            backgroundColor: 'rgba(90,196,218,0.7)',
            borderColor: 'rgba(90,196,218,1)',
            borderWidth: 1,
            data: []
        }],
        backgroundColor: 'rgba(90,196,218,0.7)',
        borderColor: 'rgba(90,196,218,1)',
        borderWidth: 1,
        data: []
    },
    options: {
        responsive: true,
        legend: {
            position: 'top',
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Επιλογή'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Πλήθος'
                }
            }]
        }
    }
}

let statsRightConfig = {
    type: 'bar',
    data: {
        labels: ['1η', '2η', '3η', 'Άλλη'],
        datasets: [{
            label: 'Προτιμήσεις Υποψηφίων',
            backgroundColor: 'rgba(90,196,218,0.7)',
            borderColor: 'rgba(90,196,218,1)',
            borderWidth: 1,
            data: []
        }]
    },
    options: {
        responsive: true,
        legend: {
            position: 'top',
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Επιλογή'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Πλήθος'
                }
            }]
        }
    }
}
