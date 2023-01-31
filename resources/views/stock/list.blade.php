@extends('adminlte::page')

@section('title', '在庫一覧')

@section('content_header')
<h1>在庫管理</h1>
@if (session('err_msg'))
    <p class="text-danger">
    {{ session('err_msg') }}
    </p>
@endif
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="btn-group mb-2">
            <a href="{{ route('pdf_output') }}" class="btn btn-outline-success btn-sm" data-submission_id="multi" data-status=""><i class="far fa-file-excel"></i>&nbsp;在庫一覧PDFダウンロード</a>
        </div>
        <div class="card-header bg-primary">
            <h3 class="card-title">在庫一覧</h3>
        </div>
        <div class="card">
            <div class="card-body table-responsive p-20">
                <table class="table table-hover text-nowrap" id="my_table">
                    <thead>
                    <tr>
                        <th>管理番号</th>
                        <th>商品名</th>
                        <th>在庫数</th>
                        <th>在庫金額</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($in_items as $key => $in_item)
                    <tr>
                        <td>{{$in_item->control_number}}</td>
                        <td>{{$in_item->name}}</td>
                        <td>{{$in_item->max_count}}</td>
                        <td>
                        @php
                            $a = $in_item->cost_price;
                            $b = $in_item->max_count;
                            $total = $a * $b;
                            echo number_format($total)
                        @endphp
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
<link rel=”stylesheet” href=”/css/admin_custom.css”>
@stop

@section('js')
<script>
function checkSubmit(){
    if(window.confirm('登録してよろしいですか？')){
        return true;
    } else {
        return false;
    }
}
function checkDelete(){
    if(window.confirm('削除してよろしいですか？')){
        return true;
    } else {
        return false;
    }
}
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