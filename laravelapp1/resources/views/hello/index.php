<?php
if(isset($items)){
    $xml_text = <<<HTML
    <table>
        
        <tr>
            <td><img alt="ロゴ" src="/img/logo.jpg"></td>
            <td><p>MetaJan</p></td>
            <td><button id="button1" type="button" name="aaa" value="aaa">新規作成</button></td>
            <td><button id="button2" type="button" name="aaa" value="aaa">操作マニュアル</button></td>
            <td><form method="POST" action="/laravelapp1/public/hello" enctype="multipart/form-data">
                
                <input type="file" id="file" name="file" class="form-control">
                <button type="submit">メタデータ読み込み</button></form></td>
            <td><form action="/laravelapp1/public/hello/show" method="post">
            
            <input type="submit" value="JOBシート作成"></form></td>
            <td><form action="/laravelapp1/public/hello/edit" method="post">
            
            <input type="submit" value="メタデータ保存"></td>
            <td><img width="100px" alt="ロゴ" src="{{ asset('/img/ytvlogo.bmp') }}"></td>
        </tr>
        <tr>
        <td><p>タイトル</p></td>
            <td><img alt="ロゴ" src="{{ asset('/img/hatena.png') }}"></td>
            <td><input id="title" type="text" name="name1" size="30" maxlength="20" value="{{$items["name"]}}"></td>
            <td><p>サブタイトル</p></td>
            <td><input id="subtitle" type="text" name="name2" size="30" maxlength="20"></td>
        </tr>
    </table>
    
    </form>
HTML;
echo $xml_text;

}

else{
    $xml_text = <<<HTML
    <table>
        
    　　<tr>
            <td><img alt="ロゴ" src="{{ asset('/img/logo.jpg') }}"></td>
            <td><p>MetaJan</p></td>
            <td><button id="button1" type="button" name="aaa" value="aaa">新規作成</button></td>
            <td><button id="button2" type="button" name="aaa" value="aaa">操作マニュアル</button></td>
            <td><form method="POST" action="/laravelapp1/public/hello" enctype="multipart/form-data">
                
                <input type="file" id="file" name="file" class="form-control">
                <button type="submit">メタデータ読み込み</button></form></td>
            <td><form action="/laravelapp1/public/hello/show" method="POST">
            
            <input type="submit" value="JOBシート作成"></form></td>
            <td><form action="/laravelapp1/public/hello/edit" method="post">
            
            <input type="submit" value="メタデータ保存"></td>
            <td><img width="100px" alt="ロゴ" src="{{ asset('/img/ytvlogo.bmp') }}"></td>
        </tr>
        <tr>
            <td><p>タイトル</p></td>
            <td><img alt="ロゴ" src="{{ asset('/img/hatena.png') }}"></td>
            <td><input id="title" type="text" name="name1" size="30" maxlength="20"></td>
            <td><p>サブタイトル</p></td>
            <td><input id="subtitle" type="text" name="name2" size="30" maxlength="20"></td>
        </tr>
        <tr>
            <td><p>ブロック</p></td>
            <td><input id="name3" type="text" name="name3" value="1"></td>
            <td><p>件</p></td>
            <td><button id="button3" type="button" name="aaa" value="aaa">行追加</button></td>
        </tr>
    </table>

    <table id="block">
        <tr>
            <th><p>開始TC</p></th>
            <th><p>終了TC</p></th>
            <th><p>項目</p></th>
            <th><p>素材情報</p></th>
            <th><p>Duration</p></th>
            <th><p>備考　20文字以内</p></th>
        </tr>

        <tr>
            <td><input id="block_start1" type="text" name="block_start1" value="10:00:00"></td>
            <td><input id="block_end1" type="text" name="block_end1"></td>
            <td>
                
            </td>
            <td>
                
            <td><input id="block_dur1" type="text" name="block_dur1"></td>
            <td><input id="block_bik1" type="text" name="block_bik1"></td>
        </tr>

    </table>
    </form>
HTML;
echo $xml_text;

}
    

