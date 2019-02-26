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
    .msg{
        color: red;
    }
</style>
@section ('title', '設定')

@section ('content')
    <div id="content">
        <form action="/login/create" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="name" value="{{$name}}">
            <input type="hidden" name="email" value="{{$email}}">
            <table align="center">
                @if ($errors->has('goukei'))
                    <tr class="msg"><th align="right">ERROR：</th><td align="left">{{$errors->first('goukei')}}</td></tr>
                @endif
                <tr>
                    <td align="right" width="140">借用金額：</td>
                    <td align="left" width="250"><input type="text" name="goukei" size="15" value="{{old('goukei')}}"> 円</td>
                </tr>
                @if ($errors->has('finyear'))
                    <tr class="msg"><th align="right">ERROR：</th><td align="left">{{$errors->first('finyear')}}</td></tr>
                @endif
                <tr>
                    <td align="right" width="140">借用終了年：</td>
                    <td align="left" width="250"><input type="text" name="finyear" size="15" value="{{old('finyear')}}"> 年</td>
                </tr>
                @if ($errors->has('finmonth'))
                    <tr class="msg"><th align="right">ERROR：</th><td align="left">{{$errors->first('finmonth')}}</td></tr>
                @endif
                <tr>
                    <td align="right" width="140">借用終了月：</td>
                    <td align="left" width="250"><input type="text" name="finmonth" size="15" value="{{old('finmonth')}}"> 月</td>
                </tr>
                @if ($errors->has('nenri'))
                    <tr class="msg"><th align="right">ERROR：</th><td align="left">{{$errors->first('nenri')}}</td></tr>
                @endif
                <tr>
                    <td align="right" width="140">年利：</td>
                    <td align="left" width="250"><input type="text" name="nenri" size="15" value="{{old('nenri')}}"> %</td>
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
