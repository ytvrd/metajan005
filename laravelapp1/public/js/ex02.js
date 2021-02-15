jQuery(function() {



    $('#shanai').on('click', function() {
       // console.log(blockN);
       /*
        var result = window.confirm('社内用メタを作成しますか？');
    
        if(result){
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },    
            url: '../public/hello/exa',
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
        
    
        }
        */
    
      });

      /*

      if($('#metaver').val()==""){
        $('#metaver').css('background-color','pink');
      }else{
        $('#metaver').css('background-color','white');
      }

      $('#metaver').on('keyup', function() {
    
        if($(this).val()!=""){
          $(this).css('background-color','white');
        }else{
          $(this).css('background-color','pink');
        }
        
    });

    if($('#cmsozai').val()==""){
      $('#cmsozai').css('background-color','pink');
    }else{
      $('#cmsozai').css('background-color','white');
    }

    $('#cmsozai').on('keyup', function() {
  
      if($(this).val()!=""){
        $(this).css('background-color','white');
      }else{
        $(this).css('background-color','pink');
      }
      
  });

  if($('#cmkaishiTC').val()==""){
    $('#cmkaishiTC').css('background-color','pink');
  }else{
    $('#cmkaishiTC').css('background-color','white');
  }

  $('#cmkaishiTC').on('keyup', function() {

    if($(this).val()!=""){
      $(this).css('background-color','white');
    }else{
      $(this).css('background-color','pink');
    }
    
});

*/


      $('#banhan').on('click', function() {
        // console.log(blockN);
        /*
         var result = window.confirm('番販用メタを作成しますか？');
     
         if(result){
           $.ajax({
             headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },    
             url: '../public/hello/ban',
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
         
     
         }
         */
     
       });


       $('#js-copybtn').on('click', function(){
        // コピーする文章の取得
        let text = "番組名:"+$('#title').val()+"\n"+"YTV放送日:"+$('#housoubi').val()+"\n"+"ファイルID:"+$('#fileid').val()
        +"\n"+"SOM:"+$('#honkai').val()+"\n"+"収録長:"+$('#honzen').val()+"\n"+"字幕有無:有　別搬入　無"+"\n"+
        "音声モード"+$('#onseimodef').val();
        //console.log(text);
        // テキストエリアの作成
        let $textarea = $('<textarea></textarea>');
        // テキストエリアに文章を挿入
        $textarea.text(text);
        //　テキストエリアを挿入
        $(this).append($textarea);
        //　テキストエリアを選択
        $textarea.select();
        // コピー
        document.execCommand('copy');
        // テキストエリアの削除
        $textarea.remove();
        // アラート文の表示
       // $('#js-copyalert').show().delay(2000).fadeOut(400);
      });


      $('#read_ban').on('click', function() {
        $("form").attr("action", "/laravelapp1/public/hello/ban").submit();
      
      
      
      });

      $('#sinkiban').on('click', function() {
        //console.log(blockN);
        var result = window.confirm('新規作成を行うと、編集中の内容が破棄されます。よろしいでしょうか？');
    
        /*if(result){
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },    
            url: '../hello/ban',
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
          window.location.href = '../hello/ban';
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


      $('#cmmetacreate').on('click', function() {
        
        var alert="";
        
        var metaver = $('#metaver').val();
        if(metaver==""){
          alert=alert+"メタデータver。";
        }
      
        var cmsozai = $('#cmsozai').val();
        if(cmsozai==""){
          alert=alert+"CM素材名。";
        }
      
        var cmkaishiTC = $('#cmkaishiTC').val();
        if(cmkaishiTC==""){
          alert=alert+"CM開始TC。";
        }
      
        var cmeizouf = $('#cmeizouf').val();
        if(cmeizouf=="0"){
          alert=alert+"映像種別。";
        }
      
        var cmbaitaif = $('#cmbaitaif').val();
        if(cmbaitaif=="0"){
          alert=alert+"搬入媒体種別。";
        }
      
        var cmcode1 = $('#cmcode1').val();
        if(cmcode1==""){
          alert=alert+"CM10桁コード1。";
        }
      
        var cmcode2 = $('#cmcode2').val();
        if(cmcode2==""){
          alert=alert+"CM10桁コード2。";
        }

        var cmsozaikoukoku = $('#cmsozaikoukoku').val();
        if(cmsozaikoukoku==""){
          alert=alert+"素材広告主名。";
        }

        var cmsozaitime = $('#cmsozaitime').val();
        if(cmsozaitime==""){
          alert=alert+"素材秒数。";
        }

        var cmonseimodef = $('#cmonseimodef').val();
        if(cmonseimodef=="0"){
          alert=alert+"音声モード。";
        }

        var cmgakakuf = $('#cmgakakuf').val();
        if(cmgakakuf=="0"){
          alert=alert+"画角。";
        }

        var cmdff = $('#cmdff').val();
        if(cmdff=="0"){
          alert=alert+"DF/NDF区分。";
        }

        var cmroudness = $('#cmroudness').val();
        if(cmroudness==""){
          alert=alert+"ラウドネス値。";
        }

        var cmjimakuf = $('#cmjimakuf').val();
        if(cmjimakuf=="0"){
          alert=alert+"字幕有無。";
        }
        
      
      
      
      
          if(alert!=""){
            
            var result = window.confirm(alert+"が入力されていません。\nこれらを無視して作成しますか。");
      
            if(!result){
              return false;
            }
            
            //return false;
            
          
      
          }
          
      
      
      
      
        $("form").attr("action", "/laravelapp1/public/hello/cmcreate").submit();
      
      
      
      });


      $('#cmread').on('click', function() {
        $("form").attr("action", "/laravelapp1/public/hello/cmmeta").submit();
      
      
      
      });

      $('#csvread').on('click', function() {
        $("form").attr("action", "/laravelapp1/public/hello/csvread").submit();
      
      
      
      });



      $('#sinki_cm').on('click', function() {
        var result = window.confirm('新規作成を行うと、編集中の内容が破棄されます。よろしいでしょうか？');
    
        
        if(result){
          window.location.href = '../hello/cmmeta';
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



      $(document).on('keydown', '#cmcode1', function(e){
        let k = e.keyCode;
        let str = String.fromCharCode(k);
        if(!(str.match(/[0-9A-HJ-NP-Z]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46)){
          return false;
        }
      });

      $(document).on('keyup', '#cmcode1', function(e){
        if(e.keyCode === 9 || e.keyCode === 16) return;
        this.value = this.value.replace(/[^0-9A-HJ-NP-Z]+/i,'');
      });
       
      $(document).on('blur', '#cmcode1',function(){
        this.value = this.value.replace(/[^0-9A-HJ-NP-Z]+/i,'');
      });


      $(document).on('keydown', '#cmcode2', function(e){
        let k = e.keyCode;
        let str = String.fromCharCode(k);
        if(!(str.match(/[0-9A-HJ-NP-Z]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46)){
          return false;
        }
      });

      $(document).on('keyup', '#cmcode2', function(e){
        if(e.keyCode === 9 || e.keyCode === 16) return;
        this.value = this.value.replace(/[^0-9A-HJ-NP-Z]+/i,'');
      });
       
      $(document).on('blur', '#cmcode2',function(){
        this.value = this.value.replace(/[^0-9A-HJ-NP-Z]+/i,'');
      });


      $(document).on('keydown', '#cmkoukokucode', function(e){
        let k = e.keyCode;
        let str = String.fromCharCode(k);
        if(!(str.match(/[0-9a-zA-Z]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46)){
          return false;
        }
      });

      $(document).on('keyup', '#cmkoukokucode', function(e){
        if(e.keyCode === 9 || e.keyCode === 16) return;
        this.value = this.value.replace(/[^0-9a-zA-Z]+/i,'');
      });
       
      $(document).on('blur', '#cmkoukokucode',function(){
        this.value = this.value.replace(/[^0-9a-zA-Z]+/i,'');
      });

      $(document).on('keydown', '#cmseisakucode', function(e){
        let k = e.keyCode;
        let str = String.fromCharCode(k);
        if(!(str.match(/[0-9a-zA-Z]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46)){
          return false;
        }
      });

      $(document).on('keyup', '#cmseisakucode', function(e){
        if(e.keyCode === 9 || e.keyCode === 16) return;
        this.value = this.value.replace(/[^0-9a-zA-Z]+/i,'');
      });
       
      $(document).on('blur', '#cmseisakucode',function(){
        this.value = this.value.replace(/[^0-9a-zA-Z]+/i,'');
      });


      $(document).on('keydown', '#cmsozai', function(e){
        let k = e.keyCode;
        let str = String.fromCharCode(k);
        if(!(str.match(/[ぁ-んーァ-ンヴー]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46)){
          return false;
        }
      });

      $(document).on('keydown', '#cmbikou', function(e){
        let k = e.keyCode;
        let str = String.fromCharCode(k);
        if(!(str.match(/[ぁ-んーァ-ンヴー]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46)){
          return false;
        }
      });


      $(document).on('keydown', '#metaver', function(e){
        let k = e.keyCode;
        let str = String.fromCharCode(k);
        if(!(str.match(/[0-9]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46|| k === 190)){
          return false;
        }
      });

      $(document).on('keyup', '#metaver', function(e){
        if(e.keyCode === 9 || e.keyCode === 16|| e.keyCode  === 190) return;
        this.value = this.value.replace(/[^0-9.]+/i,'');
      });
       
      $(document).on('blur', '#metaver',function(){
        if( e.keyCode === 190) return;
        this.value = this.value.replace(/[^0-9.]+/i,'');
      });


      $(document).on('keydown', '#cmkaishiTC', function(e){
        let k = e.keyCode;
        let str = String.fromCharCode(k);
        if(!(str.match(/[0-9]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46|| k === 186)){
          return false;
        }
      });

      $(document).on('keyup', '#cmkaishiTC', function(e){
        if(e.keyCode === 9 || e.keyCode === 16|| e.keyCode  === 186) return;
        this.value = this.value.replace(/[^0-9:]+/i,'');
      });
       
      $(document).on('blur', '#cmkaishiTC',function(e){
        if( e.keyCode === 186) return;
        this.value = this.value.replace(/[^0-9:]+/i,'');
      });


      $(document).on('keydown', '#cmkaishiTC', function(e){
        let k = e.keyCode;
        let str = String.fromCharCode(k);
        if(!(str.match(/[0-9]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k === 46|| k === 186)){
          return false;
        }
      });

      /*

      $(document).on('keyup', '#cmroudness', function(e){
        if(e.keyCode === 9 || e.keyCode === 16|| e.keyCode  === 189|| e.keyCode  === 190) return;
        this.value = this.value.replace(/[^0-9-.]+/i,'');
      });
       
      $(document).on('blur', '#cmroudness',function(e){
        if( e.keyCode === 189|| e.keyCode  === 190) return;
        this.value = this.value.replace(/[^0-9-.]+/i,'');
      });

      $(document).on('keydown', '#cmroudness', function(e){
        let k = e.keyCode;
        let str = String.fromCharCode(k);
        if(!(str.match(/[0-9]/) || e.shiftKey || (37 <= k && k <= 40) || k === 8 || k ===46 || k === 189|| e.keyCode  === 190)){
          return false;
        }
      });

      */

      $(document).on('keyup', '#cmsozaitime', function(e){
        if(e.keyCode === 9 || e.keyCode === 16) return;
        this.value = this.value.replace(/[^0-9]+/i,'');
      });
       
      $(document).on('blur', '#cmsozaitime',function(e){
        this.value = this.value.replace(/[^0-9]+/i,'');
      });



});