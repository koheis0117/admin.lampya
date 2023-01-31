@extends('adminlte::page')

@section('title', '登録商品一覧')

@section('content_header')
<h1>商品管理</h1>
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
                <h3 class="card-title">商品登録</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form method="POST" action="{{ route('item_store') }}" onSubmit="return checkSubmit()">
                @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">管理番号</label>
                                <input type="text" class="form-control" id="control_number" name="control_number" placeholder="00001" value="{{ old('control_number') }}">
                                @if ($errors->has('control_number'))
                                    <div class="text-danger">
                                        {{ $errors->first('control_number') }}
                                    </div>
                                @endif
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                                <label for="id">商品名</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="商品名を入力してください" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <div class="text-danger">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">仕入原価</label>
                                <input type="text" class="form-control" id="cost_price" name="cost_price" placeholder="¥" value="{{ old('cost_price') }}">
                                @if ($errors->has('cost_price'))
                                    <div class="text-danger">
                                        {{ $errors->first('cost_price') }}
                                    </div>
                                @endif
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">下限在庫数</label>
                                <input type="text" class="form-control" id="lower_count" name="lower_count" placeholder="10" value="{{ old('lower_count') }}">
                                @if ($errors->has('lower_count'))
                                    <div class="text-danger">
                                        {{ $errors->first('lower_count') }}
                                    </div>
                                @endif
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">&ensp;</label>
                                <button type="submit" class="btn btn-primary d-block">登録する</button>
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
            <h3 class="card-title">登録商品一覧</h3>
        </div>
        <div class="card">
            <div class="card-body table-responsive p-20">
                <table class="table table-hover text-nowrap" id="my_table">
                    <thead>
                    <tr>
                        <th>管理番号</th>
                        <th>商品名</th>
                        <th>仕入原価</th>
                        <th>下限在庫数</th>
                        <th>アクション</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>@php echo sprintf('%05d', $item->control_number); @endphp</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->cost_price}}</td>
                        <td><span class="tag tag-success">{{$item->lower_count}}</span></td>
                        <td>
                            <button type="button" class="btn btn-primary" onclick="location.href='/item/edit/{{ $item->id }}'">修正</button>
                            <form method="POST" action="{{ route('item_delete', $item->id) }}" onSubmit="return checkDelete()" class="d-inline">
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
    'language': {
      'url': "//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Japanese.json"
    },
    'pagingType': 'full_numbers',
    'iDisplayLength': 10
  })
})
</script>
@stop