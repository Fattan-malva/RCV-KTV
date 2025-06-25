<!DOCTYPE html>
<html>
<head>
    <title>Canceled Booking Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header-info { margin-bottom: 10px; }
        .header-info p { margin: 0; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Canceled Booking Report</h2>

    <div class="header-info">
        <p>{!! $info !!}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Trx Date</th>
                <th>Booking At</th>
                <th>Room</th>
                <th>Guest</th>
                <th>RCP</th>
                <th>Notes</th>
                <th>BookPack</th>
                <th>Reason</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookingCancellist as $index => $bookingCancel)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($bookingCancel->TrxDate)->format('d M Y') }}</td>
                    <td>{{ $bookingCancel->TimeIn ? \Carbon\Carbon::parse($bookingCancel->TimeIn)->format('d M Y H:i') : '-' }}</td>
                    <td>{{ $bookingCancel->RoomId }}</td>
                    <td>{{ $bookingCancel->GuestName }}</td>
                    <td>{{ $bookingCancel->ReservationWith ?? '-' }}</td>
                    <td>{{ $bookingCancel->Notes ?? '-' }}</td>
                    <td>{{ $bookingCancel->BookPack ?? '-' }}</td>
                    <td>{{ $bookingCancel->Reason ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
