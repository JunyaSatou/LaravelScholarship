@extends ('layouts.base')

<style>
    #logout {
        margin-top:50px;
        text-align: center;
    }
    table{
        font-size: 14pt;
        text-align: center;
        border: 1pt;
    }
    #submit{
        text-align: center;
        margin-top: 10pt;
    }
</style>
@section ('title', '設定')

@section ('content')
    <div id="content">
        <form action="/login/start" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="name" value="{{$name}}">
            <input type="hidden" name="email" value="{{$email}}">
            <table align="center">
                @if ($errors->has('goukei'))
                    <tr><th>ERROR：</th><td>{{$errors->first('goukei')}}</td></tr>
                @endif
                <tr>
                    <td align="left">借用金額</td>
                    {{--<td><input type="number" name="goukei" placeholder="10000">円</td>--}}
                    <td><input type="text" name="goukei">円</td>
                </tr>
                @if ($errors->has('finyear'))
                    <tr><th>ERROR：</th><td>{{$errors->first('finyear')}}</td></tr>
                @endif
                <tr>
                    <td align="left">借用終了年</td>
                    {{--<td><input type="number" name="finyear" placeholder="2019">年</td>--}}
                    <td><input type="text" name="finyear">年</td>
                </tr>
                @if ($errors->has('finmonth'))
                    <tr><th>ERROR：</th><td>{{$errors->first('finmonth')}}</td></tr>
                @endif
                <tr>
                    <td align="left">借用終了月</td>
                    {{--<td><input type="number" name="finmonth" placeholder="3">月</td>--}}
                    <td><input type="text" name="finmonth">月</td>
                </tr>
                @if ($errors->has('nenri'))
                    <tr><th>ERROR：</th><td>{{$errors->first('nenri')}}</td></tr>
                @endif
                <tr>
                    <td align="left">年利</td>
                    {{--<td><input type="text" name="nenri" placeholder="0.16">%</td>--}}
                    <td><input type="text" name="nenri">%</td>
                </tr>
            </table>
            <div id="submit">
                <input type="submit" value="シミュレーション開始">
            </div>
        </form>
    </div>
@endsection

@section ('footer')
    copyright 2019 Metaps-payment.
@endsection
