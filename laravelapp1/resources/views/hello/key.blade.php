
<tbody>
    <tr>
            <th>開始TC</th>
            <th>終了TC</th>
            <th>Duration</th>
            <th>種別</th>
            <th>内容</th>
        </tr>

        @for($i=1;$i<=$num;$i++)
        <tr>
            <td><input id="key_start{{$i}}" type="text" name="key_start{{$i}}" size="10"></td>
            <td><input id="key_end{{$i}}" type="text" name="key_end{{$i}}" size="10"></td>
            <td><input id="key_dur{{$i}}" type="text" name="key_dur{{$i}}" size="10"></td>
            <td><input id="key_shu{{$i}}" type="text" name="key_shu{{$i}}" size="10"></td>
            <td><input id="key_nai{{$i}}" type="text" name="key_nai{{$i}}" size="10"></td>
            
        </tr>
        @endfor
</tbody>