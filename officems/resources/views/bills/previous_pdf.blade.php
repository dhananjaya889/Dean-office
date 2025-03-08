<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previous Bills</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Previous Bills Report</h2>
    <table>
        <thead>
            <tr>
                <th>Bill Number</th>
                <th>Bill Name</th>
                <th>Bill Date</th>
                <th>Bill Month</th>
                <th>Bill Amount</th>
                <th>User Name</th>
                <th>Quartz Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($previousBills as $bill)
                <tr>
                    <td>{{ $bill->bill_id }}</td>
                    <td>{{ $bill->name }}</td>
                    <td>{{ $bill->date }}</td>
                    <td>{{ $bill->month }}</td>
                    <td>{{ $bill->amount }}</td>
                    <td>{{ $bill->user ? $bill->user->name : 'N/A' }}</td>
                    <td>{{ $bill->quartz ? $bill->quartz->num : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
