<div class="dashboard-card-header" style="background-color: #9c0f3f; color: white; text-align: center; padding: 1rem; border-radius: 8px 8px 0 0;">TOTAL DONORS AND RECIPIENTS</div>
<div id="totalUsersChart" style="width:100%; height:400px;"></div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Highcharts.chart('totalUsersChart', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: ['Donors', 'Recipients']
            },
            yAxis: {
                title: {
                    text: 'Count'
                },
                allowDecimals: false
            },
            series: [{
                name: 'Total Count',
                data: [{{ $totalDonors ?? 0 }}, {{ $totalRecipients ?? 0 }}],
                color: '#9c0f3f'
            }]
        });
    });
</script> 