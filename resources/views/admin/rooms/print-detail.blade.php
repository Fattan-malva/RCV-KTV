<!DOCTYPE html>
<html>

<head>
    <title>Transaction Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header-info {
            margin-bottom: 10px;
        }

        .header-info p {
            margin: 0;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Transaction Report</h2>

    <div class="header-info">
        <p>{!! $info !!}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Room</th>
                <th>Guest</th>
                <th>RCP With</th>
                <th>Notes</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detaillist as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($detail->TrxDate)->format('d M Y') }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($detail->CheckInTime)->format('d M Y H:i') }}
                    </td>
                    <td>
                        @if($detail->CheckOutTime)
                            {{ \Carbon\Carbon::parse($detail->CheckOutTime)->format('d M Y H:i') }}
                        @endif
                    </td>
                    <td>{{ $detail->RoomId }}</td>
                    <td>
                        <div>
                            <strong>{{ $detail->GuestName }}</strong>
                        </div>
                    </td>
                    <td>{{ $detail->ReservationWith }}</td>
                    <td>{{ $detail->Notes ?? '-' }}</td>
                    <td>
                        @if(in_array($detail->TypeCheckIn, [2, 3]))
                            Guest
                        @elseif(in_array($detail->TypeCheckIn, [4, 5]))
                            Maintenance
                        @elseif(in_array($detail->TypeCheckIn, [6, 7]))
                            OO
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>