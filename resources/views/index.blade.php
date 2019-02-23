@extends ('layouts.base')

<style>
    #logout {
        margin-top:50px;
        text-align: center;
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
        <form action="/login/action" method="POST">
            {{ csrf_field() }}
            <table align="center" border="1pt">
                <tr>
                    <th align="left">返済シミュレーション</th>
                    <td>
                        <input type="hidden" name="pattern" value="1">
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="submit" value="返済シミュレーション">
                    </td>
                </tr>
                <tr>
                    <th align="left">以前の履歴を復元</th>
                    <td>
                        <input type="hidden" name="pattern" value="2">
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="submit" value="履歴を復元">
                    </td>
                </tr>
            </table>
        </form>
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
