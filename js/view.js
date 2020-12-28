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
    grey: 'rgb(201, 203, 207)'
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
        label: 'Dataset ',
        backgroundColor: colorNames[0],
        borderColor: colorNames[0],
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
        label: 'Dataset ',
        backgroundColor: colorNames[0],
        borderColor: colorNames[0],
        borderWidth: 1,
        data: []
    },
    options: {
        responsive: true,
        legend: {
            position: 'top',
        },


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
        config.data.datasets.push(data);
        config.data.labels = yearsAxis;
        window.myLine.update();
    }

}

window.addEventListener('load', () => {
    let ctx = document.getElementById('myChart');
    window.myLine = new Chart(ctx, config);
    let statsLeftCtx = document.getElementById('stats-left');
    window.myBarLeft = new Chart(statsLeftCtx, statsLeftConfig);
    let statsRightCtx = document.getElementById('stats-right');
    window.myBarRight = new Chart(statsRightCtx, statsRightConfig);
    let year = new Date;
    year = year.getFullYear();
    let earliestYear = year - yearsFrom.value;
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
})

function removeDept(e, i) {
    e.target.parentElement.remove();
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
    createDeptContainer(result, newDataset.index);
}

async function fetchBases(code) {
    let url = `http://192.168.2.11/vaseis-app/api/bases/department/${code}?type=gel-ime-gen&details=full`;
    try {
        const response = await fetch(url, {
            method: 'GET',
        });
        const result = await response.json();
        return result;
    } catch (error) {
        console.error(error);
    }
}

function createDeptContainer(result, index) {
    let baseEl = document.querySelector('.base');
    let deptContainer = document.createElement('div');
    deptContainer.className = 'dept-container';
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

function showDetails(e) {

}
