<div class="graph-card">
    <div class="graph-card-header">
        <h3>Total Active Donors and Recipients</h3>
    </div>
    <div class="graph-card-footer">
        <div id="activeUsersBarChart" style="height: 400px;"></div>
    </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Highcharts.chart('activeUsersBarChart', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Total Active Donors and Recipients',
                align: 'left'
            },
            xAxis: {
                categories: ['Active Donors', 'Active Recipients'],
                title: {
                    text: ''
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Number of Users',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' users'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Count',
                data: [{{ $totalActiveDonors ?? 0 }}, {{ $totalActiveRecipients ?? 0 }}],
                color: '#9c0f3f' // Matching your existing color
            }]
        });
    });
</script> 