@extends('layouts.admin')
@section('title', 'Users')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Users</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                            <input type="text" id="search" class="form-control mb-3" placeholder="Search users...">
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">
                                    <a href="{{url('/users/create')}}" class="btn btn-info">Add Users</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Registration Number</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Province</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                            </tbody>
                        </table>
                    </div>
                    <div id="paginationLinks"></div>

                </div>
            </div>
        </div>
    </div>

    <!-- User Detail Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- User details will be populated here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('additinal-script')

    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            fetchUsers(this.value);
        });

        function fetchUsers(search = '', page = 1) {
            fetch(`/api/users?search=${search}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    let tbody = document.getElementById('userTableBody');
                    let paginationLinks = document.getElementById('paginationLinks');

                    tbody.innerHTML = '';
                    paginationLinks.innerHTML = '';
                    data.data.forEach(user => {
                        let deleteRoute = `/users/${user.id}`;
                        let row = `<tr>
                        <td>${user.first_name} ${user.last_name}</td>
                        <td>${user.email}</td>
                        <td>${user.reg_no}</td>
                        <td>${user.phone_number}</td>
                        <td>${user.role}</td>
                        <td>${user.province}</td>
                        <td><button class="btn btn-primary" onclick="viewUser(${user.id})">View</button></td>
                        <td><a class="btn btn-primary" href="{{url('/user/edit/${user.id}')}}">Update</a></td>
                        <td>
                        <form action="${deleteRoute}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    </tr>`;
                        tbody.innerHTML += row;
                    });

                    // Generate pagination links
                    if (data.links) {
                        data.links.forEach(link => {
                            let pageLink = document.createElement('button');
                            pageLink.innerHTML = link.label;
                            pageLink.className = `btn ${link.active ? 'btn-primary' : 'btn-light'} mx-1`;
                            pageLink.onclick = () => fetchUsers(search, link.url.split('page=')[1]);
                            pageLink.disabled = link.active;
                            paginationLinks.appendChild(pageLink);
                        });
                    }

                });
        }

        function viewUser(userId) {
            fetch(`/api/users/${userId}`)
                .then(response => response.json())
                .then(data => {
                    let user = data.data;
                    let modalBody = document.getElementById('modalBody');
                    modalBody.innerHTML = `
                    <p><strong>Name:</strong> ${user.first_name} ${user.last_name}</p>
                    <p><strong>Email:</strong> ${user.email}</p>
                    <p><strong>Date of Birth</strong> ${user.dob}</p>
                    <p><strong>Phone Number:</strong> ${user.phone_number}</p>
                    <p><strong>Whatsapp Number:</strong> ${user.whatsapp}</p>
                    <p><strong>Registration Number:</strong> ${user.reg_no}</p>
                    <p><strong>NIC:</strong> ${user.nic}</p>
                    <p><strong>Address Line 01:</strong> ${user.address_l1}</p>
                    <p><strong>Address Line 02:</strong> ${user.address_l2}</p>
                    <p><strong>City:</strong> ${user.city}</p>
                    <p><strong>Province:</strong> ${user.province}</p>
                    <p><strong>Postal Code:</strong> ${user.postal_code}</p>
                    <p><strong>Start Date:</strong> ${user.start_date}</p>
                    <p><strong>Gender:</strong> ${user.gender}</p>
                    <p><strong>Married:</strong> ${user.married}</p>
                    <p><strong>Role:</strong> ${user.role}</p>
                    <p><strong>Experience:</strong> ${user.experience}</p>
                `;
                    var userModal = new bootstrap.Modal(document.getElementById('userModal'));
                    userModal.show();
                });
        }

        fetchUsers();

        // document.getElementById('search').addEventListener('keyup', function() {
        //     fetchUsers(this.value);
        // });
    </script>

@endsection
