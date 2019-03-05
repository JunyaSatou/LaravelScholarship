@extends ('layouts.base')

<style>
    .msg{
        color: red;
        text-align: right;
    }
    table#buttons{
        margin-top: 15pt;
    }
    tr.rows{
        text-align: right;
    }
</style>
@section ('title', '繰上げ設定')

@section ('content')
    <script>
        function maxLengthCheck(object){
            if (object.value.length > object.maxLength){
                object.value = object.value.slice(0, object.maxLength);
            }
        }
    </script>
    <div id="content">
        <div id="msg" align="center">
            <p>{{$msg}}</p>
        </div>
        <form action="/login/prepay" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="title" value="繰上げシミュレーション結果">
            @if(isset($name))
                <input type="hidden" name="name" value={{$name}}>
                <input type="hidden" name="email" value="{{$email}}">
            @else
                <input type="hidden" name="name" value={{old('name')}}>
                <input type="hidden" name="email" value="{{old('email')}}">
            @endif
            <table align="center">
                <tr class="rows">
                    <td width="140">繰上げ実施年：</td>
                    <td align="left" width="150">
                        <select name="year" style="width: 100px;">
                            @foreach($years as $yearK => $yearV)
                                <option value="{{$yearV}}">{{$yearV}}月</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr class="rows">
                    <td width="140">繰上げ実施月：</td>
                    <td align="left" width="150">
                        <select name="month" style="width: 100px;">
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{$i}}">{{$i}}月</option>
                            @endfor
                        </select>
                    </td>
                </tr>
                @if ($errors->has('kingaku'))
                    <tr class="msg"><th>ERROR：</th><td align="left">{{$errors->first('kingaku')}}</td></tr>
                @endif
                <tr class="rows">
                    <td width="140">繰上げ実施金額：</td>
                    <td align="left" width="150"><input type="number" name="kingaku" style="width: 100px;" min="0" maxlength="8" minlength="1" oninput="maxLengthCheck(this)" required> 円</td>
                </tr>
            </table>
            <table id="buttons" align="center">
                <td><input type="submit" name="act1" value="シミュレーション開始"></td>
                <td><input type="button" name="act2" value="前に戻る" onclick="history.back()"></td>
            </table>
        </form>
    </div>
@endsection

@section ('footer')
    copyright 2019 Metaps-payment.
@endsection
