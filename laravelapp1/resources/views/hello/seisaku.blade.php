<tbody>
<tr>
    <th>職種</th>
    <th>担当(姓)</th>
    <th>担当(名)</th>
    <th>会社</th>
    <th>連絡先</th>
    </tr>

        @for($i=1;$i<=$num;$i++)
        <tr>
            <td><input id="seisaku_shokushu{{$i}}" type="text" name="seisaku_shokushu{{$i}}" size="10"></td>
            <td><input id="seisaku_sei{{$i}}" type="text" name="seisaku_sei{{$i}}" size="10"></td>
            <td><input id="seisaku_mei{{$i}}" type="text" name="seisaku_mei{{$i}}" size="10"></td>
            <td><input id="seisaku_kaisha{{$i}}" type="text" name="seisaku_kaisha{{$i}}" size="10"></td>
            <td><input id="seisaku_renraku{{$i}}" type="text" name="seisaku_renraku{{$i}}" size="10"></td>
        </tr>
        @endfor
</tbody>