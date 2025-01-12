<table>
    <thead>
        <tr>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Name</th>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Email</th>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Phone Number</th>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">NRIC</th>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Redemption</th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $param)
            <tr>
                <td style="border: 1px solid black">{{ $param->customer->name }}</td>
                <td style="border: 1px solid black">{{ $param->customer->email }}</td>
                <td style="border: 1px solid black">{{ $param->customer->mobile }}</td>
                <td style="border: 1px solid black">{{ $param->customer->nric }}</td>
                <td style="border: 1px solid black">{{ $param->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
