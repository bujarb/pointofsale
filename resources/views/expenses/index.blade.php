@extends('layouts.main')

@section('content')
  <div class="row up">
    <div class="col-md-12">
      <div class="col-md-2">
        <h4><i class="fa fa-barcode"></i> Products</h4>
      </div>
      <div class="col-md-4 col-md-offset-1">
        <input type="text" class="form-control" placeholder="Search expenses ..."/>
      </div>
      <div class="col-md-2 pull-right">
        <a href="#" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">New Expense <i class="fa fa-plus-circle"></i></a>
      </div>
    </div>
  </div>
  <hr/>
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Label</th>
            <th>Amount</th>
            <th>Reason</th>
            <th>Who</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($expenses as $expense)
            <tr>
              <td>{{$expense->label}}</td>
              <td>{{$expense->amount}}</td>
              <td>{{$expense->reason}}</td>
              <td>{{$expense->who}}</td>
              <td>{{$expense->created_at->format('M d')}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add a new product</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <form id="userForm" method="post" action="{{route('expense-store')}}">
                {{csrf_field()}}
                <div class="form-group">
                  <label>Label:</label>
                  <input type="text" class="form-control" name="label" id="label"/>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Amount:</label>
                      <input type="text" class="form-control" name="amount" id="amount"/>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tax</label>
                      <input type="text" class="form-control" name="tax" id="tax"/>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Reason</label>
                  <textarea class="form-control" name="reason" id="reason" rows="10"></textarea>
                </div>
                <div class="form-group">
                  <label>Who:</label>
                  <input type="text" class="form-control" name="who" id="who"/>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <button class="btn btn-primary btn-block btn-lg" type="submit">Insert</button>
                  </div>
                </form>
                  <div class="col-md-6">
                    <button class="btn btn-danger btn-block btn-lg" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
