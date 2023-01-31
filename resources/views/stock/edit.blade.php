@extends('adminlte::page')

@section('title', '登録在庫編集')

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
              <div class="card-header bg-success">
                <h3 class="card-title">登録在庫修正</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form method="POST" action="{{ route('stock_update') }}" onSubmit="return checkSubmit()">
                @csrf
                    <input type="hidden" name="id" value="{{ $stock->id }}">
                    <input type="hidden" name="item_id" value="{{ $stock->item_id }}">
                    <input type="hidden" name="status" value="{{ $stock->status }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">No.</label>
                                <p>{{$stock->id}}</p>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                                <label for="id">商品名</label>
                                <p>{{ $stock->item->name }}</p>
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">処理</label>
                                @if($stock->status == '1')
                                　<p>入庫</p>
                                @endif
                                @if($stock->status == '2')
                                　<p>出庫</p>
                                @endif
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">数量</label>
                                <input type="text" class="form-control" id="count" name="count" value="@php echo abs($stock->count); @endphp">
                                @if ($errors->has('count'))
                                    <div class="text-danger">
                                        {{ $errors->first('count') }}
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