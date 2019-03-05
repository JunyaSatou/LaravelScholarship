@extends ('layouts.base')

<style>
    #logout {
        margin-top:20px;
        text-align: center;
    }
    #menu table{
        /*position: relative;*/
        table-layout: auto;
        font-size: 10pt;
        height: 10%;
    }
    #menu td{
        padding-top: 15px;
    }
</style>
@section ('title', 'MENU')

@section ('content')
    <div id="menu">
        <table border="1" align="center">
            <tr>
                <th style="text-align: center;" width="200">新規シミュレーション</th>
                <td align="center" valign="middle" width="200">
                    <form action="/login/setting" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="submit" value="新規シミュレーション">
                    </form>
                </td>
            </tr>
            <tr>
                <th style="text-align: center;">繰上げシミュレーション</th>
                <td align="center" valign="middle" width="200">
                    <form action="/login/show" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="hidden" name="title" value="シミュレーション">
                        <input type="submit" value="繰上げシミュレーション">
                    </form>
                </td>
            </tr>
            <tr>
                <th style="text-align: center;">履歴から復元</th>
                <td align="center" valign="middle" width="200">
                    <form action="/login/show" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="hidden" name="title" value="シミュレーション">
                        <input type="submit" value="履歴から復元">
                    </form>
                </td>
            </tr>
        </table>
    </div>
    <div id="logout">
        <input type="button" value="ログアウト" onclick="location.href='/login'">
    </div>
@endsection

@section ('footer')
    copyright 2019 Metaps-payment.
@endsection
