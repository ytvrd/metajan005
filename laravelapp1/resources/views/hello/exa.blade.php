@extends('layouts.helloapp')

@section('content')
@if(isset($items))
<div>
<form action="/laravelapp1/public/hello/edit" method="POST" enctype="multipart/form-data">
            @csrf
<div class="left">

<div class="left1">
    <div class="left11">
        <img src="{{ asset('/img/logo.jpg') }}" width="60" height="40">
    </div>
    <div class="left12">
        <p><font size="4">MetaJan社内用</font></p>
    </div>
    <div class="left13">
        <button id="sinki" type="button" style="width:100%;font-size:20px;" >新規作成</button>
    </div>
    <div class="left14">
        <button id="manual" type="button" style="width:100%;font-size:20px;">操作マニュアル</button>
    </div>
</div>
<div class="left2">
    <div class="left21">
        タイトル
    </div>
    <div class="left22">
        <img id="titleh" src="{{ asset('/img/hatena.png') }}" height="20">
    </div>
    <div class="left23">
        <input id="title" type="text" name="title" size="80" value="{{$items["title"]}}">
    </div>
</div>
<div class="left3">
    <div class="left31">
        サブタイトル
    </div>
    <div class="left32">
        <img id="subtitleh" src="{{ asset('/img/hatena.png') }}" height="20">
    </div>
    <div class="left33">
        <input id="subtitle" type="text" name="subtitle" size="80" value="{{$items["subtitle"]}}">
    </div>
</div>
<div class="left4">
    <div class="left41">
        本編開始TC
    </div>
    <div class="left42">
        <img id="honkaih" src="{{ asset('/img/hatena.png') }}" height="20">
    </div>
    <div class="left43">
        <input id="honkai" type="text" name="honkai" size="20" value="{{$items["honkai"]}}">
    </div>
    <div class="left44">
        本編全体長
    </div>
    <div class="left45">
        <img id="honzenh" src="{{ asset('/img/hatena.png') }}" height="20">
    </div>
    <div class="left46">
        <input id="honzen" type="text" name="honzen" size="20" value="{{$items["honzen"]}}">
    </div>
</div>
<div class="left5">
    <div class="left51">
        ブロック
    </div>
    <div class="left52">
        @if($items["blocknum"]!=0)
        <input id="blocknum" type="text" value="{{$items["blocknum"]+1}}" name="blocknum" readonly>
        @else
        <input id="blocknum" type="text" value="0" name="blocknum" readonly>
        @endif
    </div>
    <div class="left53">
        件
    </div>
    <div class="left54">
        <button id="example" type="button">記載例</button>
    </div>
    <div class="left55">
        <button id="blockcmadd" type="button">CM+本編追加</button>
    </div>
    <div class="left56">
        <button id="blockadd" type="button">行追加</button>
    </div>
    <div class="left57">
        <button id="blockinsert" type="button">行挿入</button>
    </div>
    <div class="left58">
        <!--<button id="blockdel" type="button">行削除</button>-->
    </div>
</div>
<div class="left6">
    <table id="block" border="1">
      
      <tr>
          <th>開始TC</th>
          <th>終了TC</th>
          <th>項目</th>
          <th>素材情報</th>
          <th>Duration</th>
          <th>備考　20文字以内</th>
          <th>削除</th>
      </tr>


      @if($items["blocknum"]!=0)
      @for($i=1;$i<=$items["blocknum"]+1;$i++)
      @if($i<=$items["blocknum"])
      <tr id="block{{$i}}">
          <td><input id="block_start{{$i}}" type="text" name="block_start{{$i}}" size="10" class="block_start" value="{{$items["block_start"][$i-1]}}"></td>
          <td><input id="block_end{{$i}}" type="text" name="block_end{{$i}}" size="10" class="block_end" value="{{$items["block_end"][$i-1]}}"></td>
          <td>
              {{Form::select('block_obj'.$i, ['PG-本編', 'CM-無信号', 'SC-提供ベースのみ','BB-黒味','SC-提供(映像のみ記録)','SC-提供(音声のみ記録)',
                'SC-提供(映像・音声記録)','CM-焼きこみCM','NS-抜き素材','PG-本編(無信号)','CB-カラーバー','CR-クレジット','LC-ラストカット','FC-ファーストカット','END',''],$items["block_obj"][$i-1],['class'=>'block_obj','id'=>'block_obj'.$i])}}
          </td>
          <td>
              {{Form::select('block_source'.$i, ['','R-1', 'CM1', '提供1','R-2', 'CM2', '提供2','R-3', 'CM3', '提供3','R-4', 'CM4', '提供4','R-5', 'CM5', '提供5'
                ,'R-6', 'CM6', '提供6','R-7', 'CM7', '提供7','R-8', 'CM8', '提供8','R-9', 'CM9', '提供9','R-10', 'CM10', '提供10','R-11', 'CM11','R-12', 'CM12'
                ,'R-13', 'CM13','R-14', 'CM14','R-15', 'CM15','R-16','R-17','R-18','R-19','R-20'],$items["block_source"][$i-1],['class'=>'block_source','id'=>'block_source'.$i])}}
          </td>
          <td><input id="block_dur{{$i}}" type="text" name="block_dur{{$i}}" size="10"  class="block_dur" value="{{$items["block_dur"][$i-1]}}"></td>
          <td><input id="block_bik{{$i}}" type="text" name="block_bik{{$i}}" size="20"  class="block_bik" value="{{$items["block_bik"][$i-1]}}"></td>
          <td><input id="blockdel{{$i}}" type="button" value="削除" class="blockdel"></td>
      </tr>
      @else
      <tr id="block{{$i}}">
          <td><input id="block_start{{$i}}" type="text" name="block_start{{$i}}" size="10" class="block_start" value="{{$items["block_end"][$i-2]}}"></td>
          <td><input id="block_end{{$i}}" type="text" name="block_end{{$i}}" size="10" class="block_end"></td>
          <td>
              {{Form::select('block_obj'.$i, ['PG-本編', 'CM-無信号', 'SC-提供ベースのみ','BB-黒味','SC-提供(映像のみ記録)','SC-提供(音声のみ記録)',
                'SC-提供(映像・音声記録)','CM-焼きこみCM','NS-抜き素材','PG-本編(無信号)','CB-カラーバー','CR-クレジット','LC-ラストカット','FC-ファーストカット','END',''],14,['class'=>'block_obj','id'=>'block_obj'.$i])}}
          </td>
          <td>
              {{Form::select('block_source'.$i, ['','R-1', 'CM1', '提供1','R-2', 'CM2', '提供2','R-3', 'CM3', '提供3','R-4', 'CM4', '提供4','R-5', 'CM5', '提供5'
                ,'R-6', 'CM6', '提供6','R-7', 'CM7', '提供7','R-8', 'CM8', '提供8','R-9', 'CM9', '提供9','R-10', 'CM10', '提供10','R-11', 'CM11','R-12', 'CM12'
                ,'R-13', 'CM13','R-14', 'CM14','R-15', 'CM15','R-16','R-17','R-18','R-19','R-20'],null,['class'=>'block_source','id'=>'block_source'.$i])}}
          </td>
          <td><input id="block_dur{{$i}}" type="text" name="block_dur{{$i}}" size="10"  class="block_dur"></td>
          <td><input id="block_bik{{$i}}" type="text" name="block_bik{{$i}}" size="20"  class="block_bik"></td>
          <td><input id="blockdel{{$i}}" type="button" value="削除" class="blockdel"></td>
      </tr>
      @endif
      @endfor
      @endif
      

    </table>
</div>
<div class="left7">
    <div class="left71">
        キーポイント
    </div>
    <div class="left72">
        <input id="keynum" type="text" value="{{$items["keynum"]}}" name="keynum" readonly>
    </div>
    <div class="left73">
        件
    </div>
    <div class="left74">
        <button id="keyadd" type="button">行追加</button>
    </div>
    <div class="left75">
        <!--<button id="keyinsert" type="button">行挿入</button>-->
    </div>
    <div class="left76">
        <button id="keydel" type="button">行削除</button>
    </div>
    <div class="left77">
        <img id="keypointh" src="{{ asset('/img/hatena.png') }}" height="20">
    </div>
</div>
<div class="left8">
    <table id="keypoint" border="1">
    

    <tr>
        <th>開始TC</th>
        <th>終了TC</th>
        <th>Duration</th>
        <th>種別</th>
        <th>内容</th>
    </tr>

    @for($i=1;$i<=$items["keynum"];$i++)
        <tr>
            <td><input id="key_start{{$i}}" type="text" name="key_start{{$i}}" size="10" value="{{$items["key_start"][$i-1]}}"></td>
            <td><input id="key_end{{$i}}" type="text" name="key_end{{$i}}" size="10" value="{{$items["key_end"][$i-1]}}"></td>
            <td><input id="key_dur{{$i}}" type="text" name="key_dur{{$i}}" size="10" value="{{$items["key_dur"][$i-1]}}"></td>
            <td><input id="key_shu{{$i}}" type="text" name="key_shu{{$i}}" size="10" value="{{$items["key_shu"][$i-1]}}"></td>
            <td><input id="key_nai{{$i}}" type="text" name="key_nai{{$i}}" size="10" value="{{$items["key_nai"][$i-1]}}"></td>
            
        </tr>
        @endfor
    

    </table>
</div>

</div>


<div class="right">

<div class="right1">
    <div class="right101">
            <input type="file" id="file" name="file" class="form-control">
            <input type="button" value="メタデータ読み込み" name="read" id="read">
    </div>
    <div class="right102">
        
            <input type="button" value="JOBシート作成" name="job" id="job">
    </div>
    <div class="right103">
        
            <input type="button" value="メタデータ保存" name="meta" id="meta">
    </div>
    <div class="right104">
        <img height="40px" alt="ロゴ" src="{{ asset('/img/ytvlogo.bmp') }}">
    </div>
</div>
<div class="right2">
    <div class="right201">
        読み込みメタデータファイル名
    </div>
    <div class="right202">
        <input id="readfile" type="text" name="readfile" size="80" value="{{$items["readfile"]}}">
    </div>
</div>
<div class="right3">
    <div class="right301">
        ファイルID
    </div>
    <div class="right302">
        <img id="fileidh" src="{{ asset('/img/hatena.png') }}" height="20">
    </div>
    <div class="right303">
        <input id="fileid_read" type="text" name="fileid" size="80" value="{{$items["fileid"]}}">
    </div>
    <div class="right304">
        メディアNo
    </div>
    <div class="right305">
        <input id="mediano" type="text" name="mediano" size="20" value="{{$items["mediano"]}}">
    </div>
</div>
<div class="right4">
    <div class="right401">
        放送局
    </div>
    <div class="right402">
        <input id="housoukyoku" type="text" name="housoukyoku" value="{{$items["housoukyoku"]}}">
    </div>
    <div class="right403">
        放送日
    </div>
    <div class="right404">
        <img id="housoubih" src="{{ asset('/img/hatena.png') }}" height="20">
    </div>
    <div class="right405">
        <input id="housoubi_read" name="housoubi" type="date" value="{{$items["housoubi"]}}">
    </div>
    <div class="right406">
        放送時刻
    </div>
    <div class="right407">
        <img id="housoujikokuh" src="{{ asset('/img/hatena.png') }}" height="20">
    </div>
    <div class="right408">
        <input id="housoujikoku" type="text" name="housoujikoku" value="{{$items["housoujikoku"]}}">
    </div>
</div>
<div class="right5">
    <div class="right501">
        話数
    </div>
    <div class="right502">
        <input id="wasuu" type="text" name="wasuu" value="{{$items["kaisuu"]}}">
    </div>
    <div class="right503">
        ロール番号
    </div>
    <div class="right504">
        <img id="rollh" src="{{ asset('/img/hatena.png') }}" height="20">
    </div>
    <div class="right505">
        <input id="roll1" type="text" name="roll1" value="{{$items["roll1"]}}">
    </div>
    <div class="right506">
        /
    </div>
    <div class="right507">
        <input id="roll2" type="text" name="roll2" value="{{$items["roll2"]}}">
    </div>
    <div class="right508">
        用途
    </div>
    <div class="right509">
        <img id="youtoh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right510">
        {{Form::select('youtof', ['','放送', '放送予備', 'ネット', '保存','裏送り','番組管理','素材','素材予備','その他'],$items["youtof"],['id'=>'youtof'])}}
    </div>
    <div class="right511">
        映像
    </div>
    <div class="right512">
        <img id="eizouh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right513">
        <input id="eizou" type="text" name="eizou" value="HD" size="5">
    </div>
</div>
<div class="right6">
    <div class="right601">
        メディア種別
    </div>
    <div class="right602">
        <img id="mediashubetuh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right603">
        {{Form::select('mediashubetuf', ['','XDCAM', 'HDCAM', 'HDCAM-SR'],$items["mediashubetuf"],['id'=>'mediashubetuf'])}}
    </div>
    <div class="right604">
        メディアフォーマット
    </div>
    <div class="right605">
        <input id="mediaformat" type="text" name="mediaformat" value="{{$items["mediaformat"]}}">
    </div>
    <div class="right606">
        OA
    </div>
    <div class="right607">
        {{Form::select('oaf', ['','地上波', 'BS', 'CS','裏送り','その他'],$items["oaf"])}}
    </div>
</div>
<div class="right7">
    <div class="right701">
        メモ
    </div>
    <div class="right702">
        <input id="memo" type="text" name="memo" size="100" value="{{$items["memo"]}}">
    </div>
</div>
<div class="right8">
    <div class="right801">
        音声モード
    </div>
    <div class="right802">
        <img id="onseimodeh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right803">
        {{Form::select('onseimodef', ['','ステレオ', 'モノラル', 'デュアルモノラル','3モノラル','デュアルステレオ','5.1チャンネル','5.1チャンネルステレオ+ステレオ'],$items["onseimodef"],['id'=>'onseimodef'])}}
    </div>
    <div class="right804">
        ラウドネス計測
    </div>
    <div class="right805">
        <img id="roudnessh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right806">
        {{Form::select('roudnessf', ['', 'テープ毎','総尺'],$items["roudnessf"],['id'=>'roudness'])}}
    </div>
</div>
<div class="right9">
    <div class="right901">
        CH01
    </div>
    <div class="right902">
        {{Form::select('ch01f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],$items["ch01f"],['id'=>'ch01f'])}}
    </div>
    <div class="right903">
        CH02
    </div>
    <div class="right904">
        {{Form::select('ch02f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],$items["ch02f"],['id'=>'ch02f'])}}
    </div>
    <div class="right905">
        CH03
    </div>
    <div class="right906">
        {{Form::select('ch03f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],$items["ch03f"],['id'=>'ch03f'])}}
    </div>
    <div class="right907">
        CH04
    </div>
    <div class="right908">
        {{Form::select('ch04f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],$items["ch04f"],['id'=>'ch04f'])}}
    </div>
    <div class="right909">
        ストップマーク
    </div>
    <div class="right910">
        <img id="stopmarkh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right911">
        {{Form::select('stopmarkf', ['','ストップマーク無し', 'ストップマーク有り'],$items["stopmarkf"],['id'=>'stopmarkf'])}}
    </div>
</div>
<div class="right10">
    <div class="right1001">
        CH05
    </div>
    <div class="right1002">
        {{Form::select('ch05f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],$items["ch05f"],['id'=>'ch05f'])}}
    </div>
    <div class="right1003">
        CH06
    </div>
    <div class="right1004">
        {{Form::select('ch06f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],$items["ch06f"],['id'=>'ch06f'])}}
    </div>
    <div class="right1005">
        CH07
    </div>
    <div class="right1006">
        {{Form::select('ch07f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],$items["ch07f"],['id'=>'ch07f'])}}
    </div>
    <div class="right1007">
        CH08
    </div>
    <div class="right1008">
        {{Form::select('ch08f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],$items["ch08f"],['id'=>'ch08f'])}}
    </div>
    <div class="right1009">
        1009
    </div>
</div>
<div class="right11">
    <div class="right1101">
        平均ラウドネス値(LKFS)
    </div>
    <div class="right1102">
        <img id="heikinroudnessh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right1103">
        トゥルーピーク値(dBTP)
    </div>
    <div class="right1104">
        <img id="truepeakh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right1105">
        1105
    </div>
</div>
<div class="right12">
    <div class="right1201">
        主音声
    </div>
    <div class="right1202">
        <input id="roudnessmainaudio" type="text" name="roudnessmainaudio" value="{{$items["roudnessmainaudio"]}}">
    </div>
    <div class="right1203">
        主音声
    </div>
    <div class="right1204">
        <input id="truepeakmainaudio" type="text" name="truepeakmainaudio" value="{{$items["truepeakmainaudio"]}}">
    </div>
    <div class="right1205">
        1205
    </div>
</div>
<div class="right13">
    <div class="right1301">
        副音声
    </div>
    <div class="right1302">
        <input id="roudnesssubaudio" type="text" name="roudnesssubaudio" value="{{$items["roudnesssubaudio"]}}">
    </div>
    <div class="right1303">
        副音声
    </div>
    <div class="right1304">
        <input id="truepeaksubaudio" type="text" name="truepeaksubaudio" value="{{$items["truepeaksubaudio"]}}">
    </div>
    <div class="right1305">
        1305
    </div>
</div>
<div class="right14">
    <div class="right1401">
        第3音声
    </div>
    <div class="right1402">
        <input id="roudnesssanaudio" type="text" name="roudnesssanaudio" value="{{$items["roudnesssanaudio"]}}">
    </div>
    <div class="right1403">
        第3音声
    </div>
    <div class="right1404">
        <input id="truepeaksanaudio" type="text" name="truepeaksanaudio" value="{{$items["truepeaksanaudio"]}}">
    </div>
    <div class="right1405">
        1405
    </div>
</div>
<div class="right15">
    <div class="right1501">
        作業履歴
    </div>
    <div class="right1502">
        <input id="sagyounum" type="text" name="sagyounum" value="{{$items["sagyounum"]}}" readonly>
    </div>
    <div class="right1503">
        件
    </div>
    <div class="right1504">
        <button id="sagyouadd" type="button">行追加</button>
    </div>
    <div class="right1505">
        <!--<button id="sagyouinsert" type="button">行挿入</button>-->
    </div>
    <div class="right1506">
        <button id="sagyoudel" type="button">行削除</button>
    </div>
</div>
<div class="right16">
    <table id="sagyourireki" border="1">

    <tr>
    <th>作業日</th>
    <th>作業内容</th>
    <th>担当(姓)</th>
    <th>担当(名)</th>
    <th>会社</th>
    <th>連絡先</th>
    <th>収録機器</th>
    </tr>

    @for($i=1;$i<=$items["sagyounum"];$i++)
    <tr id="sagyourireki{{$i}}">
            <td><input id="sagyou_sagyoubi{{$i}}" name="sagyou_sagyoubi{{$i}}" class="sagyou_sagyoubi" type="date" value="{{$items["sagyou_sagyoubi"][$i-1]}}"></td>
            <td>
                {{Form::select('sagyou_naiyou'.$i, ['REC','PB','DUB','ED','ING','MA','PV','OA','(OA)','ERA','Meta','その他'],$items["sagyou_naiyou"][$i-1],['class'=>'sagyou_naiyou','id'=>'sagyou_naiyou'.$i])}}
            </td>
            <td><input id="sagyou_sei{{$i}}" type="text" name="sagyou_sei{{$i}}" class="sagyou_sei" size="10" value="{{$items["sagyou_sei"][$i-1]}}"></td>
            <td><input id="sagyou_mei{{$i}}" type="text" name="sagyou_mei{{$i}}" class="sagyou_mei" size="10" value="{{$items["sagyou_mei"][$i-1]}}"></td>
            <td><input id="sagyou_kaisha{{$i}}" type="text" name="sagyou_kaisha{{$i}}" class="sagyou_kaisha" size="15" value="{{$items["sagyou_kaisha"][$i-1]}}"></td>
            <td><input id="sagyou_renraku{{$i}}" type="text" name="sagyou_renraku{{$i}}" class="sagyou_renraku" size="15" value="{{$items["sagyou_renraku"][$i-1]}}"></td>
            <td><input id="sagyou_shuroku{{$i}}" type="text" name="sagyou_shuroku{{$i}}" class="sagyou_shuroku" size="10" value="{{$items["sagyou_shuroku"][$i-1]}}"></td>
        </tr>
        @endfor

    </table>
</div>
<div class="right17">
    <div class="right1701">
        制作担当者
    </div>
    <div class="right1702">
        <input id="seisakunum" type="text" name="seisakunum" value="{{$items["seisakunum"]}}" readonly>
    </div>
    <div class="right1703">
        件
    </div>
    <div class="right1704">
        <button id="seisakuadd" type="button">行追加</button>
    </div>
    <div class="right1705">
        <!--<button id="seisakuinsert" type="button">行挿入</button>-->
    </div>
    <div class="right1706">
        <button id="seisakudel" type="button">行削除</button>
    </div>
</div>
<div class="right18">
    <table id="seisakutantousha" border="1">

    <tr>
    <th>職種</th>
    <th>担当(姓)</th>
    <th>担当(名)</th>
    <th>会社</th>
    <th>連絡先</th>
    </tr>

    

    @for($i=1;$i<=$items["seisakunum"];$i++)
        <tr id="seisakutantousha{{$i}}">
            <td><input id="seisaku_shokushu{{$i}}" type="text" name="seisaku_shokushu{{$i}}" size="10" value="{{$items["seisaku_shokushu"][$i-1]}}"></td>
            <td><input id="seisaku_sei{{$i}}" type="text" name="seisaku_sei{{$i}}" size="10" value="{{$items["seisaku_sei"][$i-1]}}"></td>
            <td><input id="seisaku_mei{{$i}}" type="text" name="seisaku_mei{{$i}}" size="10" value="{{$items["seisaku_mei"][$i-1]}}"></td>
            <td><input id="seisaku_kaisha{{$i}}" type="text" name="seisaku_kaisha{{$i}}" size="10" value="{{$items["seisaku_kaisha"][$i-1]}}"></td>
            <td><input id="seisaku_renraku{{$i}}" type="text" name="seisaku_renraku{{$i}}" size="10" value="{{$items["seisaku_renraku"][$i-1]}}"></td>
        </tr>
        @endfor
        </table>
</div>
    
</div>
</form>
</div>


























































@else

<!--読み取り以外-->





























































<div>
<form action="/laravelapp1/public/hello/edit" method="POST" enctype="multipart/form-data">
            @csrf
<div class="left">

<div class="left1">
    <div class="left11">
        <img src="{{ asset('/img/logo.jpg') }}" width="80%" height="100%">
    </div>
    <div class="left12">
        <p><font size="4">MetaJan社内用</font></p>
    </div>
    <div class="left13">
        <button id="sinki" type="button" style="width:100%;font-size:20px;" >新規作成</button>
    </div>
    <div class="left14">
        <button id="manual" type="button" style="width:100%;font-size:20px;">操作マニュアル</button>
    </div>
</div>
<div class="left2">
    <div class="left21">
        タイトル
    </div>
    <div class="left22">
        <img id="titleh" src="{{ asset('/img/hatena.png') }}" height="20">
    </div>
    <div class="left23">
        <input id="title" type="text" name="title" size="80">
    </div>
</div>
<div class="left3">
    <div class="left31">
        サブタイトル
    </div>
    <div class="left32">
        <img id="subtitleh" src="{{ asset('/img/hatena.png') }}" height="20">
    </div>
    <div class="left33">
        <input id="subtitle" type="text" name="subtitle" size="80">
    </div>
</div>
<div class="left4">
    <div class="left41">
        本編開始TC
    </div>
    <div class="left42">
        <img id="honkaih" src="{{ asset('/img/hatena.png') }}" height="20">
    </div>
    <div class="left43">
        <input id="honkai" type="text" name="honkai" size="20" value="10:00:00">
    </div>
    <div class="left44">
        本編全体長
    </div>
    <div class="left45">
        <img id="honzenh" src="{{ asset('/img/hatena.png') }}" height="20">
    </div>
    <div class="left46">
        <input id="honzen" type="text" name="honzen" size="20" value="00:00:00">
    </div>
</div>
<div class="left5">
    <div class="left51">
        ブロック
    </div>
    <div class="left52">
        <input id="blocknum" type="text" value="1" name="blocknum" readonly>
    </div>
    <div class="left53">
        件
    </div>
    <div class="left54">
        <button id="example" type="button">記載例</button>
    </div>
    <div class="left55">
        <button id="blockcmadd" type="button">CM+本編追加</button>
    </div>
    <div class="left56">
        <button id="blockadd" type="button">行追加</button>
    </div>
    <div class="left57">
        <button id="blockinsert" type="button">行挿入</button>
    </div>
    <div class="left58">
        <!--<button id="blockdel" type="button">行削除</button>-->
        58
    </div>
</div>
<div class="left6">
    <table id="block" border="1">
      
      <tr>
          <th>開始TC</th>
          <th>終了TC</th>
          <th>項目</th>
          <th>素材情報</th>
          <th>Duration</th>
          <th>備考　20文字以内</th>
          <th>削除</th>
      </tr>

      @for($i=1;$i<=1;$i++)
      <tr id="block{{$i}}">
          <td><input id="block_start{{$i}}" type="text" name="block_start{{$i}}" size="10" class="block_start"></td>
          <td><input id="block_end{{$i}}" type="text" name="block_end{{$i}}" size="10" class="block_end"></td>
          <td>
               {{Form::select('block_obj'.$i, ['PG-本編', 'CM-無信号', 'SC-提供ベースのみ','BB-黒味','SC-提供(映像のみ記録)','SC-提供(音声のみ記録)',
                'SC-提供(映像・音声記録)','CM-焼きこみCM','NS-抜き素材','PG-本編(無信号)','CB-カラーバー','CR-クレジット','LC-ラストカット','FC-ファーストカット','END',''],null,['class'=>'block_obj','id'=>'block_obj'.$i])}}
          </td>
          <td>
               {{Form::select('block_source'.$i, ['','R-1', 'CM1', '提供1','R-2', 'CM2', '提供2','R-3', 'CM3', '提供3','R-4', 'CM4', '提供4','R-5', 'CM5', '提供5'
                ,'R-6', 'CM6', '提供6','R-7', 'CM7', '提供7','R-8', 'CM8', '提供8','R-9', 'CM9', '提供9','R-10', 'CM10', '提供10','R-11', 'CM11','R-12', 'CM12'
                ,'R-13', 'CM13','R-14', 'CM14','R-15', 'CM15','R-16','R-17','R-18','R-19','R-20'],null,['class'=>'block_source','id'=>'block_source'.$i])}}
          </td>
          <td><input id="block_dur{{$i}}" type="text" name="block_dur{{$i}}" size="10" class="block_dur" readonly></td>
          <td><input id="block_bik{{$i}}" type="text" name="block_bik{{$i}}" size="20" class="block_bik"></td>
          <td><input id="blockdel{{$i}}" type="button" value="削除" class="blockdel"></td>
      </tr>
      @endfor
      

    </table>
</div>
<div class="left7">
    <div class="left71">
        キーポイント
    </div>
    <div class="left72">
        <input id="keynum" type="text" value="0" name="keynum" readonly>
    </div>
    <div class="left73">
        件
    </div>
    <div class="left74">
        <button id="keyadd" type="button">行追加</button>
    </div>
    <div class="left75">
        <!--<button id="keyinsert" type="button">行挿入</button>-->
        75
    </div>
    <div class="left76">
        <button id="keydel" type="button">行削除</button>
        
    </div>
    <div class="left77">
        <img id="keypointh" src="{{ asset('/img/hatena.png') }}" height="20">
    </div>
</div>
<div class="left8">
    <table id="keypoint" border="1">
    <tbody>

    <tr>
        <th>開始TC</th>
        <th>終了TC</th>
        <th>Duration</th>
        <th>種別</th>
        <th>内容</th>
    </tr>
    </tbody>

    </table>
</div>

</div>


<div class="right">

<div class="right1">
    <div class="right101">
            <input type="file" id="file" name="file" class="form-control"><br>
            <input type="button" value="メタデータ読み込み" name="read" id="read">
    </div>
    <div class="right102">
        
            <input type="button" value="JOBシート作成" name="job" id="job">
    </div>
    <div class="right103">
        
            <input type="button" value="メタデータ保存" name="meta" id="meta">
    </div>
    <div class="right104">
        <img height="40px" alt="ロゴ" src="{{ asset('/img/ytvlogo.bmp') }}">
    </div>
</div>
<div class="right2">
    <div class="right201">
        読み込みメタデータファイル名
    </div>
    <div class="right202">
        <input id="readfile" type="text" name="readfile" size="80">
    </div>
</div>
<div class="right3">
    <div class="right301">
        ファイルID
    </div>
    <div class="right302">
        <img id="fileidh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right303">
        <input id="fileid" type="text" name="fileid" size="80">
    </div>
    <div class="right304">
        メディアNo
    </div>
    <div class="right305">
        <input id="mediano" type="text" name="mediano" size="20">
    </div>
</div>
<div class="right4">
    <div class="right401">
        放送局
    </div>
    <div class="right402">
        <input id="housoukyoku" type="text" name="housoukyoku" value="読売テレビ">
    </div>
    <div class="right403">
        放送日
    </div>
    <div class="right404">
        <img id="housoubih" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right405">
        <input id="housoubi" name="housoubi" type="date">
    </div>
    <div class="right406">
        放送時刻
    </div>
    <div class="right407">
        <img id="housoujikokuh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right408">
        <input id="housoujikoku" type="text" name="housoujikoku" value="00:00:00" size="10">
    </div>
</div>
<div class="right5">
    <div class="right501">
        話数
    </div>
    <div class="right502">
        <input id="wasuu" type="text" name="wasuu" value="1">
    </div>
    <div class="right503">
        ロール番号
    </div>
    <div class="right504">
        <img id="rollh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right505">
        <input id="roll1" type="text" name="roll1">
    </div>
    <div class="right506">
        /
    </div>
    <div class="right507">
        <input id="roll2" type="text" name="roll2">
    </div>
    <div class="right508">
        用途
    </div>
    <div class="right509">
        <img id="youtoh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right510">
        {{Form::select('youtof', ['','放送', '放送予備', 'ネット', '保存','裏送り','番組管理','素材','素材予備','その他'],null,['id'=>'youtof'])}}
    </div>
    <div class="right511">
        映像
    </div>
    <div class="right512">
        <img id="eizouh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right513">
        <input id="eizou" type="text" name="eizou" value="HD" size="5">
    </div>
</div>
<div class="right6">
    <div class="right601">
        メディア種別
    </div>
    <div class="right602">
        <img id="mediashubetuh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right603">
        {{Form::select('mediashubetuf', ['','XDCAM', 'HDCAM', 'HDCAM-SR'],1,['id'=>'mediashubetuf'])}}
    </div>
    <div class="right604">
        メディアフォーマット
    </div>
    <div class="right605">
        <input id="mediaformat" type="text" name="mediaformat" value="MPEG HD422">
    </div>
    <div class="right606">
        OA
    </div>
    <div class="right607">
        {{Form::select('oaf', ['','地上波', 'BS', 'CS','裏送り','その他'])}}
    </div>
</div>
<div class="right7">
    <div class="right701">
        メモ
    </div>
    <div class="right702">
        <input id="memo" type="text" name="memo" size="100">
    </div>
</div>
<div class="right8">
    <div class="right801">
        音声モード
    </div>
    <div class="right802">
        <img id="onseimodeh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right803">
        {{Form::select('onseimodef', ['','ステレオ', 'モノラル', 'デュアルモノラル','3モノラル','デュアルステレオ','5.1チャンネル','5.1チャンネルステレオ+ステレオ','その他'],1,['id'=>'onseimodef'])}}
    </div>
    <div class="right804">
        ラウドネス計測
    </div>
    <div class="right805">
        <img id="roudnessh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right806">
        {{Form::select('roudnessf', ['', 'テープ毎','総尺'],2,['id'=>'roudnessf'])}}
    </div>
</div>
<div class="right9">
    <div class="right901">
        CH01
    </div>
    <div class="right902">
        {{Form::select('ch01f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],1,['id'=>'ch01f'])}}
    </div>
    <div class="right903">
        CH02
    </div>
    <div class="right904">
        {{Form::select('ch02f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],2,['id'=>'ch02f'])}}
    </div>
    <div class="right905">
        CH03
    </div>
    <div class="right906">
        {{Form::select('ch03f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],null,['id'=>'ch03f'])}}
    </div>
    <div class="right907">
        CH04
    </div>
    <div class="right908">
        {{Form::select('ch04f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],null,['id'=>'ch04f'])}}
    </div>
    <div class="right909">
        ストップマーク
    </div>
    <div class="right910">
        <img id="stopmarkh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right911">
        {{Form::select('stopmarkf', ['','ストップマーク無し', 'ストップマーク有り'],null,['id'=>'stopmarkf'])}}
    </div>
</div>
<div class="right10">
    <div class="right1001">
        CH05
    </div>
    <div class="right1002">
        {{Form::select('ch05f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],null,['id'=>'ch05f'])}}
    </div>
    <div class="right1003">
        CH06
    </div>
    <div class="right1004">
        {{Form::select('ch06f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],null,['id'=>'ch06f'])}}
    </div>
    <div class="right1005">
        CH07
    </div>
    <div class="right1006">
        {{Form::select('ch07f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],null,['id'=>'ch07f'])}}
    </div>
    <div class="right1007">
        CH08
    </div>
    <div class="right1008">
        {{Form::select('ch08f', ['','L', 'R','MIX L','MIX R','MONO','主音声','副音声','副音声1','副音声2','主音声L','主音声R','副音声L','副音声R','C','LFE','SL','SR','その他'],null,['id'=>'ch08f'])}}
    </div>
    <div class="right1009">
        1009
    </div>
</div>
<div class="right11">
    <div class="right1101">
        平均ラウドネス値(LKFS)
    </div>
    <div class="right1102">
        <img id="heikinroudnessh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right1103">
        トゥルーピーク値(dBTP)
    </div>
    <div class="right1104">
        <img id="truepeakh" src="{{ asset('/img/hatena.png') }}" width="20">
    </div>
    <div class="right1105">
        1105
    </div>
</div>
<div class="right12">
    <div class="right1201">
        主音声
    </div>
    <div class="right1202">
        <input id="roudnessmainaudio" type="text" name="roudnessmainaudio">
    </div>
    <div class="right1203">
        主音声
    </div>
    <div class="right1204">
        <input id="truepeakmainaudio" type="text" name="truepeakmainaudio">
    </div>
    <div class="right1205">
        1205
    </div>
</div>
<div class="right13">
    <div class="right1301">
        副音声
    </div>
    <div class="right1302">
        <input id="roudnesssubaudio" type="text" name="roudnesssubaudio">
    </div>
    <div class="right1303">
        副音声
    </div>
    <div class="right1304">
        <input id="truepeaksubaudio" type="text" name="truepeaksubaudio">
    </div>
    <div class="right1305">
        1305
    </div>
</div>
<div class="right14">
    <div class="right1401">
        第3音声
    </div>
    <div class="right1402">
        <input id="roudnesssanaudio" type="text" name="roudnesssanaudio">
    </div>
    <div class="right1403">
        第3音声
    </div>
    <div class="right1404">
        <input id="truepeaksanaudio" type="text" name="truepeaksanaudio">
    </div>
    <div class="right1405">
        1405
    </div>
</div>
<div class="right15">
    <div class="right1501">
        作業履歴
    </div>
    <div class="right1502">
        <input id="sagyounum" type="text" name="sagyounum" value="0">
    </div>
    <div class="right1503">
        件
    </div>
    <div class="right1504">
        <button id="sagyouadd" type="button">行追加</button>
    </div>
    <div class="right1505">
        <!--<button id="sagyouinsert" type="button">行挿入</button>-->
        1505
    </div>
    <div class="right1506">
        <button id="sagyoudel" type="button">行削除</button>
    </div>
</div>
<div class="right16">
    <table id="sagyourireki" border="1">

    <tr>
    <th>作業日</th>
    <th>作業内容</th>
    <th>担当(姓)</th>
    <th>担当(名)</th>
    <th>会社</th>
    <th>連絡先</th>
    <th>収録機器</th>
    </tr>

    </table>
</div>
<div class="right17">
    <div class="right1701">
        制作担当者
    </div>
    <div class="right1702">
        <input id="seisakunum" type="text" name="seisakunum" value="0">
    </div>
    <div class="right1703">
        件
    </div>
    <div class="right1704">
        <button id="seisakuadd" type="button">行追加</button>
    </div>
    <div class="right1705">
        <!--<button id="seisakuinsert" type="button">行挿入</button>-->
        1705
    </div>
    <div class="right1706">
        <button id="seisakudel" type="button">行削除</button>
    </div>
</div>
<div class="right18">
    <table id="seisakutantousha" border="1">

    <tr>
    <th>職種</th>
    <th>担当(姓)</th>
    <th>担当(名)</th>
    <th>会社</th>
    <th>連絡先</th>
    </tr>

    </table>
</div>
    
</div>
</form>
</div>
@endif
    
@endsection