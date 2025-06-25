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

        h3.section-title {
            margin-top: 30px;
            font-size: 14px;
            text-decoration: underline;
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

    @php
        $grouped = [
            'Guest' => [],
            'Maintenance' => [],
            'OO' => [],
            'Other' => []
        ];

        foreach ($detaillist as $detail) {
            if (in_array($detail->TypeCheckIn, [2, 3])) {
                $grouped['Guest'][] = $detail;
            } elseif (in_array($detail->TypeCheckIn, [4, 5])) {
                $grouped['Maintenance'][] = $detail;
            } elseif (in_array($detail->TypeCheckIn, [6, 7])) {
                $grouped['OO'][] = $detail;
            } else {
                $grouped['Other'][] = $detail;
            }
        }
    @endphp

    @foreach ($grouped as $status => $records)
        @if(count($records) > 0)
            <h3 class="section-title">{{ $status }}</h3>
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
                    @foreach ($records as $index => $detail)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($detail->TrxDate)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($detail->CheckInTime)->format('d M Y H:i') }}</td>
                            <td>
                                @if($detail->CheckOutTime)
                                    {{ \Carbon\Carbon::parse($detail->CheckOutTime)->format('d M Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $detail->RoomId }}</td>
                            <td><strong>{{ $detail->GuestName }}</strong></td>
                            <td>{{ $detail->ReservationWith ?? '-' }}</td>
                            <td>{{ $detail->Notes ?? '-' }}</td>
                            <td>{{ $status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach
</body>

</html>