@extends('adminlte::page')

@section('title', '登録商品一覧')

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
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header bg-primary">
                <h3 class="card-title">在庫登録</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form method="POST" action="{{ route('stock_store') }}" onSubmit="return checkSubmit()">
                @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                            <div class="form-group">
                                <label for="id">商品名</label>
                                <select name="item_id" class="form-control"  id="item_id">
                                    <option value="">-- 選択してください --</option>
                                    @foreach($items as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('item_id'))
                                    <div class="text-danger">
                                        {{ $errors->first('item_id') }}
                                    </div>
                                @endif
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">処理</label>
                                <select name="status" class="form-control">
                                    <option value="">-- 選択してください --</option>
                                    <option value="1" @if(1 === (int)old('status')) selected @endif>入庫</option>
                                    <option value="2" @if(2 === (int)old('status')) selected @endif>出庫</option>
                                </select>
                                @if ($errors->has('status'))
                                    <div class="text-danger">
                                        {{ $errors->first('status') }}
                                    </div>
                                @endif
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">数量</label>
                                <input type="text" class="form-control" id="count" name="count" value="{{ old('count') }}">
                                @if ($errors->has('count'))
                                    <div class="text-danger">
                                        {{ $errors->first('count') }}
                                    </div>
                                @endif
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">&ensp;</label>
                                <button type="submit" class="btn btn-danger d-block">登録する</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>


<div class="row">
    <div class="col-12">
        <div class="card-header bg-secondary">
            <h3 class="card-title">登録履歴</h3>
        </div>
        <div class="card">
            <div class="card-body table-responsive p-20">
                <table class="table table-hover text-nowrap" id="my_table">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>登録日（最終更新日）</th>
                        <th>商品名</th>
                        <th>処理</th>
                        <th>数量</th>
                        <th>アクション</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stocks as $stock)
                    <tr>
                        <td>{{$stock->id}}</td>
                        <td>{{$stock->updated_at}}</td>
                        <td>{{$stock->item->name}}</td>
                        @if($stock->status == '1')
                        　<td>入庫</td>
                        @endif
                        @if($stock->status == '2')
                        　<td>出庫</td>
                        @endif
                        <td>
                        @php
                            echo abs($stock->count);
                        @endphp
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" onclick="location.href='/stock/edit/{{ $stock->id }}'">数量修正</button>
                            <form method="POST" action="{{ route('stock_delete', $stock->id) }}" onSubmit="return checkDelete()" class="d-inline">
                                @csrf
                            <button type="submit" class="btn btn-danger" onclick=>削除</button>
                            </form>
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
    order: [ [ 0, "desc" ] ],
    'language': {
      'url': "//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Japanese.json"
    },
    'pagingType': 'full_numbers',
    'iDisplayLength': 10
  })
})
</script>
@stop