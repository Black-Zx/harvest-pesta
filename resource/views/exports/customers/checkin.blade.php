<table>
    <thead>
        <tr>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Name</th>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Email</th>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Phone Number</th>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">NRIC</th>
            {{-- <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Register Time</th>
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Preferred Date</th> --}}
            <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Check In Time</th>
            {{-- <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Redemption Time</th> --}}
            {{-- @if ($report_date == "23th May 2024") --}}
                {{-- <th style="background-color: #2A4062;color: #ffffff;border: 1px solid black">Invited</th> --}}
            {{-- @endif --}}
        </tr>
    </thead>
    <tbody>
        @foreach($results as $param)
            <tr>
                <td style="border: 1px solid black">{{ $param->name }}</td>
                <td style="border: 1px solid black">{{ $param->email }}</td>
                <td style="border: 1px solid black">{{ $param->mobile }}</td>
                <td style="border: 1px solid black">{{ $param->nric }}</td>
                {{-- <td style="border: 1px solid black">{{ $param->created_at }}</td>
                <td style="border: 1px solid black">{{ $param->date }}</td> --}}
                <td style="border: 1px solid black">{{ $param->check_in }}</td>
                {{-- <td style="border: 1px solid black">{{ $param->redemption_time->pluck('created_at')->first() }}</td> --}}
                {{-- @if ($param->date == "23th May 2024") --}}
                    {{-- @if ($param->fixed_date == 0)
                        <td style="border: 1px solid black">N</td>
                    @else
                        <td style="border: 1px solid black">Y</td>
                    @endif --}}
                {{-- @endif --}}
            </tr>
        @endforeach
    </tbody>
</table>
