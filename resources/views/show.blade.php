@extends('layouts.base')

<style>
    #col1{
        background-color: #87CEEB;
        color: #000;
    }
    .pagination {
        font-size: 15pt;
        text-align: center;
    }
    .pagination li {
        display:inline-block;
        /*background-color: #87CEEB;*/
        border: 1px;
    }
    /*input.submit_button{*/
        /*width: 150px;*/
        /*height: 100px;*/
        /*font-size: 1.2em;*/
    /*}*/
</style>
@section('title', 'シミュレーション')
    
@section('content')
    <div id="show">
        @if (count($items) == 0)
            <p align="center">履歴が存在しません</p>
        @else
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
                        <th>削除</th>
                    </tr>
                    @foreach ($items as $item)
                        <tr>
                            <td width="80" align="center"><a href="detail?name={{$name}}&email={{$email}}&id={{$item->id}}">{{$item->id}}</a></td>
                            <td width="80">{{$item->zankai}}</td>
                            <td width="120">{{$item->zangaku}}</td>
                            <td width="140">{{$item->hikibi}}</td>
                            <td width="120">{{$item->hensaigaku}}</td>
                            <td width="120">{{$item->hensaimoto}}</td>
                            <td width="80">{{$item->suerisoku}}</td>
                            <td width="80">{{$item->risoku}}</td>
                            <td width="80">{{$item->hasu}}</td>
                            <td width="120">{{$item->atozangaku}}</td>
                            <td width="80" align="center">
                                <input type="checkbox" name="delbox" value="{{$item->id}}">
                            </td>
                        </tr>
                    @endforeach
                </table>
            </form>
            {{ $items->appends(['email' => $email, 'name' => $name])->links() }}
        @endif
    </div>
    @if ($msg != '')
        <p align="center">{{$msg}}</p>
    @endif
    <div id="content">
        <table align="center">
            <tr>
                <form action="/login/setting" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="name" value="{{$name}}">
                    <input type="hidden" name="email" value="{{$email}}">
                    <td><input class="submit_button" type="submit" value="新規シミュレーション"></td>
                    <td><input class="submit_button" type="button" name="act2" value="前に戻る" onclick="history.back()"></td>
                </form>
                <form action="/logout" method="post" align="center">
                    {{ csrf_field() }}
                    <td>
                        <input class="submit_button" type="submit" value="ログアウト">
                    </td>
                </form>
            </tr>
        </table>
    </div>
@endsection
