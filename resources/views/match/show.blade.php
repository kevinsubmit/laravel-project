<style>
    td{
        text-align: center;
        height: 30px;
        border:solid 2px #000;
    }
    table{
        border:solid 2px #000;
        border-collapse: collapse;
    }
</style>
<table border="">
    <tr style="background-color: #6699cc;text-align: center">
        <td style="width: 60px">序号</td>
        <td style="width: 200px">开盘时间</td>
        <td style="width: 111px">上盘球队</td>
        <td style="width: 60px">盘口</td>
        <td style="width: 60px">下盘球队</td>
        <td style="width: 60px">免费推荐</td>
        <td style="width: 70px">比分</td>
        <td style="width: 100px">结果</td>
    </tr>
    <span style="display: none">{{ $i=1 }}</span>
    @foreach ($metch_info as $val)
        <tr>
            <td>{{ $i++ }}</td>
            <td style="color: #5c0fa0;">
                {{ $val->m_title }} {{ date('m-d H:i', strtotime($val->m_status_time)) }}
            </td>
            <td>{{ $val->m_home_team }}</td>
            <td>{{ $val->m_change }}</td>
            <td>{{ $val->m_visiting_team }}</td>
            <td>{{ $val->m_recommend }}</td>
            <td>{{ $val->m_score }}</td>
            <td style="color: red;">{{ $val->m_result }}</td>
        </tr>
    @endforeach
</table>