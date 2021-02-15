<tbody>
<tr>
    <th>作業日</th>
    <th>作業内容</th>
    <th>担当(姓)</th>
    <th>担当(名)</th>
    <th>会社</th>
    <th>連絡先</th>
    <th>収録機器</th>
    </tr>

        @for($i=1;$i<=$num;$i++)
        <tr>
            <td><input id="sagyou_sagyoubi{{$i}}" name="sagyou_sagyoubi{{$i}}" type="date"></td>
            <td>
                {{Form::select('sagyou_naiyou'.$i, ['DUB', 'REC', 'PB'])}}
            </td>
            <td><input id="sagyou_sei{{$i}}" type="text" name="sagyou_sei{{$i}}" size="10"></td>
            <td><input id="sagyou_mei{{$i}}" type="text" name="sagyou_mei{{$i}}" size="10"></td>
            <td><input id="sagyou_kaisha{{$i}}" type="text" name="sagyou_kaisha{{$i}}" size="10"></td>
            <td><input id="sagyou_renraku{{$i}}" type="text" name="sagyou_renraku{{$i}}" size="10"></td>
            <td><input id="sagyou_shuroku{{$i}}" type="text" name="sagyou_shuroku{{$i}}" size="10"></td>
        </tr>
        @endfor
</tbody>