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
@section ('title', 'ログイン画面')

@section ('content')
    <div id="msg">
        @if (isset($msg))
            <p align="center">{{$msg}}</p>
        @endif
    </div>
    <div id="content">
        <table align="center" border="1pt">
            <tr>
                <td align="left">返済シミュレーション</td>
                <td align="center" valign="middle">
                    <form action="/login/action1" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="submit" value="返済シミュレーション">
                    </form>
                </td>
            </tr>
            <tr>
                <td align="left">履歴を復元</td>
                <td align="center" valign="middle">
                    <form action="/login/action3" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="submit" value="履歴を復元">
                    </form>
                </td>
            </tr>
        </table>
    </div>
    <div>
        <form action="/logout" method="post">
            {{ csrf_field() }}
            <div id="logout">
                <input type="submit" value="ログアウト">
            </div>
        </form>
    </div>
@endsection

@section ('footer')
    copyright 2019 Metaps-payment.
@endsection
