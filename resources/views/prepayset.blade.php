@extends ('layouts.base')

<style>
    .msg{
        color: red;
        text-align: right;
    }
    table#buttons{
        margin-top: 15pt;
    }
    tr.rows{
        text-align: right;
    }
</style>
@section ('title', '繰り上げ設定')

@section ('content')
    <div id="content">
        <form action="/login/prepay" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="title" value="繰り上げシミュレーション結果">
            @if(isset($name))
                <input type="hidden" name="name" value={{$name}}>
                <input type="hidden" name="email" value="{{$email}}">
            @else
                <input type="hidden" name="name" value={{old('name')}}>
                <input type="hidden" name="email" value="{{old('email')}}">
            @endif
            <table align="center">
                @if ($errors->has('year'))
                    <tr class="msg"><th>ERROR：</th><td align="left">{{$errors->first('year')}}</td></tr>
                @endif
                <tr class="rows">
                    <td width="140">繰り上げ年：</td>
                    <td align="left" width="250"><input type="text" name="year" size="15" value="{{old('year')}}"> 円</td>
                </tr>
                @if ($errors->has('month'))
                    <tr class="msg"><th>ERROR：</th><td align="left">{{$errors->first('month')}}</td></tr>
                @endif
                <tr class="rows">
                    <td width="140">繰り上げ月：</td>
                    <td align="left" width="250"><input type="text" name="month" size="15" value="{{old('month')}}"> 年</td>
                </tr>
                @if ($errors->has('kingaku'))
                    <tr class="msg"><th>ERROR：</th><td align="left">{{$errors->first('kingaku')}}</td></tr>
                @endif
                <tr class="rows">
                    <td width="140">繰上げ金額：</td>
                    <td align="left" width="250"><input type="text" name="kingaku" size="15" value="{{old('kingaku')}}"> 月</td>
                </tr>
            </table>
            <table id="buttons" align="center">
                <td><input type="submit" name="act1" value="シミュレーション開始"></td>
                <td><input type="button" name="act2" value="前に戻る" onclick="history.back()"></td>
            </table>
        </form>
    </div>
@endsection

@section ('footer')
    copyright 2019 Metaps-payment.
@endsection
