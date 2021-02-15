
    
        
        <tr>
            <td><input id="block_start{$id}" type="text" name="block_start{$id}" size="10"></td>
            <td><input id="block_end{$id}" type="text" name="block_end{$id}" size="10"></td>
            <td>
                {{Form::select('block_obj'.$id, ['PG-本編', 'CM-無信号', 'SC-提供ベースのみ'])}}
            </td>
            <td>
                {{Form::select('block_source'.$id, ['R-1', 'CM1', '提供1'])}}
            </td>
            <td><input id="block_dur{$id}" type="text" name="block_dur{$id}" size="10"></td>
            <td><input id="block_bik{$id}" type="text" name="block_bik{$id}" size="10"></td>
        </tr>
        
