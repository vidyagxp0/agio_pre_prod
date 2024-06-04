<div class="my-4">
    <div class="card" style="width: 26rem;">
        <div class="card-body">
          <h5 class="card-title">Processes</h5>
          
            <div class="card-text d-flex justify-content-center" id="processChart">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js" integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    function renderProcessChart(series, labels)
    {
        var options = {
            series,
            chart: {
            width: 350,
            type: 'pie',
            },
            labels,
            responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                width: 200
                },
                legend: {
                position: 'bottom'
                }
            }
            }]
        };

        var processChart = new ApexCharts(document.querySelector("#processChart"), options);
        processChart.render();
    }

    async function prepareProcessChart()
    {
        $('#processChart > .spinner-border').show();

        try {
            const url = "{{ route('api.process.chart') }}"
            const res = await axios.get(url);

            console.log('res', res.data)


            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let series = []
                let labels = []

                for (const key in bodyData) {
                    labels.push(bodyData[key].classname)
                    series.push(bodyData[key].count)
                }

                renderProcessChart(series, labels)
            }

        } catch (err) {
            console.log('Error in process chart', err.message);
        }

        $('#processChart > .spinner-border').hide();
    }

    prepareProcessChart()
      
</script>