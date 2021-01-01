let bases = [];
let deptsEl = document.querySelectorAll('.dept');
let yearsFrom = document.querySelector('.year-from');
let yearsTo = document.querySelector('.year-to');
let depts = [];
let yearsAxis = [];
window.chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)',
};
for(let i = 0; i <deptsEl.length; i++) {
    depts.push(deptsEl[i].innerHTML);
}
let colorNames = Object.keys(window.chartColors);
let ids;

let config = {
    type: 'line',
    data: {
        labels: [],
        datasets: []
    },
    options: {
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
            label: 'Dataset ',
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
        title: {
            display: true,
            text: 'Προτιμήσεις Επιτυχόντων'
        },

    }
}

let statsRightConfig = {
    type: 'bar',
    data: {
        labels: ['1η', '2η', '3η', 'Άλλη'],
        datasets: [{
            label: 'Dataset ',
            backgroundColor: 'rgba(90,196,218,0.7)',
            borderColor: 'rgba(90,196,218,1)',
            borderWidth: 1,
            data: [0, 5, 2, 10]
        }]
    },
    options: {
        responsive: true,
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Προτιμήσεις Υποψηφίων'
        }
    }
}

let yearsFromValue = yearsFrom.value;
let yearsToValue = yearsTo.value;
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
})

//TODO: Refactor function
async function loadData() {
    let getParam = window.location.search.substr(1);
    ids = getParam.split('=');
    ids = ids[1].split(',');
    let data;
    for (let i = 0; i < ids.length; i++) {
        let result = await fetchBases(ids[i]);
        result = result['records'];
        let bases = result.map(x => x['baseLast']);
        let years = result.map(x => x["year"]);
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
        }
        config.data.datasets.push(data);
        config.data.labels = yearsAxis;
        window.myLine.update();
    }
    loadStatsData(yearSelect.value, ids[0]);
}

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
    let removeDeptBtns = document.querySelectorAll('.remove-dept');
    for (let i = 0; i < removeDeptBtns.length; i++) {
        removeDeptBtns[i].addEventListener('click', (e) => removeDept(e,i));
    }
    loadData();
    let deptContainers = document.querySelectorAll('.dept-container');
    for (let i = 0; i < deptContainers.length; i++) {
        deptContainers[i].addEventListener('click', (e) => showDetails(e));
    }
    let firstDept = document.querySelector('.dept-container');
    firstDept.classList.add('selected');
});
let statsId = document.querySelector('.base-details').id;
let yearSelect = document.querySelector('.year-select');
yearSelect.addEventListener('change', () => changeId());

function changeId() {
    statsId = document.querySelector('.base-details').id;
    loadStatsData(yearSelect.value, statsId);
}

async function loadStatsData(year, code) {
    let result = await fetchStats(year, code, 0);
    if (!("error" in result)) {
        let data = makeStatsData(result);
        statsRightConfig.data.datasets[0].data = data.data;
    } else {
        statsRightConfig.data.datasets[0].data = {};
    }
    window.myBarRight.update();
    result = await fetchStats(year, code, 1);
    if (!("error" in result)) {
        let data = makeStatsData(result);
        statsLeftConfig.data.datasets[0].data = data.data;
    } else {
        statsLeftConfig.data.datasets[0].data = {};
    }
    window.myBarLeft.update();
}

function makeStatsData(result) {
    let preferences = {
        count: result.map(x => x['count']),
        preference:  result.map(x => x['preference'])
    };
    let color = window.chartColors[colorNames[config.data.datasets.length % colorNames.length]];
    let data = {
        backgroundColor: color,
        borderColor: color,
        data: preferences.count
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
        if (config.data.datasets[y].index == i) {
            config.data.datasets = config.data.datasets.filter(data => data.index != i);
        }
    }
    window.myLine.update();

}

let okBtn = document.querySelector('.ok-btn');
okBtn.addEventListener('click', () => searchResult());

async function searchResult() {
    let deptCode = document.querySelector('.list').value.split('-');
    let result = await fetchBases(deptCode[0]);
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

async function fetchBases(code) {
    let url = `https://vaseis.iee.ihu.gr/api/index.php/bases/department/${code}?type=gel-ime-gen&details=full`;
    try {
        const response = await fetch(url, {
            method: 'GET',
            mode: 'cors',
            headers: {

            }
        });
        return await response.json();
    } catch (error) {
        console.error(error);
    }
}

async function  fetchStats(year, code, category) {
    let url = `https://vaseis.iee.ihu.gr/api/index.php/statistics/${year}/department/${code}/category/${category}?type=gel-ime-gen`;
    try {
        const response = await fetch(url, {
            method: 'GET'
        });
        return await response.json();
    } catch (error) {
        console.error(error);
    }
}

function createDeptContainer(result, index, code) {
    let baseEl = document.querySelector('.base');
    let deptContainer = document.createElement('div');
    deptContainer.className = 'dept-container';
    deptContainer.id = code;
    let removeEl = document.createElement('span');
    removeEl.className = 'remove-dept';
    removeEl.innerHTML = 'X';
    let deptEl = document.createElement('div');
    deptEl.className = 'dept';
    deptEl.innerHTML = result['records'][0]['deptName'];
    let uniEl = document.createElement('div');
    uniEl.className = 'uni';
    uniEl.innerHTML = result['records'][0]['uniTitle'];
    deptContainer.appendChild(removeEl);
    deptContainer.appendChild(deptEl);
    deptContainer.appendChild(uniEl);
    baseEl.appendChild(deptContainer);
    removeEl.addEventListener('click', (e) => removeDept(e, index));
    deptContainer.addEventListener('click', (e) => showDetails(e));
}

async function showDetails(e) {
    let selectedEl = e.currentTarget;
    let deptContainers = document.querySelectorAll('.dept-container');
    for (let i = 0; i < deptContainers.length; i++) {
        if (deptContainers[i].classList.contains('selected'))
            deptContainers[i].classList.remove('selected');
    }
    selectedEl.classList.add('selected');
    let dept = selectedEl.children[1].innerHTML;
    let uni = selectedEl.children[2].innerHTML;
    let result = await fetchBases(selectedEl.id);
    let data = result['records'].map(x => x['baseLast']);
    let years = result['records'].map(x => x['year']);
    let baseEl = document.querySelector('.base-details');
    baseEl.id = selectedEl.id;
    baseEl.children[1].innerHTML = "";
    for (let i = 0; i < data.length; i++) {
        baseEl.children[1].innerHTML += `<span><span class='year'> ${years[i]} :</span> ${data[i]}</span>`;
    }
    document.querySelector('.dept-title').innerHTML = dept;
    document.querySelector('.uni-title').innerHTML = uni;
    await loadStatsData(yearSelect.value, selectedEl.id);
}
