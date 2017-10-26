@extends('layouts.main')

@section('content')
  <h1 class="text-center">Generate reports for sales</h1>
  <hr/>
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
            <option value="thismonth">This Month</option>
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
  <div class="row tablerow">
    @if (isset($rep))
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Report for sales of {{$rep['type']}}</h3>
            </div>
            <div class="panel-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Total Price</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{$rep['date']}}</td>
                    <td>{{$rep['total_price']}} <strong>Euro</strong></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="panel-footer">

            </div>
          </div>
        </div>
    @endif
  </div>
@endsection
