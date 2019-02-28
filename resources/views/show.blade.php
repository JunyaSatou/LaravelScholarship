@extends('layouts.base')

<style>
    #col1 {
        background-color: #87CEEB;
        color: #000;
        text-align: center;
    }

    .pagination {
        /*font-size: 15pt;*/
        text-align: center;
    }

    .pagination li {
        display: inline-block;
        /*background-color: #87CEEB;*/
        border: 1px;
    }

    #msg {
        text-align: center;
        color: red;
        margin-bottom: -10px;
    }

    #submit {
        margin-top: 10pt;
        text-align: center;
    }

    #addJokens{
        margin-top: 10px;
    }
</style>
@section('title', $title)

@section('content')
    <div id="show">
        @if (count($items) == 0)
            <p align="center">履歴が存在しません</p>
        @else
            <form action="/login/search" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="name" value="{{$name}}">
                <input type="hidden" name="email" value="{{$email}}">
                <input type="hidden" name="title" value="シミュレーション">
                <section>

                </section>
                <div id="submit">
                    <input type="submit" value="検索">
                </div>
            </form>
            <form action="/login/del" method="post">
                {{ csrf_field() }}
                <table align="center" border="1pt">
                    <tr id="col1">
                        <th>明細ID</th>
                        <th>残り回数</th>
                        <th>残額</th>
                        <th>引落日</th>
                        <th>返済金額</th>
                        <th>返済元金</th>
                        <th>据置利息</th>
                        <th>利息</th>
                        <th>端数</th>
                        <th>引落後残額</th>
                        @if ($title != '詳細')
                            <th>削除</th>
                        @endif
                    </tr>
                    @foreach ($items as $item)
                        <tr>
                            {{--<td width="80" align="center"><a href="detail?name={{$name}}&email={{$email}}&id={{$item->id}}">{{$item->id}}</a></td>--}}
                            @if ($title != '詳細')
                                <td width="80" align="center"><a
                                            href="show?name={{$name}}&email={{$email}}&searchID={{$item->id}}&title=詳細">{{$item->meisai_id}}</a>
                                </td>
                            @else
                                <td width="80" align="center">{{$item->meisai_id}}</td>
                            @endif
                            <td width="80">{{$item->zankai}}</td>
                            <td width="120">{{$item->zangaku}}</td>
                            <td width="140">{{$item->hikibi}}</td>
                            <td width="120">{{$item->hensaigaku}}</td>
                            <td width="120">{{$item->hensaimoto}}</td>
                            <td width="80">{{$item->suerisoku}}</td>
                            <td width="80">{{$item->risoku}}</td>
                            <td width="80">{{$item->hasu}}</td>
                            <td width="120">{{$item->atozangaku}}</td>
                            @if ($title != '詳細')
                                <td width="80" align="center"><a
                                            href="del?name={{$name}}&email={{$email}}&id={{$item->id}}&title={{$title}}">削除</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </form>
            <div align="center">
                {{ $items->appends(['email' => $email, 'name' => $name, 'title' => $title])->onEachSide(1)->links() }}
                {{--{{ $items->appends(['email' => $email, 'name' => $name, 'title' => $title])->links() }}--}}
            </div>
        @endif
    </div>
    @if ($msg != '')
        <p align="center">{{$msg}}</p>
    @endif
    <div id="content">
        <table align="center">
            <tr>
                <form action="/login/csv" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="name" value="{{$name}}">
                    <input type="hidden" name="email" value="{{$email}}">
                    @if ($title == '詳細')
                        <input type="hidden" name="searchID" value="{{$item->id}}">
                    @endif
                    <td>
                        <input class="submit_button" type="submit" value="CSV出力">
                    </td>
                </form>
                @if ($title != '詳細')
                    <form action="/login/setting" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <td><input type="submit" value="新規シミュレーション"></td>
                        {{--<td><input type="button" name="act3" value="前に戻る" onclick="history.back()"></td>--}}
                    </form>
                    <form action="/logout" method="post">
                        {{ csrf_field() }}
                        <td>
                            <input type="submit" value="ログアウト">
                        </td>
                    </form>
                @else
                    <td><input type="button" value="一覧に戻る" onclick="history.back()"></td>
                @endif
            </tr>
        </table>
    </div>
@endsection
