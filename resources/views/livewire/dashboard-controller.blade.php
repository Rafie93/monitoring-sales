<div>
    @if ($title)
    <h1 class="mt-4">{{$title}}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">{{$title}}</li>
        {{-- @if ($subtitle)
           <li class="breadcrumb-item active">{{$subtitle}}</li>
        @endif --}}
    </ol>
    @endif
    <div class="row">
         <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
            <div class="card text-white bg-primary">
              <div class="card-header"><i class="fa fa-user"></i> Salesman</div>
              <div class="card-body">
                <h3 class="card-title">{{$countSalesman}}</h3>
              </div>
             
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
            <div class="card text-white bg-success">
              <div class="card-header"><i class="fa fa-user-plus"></i> Customer</div>
              <div class="card-body">
                <h3 class="card-title">{{$countCustomer}}</h3>
              </div>
              
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
            <div class="card text-white bg-warning">
              <div class="card-header"><i class="fa fa-bar-chart"></i> Model Mobil</div>
              <div class="card-body">
                <h3 class="card-title">{{$countMobil}}</h3>
              </div>
             
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 pr-0 mb-3">
            <div class="card text-white bg-danger">
              <div class="card-header"><i class="fa fa-shopping-bag"></i> SPK Terbit</div>
              <div class="card-body">
                <h3 class="card-title">{{$countSPK}}</h3>
              </div>
            
            </div>
          </div>
    </div>
    {{-- <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 pr-0 mb-3">
            <div class="card-collapsible card">
              <div class="card-header">
                Penjualan
              </div>
              <div class="card-body d-flex justify-content-around">
                <canvas id="myBarChart" width="100%" height="50"></canvas>
              </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 pr-0 mb-3">
            <div class="card-collapsible card">
              <div class="card-header">
                Absensi
              </div>
              <div class="card-body d-flex justify-content-around">
                <canvas id="myPieChart" width="100%" height="50"></canvas>
              </div>
            </div>
        </div>
    </div> --}}
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

<script>
    // jquery ready
$(document).ready(function() {
    // chart
   // initBarChart();
   // initPieChart();
});

function initBarChart () {
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Bar Chart Example
    var ctx = document.getElementById("myBarChart");
    var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [{
        label: "Unit Terjual",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data: [14, 8, 9, 10, 8, 9],
        }],
    },
    options: {
        scales: {
        xAxes: [{
            time: {
            unit: 'month'
            },
            gridLines: {
            display: false
            },
            ticks: {
            maxTicksLimit: 6
            }
        }],
        yAxes: [{
            ticks: {
            min: 0,
            maxTicksLimit: 5
            },
            gridLines: {
            display: true
            }
        }],
        },
        legend: {
            display: false
        }
    }
    });

}
function initPieChart(){
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ["Blue", "Red", "Yellow", "Green"],
        datasets: [{
        data: [12.21, 15.58, 11.25, 8.32],
        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
        }],
    },
    });

}
</script>
@endpush
