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
              <div class="card-header bg-success">
                <h3 class="card-title">商品登録修正</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form method="POST" action="{{ route('item_update') }}" onSubmit="return checkSubmit()">
                @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">管理番号</label>
                                <input type="text" class="form-control" id="control_number" name="control_number" value="@php echo sprintf('%05d', $item->control_number); @endphp">
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
                                <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
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
                                <input type="text" class="form-control" id="cost_price" name="cost_price" value="{{ $item->cost_price }}">
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
                                <input type="text" class="form-control" id="lower_count" name="lower_count" value="{{ $item->lower_count }}">
                                @if ($errors->has('lower_count'))
                                    <div class="text-danger">
                                        {{ $errors->first('lower_count') }}
                                    </div>
                                @endif
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">アクション</label>
                                <button type="submit" class="btn btn-success d-block">更新する</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </form>
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
if(window.confirm('更新してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@stop