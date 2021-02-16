jQuery(function() {



  var today = new Date();
  today.setDate(today.getDate());
  var yyyy = today.getFullYear();
  var mm = ("0"+(today.getMonth()+1)).slice(-2);
  var dd = ("0"+today.getDate()).slice(-2);
  $('#housoubi').val(yyyy+'-'+mm+'-'+dd);
  var yy=yyyy.toString().substr(2,2);
  $('#fileid').val('M__'+yy+mm+dd);



  if($('#title').val()==""){
    $('#title').css('background-color','pink');
  }else{
    $('#title').css('background-color','white');
  }

  if($('#mediano').val()==""){
    $('#medino').css('background-color','pink');
  }else{
    $('#medino').css('background-color','white');
  }

  if($('#roll1').val()==""){
    $('#roll1').css('background-color','pink');
  }else{
    $('#roll1').css('background-color','white');
  }

  if($('#roll2').val()==""){
    $('#roll2').css('background-color','pink');
  }else{
    $('#roll2').css('background-color','white');
  }

  if($('#youtof').val()=="0"){
    $('#youtof').css('background-color','pink');
  }else{
    $('#youtof').css('background-color','white');
  }

  if($('#stopmarkf').val()=="0"){
    $('#stopmarkf').css('background-color','pink');
  }else{
    $('#stopmarkf').css('background-color','white');
  }

  if($('#roudnessmainaudio').val()=="0"){
    $('#roudnessmainaudio').css('background-color','pink');
  }else{
    $('#roudnessmainaudio').css('background-color','white');
  }
  //$('#title').css('background-color','pink');
  //$('#mediano').css('background-color','pink');
  //$('#roll1').css('background-color','pink');
  //$('#roll2').css('background-color','pink');

 // $('#youtof').css('background-color','pink');
  //$('#stopmarkf').css('background-color','pink');

  //$('#roudnessmainaudio').css('background-color','pink');


  $('#title').on('keyup', function() {
    
    if($(this).val()!=""){
      $(this).css('background-color','white');
    }else{
      $(this).css('background-color','pink');
    }
    
});

$('#fileid').on('keyup', function() {
    
  if($(this).val()!=""){
    $(this).css('background-color','white');
  }else{
    $(this).css('background-color','pink');
  }
  
});

$('#mediano').on('keyup', function() {
    
  if($(this).val()!=""){
    $(this).css('background-color','white');
  }else{
    $(this).css('background-color','pink');
  }
  
});

$('#housoukyoku').on('keyup', function() {
    
  if($(this).val()!=""){
    $(this).css('background-color','white');
  }else{
    $(this).css('background-color','pink');
  }
  
});


$('#wasuu').on('keyup', function() {
    
  if($(this).val()!=""){
    $(this).css('background-color','white');
  }else{
    $(this).css('background-color','pink');
  }
  
});

$('#roll1').on('keyup', function() {
    
  if($(this).val()!=""){
    $(this).css('background-color','white');
  }else{
    $(this).css('background-color','pink');
  }
  
});

$('#roll2').on('keyup', function() {
    
  if($(this).val()!=""){
    $(this).css('background-color','white');
  }else{
    $(this).css('background-color','pink');
  }
  
});

$('#youtof').on('change', function() {
  //console.log($(this).val());
    
  if($(this).val()!="0"){
    $(this).css('background-color','white');
  }else{
    $(this).css('background-color','pink');
  }
  
});

$('#eizou').on('keyup', function() {
    
  if($(this).val()!=""){
    $(this).css('background-color','white');
  }else{
    $(this).css('background-color','pink');
  }
  
});

$('#mediashubetuf').on('change', function() {
    
  if($(this).val()!="0"){
    $(this).css('background-color','white');
  }else{
    $(this).css('background-color','pink');
  }
  
});

$('#onseimodef').on('change', function() {
    
  if($(this).val()!="0"){
    $(this).css('background-color','white');
    if($(this).val()=="1"){
      $('#roudnessmainaudio').css('background-color','pink');
      $('#roudnesssubaudio').css('background-color','white');
      $('#roudnesssanaudio').css('background-color','white');
      $('#roudnessmainaudio').val("");
      $('#roudnesssubaudio').val("");
      $('#roudnesssanaudio').val("");
      $('#truepeakmainaudio').val("");
      $('#truepeaksubaudio').val("");
      $('#truepeaksanaudio').val("");

    }else if($(this).val()=="2"){
      $('#roudnessmainaudio').css('background-color','pink');
      $('#roudnesssubaudio').css('background-color','white');
      $('#roudnesssanaudio').css('background-color','white');
      $('#roudnessmainaudio').val("");
      $('#roudnesssubaudio').val("");
      $('#roudnesssanaudio').val("");
      $('#truepeakmainaudio').val("");
      $('#truepeaksubaudio').val("");
      $('#truepeaksanaudio').val("");
    }else if($(this).val()=="3"){
      $('#roudnessmainaudio').css('background-color','pink');
      $('#roudnesssubaudio').css('background-color','pink');
      $('#roudnesssanaudio').css('background-color','white');
      $('#roudnessmainaudio').val("");
      $('#roudnesssubaudio').val("");
      $('#roudnesssanaudio').val("");
      $('#truepeakmainaudio').val("");
      $('#truepeaksubaudio').val("");
      $('#truepeaksanaudio').val("");
    }else if($(this).val()=="4"){
      $('#roudnessmainaudio').css('background-color','pink');
      $('#roudnesssubaudio').css('background-color','pink');
      $('#roudnesssanaudio').css('background-color','pink');
      $('#roudnessmainaudio').val("");
      $('#roudnesssubaudio').val("");
      $('#roudnesssanaudio').val("");
      $('#truepeakmainaudio').val("");
      $('#truepeaksubaudio').val("");
      $('#truepeaksanaudio').val("");
    }else if($(this).val()=="5"){
      $('#roudnessmainaudio').css('background-color','pink');
      $('#roudnesssubaudio').css('background-color','pink');
      $('#roudnesssanaudio').css('background-color','white');
      $('#roudnessmainaudio').val("");
      $('#roudnesssubaudio').val("");
      $('#roudnesssanaudio').val("");
      $('#truepeakmainaudio').val("");
      $('#truepeaksubaudio').val("");
      $('#truepeaksanaudio').val("");
    }else if($(this).val()=="6"){
      $('#roudnessmainaudio').css('background-color','pink');
      $('#roudnesssubaudio').css('background-color','white');
      $('#roudnesssanaudio').css('background-color','white');
      $('#roudnessmainaudio').val("");
      $('#roudnesssubaudio').val("");
      $('#roudnesssanaudio').val("");
      $('#truepeakmainaudio').val("");
      $('#truepeaksubaudio').val("");
      $('#truepeaksanaudio').val("");
    }else if($(this).val()=="7"){
      $('#roudnessmainaudio').css('background-color','pink');
      $('#roudnesssubaudio').css('background-color','pink');
      $('#roudnesssanaudio').css('background-color','white');
      $('#roudnessmainaudio').val("");
      $('#roudnesssubaudio').val("");
      $('#roudnesssanaudio').val("");
      $('#truepeakmainaudio').val("");
      $('#truepeaksubaudio').val("");
      $('#truepeaksanaudio').val("");
    }else if($(this).val()=="8"){
      $('#roudnessmainaudio').css('background-color','white');
      $('#roudnesssubaudio').css('background-color','white');
      $('#roudnesssanaudio').css('background-color','white');
      $('#roudnessmainaudio').val("");
      $('#roudnesssubaudio').val("");
      $('#roudnesssanaudio').val("");
      $('#truepeakmainaudio').val("");
      $('#truepeaksubaudio').val("");
      $('#truepeaksanaudio').val("");
    }
  }else{
    $(this).css('background-color','pink');
  }
  
});

$('#roudnessf').on('change', function() {
    
  if($(this).val()!="0"){
    $(this).css('background-color','white');
  }else{
    $(this).css('background-color','pink');
  }
  
});

$('#stopmarkf').on('change', function() {
    
  if($(this).val()!="0"){
    $(this).css('background-color','white');
  }else{
    $(this).css('background-color','pink');
  }
  
});





  var blockN=0;
  var blockN_start=0;
  var blockN_end=0;
  var blockN_obj=0;
  var blockN_source=0;
  var blockN_dur=0;
  var blockN_bik=0;


  var keyN=0;
  var keyN_start=0;
  var keyN_end=0;
  var keyN_dur=0;

  var sagyouN=0;






  $('#sinki').on('click', function() {
    //console.log(blockN);
    var result = window.confirm('新規作成を行うと、編集中の内容が破棄されます。よろしいでしょうか？');

    /*

    if(result){
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },    
        url: '../hello/exa',
        type: 'GET',
        dataType: 'html',
        
        
        success: function(data){
          //通信が成功した場合の処理
          $('.content').html(data); //取得したHTMLを.resultに反映
          console.log(data);
        },
        error: function(){
          //通信が失敗した場合の処理
        }
      });
    

    }*/

    if(result){
      window.location.href = '../hello/exa';
      //return;
      /*
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },    
        url: '../hello/exa',
        type: 'GET',
        dataType: 'html',
        
        
        success: function(data){
          //通信が成功した場合の処理
          $('.content').html(data); //取得したHTMLを.resultに反映
          console.log(data);
        },
        error: function(){
          //通信が失敗した場合の処理
        }
      });*/
    

    }
    
    




  });

  $('#manual').on('click', function() {
      window.open("https://ytvrd.s3-ap-northeast-1.amazonaws.com/metajan/MetaJan%E6%93%8D%E4%BD%9C%E3%83%9E%E3%83%8B%E3%83%A5%E3%82%A2%E3%83%AB.pdf", '_blank');
  });

  

$('#titleh').on('click', function() {
  var result = window.confirm('必須項目\nJOBシートへの反映は40文字までです。');
  
});



$('#subtitleh').on('click', function() {
  var result = window.confirm('任意項目\nJOBシートへの反映は40文字までです。');
});

$('#honkaih').on('click', function() {
  var result = window.confirm('必須項目\n開始TCを「HHMMSS」形式の6桁で記載してください。\n(例)10:00:00:00⇒100000');
});

$('#honzenh').on('click', function() {
  var result = window.confirm('必須項目\n本編長を「HHMMSS」形式の6桁で記載してください。\n(例)10:00:00:00⇒100000');
});

$('#keypointh').on('click', function() {
  var result = window.confirm('特定区間事象を説明する場合、こちらに記載ください。\n提供ベースはブロック情報に記載してください。');
});

$('#housoubih').on('click', function() {
  var result = window.confirm('必須項目\n放送日を選択してください。\n複数日ある場合はメモ欄に記載してください。');
});

$('#housoujikokuh').on('click', function() {
  var result = window.confirm('必須項目\n放送時刻を6桁で記載してください。\n(例)10:00:00:00⇒100000');
});

$('#rollh').on('click', function() {
  var result = window.confirm('必須項目\n(例)PD1本搬入の場合は1/1。2本の場合は、1/2、2/2など。');
});

$('#youtoh').on('click', function() {
  var result = window.confirm('必須項目\n用途をタブの中から選択してください。');
});

$('#eizouh').on('click', function() {
  var result = window.confirm('必須項目\n画質(HD)');
});

$('#mediashubetuh').on('click', function() {
  var result = window.confirm('必須項目\nメディア種別をタブの中から選択してください。(XDCAMなど)');
});

$('#onseimodeh').on('click', function() {
  var result = window.confirm('必須項目\n音声モードをタブの中から選択してください。');
});

$('#roudnessh').on('click', function() {
  var result = window.confirm('必須項目\nラウドネスをタブの中から選択してください。');
});

$('#stopmarkh').on('click', function() {
  var result = window.confirm('必須項目\nストップマークをタブの中から選択してください。');
});

$('#heikinroudnessh').on('click', function() {
  var result = window.confirm('平均ラウドネス値を記載してください。\n(例)-23.0');
});

$('#truepeakh').on('click', function() {
  var result = window.confirm('トゥルーピーク値を記載してください。\n(例)-1.0');
});

$('#fileidh').on('click', function() {
  var result = window.confirm('必須項目\nM_で始まる最大24文字で記載してください。');
});

$('#example').on('click', function() {
    window.open("https://ytvrd.s3-ap-northeast-1.amazonaws.com/metajan/Block1.pdf", '_blank');
});



$('#metadata').on('click', function() {
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },    
    url: '../hello/edit',
    type: 'POST',
    dataType: 'html',
    
    
    success: function(data){
      //通信が成功した場合の処理
      //$('.content').html(data); //取得したHTMLを.resultに反映
      //console.log(data);
    },
    error: function(){
      //通信が失敗した場合の処理
    }
  });
});



$('#job').on('click', function() {
  $("form").attr("action", "/laravelapp1/public/hello/show").submit();



});


$('#read').on('click', function() {
  $("form").attr("action", "/laravelapp1/public/hello/add").submit();



});

$('#meta').on('click', function() {
  var blockch=$('#blocknum').val();
  if($('#block_obj'+blockch).val()!="14"){
    var result = window.confirm("ブロック行の最後は「END」にしてください。");
    return false;
  }
  var alert="";
  
  var title = $('#title').val();
  if(title==""){
    alert=alert+"メインタイトル。";
  }

  var honzen = $('#honzen').val();
  if(honzen==""||honzen=="00:00:00"){
    alert=alert+"本編全体長。";
  }

  var mediano = $('#mediano').val();
  if(mediano==""){
    alert=alert+"メディアNo。";
  }

  var roll1 = $('#roll1').val();
  if(roll1==""){
    alert=alert+"ロール番号1。";
  }

  var roll2 = $('#roll2').val();
  if(roll2==""){
    alert=alert+"ロール番号2。";
  }

  var youtof = $('#youtof').val();
  if(youtof=="0"){
    alert=alert+"用途。";
  }

  var stopmarkf = $('#stopmarkf').val();
  if(stopmarkf=="0"){
    alert=alert+"ストップマーク。";
  }

  var roudnessmainaudio = $('#roudnessmainaudio').val();
  if(roudnessmainaudio==""){
    alert=alert+"ラウドネス値。";
  }




    if(alert!=""){
      
      var result = window.confirm(alert+"が入力されていません。\nこれらを無視して作成しますか。");

      if(!result){
        return false;
      }
      
      //return false;
      
    

    }




  $("form").attr("action", "/laravelapp1/public/hello/del").submit();



});










  $('#blockadd').on('click', function() {
    console.log(Number($('#blocknum').val()));
  
    var id_num = Number($('#blocknum').val());
    if(id_num>=0){
      id_num=id_num+1;
      console.log(id_num);
      $('#blocknum').val(id_num);

      $('#block').append('<tr id='+"block"+id_num+'><td><input id='+"block_start"+id_num+
      ' type="text" name='+"block_start"+id_num +' size="10" class="block_start"></td><td><input id='+"block_end"+id_num+ 
      ' type="text" name='+"block_end"+id_num+ ' size="10" class="block_end"></td><td><select class="block_obj" name='+"block_obj" +id_num+
      ' id="block_obj'+id_num+'">'+
      '<option value="0">PG-本編</option><option value="1">CM-無信号</option><option value="2">SC-提供ベースのみ</option>'+
      '<option value="3">BB-黒味</option><option value="4">SC-提供(映像のみ記録)</option><option value="5">SC-提供(音声のみ記録)</option><option value="6">SC-提供(映像・音声記録)</option>'+
      '<option value="7">CM-焼きこみCM</option><option value="8">NS-抜き素材</option><option value="9">PG-本編(無信号)</option><option value="10">CB-カラーバー</option>'+
      '<option value="11">CR-クレジット</option><option value="12">LC-ラストカット</option><option value="13">FC-ファーストカット</option><option value="14">END</option><option value="15"></option></select></td>'+
      '<td><select class="block_source" name='+"block_source"+id_num+
      ' id="block_source'+id_num+'">'+
      '>  <option value="0"></option><option value="1">R-1</option><option value="2">CM1</option><option value="3">提供1</option>'+
      '<option value="4">R-2</option><option value="5">CM2</option><option value="6">提供2</option><option value="7">R-3</option>'+
      '<option value="8">CM3</option><option value="9">提供3</option><option value="10">R-4</option><option value="11">CM4</option>'+
      '<option value="12">提供4</option><option value="13">R-5</option><option value="14">CM5</option><option value="15">提供5</option>'+
      '<option value="16">R-6</option><option value="17">CM6</option><option value="18">提供6</option>'+
      '<option value="19">R-7</option><option value="20">CM7</option><option value="21">提供7</option>'+
      '<option value="22">R-8</option><option value="23">CM8</option><option value="24">提供8</option>'+
      '<option value="25">R-9</option><option value="26">CM9</option><option value="27">提供9</option>'+
      '<option value="28">R-10</option><option value="29">CM10</option><option value="30">提供10</option>'+
      '<option value="31">R-11</option><option value="32">CM11</option><option value="33">R-12</option><option value="34">CM12</option>'+
      '<option value="35">R-13</option><option value="36">CM13</option><option value="37">R-14</option><option value="38">CM14</option>'+
      '<option value="39">R-15</option><option value="40">CM15</option>'+
      '<option value="41">R-16</option><option value="42">R-17</option><option value="43">R-18</option><option value="44">R-19</option><option value="45">R-20</option>'+
      '</select></td><td><input id='+"block_dur"+id_num+
      ' type="text" name='+"block_dur"+id_num+' size="10" class="block_dur" readonly></td><td><input id='+"block_bik"+id_num+
      ' type="text" name='+"block_bik"+id_num+' size="20" class="block_bik"></td><td><input id='+"blockdel"+id_num+
      ' type="button" value="削除" class="blockdel"></td></tr>' );

      /*
    
      var id=id_num;
      $.ajax({
         headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },    
        url: '../hello/add?id='+id,
        type: 'post',
        dataType: 'html',
        
    
        success: function(data){
          //通信が成功した場合の処理
          $('#block').append(data); //取得したHTMLを.resultに反映
          console.log(data);
        },
        error: function(){
          //通信が失敗した場合の処理
        }
      });
      */

    }
    
  });


  $('#blockcmadd').on('click', function() {
    console.log(Number($('#blocknum').val()));
  
    var id_num = Number($('#blocknum').val());
    if(id_num>=0){
      id_num=id_num+1;
      console.log(id_num);
      $('#blocknum').val(id_num);

      $('#block').append('<tr id='+"block"+id_num+'><td><input id='+"block_start"+id_num+
      ' type="text" name='+"block_start"+id_num +' size="10" class="block_start"></td><td><input id='+"block_end"+id_num+ 
      ' type="text" name='+"block_end"+id_num+ ' size="10" class="block_end"></td><td><select class="block_obj" name='+"block_obj" +id_num+
      ' id="block_obj'+id_num+'">'+
      '<option value="0">PG-本編</option><option value="1" selected>CM-無信号</option><option value="2">SC-提供ベースのみ</option>'+
      '<option value="3">BB-黒味</option><option value="4">SC-提供(映像のみ記録)</option><option value="5">SC-提供(音声のみ記録)</option><option value="6">SC-提供(映像・音声記録)</option>'+
      '<option value="7">CM-焼きこみCM</option><option value="8">NS-抜き素材</option><option value="9">PG-本編(無信号)</option><option value="10">CB-カラーバー</option>'+
      '<option value="11">CR-クレジット</option><option value="12">LC-ラストカット</option><option value="13">FC-ファーストカット</option><option value="14">END</option><option value="15"></option></select></td>'+
      '<td><select class="block_source" name='+"block_source"+id_num+
      ' id="block_source'+id_num+'">'+
      '>  <option value="0"></option><option value="1">R-1</option><option value="2">CM1</option><option value="3">提供1</option>'+
      '<option value="4">R-2</option><option value="5">CM2</option><option value="6">提供2</option><option value="7">R-3</option>'+
      '<option value="8">CM3</option><option value="9">提供3</option><option value="10">R-4</option><option value="11">CM4</option>'+
      '<option value="12">提供4</option><option value="13">R-5</option><option value="14">CM5</option><option value="15">提供5</option>'+
      '<option value="16">R-6</option><option value="17">CM6</option><option value="18">提供6</option>'+
      '<option value="19">R-7</option><option value="20">CM7</option><option value="21">提供7</option>'+
      '<option value="22">R-8</option><option value="23">CM8</option><option value="24">提供8</option>'+
      '<option value="25">R-9</option><option value="26">CM9</option><option value="27">提供9</option>'+
      '<option value="28">R-10</option><option value="29">CM10</option><option value="30">提供10</option>'+
      '<option value="31">R-11</option><option value="32">CM11</option><option value="33">R-12</option><option value="34">CM12</option>'+
      '<option value="35">R-13</option><option value="36">CM13</option><option value="37">R-14</option><option value="38">CM14</option>'+
      '<option value="39">R-15</option><option value="40">CM15</option>'+
      '<option value="41">R-16</option><option value="42">R-17</option><option value="43">R-18</option><option value="44">R-19</option><option value="45">R-20</option>'+
      '</select></td><td><input id='+"block_dur"+id_num+
      ' type="text" name='+"block_dur"+id_num+' size="10" class="block_dur" readonly></td><td><input id='+"block_bik"+id_num+
      ' type="text" name='+"block_bik"+id_num+' size="20" class="block_bik"></td><td><input id='+"blockdel"+id_num+
      ' type="button" value="削除" class="blockdel"></td></tr>' );

      id_num=id_num+1;
      console.log(id_num);
      $('#blocknum').val(id_num);

      $('#block').append('<tr id='+"block"+id_num+'><td><input id='+"block_start"+id_num+
      ' type="text" name='+"block_start"+id_num +' size="10" class="block_start"></td><td><input id='+"block_end"+id_num+ 
      ' type="text" name='+"block_end"+id_num+ ' size="10" class="block_end"></td><td><select class="block_obj" name='+"block_obj" +id_num+
      ' id="block_obj'+id_num+'">'+
      '<option value="0">PG-本編</option><option value="1">CM-無信号</option><option value="2">SC-提供ベースのみ</option>'+
      '<option value="3">BB-黒味</option><option value="4">SC-提供(映像のみ記録)</option><option value="5">SC-提供(音声のみ記録)</option><option value="6">SC-提供(映像・音声記録)</option>'+
      '<option value="7">CM-焼きこみCM</option><option value="8">NS-抜き素材</option><option value="9">PG-本編(無信号)</option><option value="10">CB-カラーバー</option>'+
      '<option value="11">CR-クレジット</option><option value="12">LC-ラストカット</option><option value="13">FC-ファーストカット</option><option value="14">END</option><option value="15"></option></select></td>'+
      '<td><select class="block_source" name='+"block_source"+id_num+
      ' id="block_source'+id_num+'">'+
      '>  <option value="0"></option><option value="1">R-1</option><option value="2">CM1</option><option value="3">提供1</option>'+
      '<option value="4">R-2</option><option value="5">CM2</option><option value="6">提供2</option><option value="7">R-3</option>'+
      '<option value="8">CM3</option><option value="9">提供3</option><option value="10">R-4</option><option value="11">CM4</option>'+
      '<option value="12">提供4</option><option value="13">R-5</option><option value="14">CM5</option><option value="15">提供5</option>'+
      '<option value="16">R-6</option><option value="17">CM6</option><option value="18">提供6</option>'+
      '<option value="19">R-7</option><option value="20">CM7</option><option value="21">提供7</option>'+
      '<option value="22">R-8</option><option value="23">CM8</option><option value="24">提供8</option>'+
      '<option value="25">R-9</option><option value="26">CM9</option><option value="27">提供9</option>'+
      '<option value="28">R-10</option><option value="29">CM10</option><option value="30">提供10</option>'+
      '<option value="31">R-11</option><option value="32">CM11</option><option value="33">R-12</option><option value="34">CM12</option>'+
      '<option value="35">R-13</option><option value="36">CM13</option><option value="37">R-14</option><option value="38">CM14</option>'+
      '<option value="39">R-15</option><option value="40">CM15</option>'+
      '<option value="41">R-16</option><option value="42">R-17</option><option value="43">R-18</option><option value="44">R-19</option><option value="45">R-20</option>'+
      '</select></td><td><input id='+"block_dur"+id_num+
      ' type="text" name='+"block_dur"+id_num+' size="10" class="block_dur" readonly></td><td><input id='+"block_bik"+id_num+
      ' type="text" name='+"block_bik"+id_num+' size="20" class="block_bik"></td><td><input id='+"blockdel"+id_num+
      ' type="button" value="削除" class="blockdel"></td></tr>' );

      /*
    
      var id=id_num;
      $.ajax({
         headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },    
        url: '../hello/add?id='+id,
        type: 'post',
        dataType: 'html',
        
    
        success: function(data){
          //通信が成功した場合の処理
          $('#block').append(data); //取得したHTMLを.resultに反映
          console.log(data);
        },
        error: function(){
          //通信が失敗した場合の処理
        }
      });
      */

    }
    
  });







  $('#blockinsert').on('click', function() {
    //console.log(Number($('#blocknum').val()));
  
    var id_num = Number($('#blocknum').val());
    if(id_num>=0){
      id_num=id_num+1;
     // console.log(id_num);
      $('#blocknum').val(id_num);

      $('#block').append('<tr id='+"block"+id_num+'><td><input id='+"block_start"+id_num+
      ' type="text" name='+"block_start"+id_num +' size="10" class="block_start"></td><td><input id='+"block_end"+id_num+ 
      ' type="text" name='+"block_end"+id_num+ ' size="10" class="block_end"></td><td><select class="block_obj" name='+"block_obj" +id_num+
      ' id="block_obj'+id_num+'">'+
      '<option value="0">PG-本編</option><option value="1">CM-無信号</option><option value="2">SC-提供ベースのみ</option>'+
      '<option value="3">BB-黒味</option><option value="4">SC-提供(映像のみ記録)</option><option value="5">SC-提供(音声のみ記録)</option><option value="6">SC-提供(映像・音声記録)</option>'+
      '<option value="7">CM-焼きこみCM</option><option value="8">NS-抜き素材</option><option value="9">PG-本編(無信号)</option><option value="10">CB-カラーバー</option>'+
      '<option value="11">CR-クレジット</option><option value="12">LC-ラストカット</option><option value="13">FC-ファーストカット</option><option value="14">END</option><option value="15"></option></select></td>'+
      '<td><select class="block_source" name='+"block_source"+id_num+
      ' id="block_source'+id_num+'">'+
      '>  <option value="0"></option><option value="1">R-1</option><option value="2">CM1</option><option value="3">提供1</option>'+
      '<option value="4">R-2</option><option value="5">CM2</option><option value="6">提供2</option><option value="7">R-3</option>'+
      '<option value="8">CM3</option><option value="9">提供3</option><option value="10">R-4</option><option value="11">CM4</option>'+
      '<option value="12">提供4</option><option value="13">R-5</option><option value="14">CM5</option><option value="15">提供5</option>'+
      '<option value="16">R-6</option><option value="17">CM6</option><option value="18">提供6</option>'+
      '<option value="19">R-7</option><option value="20">CM7</option><option value="21">提供7</option>'+
      '<option value="22">R-8</option><option value="23">CM8</option><option value="24">提供8</option>'+
      '<option value="25">R-9</option><option value="26">CM9</option><option value="27">提供9</option>'+
      '<option value="28">R-10</option><option value="29">CM10</option><option value="30">提供10</option>'+
      '<option value="31">R-11</option><option value="32">CM11</option><option value="33">R-12</option><option value="34">CM12</option>'+
      '<option value="35">R-13</option><option value="36">CM13</option><option value="37">R-14</option><option value="38">CM14</option>'+
      '<option value="39">R-15</option><option value="40">CM15</option>'+
      '<option value="41">R-16</option><option value="42">R-17</option><option value="43">R-18</option><option value="44">R-19</option><option value="45">R-20</option>'+
      '</select></td><td><input id='+"block_dur"+id_num+
      ' type="text" name='+"block_dur"+id_num+' size="10" class="block_dur" readonly></td><td><input id='+"block_bik"+id_num+
      ' type="text" name='+"block_bik"+id_num+' size="20" class="block_bik"></td><td><input id='+"blockdel"+id_num+
      ' type="button" value="削除" class="blockdel"></td></tr>' );

      blockN=Number(blockN);

      // for文で初期値と繰り返しの条件式を指定
      for (var i=id_num; i>=blockN+2; i--) {
 
        // コンソールに0〜3の連番を表示
        //console.log(i);
        
        var numb=i-1;

        $('#block_start'+i).val($('#block_start'+numb).val());
        $('#block_end'+i).val($('#block_end'+numb).val());
        $('#block_obj'+i).val($('#block_obj'+numb).val());
        $('#block_dur'+i).val($('#block_dur'+numb).val());
        $('#block_source'+i).val($('#block_source'+numb).val());
        $('#block_bik'+i).val($('#block_bik'+numb).val());
        

        
 
      }

      var numb=blockN+1;

      $('#block_start'+numb).val("");
      $('#block_end'+numb).val("");
      $('#block_obj'+numb).val("0");
      $('#block_dur'+numb).val("");
      $('#block_source'+numb).val("0");
      $('#block_bik'+numb).val("");

    }
    
  });


  $('#blockdel').on('click', function() {
    console.log(Number($('#blocknum').val()));
  
  　　var id_num = Number($('#blocknum').val());
    $("#block"+id_num).remove();
    if(id_num>0){
      id_num=id_num-1;
  　　console.log(id_num);
  　　$('#blocknum').val(id_num);
 　　 var id=id_num;

     
  

      /*
      $.ajax({
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },    
       url: '../hello/add?id='+id,
       type: 'GET',
       dataType: 'html',
       id:id,
    
       success: function(data){
         //通信が成功した場合の処理
         $('#block').html(data); //取得したHTMLを.resultに反映
         console.log(data);
       },
       error: function(){
         //通信が失敗した場合の処理
       }
     });
     */

    }
  　　
  });

  /*


  $('.blockdel').on('click', function() {
    var id = $(this).attr('id');
 
    console.log( id );

    blockN=id.substr(8);
    console.log( blockN );
   // console.log(Number($('#blocknum').val()));
  
  　　var id_num = Number($('#blocknum').val());
    $("#block"+blockN).remove();
    if(id_num>0){
      id_num=id_num-1;
  　　console.log(id_num);
  　　$('#blocknum').val(id_num);
 　　 var id=id_num;

    }
  　　
  });

  */

  $(document).on('click', '.blockdel', function() {
    var id = $(this).attr('id');
 
    console.log( id );

    blockN=id.substr(8);
    console.log( blockN );
    var blockN = Number(blockN);
    var id_num = Number($('#blocknum').val());
    var numb=0;
    if(id_num>0){
      // for文で初期値と繰り返しの条件式を指定
      for (var i=blockN; i<id_num; i++) {
        //$('#block_start'+i).val($('#block_start'+i+1).val());
        numb=i+1;
        $('#block_start'+i).val($('#block_start'+numb).val());
        $('#block_end'+i).val($('#block_end'+numb).val());
        $('#block_obj'+i).val($('#block_obj'+numb).val());
        $('#block_source'+i).val($('#block_source'+numb).val());
        $('#block_dur'+i).val($('#block_dur'+numb).val());
        $('#block_bik'+i).val($('#block_bik'+numb).val());
 
        // コンソールに0〜3の連番を表示
        //console.log($('#block_start'+numb).val());

        //$("#block"+id_num).remove();
 
      }
      $("#block"+id_num).remove();
      id_num=id_num-1;
  　　console.log(id_num);
  　　$('#blocknum').val(id_num);
 　　 var id=id_num;

    }
    //$(this).parents('tr').remove();
  });



  $('#keyadd').on('click', function() {
    console.log(Number($('#keynum').val()));
  
    var id_num = Number($('#keynum').val());
    
    if(id_num>=0){
      id_num=id_num+1;
      console.log(id_num);
      $('#keynum').val(id_num);
    
      var id=id_num;


      $('#keypoint').append('<tr id='+"keypoint"+id_num+'><td><input id='+"key_start"+id_num+' type="text" name='+ "key_start"+id_num+
      ' class="key_start"'+
      ' size="10"></td><td><input id='+"key_end"+id_num+' type="text" name='+"key_end"+id_num+
      ' class="key_end"'+
      ' size="10"></td><td><input id='+"key_dur"+id_num+' type="text" name='+"key_dur"+id_num+
      ' class="key_dur"'+
      ' size="10" readonly></td><td><input id='+"key_shu"+id_num+' type="text" name='+"key_shu"+id_num+
      ' class="key_shu"'+
      ' size="10"></td><td><input id='+"key_nai"+id_num+' type="text" name='+"key_nai"+id_num+
      ' class="key_nai"'+
      ' size="20"></td></tr>' );

      

  

      /*
      $.ajax({
         headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },    
        url: '../hello/key?id='+id,
        type: 'GET',
        dataType: 'html',
        id:id,
    
        success: function(data){
          //通信が成功した場合の処理
          $('#keypoint').html(data); //取得したHTMLを.resultに反映
          console.log(data);
        },
        error: function(){
          //通信が失敗した場合の処理
        }
      });
      */

    }
    
  });


  $('#keydel').on('click', function() {
    console.log(Number($('#keynum').val()));
  
  　　var id_num = Number($('#keynum').val());
    $("#keypoint"+id_num).remove();
    if(id_num>0){
      id_num=id_num-1;
  　　console.log(id_num);
  
  　　$('#keynum').val(id_num);
 　　 var id=id_num;
  

 /*
      $.ajax({
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },    
       url: '../hello/key?id='+id,
       type: 'GET',
       dataType: 'html',
       id:id,
    
       success: function(data){
         //通信が成功した場合の処理
         $('#keypoint').html(data); //取得したHTMLを.resultに反映
         console.log(data);
       },
       error: function(){
         //通信が失敗した場合の処理
       }
     });
     */

    }
  　　
  });


  $(document).on('click', '.keydel', function() {
    var id = $(this).attr('id');
 
    console.log( id );

    keyN=id.substr(6);
    console.log( keyN );
    var keyN = Number(keyN);
    var id_num = Number($('#keynum').val());
    var numb=0;
    if(id_num>0){
      // for文で初期値と繰り返しの条件式を指定
      for (var i=keyN; i<id_num; i++) {
        //$('#block_start'+i).val($('#block_start'+i+1).val());
        numb=i+1;
        $('#key_start'+i).val($('#key_start'+numb).val());
        $('#key_end'+i).val($('#key_end'+numb).val());
        $('#key_dur'+i).val($('#key_dur'+numb).val());
        $('#key_shu'+i).val($('#key_shu'+numb).val());
        $('#key_nai'+i).val($('#key_nai'+numb).val());
        
 
        // コンソールに0〜3の連番を表示
        //console.log($('#block_start'+numb).val());

        //$("#block"+id_num).remove();
 
      }
      $("#keypoint"+id_num).remove();
      id_num=id_num-1;
  　　console.log(id_num);
  　　$('#keynum').val(id_num);
 　　 var id=id_num;

    }
    //$(this).parents('tr').remove();
  });



  $('#sagyouadd').on('click', function() {
    console.log(Number($('#sagyounum').val()));
  
    var id_num = Number($('#sagyounum').val());
    if(id_num>=0){
      id_num=id_num+1;
      console.log(id_num);
      $('#sagyounum').val(id_num);
    
      var id=id_num;

      $('#sagyourireki').append('<tr id='+"sagyourireki"+id_num+'><td><input id='+"sagyou_sagyoubi"+id_num+' name='+"sagyou_sagyoubi"+id_num+
      ' class="sagyou_sagyoubi"'+' type="date"></td>'+
      '<td><select name='+"sagyou_naiyou"+id_num+' id='+"sagyou_naiyou"+id_num+' class="sagyou_naiyou"'+
      '><option value="0">REC</option><option value="1">PB</option><option value="2" selected>DUB</option><option value="3">ED</option>'+
      '<option value="4">ING</option><option value="5">MA</option><option value="6">PV</option><option value="7">OA</option><option value="8">(OA)</option>'+
      '<option value="9">ERA</option><option value="10">Meta</option><option value="11">その他</option>'+
      '</select></td><td><input id='+"sagyou_sei"+id_num+' type="text" name='+"sagyou_sei"+id_num+' class="sagyou_sei" size="10"></td>'+
      '<td><input id='+"sagyou_mei"+id_num+' type="text" name='+"sagyou_mei"+id_num+' class="sagyou_mei" size="10"></td>'+
      '<td><input id='+"sagyou_kaisha"+id_num+' type="text" name='+"sagyou_kaisha"+id_num+' class="sagyou_kaisha" size="15"></td>'+
      '<td><input id='+"sagyou_renraku"+id_num+' type="text" name='+"sagyou_renraku"+id_num+' class="sagyou_renraku" size="15"></td>'+
      '<td><input id='+"sagyou_shuroku"+id_num+' type="text" name='+"sagyou_shuroku"+id_num+' class="sagyou_shuroku" size="10"></td></tr>' );
  

      /*
      $.ajax({
         headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },    
        url: '../hello/sagyou?id='+id,
        type: 'GET',
        dataType: 'html',
        id:id,
    
        success: function(data){
          //通信が成功した場合の処理
          $('#sagyourireki').html(data); //取得したHTMLを.resultに反映
          console.log(data);
        },
        error: function(){
          //通信が失敗した場合の処理
        }
      });
      */

    }
    
  });


  $('#sagyoudel').on('click', function() {
    console.log(Number($('#sagyounum').val()));
  
  　　var id_num = Number($('#sagyounum').val());
    $("#sagyourireki"+id_num).remove();
    if(id_num>0){
      id_num=id_num-1;
  　　console.log(id_num);
  
  　　$('#sagyounum').val(id_num);
 　　 var id=id_num;
  

 /*
      $.ajax({
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },    
       url: '../hello/sagyou?id='+id,
       type: 'GET',
       dataType: 'html',
       id:id,
    
       success: function(data){
         //通信が成功した場合の処理
         $('#sagyourireki').html(data); //取得したHTMLを.resultに反映
         console.log(data);
       },
       error: function(){
         //通信が失敗した場合の処理
       }
     });
     */

    }
  　　
  });




  $('#seisakuadd').on('click', function() {
    console.log(Number($('#seisakunum').val()));
  
    var id_num = Number($('#seisakunum').val());
    if(id_num>=0){
      id_num=id_num+1;
      console.log(id_num);
      $('#seisakunum').val(id_num);
    
      var id=id_num;

      $('#seisakutantousha').append('<tr id='+"seisakutantousha"+id_num+
      '><td><input id='+"seisaku_shokushu"+id_num+' type="text" name='+"seisaku_shokushu"+id_num+' size="15"></td>'+
      '<td><input id='+"seisaku_sei"+id_num+' type="text" name='+"seisaku_sei"+id_num+' size="10"></td>'+
      '<td><input id='+"seisaku_mei"+id_num+' type="text" name='+"seisaku_mei"+id_num+' size="10"></td>'+
      '<td><input id='+"seisaku_kaisha"+id_num+' type="text" name='+"seisaku_kaisha"+id_num+' size="15"></td>'+
      '<td><input id='+"seisaku_renraku"+id_num+' type="text" name='+"seisaku_renraku"+id_num+' size="15"></td></tr>' );
  

      /*
      $.ajax({
         headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },    
        url: '../hello/seisaku?id='+id,
        type: 'GET',
        dataType: 'html',
        id:id,
    
        success: function(data){
          //通信が成功した場合の処理
          $('#seisakutantousha').html(data); //取得したHTMLを.resultに反映
          console.log(data);
        },
        error: function(){
          //通信が失敗した場合の処理
        }
      });
      */

    }
    
  });


  $('#seisakudel').on('click', function() {
    console.log(Number($('#seisakunum').val()));
  
  　　var id_num = Number($('#seisakunum').val());
  $("#seisakutantousha"+id_num).remove();
    if(id_num>0){
      
      id_num=id_num-1;
  　　console.log(id_num);
  
  　　$('#seisakunum').val(id_num);
 　　 var id=id_num;
  

 /*
      $.ajax({
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },    
       url: '../hello/seisaku?id='+id,
       type: 'GET',
       dataType: 'html',
       id:id,
    
       success: function(data){
         //通信が成功した場合の処理
         $('#seisakutantousha').html(data); //取得したHTMLを.resultに反映
         console.log(data);
       },
       error: function(){
         //通信が失敗した場合の処理
       }
     });
     */

    }
  　　
  });



  $("#honkai").keyup(function() {
    //console.log($("#honkai").val().length);
    if($("#honkai").val().length==6){
      $("#honkai").val($("#honkai").val().substr(0,2)+":"+$("#honkai").val().substr(2,2)+":"+$("#honkai").val().substr(4,2));
      $(this).css('background-color','white');
      

    }

    if($("#honkai").val().length>6&&$("#honkai").val().length!=8){
      $("#honkai").val("");
      $(this).css('background-color','pink');

    }

    if($(this).val()==""){
      $(this).css('background-color','pink');
    }
    
    
});


$("#honzen").keyup(function() {
  //console.log($("#honkai").val().length);
  if($("#honzen").val().length==6){
    $("#honzen").val($("#honzen").val().substr(0,2)+":"+$("#honzen").val().substr(2,2)+":"+$("#honzen").val().substr(4,2));
    $(this).css('background-color','white');
    

  }

  if($("#honzen").val().length>6&&$("#honzen").val().length!=8){
    $("#honzen").val("");
    $(this).css('background-color','pink');

  }

  if($(this).val()==""){
    $(this).css('background-color','pink');
  }
  
  
});


$("#housoujikoku").keyup(function() {
  //console.log($("#honkai").val().length);
  if($("#housoujikoku").val().length==6){
    $("#housoujikoku").val($("#housoujikoku").val().substr(0,2)+":"+$("#housoujikoku").val().substr(2,2)+":"+$("#housoujikoku").val().substr(4,2));
    $(this).css('background-color','white');

  }

  if($("#housoujikoku").val().length>6&&$("#housoujikoku").val().length!=8){
    $("#housoujikoku").val("");
    $(this).css('background-color','pink');

  }

  if($(this).val()==""){
    $(this).css('background-color','pink');
  }
  
  
});

$("#onseimodef").change(function() {
  //console.log($("#onseimodef").val());
  if($("#onseimodef").val()=="1"){
    //console.log("asai");
    $("#ch01f").val("1");
    $("#ch02f").val("2");
    $("#ch03f").val("0");
    $("#ch04f").val("0");
    $("#ch05f").val("0");
    $("#ch06f").val("0");
    $("#ch07f").val("0");
    $("#ch08f").val("0");

  }else if($("#onseimodef").val()=="2"){
    $("#ch01f").val("5");
    $("#ch02f").val("5");
    $("#ch03f").val("0");
    $("#ch04f").val("0");
    $("#ch05f").val("0");
    $("#ch06f").val("0");
    $("#ch07f").val("0");
    $("#ch08f").val("0");

  }else if($("#onseimodef").val()=="3"){
    $("#ch01f").val("6");
    $("#ch02f").val("7");
    $("#ch03f").val("0");
    $("#ch04f").val("0");
    $("#ch05f").val("0");
    $("#ch06f").val("0");
    $("#ch07f").val("0");
    $("#ch08f").val("0");

  }else if($("#onseimodef").val()=="4"){
    $("#ch01f").val("6");
    $("#ch02f").val("8");
    $("#ch03f").val("9");
    $("#ch04f").val("0");
    $("#ch05f").val("0");
    $("#ch06f").val("0");
    $("#ch07f").val("0");
    $("#ch08f").val("0");

  }else if($("#onseimodef").val()=="5"){
    $("#ch01f").val("1");
    $("#ch02f").val("2");
    $("#ch03f").val("1");
    $("#ch04f").val("2");
    $("#ch05f").val("0");
    $("#ch06f").val("0");
    $("#ch07f").val("0");
    $("#ch08f").val("0");

  }else if($("#onseimodef").val()=="6"){
    $("#ch01f").val("1");
    $("#ch02f").val("2");
    $("#ch03f").val("14");
    $("#ch04f").val("15");
    $("#ch05f").val("16");
    $("#ch06f").val("17");
    $("#ch07f").val("0");
    $("#ch08f").val("0");

  }else if($("#onseimodef").val()=="7"){
    $("#ch01f").val("1");
    $("#ch02f").val("2");
    $("#ch03f").val("14");
    $("#ch04f").val("15");
    $("#ch05f").val("16");
    $("#ch06f").val("17");
    $("#ch07f").val("3");
    $("#ch08f").val("4");

  }
  
  
  
});



/*
$(".block_end").keyup(function() {
  //console.log($("#honkai").val().length);
  if($(".block_end").val().length==6){
    $(".block_end").val($(".block_end").val().substr(0,2)+":"+$(".block_end").val().substr(2,2)+":"+$(".block_end").val().substr(4,2));
    

  }

  if($(".block_end").val().length>6&&$(".block_end").val().length!=8){
    $(".block_end").val("");

  }
  
  
});
*/


$(document).on('keyup', '.block_start', function() {

  if($(this).val().length==6){
    $(this).val($(this).val().substr(0,2)+":"+$(this).val().substr(2,2)+":"+$(this).val().substr(4,2));

    blockN_start=Number(blockN_start);
    var numb=blockN_start-1;
    console.log(numb);
    $("#block_end"+numb).val($(this).val());

    if($("#block_end"+blockN_start).val().length==8){
      let t1 = new Date("2017/01/05 "+$("#block_end"+blockN_start).val());
      let t2 = new Date("2017/01/05 "+$(this).val());

      let diff = t1.getTime() - t2.getTime();

      console.log(diff);

      //HH部分取得
      let diffHour = diff / (1000 * 60 * 60);
      //MM部分取得
      let diffMinute = (diffHour - Math.floor(diffHour)) * 60;
      //SS部分取得
      let diffSecond = (diffMinute - Math.floor(diffMinute)) * 60;

      console.log(('00' + Math.floor(diffHour)).slice(-2) + ':' + ('00' + Math.floor(diffMinute)).slice(-2) + ':' + ('00' + Math.round(diffSecond)).slice(-2));
      $("#block_dur"+blockN_start).val(('00' + Math.floor(diffHour)).slice(-2) + ':' + ('00' + Math.floor(diffMinute)).slice(-2) + ':' + ('00' + Math.round(diffSecond)).slice(-2));
  

    }

    



    var numb=blockN_start-1;

    let t3 = new Date("2017/01/05 "+$("#block_end"+numb).val());
    let t4 = new Date("2017/01/05 "+$("#block_start"+numb).val());

    let diff1 = t3.getTime() - t4.getTime();

    console.log(diff1);

    //HH部分取得
    let diffHour1 = diff1 / (1000 * 60 * 60);
    //MM部分取得
    let diffMinute1 = (diffHour1 - Math.floor(diffHour1)) * 60;
    //SS部分取得
    let diffSecond1 = (diffMinute1 - Math.floor(diffMinute1)) * 60;

    console.log(('00' + Math.floor(diffHour1)).slice(-2) + ':' + ('00' + Math.floor(diffMinute1)).slice(-2) + ':' + ('00' + Math.round(diffSecond1)).slice(-2));
    $("#block_dur"+numb).val(('00' + Math.floor(diffHour1)).slice(-2) + ':' + ('00' + Math.floor(diffMinute1)).slice(-2) + ':' + ('00' + Math.round(diffSecond1)).slice(-2));
  
    

  }

  if($(this).val().length>6&&$(this).val().length!=8){
    $(this).val("");
    blockN_start=Number(blockN_start);
    var numb=blockN_start-1;
    console.log(numb);
    $("#block_end"+numb).val($(this).val());

    let t1 = new Date("2017/01/05 "+$("#block_end"+blockN_start).val());
    let t2 = new Date("2017/01/05 "+$(this).val());

    let diff = t1.getTime() - t2.getTime();

    console.log(diff);

    //HH部分取得
    let diffHour = diff / (1000 * 60 * 60);
    //MM部分取得
    let diffMinute = (diffHour - Math.floor(diffHour)) * 60;
    //SS部分取得
    let diffSecond = (diffMinute - Math.floor(diffMinute)) * 60;

    console.log(('00' + Math.floor(diffHour)).slice(-2) + ':' + ('00' + Math.floor(diffMinute)).slice(-2) + ':' + ('00' + Math.round(diffSecond)).slice(-2));
    $("#block_dur"+blockN_start).val(('00' + Math.floor(diffHour)).slice(-2) + ':' + ('00' + Math.floor(diffMinute)).slice(-2) + ':' + ('00' + Math.round(diffSecond)).slice(-2));
  

  }


  

  
});


$(document).on('focus', '.block_start', function() {
  
  var id = $(this).attr('id');
 
  console.log( id );

  blockN=id.substr(11);
  console.log( blockN );

  blockN_start=id.substr(11);
  console.log( blockN_start );
  

  
});


$(document).on('keyup', '.block_end', function() {

  if($(this).val().length==6){
    $(this).val($(this).val().substr(0,2)+":"+$(this).val().substr(2,2)+":"+$(this).val().substr(4,2));

    blockN_end=Number(blockN_end);
    var numb=blockN_end+1;
    console.log(numb);
    $("#block_start"+numb).val($(this).val());

    let t1 = new Date("2017/01/05 "+$(this).val());
    let t2 = new Date("2017/01/05 "+$("#block_start"+blockN_end).val());

    let diff = t1.getTime() - t2.getTime();

    console.log(diff);

    //HH部分取得
    let diffHour = diff / (1000 * 60 * 60);
    //MM部分取得
    let diffMinute = (diffHour - Math.floor(diffHour)) * 60;
    //SS部分取得
    let diffSecond = (diffMinute - Math.floor(diffMinute)) * 60;

    console.log(('00' + Math.floor(diffHour)).slice(-2) + ':' + ('00' + Math.floor(diffMinute)).slice(-2) + ':' + ('00' + Math.round(diffSecond)).slice(-2));
    $("#block_dur"+blockN_end).val(('00' + Math.floor(diffHour)).slice(-2) + ':' + ('00' + Math.floor(diffMinute)).slice(-2) + ':' + ('00' + Math.round(diffSecond)).slice(-2));


    

  }

  if($(this).val().length>6&&$(this).val().length!=8){
    $(this).val("");

    blockN_end=Number(blockN_end);
    var numb=blockN_end+1;
    console.log(numb);
    $("#block_start"+numb).val($(this).val());

    let t1 = new Date("2017/01/05 "+$(this).val());
  let t2 = new Date("2017/01/05 "+$("#block_start"+blockN_end).val());

  let diff = t1.getTime() - t2.getTime();

  console.log(diff);

  //HH部分取得
  let diffHour = diff / (1000 * 60 * 60);
  //MM部分取得
  let diffMinute = (diffHour - Math.floor(diffHour)) * 60;
  //SS部分取得
  let diffSecond = (diffMinute - Math.floor(diffMinute)) * 60;

  console.log(('00' + Math.floor(diffHour)).slice(-2) + ':' + ('00' + Math.floor(diffMinute)).slice(-2) + ':' + ('00' + Math.round(diffSecond)).slice(-2));
  $("#block_dur"+blockN_end).val(('00' + Math.floor(diffHour)).slice(-2) + ':' + ('00' + Math.floor(diffMinute)).slice(-2) + ':' + ('00' + Math.round(diffSecond)).slice(-2));
  

  }

  
   
  
});


$(document).on('focus', '.block_end', function() {
  
  var id = $(this).attr('id');
 
  console.log( id );

  blockN=id.substr(9);
  console.log( blockN );

  blockN_end=id.substr(9);
  console.log( blockN_end );
  

  
});

$(document).on('focus', '.block_obj', function() {
  
  var id = $(this).attr('id');
 
  console.log( id );

  blockN=id.substr(9);
  console.log( blockN );

  blockN_obj=id.substr(9);
  console.log( blockN_obj );
  

  
});

$(document).on('focus', '.block_source', function() {
  
  var id = $(this).attr('id');
 
  console.log( id );

  blockN=id.substr(12);
  console.log( blockN );

  blockN_source=id.substr(12);
  console.log( blockN_source );
  

  
});

$(document).on('focus', '.block_dur', function() {
  
  var id = $(this).attr('id');
 
  console.log( id );

  blockN=id.substr(9);
  console.log( blockN );

  blockN_dur=id.substr(9);
  console.log( blockN_dur );
  

  
});

$(document).on('focus', '.block_bik', function() {
  
  var id = $(this).attr('id');
 
  console.log( id );

  blockN=id.substr(9);
  console.log( blockN );

  blockN_bik=id.substr(9);
  console.log( blockN_bik );
  

  
});








$(document).on('keyup', '.key_start', function() {

  if($(this).val().length==6){
    $(this).val($(this).val().substr(0,2)+":"+$(this).val().substr(2,2)+":"+$(this).val().substr(4,2));

    keyN_start=Number(keyN_start);

    if($("#key_end"+keyN_start).val().length==8){
      let t1 = new Date("2017/01/05 "+$("#key_end"+keyN_start).val());
      let t2 = new Date("2017/01/05 "+$(this).val());

      let diff = t1.getTime() - t2.getTime();

      console.log(diff);

      //HH部分取得
      let diffHour = diff / (1000 * 60 * 60);
      //MM部分取得
      let diffMinute = (diffHour - Math.floor(diffHour)) * 60;
      //SS部分取得
      let diffSecond = (diffMinute - Math.floor(diffMinute)) * 60;

      console.log(('00' + Math.floor(diffHour)).slice(-2) + ':' + ('00' + Math.floor(diffMinute)).slice(-2) + ':' + ('00' + Math.round(diffSecond)).slice(-2));
      $("#key_dur"+blockN_start).val(('00' + Math.floor(diffHour)).slice(-2) + ':' + ('00' + Math.floor(diffMinute)).slice(-2) + ':' + ('00' + Math.round(diffSecond)).slice(-2));
  

    }

  }

  if($(this).val().length>6&&$(this).val().length!=8){
    $(this).val("");

  }
  
});


$(document).on('focus', '.key_start', function() {
  
  var id = $(this).attr('id');
 
  console.log( id );

  keyN=id.substr(9);
  console.log( keyN );

  keyN_start=id.substr(9);
  console.log( keyN_start );
  

  
});


$(document).on('keyup', '.key_end', function() {

  if($(this).val().length==6){
    $(this).val($(this).val().substr(0,2)+":"+$(this).val().substr(2,2)+":"+$(this).val().substr(4,2));

    keyN_end=Number(keyN_end);

    let t1 = new Date("2017/01/05 "+$(this).val());
    let t2 = new Date("2017/01/05 "+$("#key_start"+keyN_end).val());

    let diff = t1.getTime() - t2.getTime();

    console.log(diff);

    //HH部分取得
    let diffHour = diff / (1000 * 60 * 60);
    //MM部分取得
    let diffMinute = (diffHour - Math.floor(diffHour)) * 60;
    //SS部分取得
    let diffSecond = (diffMinute - Math.floor(diffMinute)) * 60;

    console.log(('00' + Math.floor(diffHour)).slice(-2) + ':' + ('00' + Math.floor(diffMinute)).slice(-2) + ':' + ('00' + Math.round(diffSecond)).slice(-2));
    $("#key_dur"+keyN_end).val(('00' + Math.floor(diffHour)).slice(-2) + ':' + ('00' + Math.floor(diffMinute)).slice(-2) + ':' + ('00' + Math.round(diffSecond)).slice(-2));


    

  }

  if($(this).val().length>6&&$(this).val().length!=8){
    $(this).val("");

  }

  
   
  
});


$(document).on('focus', '.key_end', function() {
  
  var id = $(this).attr('id');
 
  console.log( id );

  keyN=id.substr(7);
  console.log( keyN );

  keyN_end=id.substr(7);
  console.log( keyN_end );
  

  
});



$(document).on('change', '#housoubi', function() {
  console.log("asai");

  console.log($("#fileid").val());

  for(var i=0;i<$("#fileid").val().length;i++){
    var val = $("#fileid").val().substr(i,6);
    var result = $.isNumeric(val);
    
    //console.log(result);
    if(result){
      console.log(i);
      var h1 = $("#fileid").val();
      var result = h1.replace($("#fileid").val().substr(i,6), $("#housoubi").val().substr(2,2)+$("#housoubi").val().substr(5,2)+$("#housoubi").val().substr(8,2));
      $("#fileid").val(result );
      return;
    }

  }
  

  
  
});


$(document).on('change', '#housoubi_read', function() {
  console.log("asai");

  console.log($("#fileid_read").val());

  for(var i=0;i<$("#fileid_read").val().length;i++){
    var val = $("#fileid_read").val().substr(i,6);
    var result = $.isNumeric(val);
    
    //console.log(result);
    if(result){
      console.log(i);
      var h1 = $("#fileid_read").val();
      var result = h1.replace($("#fileid_read").val().substr(i,6), $("#housoubi_read").val().substr(2,2)+$("#housoubi_read").val().substr(5,2)+$("#housoubi_read").val().substr(8,2));
      $("#fileid_read").val(result );
      return;
    }

  }
  

  
  
});


/*
$(document).on('keydown', '#honkai', function(e){
  let k = e.keyCode;
  let str = String.fromCharCode(k);
  if(!(str.match(/[0-9:]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46)){
    console.log("asai");
    return false;
  }
});

$(document).on('keyup', '#honkai', function(e){
  if(e.keyCode === 9 || e.keyCode === 16) return;
  this.value = this.value.replace(/[^0-9a-zA-Z]+/i,'');
});

$(document).on('blur', '#honkai',function(){
  this.value = this.value.replace(/[^0-9a-zA-Z]+/i,'');
});
*/

$(document).on('keydown', '#honkai', function(e){
  let k = e.keyCode;
  let str = String.fromCharCode(k);
  if(!(str.match(/[0-9]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46|| k === 186)){
    return false;
  }
});

$(document).on('keyup', '#honkai', function(e){
  if(e.keyCode === 9 || e.keyCode === 16|| e.keyCode  === 186) return;
  this.value = this.value.replace(/[^0-9:]+/i,'');
});
 
$(document).on('blur', '#honkai',function(e){
  if( e.keyCode === 186) return;
  this.value = this.value.replace(/[^0-9:]+/i,'');
});


$(document).on('keydown', '#honzen', function(e){
  let k = e.keyCode;
  let str = String.fromCharCode(k);
  if(!(str.match(/[0-9]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46|| k === 186)){
    return false;
  }
});

$(document).on('keyup', '#honzen', function(e){
  if(e.keyCode === 9 || e.keyCode === 16|| e.keyCode  === 186) return;
  this.value = this.value.replace(/[^0-9:]+/i,'');
});
 
$(document).on('blur', '#honzen',function(e){
  if( e.keyCode === 186) return;
  this.value = this.value.replace(/[^0-9:]+/i,'');
});


$(document).on('keydown', '.block_start', function(e){
  let k = e.keyCode;
  let str = String.fromCharCode(k);
  if(!(str.match(/[0-9]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46|| k === 186)){
    return false;
  }
});

$(document).on('keyup', '.block_start', function(e){
  if(e.keyCode === 9 || e.keyCode === 16|| e.keyCode  === 186) return;
  this.value = this.value.replace(/[^0-9:]+/i,'');
});
 
$(document).on('blur', '.block_start',function(e){
  if( e.keyCode === 186) return;
  this.value = this.value.replace(/[^0-9:]+/i,'');
});

$(document).on('keydown', '.block_end', function(e){
  let k = e.keyCode;
  let str = String.fromCharCode(k);
  if(!(str.match(/[0-9]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46|| k === 186)){
    return false;
  }
});

$(document).on('keyup', '.block_end', function(e){
  if(e.keyCode === 9 || e.keyCode === 16|| e.keyCode  === 186) return;
  this.value = this.value.replace(/[^0-9:]+/i,'');
});
 
$(document).on('blur', '.block_end',function(e){
  if( e.keyCode === 186) return;
  this.value = this.value.replace(/[^0-9:]+/i,'');
});



$(document).on('keydown', '.key_start', function(e){
  let k = e.keyCode;
  let str = String.fromCharCode(k);
  if(!(str.match(/[0-9]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46|| k === 186)){
    return false;
  }
});

$(document).on('keyup', '.key_start', function(e){
  if(e.keyCode === 9 || e.keyCode === 16|| e.keyCode  === 186) return;
  this.value = this.value.replace(/[^0-9:]+/i,'');
});
 
$(document).on('blur', '.key_start',function(e){
  if( e.keyCode === 186) return;
  this.value = this.value.replace(/[^0-9:]+/i,'');
});

$(document).on('keydown', '.key_end', function(e){
  let k = e.keyCode;
  let str = String.fromCharCode(k);
  if(!(str.match(/[0-9]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46|| k === 186)){
    return false;
  }
});

$(document).on('keyup', '.key_end', function(e){
  if(e.keyCode === 9 || e.keyCode === 16|| e.keyCode  === 186) return;
  this.value = this.value.replace(/[^0-9:]+/i,'');
});
 
$(document).on('blur', '.key_end',function(e){
  if( e.keyCode === 186) return;
  this.value = this.value.replace(/[^0-9:]+/i,'');
});


$(document).on('keydown', '#housoujikoku', function(e){
  let k = e.keyCode;
  let str = String.fromCharCode(k);
  if(!(str.match(/[0-9]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46|| k === 186)){
    return false;
  }
});

$(document).on('keyup', '#housoujikoku', function(e){
  if(e.keyCode === 9 || e.keyCode === 16|| e.keyCode  === 186) return;
  this.value = this.value.replace(/[^0-9:]+/i,'');
});
 
$(document).on('blur', '#housoujikoku',function(e){
  if( e.keyCode === 186) return;
  this.value = this.value.replace(/[^0-9:]+/i,'');
});


$(document).on('keydown', '#fileid', function(e){
  let k = e.keyCode;
  let str = String.fromCharCode(k);
  if(!(str.match(/[0-9a-z]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46||k==226)){
    return false;
  }
});

$(document).on('keyup', '#fileid', function(e){
  if(e.keyCode === 9 || e.keyCode === 16|| e.keyCode === 226) return;
  this.value = this.value.replace(/[^0-9a-z_]+/i,'');
});
 
$(document).on('blur', '#fileid',function(e){
  this.value = this.value.replace(/[^0-9a-z_]+/i,'');
});


$(document).on('keydown', '#roll1', function(e){
  let k = e.keyCode;
  let str = String.fromCharCode(k);
  if(!(str.match(/[0-9]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46)){
    return false;
  }
});

$(document).on('keyup', '#roll1', function(e){
  if(e.keyCode === 9 || e.keyCode === 16) return;
  this.value = this.value.replace(/[^0-9]+/i,'');
});
 
$(document).on('blur', '#roll1',function(e){
  this.value = this.value.replace(/[^0-9]+/i,'');
});


$(document).on('keydown', '#roll2', function(e){
  let k = e.keyCode;
  let str = String.fromCharCode(k);
  if(!(str.match(/[0-9]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46)){
    return false;
  }
});

$(document).on('keyup', '#roll2', function(e){
  if(e.keyCode === 9 || e.keyCode === 16) return;
  this.value = this.value.replace(/[^0-9]+/i,'');
});
 
$(document).on('blur', '#roll2',function(e){
  this.value = this.value.replace(/[^0-9]+/i,'');
});








});