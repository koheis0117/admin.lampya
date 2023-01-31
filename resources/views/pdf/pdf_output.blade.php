<html lang="ja">
    <head>
        <title>pdf output test</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            @font-face{
                font-family: migmix;
                font-style: normal;
                font-weight: normal;
                src: url("{{ storage_path('fonts/migmix-2p-regular.ttf')}}") format('truetype');
            }
            @font-face{
                font-family: migmix;
                font-style: bold;
                font-weight: bold;
                src: url("{{ storage_path('fonts/migmix-2p-bold.ttf')}}") format('truetype');
            }
            body {
                font-family: migmix;
                line-height: 80%;
            }
            table {
                border-collapse: collapse;
                width: 100%;
            }
            .table {
            width: 100%;
            text-align: center;
            border-collapse: collapse;
            border-spacing: 0;
            }
            .table tr:last-of-type {
            background: #b8b8b8;
            border-top: solid 2px #666666;
            font-weight: bold;
            }
            .table th {
            padding: 10px;
            background: #778ca3;
            border: solid 1px #666666;
            color: #ffffff;
            }
            .table td {
            padding: 10px;
            border: solid 1px #666666;
            }

        </style>
    </head>
    <body>
      <h2 style="text-align: center;">在庫管理表</h2>
      <h4 style="text-align: right;">発行日時：{{$now}}</h4>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">管理番号</th>
            <th scope="col">商品名</th>
            <th scope="col">仕入原価</th>
            <th scope="col">在庫数</th>
            <th scope="col">在庫金額</th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $item)
          <tr>
              <td>{{ $item->control_number }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->cost_price }}</td>
              <td>{{ $item->max_count }}</td>
              <td>
              @php
                  $a = $item->cost_price;
                  $b = $item->max_count;
                  $total = $a * $b;
                  echo '¥'.number_format($total)
              @endphp
              </td>
          </tr>
          @endforeach
          <tr>
              <td>合計</td>
              <td></td>
              <td></td>
              <td>{{$item_amount}}</td>
              <td>
              @php
                  echo '¥'.number_format($total_cost)
              @endphp
              </td>
          </tr>
        </tbody>
      </table>
    </body>
</html>