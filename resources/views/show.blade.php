@extends('layouts.base')

<style>
    #col1{
        background-color: #87CEEB;
        color: #000;
    }
</style>
@section('title', 'シミュレーション結果')
    
@section('content')
    <div id="show">
        <table align="center" border="1pt">
            <tr id="col1">
                <th>残り回数</th><th>残額</th><th>引落日</th><th>返済金額</th><th>返済元金</th><th>据置利息</th><th>利息</th><th>端数</th><th>引落後残額</th>
            </tr>
            @foreach ($items as $item)
                <tr>
                    <td>{{$item->zankai}}</td><td>{{$item->zangaku}}</td><td>{{$item->hikibi}}</td><td>{{$item->hensaigaku}}</td><td>{{$item->hensaimoto}}</td><td>{{$item->suerisoku}}</td><td>{{$item->risoku}}</td><td>{{$item->hasu}}</td><td>{{$item->atozangaku}}</td>
                </tr>                
            @endforeach
        </table>
    </div>

    <div id="content">
        <table align="center">
            <tr>
                <td>
                    <form action="/login/action1" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="submit" value="新規">
                    </form>
                </td>
                <td>
                    <form action="/login/action2" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="submit" value="保存">
                    </form>
                </td>    
                <td>
                    <form action="/login/action3" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="name" value="{{$name}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="submit" value="履歴">
                    </form>
                </td>
            </tr>
        </table>
@endsection
