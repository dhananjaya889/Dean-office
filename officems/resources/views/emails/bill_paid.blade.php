<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Payment Completed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h2 {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
  
  <p style="text-align: right;">{{ $data['created_at'] }}</p>
  
    <p>Assistant Registrar<br>
    Faculty of Technology<br>
    University of Ruhuna</p>
    
    <h2>Regarding the presentation of the paid bill</h2>
    
    <p>The above-mentioned staff member has paid the quarters bill and uploaded 
        the paid quarters bill to the Dean's Office system.</p>
    
    <table>
        <tr>
            <th>Bill Name</th>
            <th>Bill Number</th>
            <th>Amount</th>
            <th>Premises ID / Inv NO</th>
        </tr>
        <tr>
            <td>{{ $data['bill_name'] }}</td>
            <td>{{ $data['bill_id'] }}</td>
            <td>{{ $data['amount'] }}</td>
            <td>{{ $data['ref_id'] }}</td>
        </tr>
    </table>
    
    <br>
    
    <p><br>
    Faculty of Technology<br>
    University of Ruhuna</p>
</body>
</html>