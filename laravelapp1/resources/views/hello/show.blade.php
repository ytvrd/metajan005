

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>PDF</title>
<style>
@font-face{
    font-family: ipag;
    font-style: normal;
    font-weight: normal;
    src:url('{{ storage_path('fonts/ipag.ttf')}}');
}
body {
font-family: ipag;
}

p{
    text-align:center;
}

.main{
    width: 700px;
    height: 970px;
    background-color: white;
   /* border: 1px solid #000000;*/
}

div{
    font-size:x-small;
}

.top{
    width: 700px;
    height: 50px;
    background-color: white;
    border: 1px solid #000000;
}

.righttop{
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 20px;
    background-color: white;
    /*border: 1px solid #000000;*/
}

.rightbottom{
    position: absolute;
    top: 20;
    right: 10;
    width: 100px;
    height: 20px;
    background-color: white;
    /*border: 1px solid #000000;*/
}

.middle{
    width: 700px;
    height: 900px;
    margin-top:10px;
    background-color: white;
   /* border: 1px solid #000000;*/
}

.middle1{
    width: 700px;
    height: 40px;
    background-color: white;
    /*border: 1px solid #000000;*/
    position:relative;
}

.middle11{
    position: absolute;
    top: 0px;
    left: 0px;
    width: 300px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
}

.middle12{
    position: absolute;
    top: 0px;
    left: 300px;
    width: 200px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
}

.middle13{
    position: absolute;
    top: 0px;
    left: 500px;
    width: 200px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
    
}

.middle2{
    width: 700px;
    height: 40px;
    background-color: white;
   /* border: 1px solid #000000;*/
    position:relative;
}

.middle21{
    position: absolute;
    top: 0px;
    left: 0px;
    width: 300px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
}

.middle22{
    position: absolute;
    top: 0px;
    left: 300px;
    width: 150px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
}

.middle23{
    position: absolute;
    top: 0px;
    left: 450px;
    width: 150px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
}

.middle24{
    position: absolute;
    top: 0px;
    left: 600px;
    width: 100px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
    
}

.middle3{
    width: 700px;
    height: 40px;
    background-color: white;
   /* border: 1px solid #000000;*/
    position:relative;
}

.middle31{
    position: absolute;
    top: 0px;
    left: 0px;
    width: 150px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
}

.middle32{
    position: absolute;
    top: 0px;
    left: 150px;
    width: 150px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
}

.middle33{
    position: absolute;
    top: 0px;
    left: 300px;
    width: 50px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
}

.middle34{
    position: absolute;
    top: 0px;
    left: 350px;
    width: 150px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
    
}

.middle35{
    position: absolute;
    top: 0px;
    left: 500px;
    width: 150px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
    
}

.middle36{
    position: absolute;
    top: 0px;
    left: 650px;
    width: 50px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
    text-align:left;
    font-size: xx-small; 
}

.middle4{
    width: 700px;
    height: 770px;
    background-color: white;
  /*  border: 1px solid #000000;*/
    position:relative;
}

.middle41{
    width: 170px;
    height: 770px;
    background-color: white;
    border: 1px solid #000000;
    position:relative;
    float:left;
}

.middle411{
    width: 170px;
    height: 70px;
    background-color: white;
    border: 1px solid #000000;
    position:relative;
}

.middle4111{
    position: absolute;
    top: 10px;
    left: 10px;
    width: 50px;
    height: 10px;
    background-color: white;
    /*border: 1px solid #000000;*/
}

.middle4112{
    position: absolute;
    top: 30px;
    left: 60px;
    width: 10px;
    height: 30px;
    background-color: white;
    /*border: 1px solid #000000;*/
}

.middle4113{
    position: absolute;
    top: 30px;
    left: 90px;
    width: 50px;
    height: 30px;
    background-color: white;
    /*border: 1px solid #000000;*/
}

.middle421{
    width: 170px;
    height: 70px;
    background-color: white;
    border: 1px solid #000000;
    position:relative;
}

.middle4211{
    position: absolute;
    top: 10px;
    left: 10px;
    width: 50px;
    height: 10px;
    background-color: white;
    /*border: 1px solid #000000;*/
}

.middle4212{
    position: absolute;
    top: 30px;
    left: 60px;
    width: 10px;
    height: 30px;
    background-color: white;
    /*border: 1px solid #000000;*/
}

.middle4213{
    position: absolute;
    top: 30px;
    left: 90px;
    width: 50px;
    height: 30px;
    background-color: white;
    /*border: 1px solid #000000;*/
}

.middle42{
    width: 180px;
    height: 770px;
    background-color: white;
    border: 1px solid #000000;
    position:relative;
    float:left;
}

.middle43{
    width: 350px;
    height: 770px;
    background-color: white;
    border: 1px solid #000000;
    position:relative;
    float:left;
}

.middle431{
    width: 350px;
    height: 40px;
    background-color: white;
  /*  border: 1px solid #000000;*/
    position:relative;
    
}

.middle4311{
    position: absolute;
    top: 0px;
    left: 0px;
    width: 170px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
    
}

.middle4312{
    position: absolute;
    top: 0px;
    left: 170px;
    width: 180px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
    
}

.middle432{
    width: 350px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
    position:relative;
    
}

.middle433{
    width: 350px;
    height: 120px;
    background-color: white;
    border: 1px solid #000000;
    position:relative;
    
}

.middle434{
    width: 350px;
    height: 40px;
    background-color: white;
    border: 1px solid #000000;
    position:relative;
    
}

.middle435{
    width: 350px;
    height: 60px;
    background-color: white;
    border: 1px solid #000000;
    position:relative;
    
}

.middle436{
    width: 350px;
    height: 20px;
    background-color: white;
   /* border: 1px solid #000000;*/
    position:relative;
}

.middle4361{
    position: absolute;
    top: 0px;
    left: 0px;
    width: 70px;
    height: 20px;
    background-color: white;
    border: 1px solid #000000;
    font-size: xx-small; 
}

.middle4362{
    position: absolute;
    top: 0px;
    left: 70px;
    width: 70px;
    height: 20px;
    background-color: white;
    border: 1px solid #000000;
    font-size: xx-small; 
}

.middle4363{
    position: absolute;
    top: 0px;
    left: 140px;
    width: 70px;
    height: 20px;
    background-color: white;
    border: 1px solid #000000;
    font-size: xx-small; 
}

.middle4364{
    position: absolute;
    top: 0px;
    left: 210px;
    width: 70px;
    height: 20px;
    background-color: white;
    border: 1px solid #000000;
    font-size: xx-small; 
}

.middle4365{
    position: absolute;
    top: 0px;
    left: 280px;
    width: 70px;
    height: 20px;
    background-color: white;
    border: 1px solid #000000;
    font-size: xx-small; 
}


.middle437{
    width: 350px;
    height: 20px;
    background-color: white;
    border: 1px solid #000000;
    position:relative;
}


.middle438{
    width: 350px;
    height: 20px;
    background-color: white;
  /*  border: 1px solid #000000;*/
    position:relative;
}

.middle4381{
    position: absolute;
    top: 0px;
    left: 0px;
    width: 90px;
    height: 20px;
    background-color: white;
    border: 1px solid #000000;
    font-size: xx-small; 
}

.middle4382{
    position: absolute;
    top: 0px;
    left: 90px;
    width: 90px;
    height: 20px;
    background-color: white;
    border: 1px solid #000000;
    font-size: xx-small; 
}

.middle4383{
    position: absolute;
    top: 0px;
    left: 180px;
    width: 90px;
    height: 20px;
    background-color: white;
    border: 1px solid #000000;
    font-size: xx-small; 
}

.middle4384{
    position: absolute;
    top: 0px;
    left: 270px;
    width: 80px;
    height: 20px;
    background-color: white;
    border: 1px solid #000000;
    font-size: xx-small; 
}






.main2{
    
    width: 700px;
    height: 970px;
    background-color: white;
    border: 1px solid white;
    
   
}

.main21{
    margin-top:50px;
    width: 700px;
    height: 950px;
    background-color: white;
    border: 1px solid white;
    position:relative;
}

.main211{
    width: 230px;
    height: 930px;
    background-color: white;
    border: 1px solid #000000;
    position:relative;
    float:left;
}

.main2111{
    width: 230px;
    height: 90px;
    background-color: white;
    border: 1px solid #000000;
    position:relative;
}

.main21111{
    position: absolute;
    top: 10px;
    left: 10px;
    width: 50px;
    height: 10px;
    background-color: white;
    /*border: 1px solid #000000;*/
}

.main21112{
    position: absolute;
    top: 30px;
    left: 60px;
    width: 10px;
    height: 30px;
    background-color: white;
    /*border: 1px solid #000000;*/
}

.main21113{
    position: absolute;
    top: 30px;
    left: 90px;
    width: 20px;
    height: 30px;
    background-color: white;
    /*border: 1px solid #000000;*/
}

.main212{
    width: 230px;
    height: 930px;
    background-color: white;
    border: 1px solid #000000;
    position:relative;
    float:left;
}

.main213{
    width: 230px;
    height: 930px;
    background-color: white;
    border: 1px solid #000000;
    position:relative;
    float:left;
}






</style>
</head>
<body>
<div class="main">
    <div class="top">
        <p><font size="5">VTR記録表(JobSheet)</p>
        <!--<div class="righttop">
            Page:1
        </div>-->
        <div class="rightbottom">
            作成日:{{$items["today"]}}
        </div>
    </div>
    
    <div class="middle">
        <div class="middle1">
            <div class="middle11">
                タイトル<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$items["title"]}}
            </div>
            <div class="middle12">
                メディアID<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$items["mediano"]}}
            </div>
            <div class="middle13">
                放送日<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$items["housoubi"]}}
            </div>
        </div>
        
        
        <div class="middle2">
            <div class="middle21">
                サブタイトル<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$items["subtitle"]}}
            </div>
            
            <div class="middle22">
                話数<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$items["wasuu"]}}
            </div>
            <div class="middle23">
                ロール番号<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$items["roll"]}}
            </div>
            <div class="middle24">
                用途<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$items["youto"]}}
            </div>
        </div>

        <div class="middle3">
            <div class="middle31">
                本編開始TC<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$items["honkai"]}}
            </div>
            
            <div class="middle32">
                本編全体長<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$items["honzen"]}}
            </div>
            <div class="middle33">
                映像<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$items["eizou"]}}
            </div>
            <div class="middle34">
                メディア種別<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$items["mediashubetu"]}}
            </div>
            <div class="middle35">
                メディアフォーマット<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$items["mediaformat"]}}
            </div>
            <div class="middle36">
                OA<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$items["oa"]}}
            </div>
        </div>

        @php
        $counter=0;
        @endphp

        <div class="middle4">
            <div class="middle41">

            @if($items["blocknumh"][0]==$counter)
            @php
            $counter++;
            @endphp
            
            
            @for($i=0;$i<$items["blocknumh"][1];$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="middle411">
                    <div class="middle4111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4112" style="background-color:lightgray;">
                    </div>
                    <div class="middle4113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="middle411">
                    <div class="middle4111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4112" style="background-color:lightgray;">
                    </div>
                    <div class="middle4113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="middle411">
                    <div class="middle4111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4112" style="background-color:black;">
                    </div>
                    <div class="middle4113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="middle411">
                    <div class="middle4111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4112" style="background-color:black;">
                    </div>
                    <div class="middle4113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
            @endfor
            @elseif($items["blocknumh"][0]>$counter)
            @php
            $counter++;
            @endphp
            @for($i=0;$i<10;$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="middle411">
                    <div class="middle4111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4112" style="background-color:lightgray;">
                    </div>
                    <div class="middle4113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="middle411">
                    <div class="middle4111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4112" style="background-color:lightgray;">
                    </div>
                    <div class="middle4113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="middle411">
                    <div class="middle4111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4112" style="background-color:black;">
                    </div>
                    <div class="middle4113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="middle411">
                    <div class="middle4111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4112" style="background-color:black;">
                    </div>
                    <div class="middle4113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
                
            @endfor
            @endif
            </div>
            <div class="middle42">
            @if($items["blocknumh"][0]==$counter)
            @php
            $counter++;
            @endphp
            
            @for($i=0;$i<$items["blocknumh"][1];$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="middle421">
                    <div class="middle4211">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4212" style="background-color:lightgray;">
                    </div>
                    <div class="middle4213">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="middle421">
                    <div class="middle4211">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4212" style="background-color:lightgray;">
                    </div>
                    <div class="middle4213">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="middle421">
                    <div class="middle4211">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4212" style="background-color:black;">
                    </div>
                    <div class="middle4213">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="middle421">
                    <div class="middle4211">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4212" style="background-color:black;">
                    </div>
                    <div class="middle4213">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
            @endfor
            @elseif($items["blocknumh"][0]>$counter)
            @php
            $counter++;
            @endphp
            @for($i=0;$i<10;$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="middle421">
                    <div class="middle4211">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4212" style="background-color:lightgray;">
                    </div>
                    <div class="middle4213">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="middle421">
                    <div class="middle4211">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4212" style="background-color:lightgray;">
                    </div>
                    <div class="middle4213">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="middle421">
                    <div class="middle4211">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4212" style="background-color:black;">
                    </div>
                    <div class="middle4213">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="middle421">
                    <div class="middle4211">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="middle4212" style="background-color:black;">
                    </div>
                    <div class="middle4213">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
            @endfor
            @endif
            </div>
            <div class="middle43">
                <div class="middle431">
                    <div class="middle4311">
                        放送局<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{{$items["housoukyoku"]}}
                    </div>
                    <div class="middle4312">
                        ラウドネス計測<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{{$items["roudness"]}}
                    </div>
                </div>

                <div class="middle432">
                        音声モード<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{{$items["onseimode"]}}
                </div>

                <div class="middle433">
                        CH01(  {{$items["ch01"]}}  )  CH05(  {{$items["ch05"]}}  )<br>
                        CH02(  {{$items["ch02"]}}  )  CH06(  {{$items["ch06"]}}  )<br>
                        CH03(  {{$items["ch03"]}}  )  CH07(  {{$items["ch07"]}}  )<br>
                        CH04(  {{$items["ch04"]}}  )  CH08(  {{$items["ch08"]}}  )<br>
                        主音声  平均ラウドネス値(  {{$items["roudnessmainaudio"]}}  )  TP(  {{$items["truepeakmainaudio"]}}  )<br>
                        副音声  平均ラウドネス値(  {{$items["roudnesssubaudio"]}}  )  TP(  {{$items["truepeaksubaudio"]}}  )<br>
                        第三音声  平均ラウドネス値(  {{$items["roudnesssanaudio"]}}  )  TP(  {{$items["truepeaksanaudio"]}}  )<br>
                </div>

                <div class="middle434">
                        ファイルID<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{{$items["fileid"]}}
                </div>

                <div class="middle435">
                        メモ<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{{$items["memo"]}}
                </div>

                <div class="middle436">
                    <div class="middle4361">
                        作業日
                    </div>
                    <div class="middle4362">
                        作業内容
                    </div>
                    <div class="middle4363">
                        担当
                    </div>
                    <div class="middle4364">
                        会社
                    </div>
                    <div class="middle4365">
                        連絡先
                    </div>
                </div>

                

                @if($items["sagyounum"]<5)
                @for($i=0;$i<$items["sagyounum"];$i++)
                <div class="middle436">
                    <div class="middle4361">
                        {{$items["sagyou_sagyoubi"][$i]}}
                    </div>
                    <div class="middle4362">
                        {{$items["sagyou_naiyou"][$i]}}
                    </div>
                    <div class="middle4363">
                        {{$items["sagyou_name"][$i]}}
                    </div>
                    <div class="middle4364">
                        {{$items["sagyou_kaisha"][$i]}}
                    </div>
                    <div class="middle4365">
                        {{$items["sagyou_renraku"][$i]}}
                    </div>
                </div>
                
                @endfor
                @else
                @for($i=0;$i<5;$i++)
                <div class="middle436">
                    <div class="middle4361">
                        {{$items["sagyou_sagyoubi"][$i]}}
                    </div>
                    <div class="middle4362">
                        {{$items["sagyou_naiyou"][$i]}}
                    </div>
                    <div class="middle4363">
                        {{$items["sagyou_name"][$i]}}
                    </div>
                    <div class="middle4364">
                        {{$items["sagyou_kaisha"][$i]}}
                    </div>
                    <div class="middle4365">
                        {{$items["sagyou_renraku"][$i]}}
                    </div>
                </div>
                
                @endfor
                @endif
                

                

                <div class="middle437">
                        作業担当者
                </div>

                

                <div class="middle438">
                    <div class="middle4381">
                        職務
                    </div>
                    <div class="middle4382">
                        氏名
                    </div>
                    <div class="middle4383">
                        会社名
                    </div>
                    <div class="middle4384">
                        連絡先
                    </div>
                </div>



                @if($items["seisakunum"]<5)
                @for($i=0;$i<$items["seisakunum"];$i++)
                <div class="middle438">
                    <div class="middle4381">
                        {{$items["seisaku_shokushu"][$i]}}
                    </div>
                    <div class="middle4382">
                        {{$items["seisaku_name"][$i]}}
                    </div>
                    <div class="middle4383">
                        {{$items["seisaku_kaisha"][$i]}}
                    </div>
                    <div class="middle4384">
                        {{$items["seisaku_renraku"][$i]}}
                    </div>
                </div>
                @endfor
                @else
                @for($i=0;$i<5;$i++)
                <div class="middle438">
                    <div class="middle4381">
                        {{$items["seisaku_shokushu"][$i]}}
                    </div>
                    <div class="middle4382">
                        {{$items["seisaku_name"][$i]}}
                    </div>
                    <div class="middle4383">
                        {{$items["seisaku_kaisha"][$i]}}
                    </div>
                    <div class="middle4384">
                        {{$items["seisaku_renraku"][$i]}}
                    </div>
                </div>
                @endfor
                @endif

                
                
            </div>
        </div>
        
    
    </div>
</div>




@if($items["blocknum"]>20)
<div class="main2">
    <div class="main21">
        <div class="main211">

            @if($items["blocknumh"][0]==$counter)
            @php
            $counter++;
            @endphp
            
            @for($i=0;$i<$items["blocknumh"][1];$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
                
            @endfor
            @elseif($items["blocknumh"][0]>$counter)
            @php
            $counter++;
            @endphp
            @for($i=0;$i<10;$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
            @endfor
            @endif
        </div>
        <div class="main212">
            @if($items["blocknumh"][0]==$counter)
            @php
            $counter++;
            @endphp
            
            @for($i=0;$i<$items["blocknumh"][1];$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
                
            @endfor
            @elseif($items["blocknumh"][0]>$counter)
            @php
            $counter++;
            @endphp
            @for($i=0;$i<10;$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
                
            @endfor
            @endif
        </div>
        <div class="main213">
            @if($items["blocknumh"][0]==$counter)
            @php
            $counter++;
            @endphp
            
            @for($i=0;$i<$items["blocknumh"][1];$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
                
            @endfor
            @elseif($items["blocknumh"][0]>$counter)
            @php
            $counter++;
            @endphp
            @for($i=0;$i<10;$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
                
            @endfor
            @endif
        </div>
    </div>
    
    
    
</div>
@endif

@if($items["blocknum"]>50)
<div class="main2">
    <div class="main21">
        <div class="main211">

            @if($items["blocknumh"][0]==$counter)
            @php
            $counter++;
            @endphp
            
            @for($i=0;$i<$items["blocknumh"][1];$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
                
            @endfor
            @elseif($items["blocknumh"][0]>$counter)
            @php
            $counter++;
            @endphp
            @for($i=0;$i<10;$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
                
            @endfor
            @endif
        </div>
        <div class="main212">
            @if($items["blocknumh"][0]==$counter)
            @php
            $counter++;
            @endphp
            
            @for($i=0;$i<$items["blocknumh"][1];$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
                
            @endfor
            @elseif($items["blocknumh"][0]>$counter)
            @php
            $counter++;
            @endphp
            @for($i=0;$i<10;$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
                
            @endfor
            @endif
        </div>
        <div class="main213">
            @if($items["blocknumh"][0]==$counter)
            @php
            $counter++;
            @endphp
            
            @for($i=0;$i<$items["blocknumh"][1];$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
                
            @endfor
            @elseif($items["blocknumh"][0]>$counter)
            @php
            $counter++;
            @endphp
            @for($i=0;$i<10;$i++)
            @if($items["block_obj"][$i+10*($counter-1)]=="CM")
                @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:lightgray;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @else
            @if($items["block_source"][$i+10*($counter-1)]=="")
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_obj"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @else
                <div class="main2111">
                    <div class="main21111">
                        {{$items["block_start"][$i+10*($counter-1)]}}
                    </div>
                    <div class="main21112" style="background-color:black;">
                    </div>
                    <div class="main21113">
                        {{$items["block_source"][$i+10*($counter-1)]}}
                        {{$items["block_dur"][$i+10*($counter-1)]}}
                    </div>
                </div>
                @endif
            @endif
                
            @endfor
            @endif
        </div>
    </div>
    
    
    
</div>
@endif
</body>
</html>