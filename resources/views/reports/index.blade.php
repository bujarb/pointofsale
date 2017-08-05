@extends('layouts.main')

@section('content')
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <form action="{{route('report-generate')}}" method="post">
        {{csrf_field()}}
        <div class="col-md-2">
          <p id="onreports" class="text-center">
            Select by choice
          </p>
        </div>
        <div class="col-md-2">
          <select class="form-control" name="choice" id="choice">
            <option value="">Select your report ...</option>
            <option value="today">Today</option>
            <option value="yesterday">Yesterday</option>
            <option value="thisweek">This Week</option>
            <option value="lastweek">Last Week</option>
            <option value="thismonth">This Month</option>
            <option value="lastmonth">Last Month</option>
            <option value="thisquarter">This Quarter</option>
            <option value="lastquarter">Last Quarter</option>
            <option value="thisyear">This Year</option>
            <option value="lastyear">Last Year</option>
            <option value="alltime">All Time</option>
          </select>
        </div>
        <div class="col-sm-2">
          <p id="onreports" class="text-center">
            Or select by custom date
          </p>
        </div>
        <div class="col-md-2">
          <input type="date" name="datefrom" id="datefrom" class="form-control"/>
        </div>
        <div class="col-md-1">
          <p id="onreports" class="text-center">
            To
          </p>
        </div>
        <div class="col-md-2">
          <input type="date" name="dateto" id="dateto" class="form-control"/>
        </div>
        <div class="col-md-1">
          <button class="btn btn-info btn-sm btn-block">Generate</button>
        </div>
      </form>
    </div>
  </div>
  <hr class="myhr"/>
  <div class="row">
    <div class="col-md-2">
      <h4><a href="#">Export CVS</a> <i class="fa fa-file-excel-o" aria-hidden="true"></i></h4>
    </div>
    <div class="col-md-2 pull-right">
      <h4 class="text-right"><a href="{{route('report-index')}}">Clear</a></h4>
    </div>
  </div>
  <div class="row">
    @if (isset($rep))
        <div class="col-md-6 col-md-offset-3">
          <table class="table table-striped table-hover table-bordered">
            <thead>
              <tr>
                <th>Date</th>
                <th>Quantity</th>
                <th>Total Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{$rep['date']}}</td>
                <td>{{$rep['quantity']}}</td>
                <td>{{$rep['total_price']}}</td>
              </tr>
            </tbody>
          </table>
        </div>
    @endif
  </div>
@endsection
