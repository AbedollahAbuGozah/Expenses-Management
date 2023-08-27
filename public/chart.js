const ctx = document.getElementById('myChart');
const ctx2 = document.getElementById('myChart3');
const ctx1 = document.getElementById('myChart2');
const ctx3 = document.getElementById('myChart4');
const data = jsonData.data
const labels = jsonData.labels
const $avaregeExpenseDay = jsonData.avaregeExpenseDay
const $avaregeExpenseMonth = jsonData.avaregeExpenseMonth
const $avaregeExpenseYear = jsonData.avaregeExpenseYear

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: '# of Expenses',
            data: data,
            backgroundColor: '#e94f37',
            categoryPercentage: .3,

        }],
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)',
                },
                ticks: {
                    font: {
                        weight: 'bold',
                    },
                },
            },
            x: {
                grid: {
                    display: false,
                },
                ticks: {
                    font: {
                        weight: 'bold',
                    },
                },
            },
        },
        plugins: {
            legend: {
                display: false,
            },
        },
    },
});

new Chart(ctx1, {
    type: 'doughnut',
    data: {
        labels: ['average of daily expenses'],
        datasets: [{
            label: '',
            data: $avaregeExpenseDay,
            backgroundColor: [
                '#e94f37',
                '#393e41'
            ],
            hoverOffset: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                display: false,
            }
        }
    }
});


new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ['average of monthly expenses'],
        datasets: [{
            label: 'Monthly Expense',
            data: ($avaregeExpenseMonth),
            backgroundColor: [
                '#e94f37',
                '#393e41'
            ],
            hoverOffset: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                display: false,

            }
        }
    }
});


new Chart(ctx3, {
    type: 'doughnut',
    data: {
        labels: ['average of Yearly expenses'],
        datasets: [{
            label: '',
            data: ($avaregeExpenseYear),
            backgroundColor: [
                '#e94f37',
                '#393e41'
            ],
            hoverOffset: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                display: false,
            }
        }
    }
});

document.getElementById("showFormButton").addEventListener("click", function () {
    var form = document.getElementById("expenseForm");
    form.style.backgroundColor = "white"
    form.style.width = " 50%";
    form.style.height = " 50%";
    form.style.opacity = "100%";
    var sec = document.getElementById("add_expenses");
    if (sec.style.display === "none") {
        sec.style.width = "100%";
        sec.style.height = "100%";
        sec.style.display = "flex";
        sec.style.top = "0";
        sec.style.backgroundColor = "rgb(0,0,0,0.5)";
        sec.style.justifyContent = "center";
        sec.style.alignItems = "center";
    } else {
        sec.style.display = "none";
        sec.style.display = "block";

    }
});

document.getElementById("Filter").addEventListener("click", function () {
    var form = document.getElementById("filterForm");
    form.style.backgroundColor = "white"
    form.style.width = " 50%";
    form.style.height = " 50%";
    form.style.opacity = "100%";
    var sec = document.getElementById("filters");
    if (sec.style.display === "none") {
        sec.style.width = "100%";
        sec.style.height = "100%";
        sec.style.display = "flex";
        sec.style.backgroundColor = "rgb(0,0,0,0.5)";
        sec.style.top = "0";
        sec.style.justifyContent = "center";
        sec.style.alignItems = "center";
    } else {
        sec.style.display = "none";
        sec.style.display = "block";

    }
});
document.getElementById("cancel1").addEventListener("click", function () {
    var sec = document.getElementById("filters");
    sec.style.display = "none";

});
document.getElementById("cancel2").addEventListener("click", function () {
    var sec = document.getElementById("add_expenses");
    sec.style.display = "none";

});
