@extends ('layouts.base')

<style>
    #logout {
        margin-top:50px;
        text-align: center;
    }
    table{
        font-size: 14pt;
    }
</style>
@section ('title', '設定')

@section ('content')
    <div id="content">
        <form action="/login/action4" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="name" value="{{$name}}">
            <input type="hidden" name="email" value="{{$email}}">
            <table align="center" border="1pt">
                <tr>
                    <td align="left">貸与金額</td>
                    <td><input type="text" name="goukei"></td>
                </tr>
                <tr>
                    <td align="left">返済終了年</td>
                    <td><input type="text" name="finyear"></td>
                </tr>
                <tr>
                    <td align="left">返済終了月</td>
                    <td><input type="text" name="finmonth"></td>
                </tr>        
                <tr>
                    <td align="left">年利</td>
                    <td><input type="text" name="nenri"></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center"><input type="submit" value="シミュレーション開始"></td>
                </tr>
            </table>
        </form>
    </div>
@endsection

@section ('footer')
    copyright 2019 Metaps-payment.
@endsection
