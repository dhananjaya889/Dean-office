@extends('layouts.admin')

@section('title', 'View Quarters Items Check List')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">Add Check List Items</div>
                <div class="card-body">
                    <form method="GET" action="" class="mb-3">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label class="form-label">Items Name</label>
                                <select name="" id="checklist_item" class="form-control">

                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Items Quantity</label>
                                <input type="text" name="" id="qun" class="form-control" value="">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-primary" onclick="addList()">Add check list</button>
                            </div>
                            <div class="col-md-2 d-flex align-items-end"></div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#item">Add Items</button>

                                <!-- The Modal -->
                                <div class="modal" id="item">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add New Item</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <input type="text" name="item_name" class="form-control"
                                                        id="item_name" placeholder="Enter the New Checklist Item" required>
                                                </div>
                                                <button type="button" class="btn btn-primary w-100"
                                                    onclick="addItems()">Save</button>

                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">Quarters Check List Items</div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item</th>
                                    <th>Amount</th>
                                    <th>Working</th>
                                    <th>Damage</th>
                                    <th>REmark</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="list_t_body">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">Other Damage or Failure Note by Here</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-9"></div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success" id="note-modal-btn" data-bs-toggle="modal"
                                data-bs-target="#note">Add Notes</button>

                            <!-- The Modal -->
                            <div class="modal" id="note">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Other Damage or Failure Note by Here</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <textarea name="note" class="form-control" id="note-textarea" required></textarea>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" onclick="addNote()">Save</button>
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <p id="note_tag"></p>
                    </div>

                    <!-- The Modal for edit checklist items-->
                    <div class="modal fade" id="checklistItem" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                    
                                <!-- Modal Header -->
                                <div class="modal-header bg-primary text-white">
                                    <h4 class="modal-title" id="modalTitle">Edit Item Details</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                    
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <form id="modalForm">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Item Name</label>
                                            <input type="text" class="form-control" id="modal-item-name">
                                        </div>
                    
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label fw-bold">Available Quantity</label>
                                                <input type="number" class="form-control" id="modal-available-qty">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-bold">Working Quantity</label>
                                                <input type="number" class="form-control" id="modal-working-qty">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-bold">Damaged Quantity</label>
                                                <input type="number" class="form-control" id="modal-damage-qty">
                                            </div>
                                        </div>
                    
                                        <div class="mt-3">
                                            <label class="form-label fw-bold">Remark</label>
                                            <textarea class="form-control" id="modal-remark" rows="3"></textarea>
                                        </div>
                                    </form>
                                </div>
                    
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success" onclick="updateItem()">Update</button>
                                    <button type="button" class="btn btn-danger" onclick="deleteItem()">Delete</button>
                                </div>
                    
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const user_id = '{{ $user_id }}';
        const quartz_id = '{{ $qua_id }}';

        async function getItems() {
            try {
                const response = await fetch("{{ route('check_list.get-items') }}", {
                    method: "GET",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    }
                });

                const result = await response.json();

                if (response.ok) {

                    const selectElement = document.getElementById("checklist_item");
                    selectElement.innerHTML = '<option value="">Select an item</option>';


                    const items = Array.isArray(result) ? result : [result];

                    items.forEach(item => {
                        let option = document.createElement("option");
                        option.value = item.id;
                        option.textContent = item.item_name;
                        selectElement.appendChild(option);
                    });
                } else {
                    Swal.fire("Error", "Something went wrong while fetching items!", "error");

                }

            } catch (error) {
                Swal.fire("Error", error.message, "error");

            }
        }

        async function addItems() {

            const itemName = document.getElementById('item_name').value;

            const formData = new FormData();
            formData.append('item_name', itemName);

            try {
                const response = await fetch("{{ route('check_list.store-item') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}", // Laravel CSRF token
                        "Accept": "application/json"
                    },
                    body: formData
                });

                const result = await response.json();
                console.log(result);

                if (response.ok) {
                    Swal.fire("Success", "Item added successfully!", "success");
                    getItems();
                } else {
                    Swal.fire("Error", "Failed to add item!", "error");

                }
            } catch (error) {
                Swal.fire("Error", error.message, "error");

            }

        }

        async function addList() {

            const item_id = document.getElementById("checklist_item").value;
            const qun = document.getElementById("qun").value;



            const formData = {
                item_id: item_id,
                user_id: user_id,
                quartz_id: quartz_id,
                qun: qun
            };

            try {
                const response = await fetch("{{ route('check_list.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();
                

                if (response.ok) {
                    Swal.fire("Success", "Item added to checklist!", "success");
                    getList();
                } else {
                    Swal.fire("Error", "Failed to add item!", "error");

                }
            } catch (error) {
                Swal.fire("Error", error.message, "error");

            }

        }

        async function getList() {
            try {
                const response = await fetch("{{ route('check_list.list', ['USER_ID', 'QUARTZ_ID']) }}"
                    .replace('USER_ID', user_id)
                    .replace('QUARTZ_ID', quartz_id), {
                        method: "GET",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        }
                    });

                const result = await response.json();
                console.log(result);

                var listbody = document.getElementById('')

                if (response.ok) {
                    const lists = result.list;
                    const notes = result.note
                    const listBody = document.getElementById('list_t_body');
                    listBody.innerHTML = "";

                    lists.forEach((list, index) => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${list.item_name || '-'}</td>
                            <td>${list.available_qty || '-'}</td>
                            <td>${list.working_qty !== null ? list.working_qty : '-'}</td>
                            <td>${list.damage_qty !== null ? list.damage_qty : '-'}</td>
                            <td>${list.remark || '-'}</td>
                            <td>
                                <button type="button" class="btn btn-info text-white view-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#checklistItem"
                                    data-id="${list.id}"
                                    data-itemid="${list.item}"
                                    data-item="${list.item_name}"
                                    data-available="${list.available_qty}"
                                    data-working="${list.working_qty}"
                                    data-damage="${list.damage_qty}"
                                    data-remark="${list.remark}">
                                    View & Edit
                                </button>
                            </td>
                        `;
                        listBody.appendChild(row);
                    });

                    
                    if (notes) {
                        document.getElementById('note_tag').innerHTML = notes.note;
                        document.getElementById('note-modal-btn').innerText = "Edit Note";
                        document.getElementById('note-textarea').value = notes.note;

                    }

                    // Attach event listeners to view buttons
                    document.querySelectorAll('.view-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            document.getElementById('modal-item-name').value = this.getAttribute('data-item') || '';
                            document.getElementById('modal-available-qty').value = this.getAttribute('data-available') || '0';
                            document.getElementById('modal-working-qty').value = this.getAttribute('data-working') || '0';
                            document.getElementById('modal-damage-qty').value = this.getAttribute('data-damage') || '0';
                            document.getElementById('modal-remark').value = this.getAttribute('data-remark') || '';
                            document.getElementById('modalForm').setAttribute('data-id', this.getAttribute('data-id'));
                        });
                    });


                } else {
                    Swal.fire("Error", "Failed to fetch checklist!", "error");

                }

            } catch (error) {
                Swal.fire("Error", error.message, "error");
                console.log(error);
                

            }
        }

        async function addNote() {

            const note = document.getElementById("note-textarea").value;

            const formData = {
                note: note,
                user_id: user_id,
                quartz_id: quartz_id
            };

            try {
                const response = await fetch("{{ route('check_list.store-note') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();
                

                if (response.ok) {
                    Swal.fire("Success", "Note updated successfully!", "success");
                    getList();
                } else {
                    Swal.fire("Error", "Failed to update Note!", "error");

                }
            } catch (error) {
                Swal.fire("Error", error.message, "error");

            }

        }


        async function updateItem() {
            const id = document.getElementById('modalForm').getAttribute('data-id');
            const itemId = document.getElementById('modalForm').getAttribute('data-itemid');
            const updatedData = {
                available_qty: document.getElementById('modal-available-qty').value,
                working_qty: document.getElementById('modal-working-qty').value,
                damage_qty: document.getElementById('modal-damage-qty').value,
                remark: document.getElementById('modal-remark').value
            };

            try {
                const response = await fetch(`{{ route('check_list.update-list', ['ITEM_ID']) }}`.replace('ITEM_ID', id), {
                    method: "PUT",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify(updatedData)
                });

                const result = await response.json();
               

                if (response.ok) {
                    Swal.fire("Success", "Item updated successfully!", "success");
                    getList();
                } else {
                    Swal.fire("Error", "Failed to Update the Item!", "error");

                }
            } catch (error) {
                Swal.fire("Error", error.message, "error");

            }
        }


        async function deleteItem() {
            const id = document.getElementById('modalForm').getAttribute('data-id');
            

            try {
                const response = await fetch(`{{ route('check_list.delete-item', ['ITEM_ID']) }}`.replace('ITEM_ID', id), {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    }
                });

                const result = await response.json();
               

                if (response.ok) {
                    Swal.fire("Success", "Item deleted successfully!", "success");
                    getList();
                } else {
                    Swal.fire("Error", "Failed to delete the Item!", "error");

                }
            } catch (error) {
                Swal.fire("Error", error.message, "error");

            }
        }




        document.addEventListener("DOMContentLoaded", function() {
            getItems(); // Fetch and populate select options
            getList(); // Fetch and display the checklist
        });
    </script>
@endsection
