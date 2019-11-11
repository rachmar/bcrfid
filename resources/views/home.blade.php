@extends('layouts.admin')

@section('css')

@endsection

@section('content')
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>150</h3>

        <p>New Accounts</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3>150</h3>

        <p>New Loan</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>53<sup style="font-size: 20px">%</sup></h3>

        <p>Loan Approval Rate</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>53<sup style="font-size: 20px">%</sup></h3>

        <p>Rejected Rate</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
    </div>
  </div>

</div>
@endsection


@section('script')

@endsection
