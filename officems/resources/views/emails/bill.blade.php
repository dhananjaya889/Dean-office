@component('mail::message')
# New Bill Submission

A new bill has been submitted with the following details:

- **Name:** {{ $billData['name'] }}
- **Bill ID:** {{ $billData['bill_id'] }}
- **Date:** {{ $billData['date'] }}
- **Month:** {{ $billData['month'] }}
- **Amount:** {{ $billData['amount'] }}
- **Points:** {{ $billData['point'] }}

@if($billData['image'])
A copy of the bill is attached.
@endif

Thanks,
{{ config('app.name') }}
@endcomponent
