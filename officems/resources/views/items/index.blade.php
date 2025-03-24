@extends('layouts.admin')

@section('title', 'Quarters Items')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">All Quarters Items</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form method="GET" action="{{ route('items') }}" class="mb-3">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label class="form-label">Item Number</label>
                                <input type="text" name="item_id" class="form-control" value="{{ request('item_id') }}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Item Name</label>
                                <input type="text" name="name" class="form-control" value="{{ request('name') }}">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('items') }}" class="btn btn-secondary ms-2">Reset</a>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <a href="{{ url('/items/create') }}" class="btn btn-info">Add Items</a>
                            </div>
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                            <div class="col-sm-2 d-flex align-items-end">
                                <a href="{{ route('previous_items.index') }}" class="btn btn-warning">Previous Items</a>
                            </div>
                        @endif
                        </div>
                    </form>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item Number</th>
                                    <th>Item Name</th>
                                    <th>Item add Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="noticeTableBody">
                                @foreach ($items as $n)
                                    <tr>
                                        <td>{{ $n->item_id }}</td>
                                        <td>{{ $n->name }}</td>
                                        <td>{{ $n->created_at }}</td>
                                        <td><a class="btn btn-primary"
                                                href="{{ url('/items/' . $n->id . '/' . $n->name) }}">View</a></td>
                                        <td><a href="{{ route('items.edit', [$n->id, $n->name]) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('items.destroy', $n->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this item?')">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="paginationLinks">
                        {{ $items->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('additinal-script')
    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            fetchItems(this.value);
        });

        function fetchItems(search = '', page = 1) {
            fetch(`/api/items?search=${search}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    let tbody = document.getElementById('itemsTableBody');
                    let paginationLinks = document.getElementById('paginationLinks');

                    tbody.innerHTML = '';
                    paginationLinks.innerHTML = '';

                    data.data.forEach(item => {
                        let deleteRoute = `/items/${item.id}`;
                        let row = `<tr>
                        <td>${item.item_id}</td>
                        <td>${item.name}</td>
                        <td>${item.description}</td>
                        <td><a class="btn btn-primary" href="/items/${item.id}/${item.name}">View</a></td>
                        <td>
                            <form action="${deleteRoute}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>`;
                        tbody.innerHTML += row;
                    });

                    if (data.links) {
                        data.links.forEach(link => {
                            let pageLink = document.createElement('button');
                            pageLink.innerHTML = link.label;
                            pageLink.className = `btn ${link.active ? 'btn-primary' : 'btn-light'} mx-1`;
                            pageLink.onclick = () => fetchItems(search, link.url.split('page=')[1]);
                            pageLink.disabled = link.active;
                            paginationLinks.appendChild(pageLink);
                        });
                    }
                });
        }

        fetchItems();
    </script>
@endsection
