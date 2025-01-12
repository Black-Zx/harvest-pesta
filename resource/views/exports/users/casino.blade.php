<table>
    <thead>
        <tr>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Username</th>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Casino point</th>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Casino Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $param)
            <tr>
                <td style="border: 1px solid black">{{ $param->username }}</td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
            </tr>
        @endforeach
    </tbody>
</table>
