@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>ダッシュボード</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-3 col-12">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
        <h3>
        @php
            echo '¥'.number_format($total_costs)
        @endphp
        </h3>

        <p>在庫金額</p>
        </div>
        <div class="icon">
        <i class="ion ion-bag"></i>
        </div>
    </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-12">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
        <h3>{{$item_kinds}}</h3>

        <p>在庫の種類</p>
        </div>
        <div class="icon">
        <i class="ion ion-stats-bars"></i>
        </div>
    </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <div class="col-12">
        <div class="card-header bg-danger">
            <h3 class="card-title">※下記在庫を発注して下さい</h3>
        </div>
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body table-responsive p-20">
                <table class="table table-hover text-nowrap" id="my_table">
                    <thead>
                    <tr>
                        <th>管理番号</th>
                        <th>商品名</th>
                        <th>下限在庫数</th>
                        <th>現在の在庫数</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lower_items as $lower_item)
                    @if($lower_item->max_count < $lower_item->lower_count)
                    <tr>
                        <td>{{$lower_item->control_number}}</td>
                        <td>{{$lower_item->name}}</td>
                        <td>{{$lower_item->lower_count}}</td>
                        <td><span class="tag tag-success">{{$lower_item->max_count}}</span></td>
                    </tr>
                    @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    <!-- /.card -->
    </div>
</div>

@stop

@section('css')
<link rel=”stylesheet” href=”/css/admin_custom.css”>
@stop

@section('js')
<script>
$(document).ready(function(){
  $('#my_table').DataTable({
    'language': {
      'url': "//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Japanese.json"
    },
    'pagingType': 'full_numbers',
    'iDisplayLength': 10
  })
})
</script>
@stop