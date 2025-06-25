<!DOCTYPE html>
<html>
<head>
    <title>Booking Report</title>
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
    <h2 style="text-align: center;">Booking Report</h2>

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
            </tr>
        </thead>
        <tbody>
            @foreach ($bookinglist as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->TrxDate)->format('d M Y') }}</td>
                    <td>{{ $booking->TimeIn ? \Carbon\Carbon::parse($booking->TimeIn)->format('d M Y H:i') : '-' }}</td>
                    <td>{{ $booking->RoomId }}</td>
                    <td>{{ $booking->GuestName }}</td>
                    <td>{{ $booking->ReservationWith ?? '-' }}</td>
                    <td>{{ $booking->Notes ?? '-' }}</td>
                    <td>{{ $booking->BookPack ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
