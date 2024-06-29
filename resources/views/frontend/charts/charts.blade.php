<div class="my-4 row">
    <div class="col-sm-6">
        <div class="card border-0" style="width: 26rem;">
            <div class="card-body">
                <h5 class="card-title">Deviation Delay and On Time</h5>

                <div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100"
                    id="delayedCharts">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="card border-0" style="width: 26rem;">
            <div class="card-body">
                <h5 class="card-title">Deviation By Site</h5>

                <div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100"
                    id="documentSiteCharts">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-4 row">
    <div class="col-sm-6">
        <div class="card border-0" style="width: 26rem;">
            <div class="card-body">
                <h5 class="card-title">Priority Levels (Risk Management)</h5>

                <div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100"
                    id="priorityLevelChart">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="card border-0" style="width: 26rem;">
            <div class="card-body">
                <h5 class="card-title">Priority Levels (RCA)</h5>

                <div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100"
                    id="priorityLevelChartRca">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="my-4 row">

    <div class="col-sm-6">
        <div class="card border-0" style="width: 26rem;">
            <div class="card-body">
              <h5 class="card-title">Deviation By Classification</h5>
              
                <div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="deviationClassificationChart">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="card border-0" style="width: 26rem;">
            <div class="card-body">
              <h5 class="card-title">Deviation By Departments</h5>
              
                <div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="deviationDepartmentChart">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-4 row">
    <div class="col-sm-6">
        <div class="card border-0" style="width: 26rem;">
            <div class="card-body">
              <h5 class="card-title">Processes</h5>
              
                <div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="processChart">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="col-sm-6">
        <div class="card border-0" style="width: 26rem;">
            <div class="card-body">
                <h5 class="card-title">Deviation by Severity</h5>

                <div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100"
                    id="deviationSeverityChart">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>
<h4>Documents Analytics</h4>

<div class="my-4 row">

  <div class="col-sm-6">

    <ul class="nav nav-tabs" id="myTab4" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab2" data-bs-toggle="tab" data-bs-target="#hodAnalysisBar" type="button" role="tab" aria-controls="home" aria-selected="true">Bar</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab2" data-bs-toggle="tab" data-bs-target="#hodAnalysisPie" type="button" role="tab" aria-controls="profile" aria-selected="false">Pie</button>
      </li>
    </ul>

    <div class="tab-content" id="myTabContent2">

      <div class="tab-pane fade show active" id="hodAnalysisBar" role="tabpanel" aria-labelledby="home-tab">
        
        <div class="card border-0" style="width: 26rem;">
          <div class="card-body">
            <h5 class="card-title">Pending HOD Analysis</h5>
            
				<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="pendingHODAnalysis">
					<div class="spinner-border" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
				</div>
              
          </div>
        </div>

      </div>

      <div class="tab-pane fade" id="hodAnalysisPie" role="tabpanel" aria-labelledby="profile">
        
        <div class="card border-0" style="width: 26rem;">
          <div class="card-body">
            <h5 class="card-title">Pending HOD Analysis</h5>
            
				<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="pendingHODAnalysisPie">
				</div>
              
          </div>
        </div>

      </div>
    
    </div>

  </div>

  <div class="col-sm-6">

	<ul class="nav nav-tabs" id="myTab1" role="tablist">
		<li class="nav-item" role="presentation">
		  <button class="nav-link active" id="home-tab2" data-bs-toggle="tab" data-bs-target="#pendingTrainingBar" type="button" role="tab" aria-controls="home" aria-selected="true">Bar</button>
		</li>
		<li class="nav-item" role="presentation">
		  <button class="nav-link" id="profile-tab2" data-bs-toggle="tab" data-bs-target="#pendingTrainingPie" type="button" role="tab" aria-controls="profile" aria-selected="false">Pie</button>
		</li>
	</ul>

	<div class="tab-content" id="myTabContent3">

		<div class="tab-pane fade show active" id="pendingTrainingBar" role="tabpanel" aria-labelledby="home-tab">
		
			<div class="card border-0" style="width: 26rem;">
				<div class="card-body">
				  <h5 class="card-title">Pending Training Analysis</h5>
				  
					<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="pendingTrainingAnalysis">
						<div class="spinner-border" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
			</div>
			
		</div>

		<div class="tab-pane fade" id="pendingTrainingPie" role="tabpanel" aria-labelledby="home-tab">
		
			<div class="card border-0" style="width: 26rem;">
				<div class="card-body">
				  <h5 class="card-title">Pending Training Analysis</h5>
				  
					<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="pendingTrainingAnalysisPie">
						
					</div>
				</div>
			</div>

		</div>

	</div>

</div>

</div>

<div class="my-4 row">
  <div class="col-sm-6">

	<ul class="nav nav-tabs" id="myTab3" role="tablist">
		<li class="nav-item" role="presentation">
		  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#pendingReviewBar" type="button" role="tab" aria-controls="home" aria-selected="true">Bar</button>
		</li>
		<li class="nav-item" role="presentation">
		  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#pendingReviewPie" type="button" role="tab" aria-controls="profile" aria-selected="false">Pie</button>
		</li>
	</ul>

	<div class="tab-content" id="myTabContent4">

		<div class="tab-pane fade show active" id="pendingReviewBar" role="tabpanel" aria-labelledby="home-tab">
			<div class="card border-0" style="width: 26rem;">
				<div class="card-body">
				  <h5 class="card-title">Pending Review Analysis</h5>
				  
					<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="pendingReviewAnalysis">
						<div class="spinner-border" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="tab-pane fade" id="pendingReviewPie" role="tabpanel" aria-labelledby="home-tab">
			<div class="card border-0" style="width: 26rem;">
				<div class="card-body">
				  <h5 class="card-title">Pending Review Analysis</h5>
				  
					<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="pendingReviewAnalysisBar">

					</div>
				</div>
			</div>
		</div>
	
	</div>
  </div>

  {{-- PENDING APPROVAL ANALYSIS START --}}
  <div class="col-sm-6">

	<ul class="nav nav-tabs" id="myTab3" role="tablist">
		<li class="nav-item" role="presentation">
		  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#pendingApprovalBar" type="button" role="tab" aria-controls="home" aria-selected="true">Bar</button>
		</li>
		<li class="nav-item" role="presentation">
		  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#pendingApprovalPie" type="button" role="tab" aria-controls="profile" aria-selected="false">Pie</button>
		</li>
	</ul>

	<div class="tab-content" id="myTabContent4">

		<div class="tab-pane fade show active" id="pendingApprovalBar" role="tabpanel" aria-labelledby="home23-tab">
			<div class="card border-0" style="width: 26rem;">
				<div class="card-body">
				  <h5 class="card-title">Pending Approval Analysis</h5>
				  
					<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="pendingApproveAnalysis">
						<div class="spinner-border" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="pendingApprovalPie" role="tabpanel" aria-labelledby="home23-tab">
			<div class="card border-0" style="width: 26rem;">
				<div class="card-body">
				  <h5 class="card-title">Pending Approval Analysis</h5>
				  
					<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="pendingApproveAnalysisPie">

					</div>
				</div>
			</div>
		</div>
	
	</div>

	
  </div>
  {{-- PENDING APPROVAL ANALYSIS END --}}

</div>

<div class="my-4 row">
  <div class="col-sm-6">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#docTypeBar" type="button" role="tab" aria-controls="home" aria-selected="true">Bar</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#docTypePie" type="button" role="tab" aria-controls="profile" aria-selected="false">Pie</button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="docTypeBar" role="tabpanel" aria-labelledby="home-tab">

        <div class="card border-0" style="width: 26rem;">
            <div class="card-body">
              <h5 class="card-title">Document Type Distribution</h5>
              
                <div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="documentTypeDistribution">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>

      </div>

      <div class="tab-pane fade" id="docTypePie" role="tabpanel" aria-labelledby="profile-tab">
        <div class="card border-0" style="width: 26rem;">
            <div class="card-body">
              <h5 class="card-title">Document Type Distribution</h5>
              
                <div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="documentTypeDistributionBar">
                    
                </div>
            </div>
        </div>
      </div>

    </div>

      
  </div>

{{-- REVIEW NEXT 6 MONTH START --}}
  <div class="col-sm-6">
	
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
		  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#reviewSixBar" type="button" role="tab" aria-controls="home" aria-selected="true">Bar</button>
		</li>
		<li class="nav-item" role="presentation">
		  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#reviewSixPie" type="button" role="tab" aria-controls="profile" aria-selected="false">Pie</button>
		</li>
	</ul>

    <div class="tab-content" id="myTabContent">
	
		<div class="tab-pane fade show active" id="reviewSixBar" role="tabpanel" aria-labelledby="home42-tab">
			<div class="card border-0" style="width: 26rem;">
				<div class="card-body">
				<h5 class="card-title">Review in Next 6 Months</h5>
				
					<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="documentReviewSix">
						<div class="spinner-border" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="tab-pane fade" id="reviewSixPie" role="tabpanel" aria-labelledby="home42-tab">
			<div class="card border-0" style="width: 26rem;">
				<div class="card-body">
				<h5 class="card-title">Review in Next 6 Months</h5>
				
					<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="documentReviewSixPie">
						
					</div>
				</div>
			</div>
		</div>
	
	</div>
	
	
  </div>
{{-- REVIEW NEXT 6 MONTH END --}}


</div>

<div class="my-4 row">

{{-- REVIEW NEXT 1 YEAR START --}}
  <div class="col-sm-6">
	
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
		  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#reviewOneBar" type="button" role="tab" aria-controls="home" aria-selected="true">Bar</button>
		</li>
		<li class="nav-item" role="presentation">
		  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#reviewOnePie" type="button" role="tab" aria-controls="profile" aria-selected="false">Pie</button>
		</li>
	</ul>

	<div class="tab-content" id="myTabContent">
	
		<div class="tab-pane fade show active" id="reviewOneBar" role="tabpanel" aria-labelledby="home45-tab">
			<div class="card border-0" style="width: 26rem;">
				<div class="card-body">
				  <h5 class="card-title">Review in Next 1 Year</h5>
				  
					<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="documentReviewOne">
						<div class="spinner-border" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="tab-pane fade" id="reviewOnePie" role="tabpanel" aria-labelledby="home45-tab">
			<div class="card border-0" style="width: 26rem;">
				<div class="card-body">
				  <h5 class="card-title">Review in Next 1 Year</h5>
				  
					<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="documentReviewOnePie">

					</div>
				</div>
			</div>
		</div>

	</div>

  </div>
{{-- REVIEW NEXT 1 YEAR END --}}

{{-- REVIEW NEXT 2 YEAR START --}}
  <div class="col-sm-6">

	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
		  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#reviewTwoBar" type="button" role="tab" aria-controls="home" aria-selected="true">Bar</button>
		</li>
		<li class="nav-item" role="presentation">
		  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#reviewTwoPie" type="button" role="tab" aria-controls="profile" aria-selected="false">Pie</button>
		</li>
	</ul>

	<div class="tab-content" id="myTabContent">
	
		<div class="tab-pane fade show active" id="reviewTwoBar" role="tabpanel" aria-labelledby="home45-tab">
			<div class="card border-0" style="width: 26rem;">
				<div class="card-body">
				  <h5 class="card-title">Review in Next 2 Years</h5>
				  
					<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="documentReviewTwo">
						<div class="spinner-border" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="tab-pane fade" id="reviewTwoPie" role="tabpanel" aria-labelledby="home45-tab">
			<div class="card border-0" style="width: 26rem;">
				<div class="card-body">
				  <h5 class="card-title">Review in Next 2 Years</h5>
				  
					<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="documentReviewTwoPie">

					</div>
				</div>
			</div>
		</div>
	
	</div>

    
  </div>
  {{-- REVIEW NEXT 2 YEAR END --}}
</div>

<div class="my-4 row">

	{{-- ORIGINATOR DISTRIBUTION START --}}
    <div class="col-sm-6">

		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item" role="presentation">
			  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#originatorDistBar" type="button" role="tab" aria-controls="home" aria-selected="true">Bar</button>
			</li>
			<li class="nav-item" role="presentation">
			  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#originatorDistPie" type="button" role="tab" aria-controls="profile" aria-selected="false">Pie</button>
			</li>
		</ul>

		<div class="tab-content" id="myTabContent">
	
			<div class="tab-pane fade show active" id="originatorDistBar" role="tabpanel" aria-labelledby="home45-tab">
				<div class="card border-0" style="width: 26rem;">
					<div class="card-body">
					  <h5 class="card-title">Originator Distribution</h5>
					  
						<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="documentOriginatorDistribution">
							<div class="spinner-border" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="tab-pane fade" id="originatorDistPie" role="tabpanel" aria-labelledby="home45-tab">
				<div class="card border-0" style="width: 26rem;">
					<div class="card-body">
					  <h5 class="card-title">Originator Distribution</h5>
					  
						<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="documentOriginatorDistributionPie">
							
						</div>
					</div>
				</div>
			</div>

		</div>

        
    </div>
	{{-- ORIGINATOR DISTRIBUTION END --}}


	{{-- DOCUMENT BY STATUS START --}}
    <div class="col-sm-6">

		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item" role="presentation">
			  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#documentStatusBar" type="button" role="tab" aria-controls="home" aria-selected="true">Bar</button>
			</li>
			<li class="nav-item" role="presentation">
			  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#documentStatusPie" type="button" role="tab" aria-controls="profile" aria-selected="false">Pie</button>
			</li>
		</ul>

		<div class="tab-content" id="myTabContent">
	
			<div class="tab-pane fade show active" id="documentStatusBar" role="tabpanel" aria-labelledby="home45-tab">
				<div class="card border-0" style="width: 26rem;">
					<div class="card-body">
					  <h5 class="card-title">Documents by status</h5>
					  
						<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="documentCategoryChart">
							<div class="spinner-border" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="tab-pane fade" id="documentStatusPie" role="tabpanel" aria-labelledby="home45-tab">
				<div class="card border-0" style="width: 26rem;">
					<div class="card-body">
					  <h5 class="card-title">Documents by status</h5>
					  
						<div class="card-text d-flex justify-content-center d-flex justify-content-center align-items-center h-100" id="documentCategoryChartPie">

						</div>
					</div>
				</div>
			</div>

		</div>

       
    </div>
	{{-- DOCUMENT BY STATUS END --}}

</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js" integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>


    // Processes Charts start 
    function renderProcessChart(series, labels)
    {
        var options = {
            series,
            chart: {
            width: 450,
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
    // Processes Charts End
    
    // Document by status Charts Starts
    function renderDocumentCategoryChart(series, labels)
    {
        var options = {
          series: [
                {
                    name: 'Documents',
                    data: series
                }
            ],
                chart: {
                type: 'bar',
                height: 350
                },
                plotOptions: {
                bar: {
                    distributed: true,
                    borderRadius: 4,
                    borderRadiusApplication: 'end',
                    horizontal: true,
                }
                },
                dataLabels: {
                enabled: false
                },
                xaxis: {
                categories: labels,
            }
        };

		var barOptions = {
            series: series,
            chart: {
            width: 450,
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

        var documentCategoryChart = new ApexCharts(document.querySelector("#documentCategoryChart"), options);
        var documentCategoryChartPie = new ApexCharts(document.querySelector("#documentCategoryChartPie"), barOptions);
        documentCategoryChart.render();
        documentCategoryChartPie.render();
    }

    async function prepareDocumentCategoryChart()
    {
        $('#documentCategoryChart > .spinner-border').show();

        try {
            const url = "{{ route('api.document_by_status.chart') }}"
            const res = await axios.get(url);

            


            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let series = []
                let labels = []

                for (const key in bodyData) {
                    labels.push(key)
                    series.push(bodyData[key])
                }

                renderDocumentCategoryChart(series, labels)
            }

        } catch (err) {
            console.log('Error in process chart', err.message);
        }

        $('#documentCategoryChart > .spinner-border').hide();
    }
    // Document by status Charts End

    // Classification of deviation start
    function renderClassificationDeviationChart(minorData, majorData, criticalData, months)
    {
        var options = {
          series: [
            {
                name: 'Minor',
                data: minorData
            }, 
            {
                name: 'Major',
                data: majorData
            }, 
            {
                name: 'Critical',
                data: criticalData
            }
        ],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: months,
        },
        yaxis: {
          title: {
            text: '# of Deviations'
          }
        },
        fill: {
          opacity: 1,
          colors: ['#008FFB', '#FFBD00', '#FF2C00']
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " deviations"
            }
          }
        }
        };

        var deviationClassificationChart = new ApexCharts(document.querySelector("#deviationClassificationChart"), options);
        deviationClassificationChart.render();
    }

    async function prepareClassificationDeviationChart()
    {
        $('#deviationClassificationChart > .spinner-border').show();

        try {
            const url = "{{ route('api.deviation.chart') }}"
            const res = await axios.get(url);

            


            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let minor = []
                let major = []
                let critical = []
                let labels = []

                for (const key in bodyData) {
                    labels.push(bodyData[key].month)
                    minor.push(bodyData[key].minor)
                    major.push(bodyData[key].major)
                    critical.push(bodyData[key].critical)
                }

                renderClassificationDeviationChart(minor, major, critical, labels)
            }

        } catch (err) {
            console.log('Error in deviation chart', err.message);
        }

        $('#deviationClassificationChart > .spinner-border').hide();
    }
    // Classification of deviation end
    
    // Departments wise deviation start
    function renderDeviationDepartmentChart(seriesData, labels)
    {
        var options = {
          series: seriesData,
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            distributed: true,
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: labels,
        },
        yaxis: {
          title: {
            text: '# of Deviations'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " deviations"
            }
          }
        }
        };

        var deviationDepartmentChart = new ApexCharts(document.querySelector("#deviationDepartmentChart"), options);
        deviationDepartmentChart.render();
    }

    async function prepareDeviationDepartmentChart()
    {
        $('#deviationDepartmentChart > .spinner-border').show();

        try {
            const url = "{{ route('api.deviation_departments.chart') }}"
            const res = await axios.get(url);

            


            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let labels = []
                let seriesData = []

                for (const key in bodyData) {
                    labels.push(key)
                    seriesData[bodyData[key]['January']]
                }

                renderDeviationDepartmentChart(seriesData, labels)
            }

        } catch (err) {
            console.log('Error in deviation department chart', err.message);
        }

        $('#deviationDepartmentChart > .spinner-border').hide();
    }
    // Departments wise deviation end
    
    // Originator Distribution start
    function renderDocumentOriginatorChart(seriesData, labels)
    {
      var options = {
          series: [
          {
            name: 'Documents',
            data: seriesData
          }
        ],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            distributed: true,
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: labels,
        },
        yaxis: {
          title: {
            text: '# (documents)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " documents"
            }
          }
        }
        };

		var barOptions = {
            series: seriesData,
            chart: {
            width: 450,
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



        var documentOriginatorDistribution = new ApexCharts(document.querySelector("#documentOriginatorDistribution"), options);
        var documentOriginatorDistributionPie = new ApexCharts(document.querySelector("#documentOriginatorDistributionPie"), barOptions);
        documentOriginatorDistribution.render();
        documentOriginatorDistributionPie.render();
    }

    async function prepareDocumentOriginatorChart()
    {
        $('#documentOriginatorDistribution > .spinner-border').show();

        try {
            const url = "{{ route('api.document.originator.chart') }}"
            const res = await axios.get(url);

            


            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let labels = []
                let seriesData = []

                for (const key in bodyData) {
                    labels.push(bodyData[key]['originator_name'])
                    seriesData.push(bodyData[key]['document_count'])
                }

                renderDocumentOriginatorChart(seriesData, labels)
            }

        } catch (err) {
            console.log('Error in document originator', err.message);
        }

        $('#documentOriginatorDistribution > .spinner-border').hide();
    }
    // Originator distribution end
    
    // Type Distribution start
    function renderDocumentTypeChart(seriesData, labels)
    {
      var options = {
          series: [
          {
            name: 'Documents',
            data: seriesData
          }
        ],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            distributed: true,
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: labels,
        },
        yaxis: {
          title: {
            text: '# (documents)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " documents"
            }
          }
        }
        };

        var barOptions = {
            series: seriesData,
            chart: {
            width: 450,
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

        var documentTypeDistribution = new ApexCharts(document.querySelector("#documentTypeDistribution"), options);
        var documentTypeDistributionBar = new ApexCharts(document.querySelector("#documentTypeDistributionBar"), barOptions);
        documentTypeDistribution.render();
        documentTypeDistributionBar.render();
    }

    async function prepareDocumentTypeChart()
    {
        $('#documentTypeDistribution > .spinner-border').show();

        try {
            const url = "{{ route('api.document.type.chart') }}"
            const res = await axios.get(url);

            


            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let labels = []
                let seriesData = []

                for (const key in bodyData) {
                    labels.push(bodyData[key]['document_type_name'])
                    seriesData.push(bodyData[key]['document_count'])
                }

                renderDocumentTypeChart(seriesData, labels)
            }

        } catch (err) {
            console.log('Error in document originator', err.message);
        }

        $('#documentTypeDistribution > .spinner-border').hide();
    }
    // Type distribution end
    
    // Review six month start
    function renderDocumentSixChart(seriesData, labels)
    {
      var options = {
          series: [
          {
            name: 'Documents',
            data: seriesData
          }
        ],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            distributed: true,
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: labels,
        },
        yaxis: {
          title: {
            text: '# (documents)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " documents to be reviewed by this date"
            }
          }
        }
        };

		var barOptions = {
            series: seriesData,
            chart: {
            width: 450,
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



        var documentReviewSix = new ApexCharts(document.querySelector("#documentReviewSix"), options);
        var documentReviewSixPie = new ApexCharts(document.querySelector("#documentReviewSixPie"), barOptions);
        documentReviewSix.render();
        documentReviewSixPie.render();
    }

    async function prepareDocumentSixChart()
    {
        $('#documentReviewSix > .spinner-border').show();

        try {
            const url = "{{ route('api.document.review.chart', 6) }}"
            const res = await axios.get(url);

            


            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let labels = []
                let seriesData = []

                bodyData.forEach(data => {
                    seriesData.push(1);
                    labels.push(data.next_review_date)
                });

                renderDocumentSixChart(seriesData, labels)
            }

        } catch (err) {
            console.log('Error in document originator', err.message);
        }

        $('#documentReviewSix > .spinner-border').hide();
    }
    // Review six month end

    // Review one year start
    function renderDocumentOneChart(seriesData, labels)
    {
      var options = {
          series: [
          {
            name: 'Documents',
            data: seriesData
          }
        ],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            distributed: true,
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: labels,
        },
        yaxis: {
          title: {
            text: '# (documents)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " documents to be reviewed by this date"
            }
          }
        }
        };

		var barOptions = {
            series: seriesData,
            chart: {
            width: 450,
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

        var documentReviewOne = new ApexCharts(document.querySelector("#documentReviewOne"), options);
        var documentReviewOnePie = new ApexCharts(document.querySelector("#documentReviewOnePie"), barOptions);
        documentReviewOne.render();
        documentReviewOnePie.render();
    }

    async function prepareDocumentOneChart()
    {
        $('#documentReviewOne > .spinner-border').show();

        try {
            const url = "{{ route('api.document.review.chart', 12) }}"
            const res = await axios.get(url);

            


            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let labels = []
                let seriesData = []

                bodyData.forEach(data => {
                    seriesData.push(1);
                    labels.push(data.next_review_date)
                });

                renderDocumentOneChart(seriesData, labels)
            }

        } catch (err) {
            console.log('Error in document one', err.message);
        }

        $('#documentReviewOne > .spinner-border').hide();
    }
    // Review one year end

    // Review two year start
    function renderDocumentTwoChart(seriesData, labels)
    {
      var options = {
          series: [
          {
            name: 'Documents',
            data: seriesData
          }
        ],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            distributed: true,
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: labels,
        },
        yaxis: {
          title: {
            text: '# (documents)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " documents to be reviewed by this date"
            }
          }
        }
        };

		var barOptions = {
            series: seriesData,
            chart: {
            width: 450,
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

        var documentReviewTwo = new ApexCharts(document.querySelector("#documentReviewTwo"), options);
        var documentReviewTwoPie = new ApexCharts(document.querySelector("#documentReviewTwoPie"), barOptions);
        documentReviewTwo.render();
        documentReviewTwoPie.render();
    }

    async function prepareDocumentTwoChart()
    {
        $('#documentReviewTwo > .spinner-border').show();

        try {
            const url = "{{ route('api.document.review.chart', 24) }}"
            const res = await axios.get(url);

            


            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let labels = []
                let seriesData = []

                bodyData.forEach(data => {
                    seriesData.push(1);
                    labels.push(data.next_review_date)
                });

                renderDocumentTwoChart(seriesData, labels)
            }

        } catch (err) {
            console.log('Error in document one', err.message);
        }

        $('#documentReviewTwo > .spinner-border').hide();
    }
    // Review two year end
    
    // Pending Review Analysis start
    function renderPendingReviewerChart(seriesData, labels)
    {
      var options = {
          series: [
          {
            name: 'Documents',
            data: seriesData
          }
        ],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            distributed: true,
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: labels,
        },
        yaxis: {
          title: {
            text: '# (documents)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " documents to be reviewed"
            }
          }
        }
        };

		var barOptions = {
            series: seriesData,
            chart: {
            width: 450,
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

        var pendingReviewAnalysis = new ApexCharts(document.querySelector("#pendingReviewAnalysis"), options);
        var pendingReviewAnalysisBar = new ApexCharts(document.querySelector("#pendingReviewAnalysisBar"), barOptions);
        pendingReviewAnalysis.render();
        pendingReviewAnalysisBar.render();
    }

    async function preparePendingReviewerChart()
    {
        $('#pendingReviewAnalysis > .spinner-border').show();

        try {
            const url = "{{ route('api.document.pending.reviewers.chart') }}"
            const res = await axios.get(url);

            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let labels = []
                let seriesData = []

                for (const key in bodyData) 
                {
                  console.log('key', key)
                  console.log('bodyData', bodyData[key])
                  labels.push(key);
                  seriesData.push(bodyData[key])
                }

                renderPendingReviewerChart(seriesData, labels)
            }

        } catch (err) {
            console.log('Error in document one', err.message);
        }

        $('#pendingReviewAnalysis > .spinner-border').hide();
    }
    // Pending Review Analysis end
    
    // Pending Approval Analysis start
    function renderPendingApproverChart(seriesData, labels)
    {
      var options = {
          series: [
          {
            name: 'Documents',
            data: seriesData
          }
        ],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            distributed: true,
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: labels,
        },
        yaxis: {
          title: {
            text: '# (documents)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " documents to be approved"
            }
          }
        }
        };

		var barOptions = {
            series: seriesData,
            chart: {
            width: 450,
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

        var pendingApproveAnalysis = new ApexCharts(document.querySelector("#pendingApproveAnalysis"), options);
        var pendingApproveAnalysisPie = new ApexCharts(document.querySelector("#pendingApproveAnalysisPie"), barOptions);
        pendingApproveAnalysis.render();
        pendingApproveAnalysisPie.render();
    }

    async function preparePendingApproverChart()
    {
        $('#pendingApproveAnalysis > .spinner-border').show();

        try {
            const url = "{{ route('api.document.pending.approvers.chart') }}"
            const res = await axios.get(url);

            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let labels = []
                let seriesData = []

                for (const key in bodyData) 
                {
                  console.log('key', key)
                  console.log('bodyData', bodyData[key])
                  labels.push(key);
                  seriesData.push(bodyData[key])
                }

                renderPendingApproverChart(seriesData, labels)
            }

        } catch (err) {
            console.log('Error in document one', err.message);
        }

        $('#pendingApproveAnalysis > .spinner-border').hide();
    }
    // Pending Approval Analysis end


    // Pending HOD Analysis start
    function renderPendingHODChart(seriesData, labels)
    {
      var options = {
          series: [
          {
            name: 'Documents',
            data: seriesData
          }
        ],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            distributed: true,
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: labels,
        },
        yaxis: {
          title: {
            text: '# (documents)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " documents pending HOD review"
            }
          }
        }
        };

		var barOptions = {
            series: seriesData,
            chart: {
            width: 450,
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

        var pendingHODAnalysis = new ApexCharts(document.querySelector("#pendingHODAnalysis"), options);
        var pendingHODAnalysisPie = new ApexCharts(document.querySelector("#pendingHODAnalysisPie"), barOptions);
        pendingHODAnalysis.render();
        pendingHODAnalysisPie.render();
    }

    async function preparePendingHODChart()
    {
        $('#pendingHODAnalysis > .spinner-border').show();

        try {
            const url = "{{ route('api.document.pending.hod.chart') }}"
            const res = await axios.get(url);

            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let labels = []
                let seriesData = []

                for (const key in bodyData) 
                {
                  console.log('key', key)
                  console.log('bodyData', bodyData[key])
                  labels.push(key);
                  seriesData.push(bodyData[key])
                }

                renderPendingHODChart(seriesData, labels)
            }

        } catch (err) {
            console.log('Error in document one', err.message);
        }

        $('#pendingHODAnalysis > .spinner-border').hide();
    }
    // Pending HOD Analysis end

    // Pending Training Analysis start
    function renderPendingTrainingChart(seriesData, labels)
    {
      var options = {
          series: [
          {
            name: 'Documents',
            data: seriesData
          }
        ],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            distributed: true,
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: labels,
        },
        yaxis: {
          title: {
            text: '# (documents)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " documents pending HOD review"
            }
          }
        }
        };

		var barOptions = {
            series: seriesData,
            chart: {
            width: 450,
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

        var pendingTrainingAnalysis = new ApexCharts(document.querySelector("#pendingTrainingAnalysis"), options);
        var pendingTrainingAnalysisPie = new ApexCharts(document.querySelector("#pendingTrainingAnalysisPie"), barOptions);
        pendingTrainingAnalysis.render();
        pendingTrainingAnalysisPie.render();
    }

    async function preparePendingTrainingChart()
    {
        $('#pendingTrainingAnalysis > .spinner-border').show();

        try {
            const url = "{{ route('api.document.pending.training.chart') }}"
            const res = await axios.get(url);

            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let labels = []
                let seriesData = []

                for (const key in bodyData) 
                {
                  console.log('key', key)
                  console.log('bodyData', bodyData[key])
                  labels.push(key);
                  seriesData.push(bodyData[key])
                }

                renderPendingTrainingChart(seriesData, labels)
            }

        } catch (err) {
            console.log('Error in document one', err.message);
        }

        $('#pendingTrainingAnalysis > .spinner-border').hide();
    }
    // Pending Training Analysis end

	// Severity Level start
    function renderSeverityChart(negligibleData, moderateData, majorData, fatalData, months) {
        var options = {
            series: [{
                    name: 'Negligible',
                    data: negligibleData
                },
                {
                    name: 'Moderate',
                    data: moderateData
                },
                {
                    name: 'Major',
                    data: majorData
                },
                {
                    name: 'Fatal',
                    data: fatalData
                }
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: months,
            },
            yaxis: {
                title: {
                    text: '# of Deviations'
                }
            },
            fill: {
                opacity: 1,
                colors: ['#008FFB', '#00E396', '#FFBD00', '#FF2C00']
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " deviations"
                    }
                }
            }
        };

        var deviationSeverityChart = new ApexCharts(document.querySelector("#deviationSeverityChart"), options);
        deviationSeverityChart.render();
    }

    async function prepareSeverityDeviationChart() {
        $('#deviationSeverityChart > .spinner-border').show();

        try {
            const url = "{{ route('api.document_by_severity.chart') }}"
            const res = await axios.get(url);

            console.log('res', res.data)


            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let negligible = []
                let moderate = []
                let major = []
                let fatal = []
                let labels = []

                for (const key in bodyData) {
                    labels.push(bodyData[key].month)
                    negligible.push(bodyData[key].negligible)
                    moderate.push(bodyData[key].moderate)
                    major.push(bodyData[key].major)
                    fatal.push(bodyData[key].fatal)
                }

                renderSeverityChart(negligible, moderate, major, fatal, labels)
            }

        } catch (err) {
            console.log('Error in deviation chart', err.message);
        }

        $('#deviationSeverityChart > .spinner-border').hide();
    }
    // Severity Level deviation end

    // Priority Level start
    function renderPriorityLevelChart(lowData, mediumData, highData, months) {
        var options = {
            series: [{
                    name: 'Low',
                    data: lowData
                },
                {
                    name: 'Medium',
                    data: mediumData
                },
                {
                    name: 'High',
                    data: highData
                },
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: months,
            },
            yaxis: {
                title: {
                    text: '# of Risk Management'
                }
            },
            fill: {
                opacity: 1,
                colors: ['#008FFB', '#00E396', '#FFBD00']
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " risk_managements"
                    }
                }
            }
        };

        var priorityLevelChart = new ApexCharts(document.querySelector("#priorityLevelChart"), options);
        priorityLevelChart.render();
    }

    async function preparePriorityLevelChart() {
        $('#priorityLevelChart > .spinner-border').show();

        try {
            const url = "{{ route('api.document_by_priority.chart') }}"
            const res = await axios.get(url);

            console.log('preparePriorityLevelChart', res.data)


            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let low = []
                let medium = []
                let high = []
                let labels = []

                for (const key in bodyData) {
                    labels.push(bodyData[key].month)
                    low.push(bodyData[key].low)
                    medium.push(bodyData[key].medium)
                    high.push(bodyData[key].high)
                }

                renderPriorityLevelChart(low, medium, high, labels)
            }

        } catch (err) {
            console.log('Error in Risk Managment chart', err.message);
        }

        $('#priorityLevelChart > .spinner-border').hide();
    }
    // Priority Level deviation end

    // Priority Level start
    
    function renderPriorityLevelChartRca(lowData, mediumData, highData, months) {
        var options = {
            series: [{
                    name: 'Low',
                    data: lowData
                },
                {
                    name: 'Medium',
                    data: mediumData
                },
                {
                    name: 'High',
                    data: highData
                },
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: months,
            },
            yaxis: {
                title: {
                    text: '# of RCA'
                }
            },
            fill: {
                opacity: 1,
                colors: ['#008FFB', '#00E396', '#FFBD00', '#FF2C00']
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " root_cause_analysis"
                    }
                }
            }
        };

        var priorityLevelChartRca = new ApexCharts(document.querySelector("#priorityLevelChartRca"), options);
        priorityLevelChartRca.render();
    }

    async function preparePriorityLevelChartRca() {
        $('#priorityLevelChartRca > .spinner-border').show();

        try {
            const url = "{{ route('api.document_by_priority_rca.chart') }}"
            const res = await axios.get(url);

            console.log('priorityLevelChartRca', res.data)


            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let low = []
                let medium = []
                let high = []
                let labels = []

                for (const key in bodyData) {
                    labels.push(bodyData[key].month)
                    low.push(bodyData[key].low)
                    medium.push(bodyData[key].medium)
                    high.push(bodyData[key].high)
                }

                renderPriorityLevelChartRca(low, medium, high, labels)
            }

        } catch (err) {
            console.log('Error in RCA chart', err.message);
        }

        $('#priorityLevelChartRca > .spinner-border').hide();
    }
    // Priority Level deviation end


    // Delayed Data Chart Start

    function renderDelayedCharts(delayed, onTime, months) {
        var options = {
            series: [{
                    name: 'Delay',
                    data: delayed
                },
                {
                    name: 'On Time',
                    data: onTime
                }
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: months,
            },
            yaxis: {
                title: {
                    text: '# of Deviations'
                }
            },
            fill: {
                opacity: 1,
                colors: ['#008FFB', '#00E396']
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " deviations"
                    }
                }
            }
        };

        var delayedCharts = new ApexCharts(document.querySelector("#delayedCharts"), options);
        delayedCharts.render();
    }

    async function preparedelayedCharts() {
        $('#delayedCharts > .spinner-border').show();

        try {
            const url = "{{ route('api.document_by_delayed.chart') }}"
            const res = await axios.get(url);

            console.log('delayedCharts', res.data)


            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let delayed = []
                let onTime = []
                let labels = []

                for (const key in bodyData) {
                    labels.push(bodyData[key].month)
                    delayed.push(bodyData[key].delayed)
                    onTime.push(bodyData[key].onTime)
                }

                renderDelayedCharts(delayed, onTime, labels)
            }

        } catch (err) {
            console.log('Error in RCA chart', err.message);
        }

        $('#delayedCharts > .spinner-border').hide();
    }

    // Delayed Data Chart Ends


    // Document by Site Chart Start

    function renderSiteCharts(corporateDate, plantData, months) {
        var options = {
            series: [{
                    name: 'Corporate',
                    data: corporateDate
                },
                {
                    name: 'Plant',
                    data: plantData
                }
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: months,
            },
            yaxis: {
                title: {
                    text: '# of Deviations'
                }
            },
            fill: {
                opacity: 1,
                colors: ['#008FFB', '#00E396']
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " deviations"
                    }
                }
            }
        };

        var documentSiteCharts = new ApexCharts(document.querySelector("#documentSiteCharts"), options);
        documentSiteCharts.render();
    }

    async function prepareSiteCharts() {
        $('#documentSiteCharts > .spinner-border').show();

        try {
            const url = "{{ route('api.document_by_site.chart') }}"
            const res = await axios.get(url);

            console.log('documentSiteCharts', res.data)


            if (res.data.status == 'ok') {
                let bodyData = res.data.body;
                let corporate = []
                let plant = []
                let labels = []

                for (const key in bodyData) {
                    labels.push(bodyData[key].month)
                    corporate.push(bodyData[key].corporate)
                    plant.push(bodyData[key].plant)
                }

                renderSiteCharts(corporate, plant, labels)
            }

        } catch (err) {
            console.log('Error in Deviations chart', err.message);
        }

        $('#documentSiteCharts > .spinner-border').hide();
    }

    prepareProcessChart()
    prepareDocumentCategoryChart()
    prepareClassificationDeviationChart()
    prepareDeviationDepartmentChart()
    prepareDocumentOriginatorChart()
    prepareDocumentTypeChart()
    prepareDocumentSixChart()
    prepareDocumentOneChart()
    prepareDocumentTwoChart()
    preparePendingReviewerChart()
    preparePendingApproverChart()
    preparePendingHODChart()
    preparePendingTrainingChart()
	prepareSeverityDeviationChart()
    preparePriorityLevelChart()
    preparePriorityLevelChartRca()
    preparedelayedCharts()
    prepareSiteCharts()
      
</script>