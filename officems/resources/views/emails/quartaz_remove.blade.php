<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stoppage of Salary Deduction</title>
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
  
  <p style="text-align: right;">{{now()}}</p>
  
    <p>{{$data['name']}}<br>
    Faculty of Technology<br>
    University of Ruhuna</p>
    
    <h2>Stoppage of Salary Deduction</h2>
    
    <p>I would be grateful to you if you could kindly take necessary action to stop the salary deduction from the below-mentioned staff members as they have handed over the quarters to the Dean’s office.</p>
    
    <table>
        <tr>
            <th>No</th>
            <th>Name and Designation</th>
            <th>Quarters Return Date/ Deduction stoppage date</th>
            <th>Quarters Details</th>
            <th>Monthly Rent</th>
        </tr>
        <tr>
            <td>01</td>
            <td>{{$data['name']}}</td>
            <td>{{$data['rdate']}}</td>
            <td>{{$data['qnum']}}</td>
            <td>{{$data['rent']}}</td>
        </tr>
    </table>
    
    <br>
    
    <p>Assistant Registrar<br>
    Faculty of Technology<br>
    University of Ruhuna</p>
</body>
</html>
