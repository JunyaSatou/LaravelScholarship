@extends ('layouts.base')

<style>
    #logout {
        margin-top:50px;
        text-align: center;
    }
    table{
        font-size: 14pt;
    }
    .rows {
        vertical-align: middle;
        height: 30pt;
    }
    .button{
        margin-top: 15pt;
    }
</style>
@section ('title', 'MENU')

@section ('content')
    <div id="msg">
        @if (isset($msg))
            <p align="center">{{$msg}}</p>
        @endif
    </div>
    <div id="content">
        <table align="center" border="1pt">
            <tr class="rows">
                <th align="left" width="200">新規シミュレーション</th>
                <td align="center" valign="middle" width="130">
                    <form action="/login/setting" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <div class="button">
                            <input type="submit" value="新規シミュレーション">
                        </div>
                    </form>
                </td>
            </tr>
            <tr class="rows">
                <th align="left">履歴から復元</th>
                <td align="center" valign="middle">
                    <form action="/login/history" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <div class="button">
                            <input type="submit" value="履歴から復元">
                        </div>
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
