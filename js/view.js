let bases = [];
let deptsEl = document.querySelectorAll('.dept');
let depts = [];
window.chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)'
};
let colorNames = Object.keys(window.chartColors);

for(let i = 0; i <deptsEl.length; i++) {
    depts.push(deptsEl[i].innerHTML);
}
let basesDiv = document.querySelectorAll('.dept-container');
// for (let i = 1; i < basesDiv.length -1; i++) {
//     console.log(basesDiv[i]);
//     let splittedDiv = basesDiv[i].innerHTML.split(' ');
//     years.push(splittedDiv[1].split(':')[0]);
//     bases.push(splittedDiv[2]);
//     console.log(years[i-1]);
// }

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
            intersect: false
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
//TODO: Refactor function
async function loadData() {
    let getParam = window.location.search.substr(1);
    let ids = getParam.split('=');
    ids = ids[1].split(',');
    let data;
    let yearsAxis = [];
    for (let i = 0; i < ids.length; i++) {
        let result = await fetchBases(ids[i]);
        result = result['records'];
        let bases = result.map(x => x['baseLast']);
        let years = result.map(x => x["year"]);
        let year = new Date;
        year = year.getFullYear();
        let latestDataYear = Math.max(...years);
        let earliestDataYear = Math.min(...years);
        console.log(earliestDataYear);
        if (earliestDataYear > 2013 ) {
            for (let y = earliestDataYear; y > 2013; y--) {
                bases.unshift(null);
                console.log(years);
            }
        }
        if (years.length > yearsAxis.length) {
            yearsAxis = years;
        }
        let dept = result[0]['deptName'];
        console.log(bases, dept);
        let color = window.chartColors[colorNames[config.data.datasets.length % colorNames.length]];
        data = {
            label: `Τμήμα ${dept}`,
            backgroundColor: color,
            borderColor: color,
            data: bases,
            fill: false
        }
        config.data.datasets.push(data);
        config.data.labels = yearsAxis;
        window.myLine.update();
    }

}

window.addEventListener('load', () => {
    let ctx = document.getElementById('myChart');
    window.myLine = new Chart(ctx, config);
    loadData();
})

let okBtn = document.querySelector('.ok-btn');
okBtn.addEventListener('click', () => searchResult());

async function searchResult() {
    let deptCode = document.querySelector('.list').value.split('-');
    let result = await fetchBases(deptCode[0]);
    console.log(result);
    let data = result['records'].map(x => x['baseLast']);
    console.log(data);
    let years = result['records'].map(x => x['year']);
    let earliestDataYear = Math.min(...years);
    if (earliestDataYear > 2013 ) {
        for (let y = earliestDataYear; y > 2013; y--) {
            data.unshift(null);
            console.log(years);
        }
    }
    let color = window.chartColors[colorNames[config.data.datasets.length % colorNames.length]];
    let newDataset = {
        label: `Τμήμα ${deptCode[1]}`,
        backgroundColor: color,
        borderColor: color,
        data: data,
        fill: false
    };
    config.data.datasets.push(newDataset);
    window.myLine.update();
    window.history.pushState('', 'Title', window.location.href + ',' + deptCode[0]);
    let baseEl = document.querySelector('.base');
    let deptContainer = document.createElement('div');
    deptContainer.className = 'dept-container';
    let deptEl = document.createElement('div');
    deptEl.className = 'dept';
    deptEl.innerHTML = result['records'][0]['deptName'];
    let uniEl = document.createElement('div');
    uniEl.className = 'uni';
    uniEl.innerHTML = result['records'][0]['uniTitle'];
    deptContainer.appendChild(deptEl);
    deptContainer.appendChild(uniEl);
    baseEl.appendChild(deptContainer);
}

async function fetchBases(code) {
    let url = `http://192.168.100.3/vaseis-app/api/bases/department/${code}?type=gel-ime-gen&details=full`;
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
