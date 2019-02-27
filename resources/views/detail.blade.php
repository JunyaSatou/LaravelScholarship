@extends('layouts.base')

<style>
    #col1 {
        background-color: #87CEEB;
        color: #000;
    }

    #button {
        margin-top: 15pt;
        text-align: center;
    }
</style>
@section('title', '詳細')

@section('content')
    <div id="show">
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
            </tr>
            <tr>
                <td width="80">{{$item->id}}</td>
                <td width="80">{{$item->zankai}}</td>
                <td width="120">{{$item->zangaku}}</td>
                <td width="140">{{$item->hikibi}}</td>
                <td width="120">{{$item->hensaigaku}}</td>
                <td width="120">{{$item->hensaimoto}}</td>
                <td width="80">{{$item->suerisoku}}</td>
                <td width="80">{{$item->risoku}}</td>
                <td width="80">{{$item->hasu}}</td>
                <td width="120">{{$item->atozangaku}}</td>
            </tr>
        </table>
    </div>
    <div id="button">
        <input type="button" value="一覧に戻る" onclick="history.back()">
    </div>
@endsection
