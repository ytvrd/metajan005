@extends('layouts.helloapp')

@section('content')
<link rel="stylesheet" href="{{ asset('css/exa1.css') }}">
@if(isset($items))
<div>
<form action="/laravelapp1/public/hello/edit" method="POST" enctype="multipart/form-data">
            @csrf
<div class="left_cm">

<div class="left1_cm">
    <div class="left11_cm">
        <img src="{{ asset('/img/logo.jpg') }}" width="80%" height="100%">
    </div>
    <div class="left12_cm">
        <p><font size="4">MetaJanCM用</font></p>
    </div>
    <div class="left13_cm">
        <button id="sinki_cm" type="button" style="width:100%;font-size:20px;" >新規作成</button>
    </div>
    <div class="left14_cm">
        <input type="file" id="cmfile" name="cmfile" class="form-control"><br>
        <input type="button" value="CSV読み込み" name="read" id="csvread">
    </div>
</div>
<div class="left2_cm">
    <div class="left21_cm">
        メタデータver(必須)
    </div>
    <div class="left22_cm">
        <input id="metaver" type="text" name="metaver" size="50" value="1.0.0">
    </div>
</div>
<div class="left3_cm">
    <div class="left31_cm">
        CM素材名(必須)(全角)
    </div>
    <div class="left32_cm">
        <input id="cmsozai" type="text" name="cmsozai" size="50" value="{{$items["CM_name"]}}">
    </div>
</div>
<div class="left4_cm">
    <div class="left41_cm">
        CM作品名
    </div>
    <div class="left42_cm">
        <input id="cmsakuhin" type="text" name="cmsakuhin" size="50" value="{{$items["CM_original_name"]}}">
    </div>
</div>
<div class="left5_cm">
    <div class="left51_cm">
        制作広告会社名
    </div>
    <div class="left52_cm">
        <input id="cmkoukokumei" type="text" name="cmkoukokumei" size="50" value="{{$items["production_ADcompany_name"]}}">
    </div>
</div>
<div class="left6_cm">
    <div class="left61_cm">
        制作広告会社コード
    </div>
    <div class="left62_cm">
        <input id="cmkoukokucode" type="text" name="cmkoukokucode" size="50" value="{{$items["production_ADcompany_name_code"]}}">
    </div>
</div>
<div class="left7_cm">
    <div class="left71_cm">
        開始TC(必須)
        HH:MM:SS:FF
    </div>
    <div class="left72_cm">
        <input id="cmkaishiTC" type="text" name="cmkaishiTC" size="50" value="{{$items["start_timecode"]}}">
    </div>
</div>
<div class="left8_cm">
    <div class="left81_cm">
        映像種別(必須)
    </div>
    <div class="left82_cm">
        {{Form::select('cmeizouf', ['','HD', 'SD'],$items["video_definition_modef"],['id'=>'cmeizouf'])}}
    </div>
</div>
<div class="left9_cm">
    <div class="left91_cm">
        搬入媒体種別(必須)
    </div>
    <div class="left92_cm">
        {{Form::select('cmbaitaif', ['','XDCAM', 'P2'],$items["media_typef"],['id'=>'cmbaitaif'])}}
    </div>
</div>
<div class="left10_cm">
    <div class="left101_cm">
        備考(全角)
    </div>
    <div class="left102_cm">
        <input id="cmbikou" type="text" name="cmbikou" size="50" value="{{$items["remarks_column"]}}">
    </div>
</div>

</div>


<div class="right_cm">

<div class="right1_cm">
    <div class="right101_cm">
        
            <input type="file" id="file" name="file" class="form-control"><br>
            <input type="button" value="メタデータ読み込み" name="read" id="cmread">
    </div>
    <div class="right102_cm">
        <input type="button" value="メタデータ保存" name="meta" id="cmmetacreate">
    </div>
    <div class="right103_cm">
        <img height="40px" alt="ロゴ" src="{{ asset('/img/ytvlogo.bmp') }}"> 
    </div>
</div>
<div class="right2_cm">
    <div class="right201_cm">
        CM10桁コード(必須項目)
    </div>
    <div class="right202_cm">
        <input id="cmcode1" type="text" name="cmcode1" size="30" value="{{$items["cm_code_advertiser_id"]}}">
    </div>
    <div class="right203_cm">
        =
    </div>
    <div class="right204_cm">
        <input id="cmcode2" type="text" name="cmcode2" size="40" value="{{$items["cm_code_material_id"]}}">
    </div>
</div>
<div class="right3_cm">
    <div class="right301_cm">
        素材広告主名(必須)
    </div>
    <div class="right302_cm">
        <input id="cmsozaikoukoku" type="text" name="cmsozaikoukoku" size="50" value="{{$items["CM_sponsor_name"]}}">
    </div>
</div>
<div class="right4_cm">
    <div class="right401_cm">
        商品名
    </div>
    <div class="right402_cm">
        <input id="cmshouhinmei" type="text" name="cmshouhinmei" size="50" value="{{$items["product_name"]}}">
    </div>
</div>
<div class="right5_cm">
    <div class="right501_cm">
        制作会社名
    </div>
    <div class="right502_cm">
        <input id="cmseisakumei" type="text" name="cmseisakumei" size="50" value="{{$items["production_company_name"]}}">
    </div>
</div>
<div class="right6_cm">
    <div class="right601_cm">
        制作会社コード
    </div>
    <div class="right602_cm">
        <input id="cmseisakucode" type="text" name="cmseisakucode" size="50" value="{{$items["production_company_name_code"]}}">
    </div>
</div>
<div class="right7_cm">
    <div class="right701_cm">
        素材秒数(必須)
    </div>
    <div class="right702_cm">
        <input id="cmsozaitime" type="text" name="cmsozaitime" size="50" value="{{$items["CM_duration"]}}">
    </div>
</div>
<div class="right8_cm">
    <div class="right801_cm">
        音声モード(必須)
    </div>
    <div class="right802_cm">
        {{Form::select('cmonseimodef', ['','モノラル', 'ステレオ','5.1+S'],$items["audio_formatf"],['id'=>'cmonseimodef'])}}
    </div>
</div>
<div class="right9_cm">
    <div class="right901_cm">
        画角(必須)
    </div>
    <div class="right902_cm">
        {{Form::select('cmgakakuf', ['','4:3', '16:9'],$items["video_aspect_ratiof"],['id'=>'cmgakakuf'])}}
    </div>
</div>
<div class="right10_cm">
    <div class="right1001_cm">
        DF/NDF区分(必須)
    </div>
    <div class="right1002_cm">
        {{Form::select('cmdff', ['','DF', 'NDF'],$items["TC_count_modef"],['id'=>'cmdff'])}}
    </div>
</div>
<div class="right11_cm">
    <div class="right1101_cm">
        ラウドネス値(必須)
    </div>
    <div class="right1102_cm">
        <input id="cmroudness" type="text" name="cmroudness" size="50" value="{{$items["user_area_3"]}}">
    </div>
    <div class="right1103_cm">
        LKFS
    </div>
</div>
<div class="right12_cm">
    <div class="right1201_cm">
        字幕有無(必須)
    </div>
    <div class="right1202_cm">
        {{Form::select('cmjimakuf', ['','無し', '有り'],$items["CM_caption_existencef"],['id'=>'cmjimakuf'])}}
    </div>
</div>
<div class="right13_cm">
    <div class="right1301_cm">
        ユーザーエリア1
    </div>
    <div class="right1302_cm">
        <input id="cmuser1" type="text" name="cmuser1" size="50" value="{{$items["user_area_1"]}}">
    </div>
</div>
<div class="right14_cm">
    <div class="right1401_cm">
        ユーザーエリア2
    </div>
    <div class="right1402_cm">
        <input id="cmuser2" type="text" name="cmuser2" size="50" value="{{$items["user_area_2"]}}">
    </div>
</div>
</div>
</form>
</div>

























































@else

<!--読み取り以外-->





























































<div>
<form action="/laravelapp1/public/hello/edit" method="POST" enctype="multipart/form-data">
            @csrf
<div class="left_cm">

<div class="left1_cm">
    <div class="left11_cm">
        <img src="{{ asset('/img/logo.jpg') }}" width="80%" height="100%">
    </div>
    <div class="left12_cm">
        <p><font size="4">MetaJanCM用</font></p>
    </div>
    <div class="left13_cm">
        <button id="sinki_cm" type="button" style="width:100%;font-size:20px;">新規作成</button>
    </div>
    <div class="left14_cm">
        <input type="file" id="cmfile" name="cmfile" class="form-control"><br>
        <input type="button" value="CSV読み込み" name="read" id="csvread">
    </div>
</div>
<div class="left2_cm">
    <div class="left21_cm">
        メタデータver(必須)
    </div>
    <div class="left22_cm">
        <input id="metaver" type="text" name="metaver" size="50" value="1.0.0">
    </div>
</div>
<div class="left3_cm">
    <div class="left31_cm">
        CM素材名(必須)(全角)
    </div>
    <div class="left32_cm">
        <input id="cmsozai" type="text" name="cmsozai" size="50">
    </div>
</div>
<div class="left4_cm">
    <div class="left41_cm">
        CM作品名
    </div>
    <div class="left42_cm">
        <input id="cmsakuhin" type="text" name="cmsakuhin" size="50">
    </div>
</div>
<div class="left5_cm">
    <div class="left51_cm">
        制作広告会社名
    </div>
    <div class="left52_cm">
        <input id="cmkoukokumei" type="text" name="cmkoukokumei" size="50">
    </div>
</div>
<div class="left6_cm">
    <div class="left61_cm">
        制作広告会社コード
        (半角)
    </div>
    <div class="left62_cm">
        <input id="cmkoukokucode" type="text" name="cmkoukokucode" size="50" maxlength="4">
    </div>
</div>
<div class="left7_cm">
    <div class="left71_cm">
        開始TC(必須)
        HH:MM:SS:FF
    </div>
    <div class="left72_cm">
        <input id="cmkaishiTC" type="text" name="cmkaishiTC" size="50" maxlength="11">
    </div>
</div>
<div class="left8_cm">
    <div class="left81_cm">
        映像種別(必須)
    </div>
    <div class="left82_cm">
        {{Form::select('cmeizouf', ['','HD', 'SD'],1,['id'=>'cmeizouf'])}}
    </div>
</div>
<div class="left9_cm">
    <div class="left91_cm">
        搬入媒体種別(必須)
    </div>
    <div class="left92_cm">
        {{Form::select('cmbaitaif', ['','XDCAM', 'P2'],1,['id'=>'cmbaitaif'])}}
    </div>
</div>
<div class="left10_cm">
    <div class="left101_cm">
        備考(全角)
    </div>
    <div class="left102_cm">
        <input id="cmbikou" type="text" name="cmbikou" size="50">
    </div>
</div>

</div>


<div class="right_cm">

<div class="right1_cm">
    <div class="right101_cm">
        
            <input type="file" id="file" name="file" class="form-control"><br>
            <input type="button" value="メタデータ読み込み" name="cmread" id="cmread">
    </div>
    <div class="right102_cm">
        <input type="button" value="メタデータ保存" name="meta" id="cmmetacreate">
    </div>
    <div class="right103_cm">
        <img height="40px" alt="ロゴ" src="{{ asset('/img/ytvlogo.bmp') }}"> 
    </div>
</div>
<div class="right2_cm">
    <div class="right201_cm">
        CM10桁コード(必須項目)
    </div>
    <div class="right202_cm">
        <input id="cmcode1" type="text" name="cmcode1" size="30" maxlength="4">
    </div>
    <div class="right203_cm">
        =
    </div>
    <div class="right204_cm">
        <input id="cmcode2" type="text" name="cmcode2" size="40" maxlength="6">
    </div>
</div>
<div class="right3_cm">
    <div class="right301_cm">
        素材広告主名(必須)
    </div>
    <div class="right302_cm">
        <input id="cmsozaikoukoku" type="text" name="cmsozaikoukoku" size="50">
    </div>
</div>
<div class="right4_cm">
    <div class="right401_cm">
        商品名
    </div>
    <div class="right402_cm">
        <input id="cmshouhinmei" type="text" name="cmshouhinmei" size="50">
    </div>
</div>
<div class="right5_cm">
    <div class="right501_cm">
        制作会社名
    </div>
    <div class="right502_cm">
        <input id="cmseisakumei" type="text" name="cmseisakumei" size="50">
    </div>
</div>
<div class="right6_cm">
    <div class="right601_cm">
        制作会社コード(半角)
    </div>
    <div class="right602_cm">
        <input id="cmseisakucode" type="text" name="cmseisakucode" size="50" maxlength="4">
    </div>
</div>
<div class="right7_cm">
    <div class="right701_cm">
        素材秒数(必須)
    </div>
    <div class="right702_cm">
        <input id="cmsozaitime" type="text" name="cmsozaitime" size="50">
    </div>
</div>
<div class="right8_cm">
    <div class="right801_cm">
        音声モード(必須)
    </div>
    <div class="right802_cm">
        {{Form::select('cmonseimodef', ['','モノラル', 'ステレオ','5.1+S'],2,['id'=>'cmonseimodef'])}}
    </div>
</div>
<div class="right9_cm">
    <div class="right901_cm">
        画角(必須)
    </div>
    <div class="right902_cm">
        {{Form::select('cmgakakuf', ['','4:3', '16:9'],2,['id'=>'cmgakakuf'])}}
    </div>
</div>
<div class="right10_cm">
    <div class="right1001_cm">
        DF/NDF区分(必須)
    </div>
    <div class="right1002_cm">
        {{Form::select('cmdff', ['','DF', 'NDF'],1,['id'=>'cmdff'])}}
    </div>
</div>
<div class="right11_cm">
    <div class="right1101_cm">
        ラウドネス値(必須)
    </div>
    <div class="right1102_cm">
        <input id="cmroudness" type="text" name="cmroudness" size="50">
    </div>
    <div class="right1103_cm">
        LKFS
    </div>
</div>
<div class="right12_cm">
    <div class="right1201_cm">
        字幕有無(必須)
    </div>
    <div class="right1202_cm">
        {{Form::select('cmjimakuf', ['','無し', '有り'],0,['id'=>'cmjimakuf'])}}
    </div>
</div>
<div class="right13_cm">
    <div class="right1301_cm">
        ユーザーエリア1
    </div>
    <div class="right1302_cm">
        <input id="cmuser1" type="text" name="cmuser1" size="50">
    </div>
</div>
<div class="right14_cm">
    <div class="right1401_cm">
        ユーザーエリア2
    </div>
    <div class="right1402_cm">
        <input id="cmuser2" type="text" name="cmuser2" size="50">
    </div>
</div>
</div>
</form>
</div>
@endif
    
@endsection