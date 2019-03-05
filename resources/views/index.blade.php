@extends ('layouts.base')

<style>
    #logout {
        margin-top: 20px;
        text-align: center;
    }

    #menu table {
        table-layout: auto;
        font-size: 10pt;
        height: 10%;
    }
</style>
@section ('title', 'MENU')

@section ('content')
    <div id="menu">
        <table border="1" align="center">
            <tr>
                <th style="text-align: center;" width="200">新規シミュレーション</th>
                <form action="/login/setting" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="name" value="{{$name}}">
                    <input type="hidden" name="email" value="{{$email}}">
                    <td align="center" width="200">
                        <input type="submit" value="新規シミュレーション">
                    </td>
                </form>
            </tr>
            <tr>
                <th style="text-align: center;">履歴から復元</th>
                <form action="/login/show" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="name" value="{{$name}}">
                    <input type="hidden" name="email" value="{{$email}}">
                    <input type="hidden" name="title" value="シミュレーション">
                    <td align="center" width="200">
                        <input type="submit" value="履歴から復元">
                    </td>
                </form>
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
