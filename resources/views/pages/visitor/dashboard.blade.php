@extends('layouts.layout')


@section('content')
    <div class="card-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <select class="form-control" name="graph_company_name" >
                        <option value="">--Select Company Name--</option>
                        @foreach($visitorsByCompany as $key=> $visitor)
                            <option>{{$visitor->company_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text"  name="datefilter" class="form-control" id="datefilter" placeholder="Select Date Range">
                </div>  
            </div>  
        </div>
    </div>
    <div class="card-body" >
        <div class="row">
            <div class="col-md-6" id="graphByCompanyName">
               <div style="width: 100%">
                   <h1>Graph A - Total count of visitors by name</h1>
                    <canvas id="myChart" height="100px"></canvas>
                </div> 
            </div>
            <div class="col-md-6" id="graphByDate">
               <div style="width: 100%">
                   <h1>Graph B - Total count of visitors by date</h1>
                    <canvas id="myChart1" height="100px"></canvas>
                </div>
            </div>  
        </div> 
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
 
        var labels =  {{ Js::from($labels) }};
        var visitors =  {{ Js::from($data) }};

        var labels1 =  {{ Js::from($labels1) }};
        var visitors1 =  {{ Js::from($data1) }};
      
        const data = {
            labels: labels,
            datasets: [{
              label: 'Visitors List',
              backgroundColor: 'rgb(255, 99, 132)',
              borderColor: 'rgb(255, 99, 132)',
              data: visitors,
            }]
        };

        const data1 = {
            labels: labels1,
            datasets: [{
              label: 'Visitors List',
              backgroundColor: 'rgb(255, 99, 132)',
              borderColor: 'rgb(255, 99, 132)',
              data: visitors1,
            }]
        };
      
        const config = {
            type: 'line',
            data: data,
            options: {}
        };
        const config1 = {
            type: 'line',
            data: data1,
            options: {}
        };
      
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

        const myChart1 = new Chart(
            document.getElementById('myChart1'),
            config1
        ); 
    </script>
@endsection