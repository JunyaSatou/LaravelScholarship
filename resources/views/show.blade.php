@extends('layouts.base')

<style>
    #col1{
        background-color: #87CEEB;
        color: #000;
    }
</style>
@section('title', 'シミュレーション')
    
@section('content')
    <div id="show">
        @if (count($items) == 0)
            <p align="center">履歴が存在しません</p>
        @else
            <table align="center" border="1pt">
                <tr id="col1">
                    <th>残り回数</th><th>残額</th><th>引落日</th><th>返済金額</th><th>返済元金</th><th>据置利息</th><th>利息</th><th>端数</th><th>引落後残額</th>
                </tr>
                @foreach ($items as $item)
                    <tr>
                        <td>{{$item->zankai}}</td><td>{{$item->zangaku}}</td><td>{{$item->hikibi}}</td><td>{{$item->hensaigaku}}</td><td>{{$item->hensaimoto}}</td><td>{{$item->suerisoku}}</td><td>{{$item->risoku}}</td><td>{{$item->hasu}}</td><td>{{$item->atozangaku}}</td></tr>
                @endforeach
            </table>
        @endif
    </div>
    @if ($msg != '')
        <p align="center">{{$msg}}</p>
    @endif
    <div id="content">
        <table align="center">
            <tr>
                <td>
                    <form action="/login/new" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="submit" value="新規シミュレーション">
                    </form>
                </td>
                <td>
                    <form action="/logout" method="post" align="center">
                        {{ csrf_field() }}
                        <input type="submit" value="ログアウト">
                    </form>
                </td>
            </tr>
        </table>

@endsection
