<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Quarters</title>
</head>

<body>
    <p>{{ now()->format('Y/m/d') }}<br>
        {{$user['name']}},<br>
        {{$user['role']}},<br>
        Faculty of Technology.
        </p>

    <h4>Dear Sir/Madam,</h4>

    <p><u>Providing faculty residential facilities</u></p>

    <p>On the recommendation of the Housing Committee that met to consider your request, 
        residential facilities have been provided in 
        Staff House No. {{$data->num}} of the Faculty of Technology from {{ now()->format('Y/m/d') }}.</p>

    <p>You hereby agree to hand over the house to the University in the event that the house is requested again due to the need of the Faculty or 
        the University and to pay the University for any damage to the house.</p>

    <p>The monthly rent for this house is {{$data->rent}}, 
        and you must pay the electricity and water charges yourself. 
        Furthermore, when you vacate the {{$data->num}} house, you must formally hand over the house to 
        the faculty office.</p>

    <br>I request you to inform the Assistant Registrar, Faculty of Technology in writing regarding your acceptance of the house.
            For quarters information, visit www.MISDeanOffice.com.</p>

    <p>Username: {{$user['email']}}<br>
        Password: 12345678</p>

    <p>Assistant Registrar,<br>
        Faculty of Technology,<br>
        University of Ruhuna.</p>

</body>

</html>
