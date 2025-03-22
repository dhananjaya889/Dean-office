@extends('layouts.admin')

@section('title', 'Utility Bills for Quarters')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Add Bill Details</div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('bills.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Asign to a quartaz</label>
                        <select name="assign_quartaz" id="qua" class="form-control">
                            <option value="">-- Select a Quartaz --</option>
                            @foreach ($qua as $q)
                                <option value="{{$q->id}}">{{$q->num}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3"><label class="form-label">Bill Name</label>
                        <select name="name" id="bil_type"
                            class="form-control" onchange="getdata()">
                            <option value="">---Select Bill Type---</option>
                            <option value="Electric Bill">Electric Bill</option>
                            <option value="Water Bill">Water Bill</option>
                            <option value="Telecommunication Bill">Telecommunication Bill</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Assign to a user</label>
                        <input type="text" name="assign_user" id="bill_user" class="form-control" value="{{Auth::user()->name}}" required>
                        {{-- <select name="assign_user" id="" class="form-control">
                            <option value="">-- Select a user --</option>
                            @foreach ($users as $u)
                                <option value="{{$u->id}}">{{$u->name}} - {{$u->email}}</option>
                            @endforeach
                        </select> --}}
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Bill Number</label>
                        <input type="text" name="bill_id" id="bill_number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bill Issue Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="mb-3"><label class="form-label">Month of Bill</label>
                        <select name="month"
                            class="form-control">
                            <option value="">---Select Month---</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="int" name="amount" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Point for Month</label>
                        <input type="int" name="point" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bill Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Add Bill</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function getdata(){
        const qua = document.getElementById('qua').value;
        const billType = document.getElementById('bil_type').value;
        var bill_user  = document.getElementById('bill_user');
        var bill_number = document.getElementById('bill_number');
        var billSerch = ""; 
    

        fetch(`/bills/getByQua/data/${qua}`)
                .then(response => response.json())
                .then(data => {
                  
                  bill_user.value = data.name;
                  if (billType == 'Electric Bill') {
                    bill_number.value = data.ebill_no
                    }else if(billType == 'Water Bill'){
                        bill_number.value = data.wbill_no;
                    }
                  
                });
        
    }
</script>

@endsection
