@extends('layouts.base')

<style>
    .pagination {
        /*font-size: 15pt;*/
        text-align: center;
    }

    .pagination li {
        display: inline-block;
        /*background-color: #87CEEB;*/
        border: 1px;
    }


    #links2 {
        margin-top: 20px;
    }

    #searchField {
        position: relative;
        margin: 10px 100px 10px 100px;
        padding: 20px 50px 0px 50px;

        border: 1px solid #818182;
    }

    #searchField .caption {
        position: absolute;
        top: 0;
        left: 0;

        font-size: 1em;
        padding: 0px 10px 0px 10px;
        background-color: #f8fafc;
        color: black;
        transform: translateY(-130%) translateX(1em);
        letter-spacing: 5px
    }

    #searchField table {
        position: relative;
        table-layout: auto;
        width: 100%;
        height: 5%;
    }

    #searchField #csvout {
        margin-top: 40px;
        font-size: 20pt;
        float: left;
    }

    #searchField #submit {
        display: block;
        margin-top: 40px;
        margin-right: 120px;
    }

    #searchField .rows {
        margin-top: -20px;
        height: 10px;
    }

    #showField {
        margin: 30px 100px 30px 100px;
    }

    #showField table {
        table-layout: auto;
        width: 100%;
    }

    #showField #col1 {
        background-color: #87CEEB;
        color: #000;
        text-align: center;
    }
</style>
@section('title', "シミュレーション")

@section('script')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script>
        function submitAfterValidation() {
            if (document.searchForm.searchID.value.length == 0
                && (document.searchForm.year.value.length == 0
                    || document.searchForm.month.value.length == 0)
                && document.searchForm.zankai.value.length == 0) {
                alert('検索条件が設定されていません')
                return;
            }

            if (document.searchForm.searchID2.value.length > 0) {
                if (document.searchForm.searchID.value.length == 0) {
                    document.searchForm.searchID.focus();
                    alert('明細IDが入力されていません')
                    return;
                }
            }
            if (document.searchForm.year.value.length > 0) {
                if (document.searchForm.month.value.length == 0) {
                    document.searchForm.month.focus();
                    alert('月が選択されていません')
                    return;
                }
            }
            if (document.searchForm.year2.value.length > 0) {
                if (document.searchForm.month2.value.length == 0) {
                    document.searchForm.month2.focus();
                    alert('月が選択されていません')
                    return;
                }
            }
            if (document.searchForm.month.value.length > 0) {
                if (document.searchForm.year.value.length == 0) {
                    document.searchForm.year.focus();
                    alert('年が選択されていません')
                    return;
                }
            }
            if (document.searchForm.month2.value.length > 0) {
                if (document.searchForm.year2.value.length == 0) {
                    document.searchForm.year2.focus();
                    alert('年が選択されていません')
                    return;
                }
            }

            if (document.searchForm.year2.value.length > 0) {
                if (document.searchForm.year.value.length == 0) {
                    document.searchForm.year.focus();
                    alert('年が選択されていません')
                    return;
                }
            }
            if (document.searchForm.zankai2.value.length > 0) {
                if (document.searchForm.zankai.value.length == 0) {
                    document.searchForm.zankai.focus();
                    alert('残り回数が選択されていません')
                    return;
                }
            }
            document.searchForm.submit();
        }

        // 削除ボタン押下
        $(function () {
            $('.delete_button').on('click', function () {
                if (confirm('本当に削除していいですか?')) {
                    $.ajax({
                        url: '/login/ajax_del',
                        type: 'get',
                        data: {
                            name: '{{$name}}',
                            email: '{{$email}}',
                            searchID: $(this).attr('title')
                        },
                    })
                    // Ajaxリクエストが成功した場合
                        .done(function (data) {
                            alert("削除しました。");
                            // $('#item_'+$(this).attr('title')).css("display","none");
                            location.reload();
                        })
                        // Ajaxリクエストが失敗した場合
                        .fail(function (data) {
                            alert(data.responseJSON);
                        });
                    return true;
                }
                return false;
            });
        });
    </script>
@endsection

@section('content')
    <div id="show">
        @if (count($items) == 0)
            <p align="center">履歴が存在しません</p>
        @else
            <div id="searchField">
                <h1 class="caption">検索条件</h1>
                <form name="searchForm" action="/login/search" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="name" value="{{$name}}">
                    <input type="hidden" name="email" value="{{$email}}">
                    <input type="hidden" name="title" value="検索結果">
                    <table>
                        <tr class="rows">
                            <th width="70" style="text-align: right;">明細ID：</th>
                            <td width="70"><input id="searchID" type="number" min="1" max="240" style="width: 70px" name="searchID">
                            </td>
                            <td width="5">〜</td>
                            <td width="70"><input id="searchID2" type="number" min="1" max="240" style="width: 70px" name="searchID2">
                            </td>
                            <th style="text-align: right;">引落年月：</th>
                            <td width="150">
                                <select id="year" name="year">
                                    <option value="" selected>年</option>
                                    @for($i = (int)date('Y') - 20; $i <= (int)date('Y') + 20; $i++)
                                        <option value="{{$i}}">{{$i}}月</option>
                                    @endfor
                                </select>
                                <select id="month" name="month">
                                    <option value="" selected>月</option>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{$i}}">{{$i}}月</option>
                                    @endfor
                                </select>
                            </td>
                            <td width="5">〜</td>
                            <td width="160">
                                <select id="year2" name="year2">
                                    <option value="" selected>年</option>
                                    @for($i = (int)date('Y') - 20; $i <= (int)date('Y') + 20; $i++)
                                        <option value="{{$i}}">{{$i}}月</option>
                                    @endfor
                                </select>
                                <select id="month2" name="month2">
                                    <option value="" selected>月</option>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{$i}}">{{$i}}月</option>
                                    @endfor
                                </select>
                            </td>
                            <th style="text-align: right;">残り回数：</th>
                            <td width="90"><input id="zankai" type="number" min="0" max="240" step="1" style="width: 70px" name="zankai">回</td>
                            <td width="5">〜</td>
                            <td width="90"><input id="zanakai2" type="number" min="0" max="240" step="1" style="width: 70px" name="zankai2">回</td>
                        </tr>
                    </table>
                    <div id="csvout">
                        <input style="width: 120px;" type="button" value="CSV出力"
                               onclick="location.href='csv?name={{$name}}&email={{$email}}'">
                    </div>
                    <div id="submit" align="center">
                        <input type="button" value="検索" onclick="submitAfterValidation()">
                    </div>
                </form>
            </div>
            <div id="showField">
                <div id="links1">
                    {{ $items->appends(['email' => $email, 'name' => $name])->onEachSide(1)->links() }}
                </div>
                <table align="center" border="1">
                    <thead>
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
                    </thead>
                    <tbody>
                    @foreach ($items as $item)
                        <tr id="item_{{$item->meisai_id}}">
                            <td align="center"><a
                                        href="search?name={{$name}}&email={{$email}}&title=詳細&searchID={{$item->meisai_id}}">{{str_pad($item->meisai_id,4,0,STR_PAD_LEFT)}}</a>
                            </td>
                            <td>{{$item->zankai}}回</td>
                            <td>{{$item->zangaku}}</td>
                            <td>{{date('Y年n月j日', strtotime($item->hikibi . '+0 day'))}}</td>
                            <td>{{$item->hensaigaku}}</td>
                            <td>{{$item->hensaimoto}}</td>
                            <td>{{$item->suerisoku}}</td>
                            <td>{{$item->risoku}}</td>
                            <td>{{$item->hasu}}</td>
                            <td>{{$item->atozangaku}}</td>
                            <td align="center">
                                <a href="#" class="delete_button" title="{{$item->meisai_id}}">削除</a>
                                {{--<a href="javascript:void(0)" class="delete_button" title="{{$item->meisai_id}}">削除</a>--}}
                                {{--<a href="" class="delete_button" title="{{$item->meisai_id}}">削除</a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div id="links2">
                    {{ $items->appends(['email' => $email, 'name' => $name])->onEachSide(1)->links() }}
                </div>
            </div>
        @endif
    <div/>
    <div id="buttons">
        <table align="center">
            <tr>
                {{--<form action="/login/preset" method="POST">--}}
                {{--{{ csrf_field() }}--}}
                {{--<input type="hidden" name="name" value="{{$name}}">--}}
                {{--<input type="hidden" name="email" value="{{$email}}">--}}
                {{--<td>--}}
                {{--<input class="submit_button" type="submit" value="繰上げシミュレーション">--}}
                {{--</td>--}}
                {{--</form>--}}
                <form action="/login/viewMenu" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="name" value="{{$name}}">
                    <input type="hidden" name="email" value="{{$email}}">
                    <td>
                        <input class="submit_button" type="submit" value="メニューに戻る">
                    </td>
                </form>
                <td>
                    <input class="submit_button" type="button" value="ログアウト" onclick="location.href='/login'">
                </td>
            </tr>
        </table>
    </div>
@endsection

@section ('footer')
    copyright 2019 Metaps-payment.
@endsection
