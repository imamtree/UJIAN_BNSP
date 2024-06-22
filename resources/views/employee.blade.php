@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>

<head>
    <title>Employee Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        /* Custom CSS for table */
        table.table {
            background-color: #f8f9fa; /* Light background */
            color: #343a40; /* Dark text color */
        }
        table.table th {
            background-color: #343a40; /* Dark header background */
            color: #fff; /* White text color for header */
        }
        table.table td {
            background-color: #fff; /* White cell background */
            color: #343a40; /* Dark text color for cells */
        }
        table.table tr:nth-child(even) td {
            background-color: #e9ecef; /* Light grey background for even rows */
        }
        .form-section {
            border: 1px solid #e9ecef;
            padding: 20px;
            border-radius: 5px;
            background-color: #fff;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>Employee Management</h1>
        <div class="row">
            <div class="col-md-6">
                <h2>Create Employee</h2>
                <div class="form-section">
                    <form id="createEmployeeForm">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" id="position" name="position" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Create</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <h2>Update Employee</h2>
                <div class="form-section">
                    <form id="updateEmployeeForm">
                        <input type="hidden" id="update_id" name="id">
                        <div class="form-group">
                            <label for="update_name">Name</label>
                            <input type="text" id="update_name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="update_email">Email</label>
                            <input type="email" id="update_email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="update_phone">Phone</label>
                            <input type="text" id="update_phone" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="update_address">Address</label>
                            <input type="text" id="update_address" name="address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="update_position">Position</label>
                            <input type="text" id="update_position" name="position" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </form>
                </div>
            </div>
        </div>

        <h2 class="mt-5">Employee List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Position</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="employeeTableBody">
                <!-- Data employee akan diisi di sini oleh JavaScript -->
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            fetchemployee();

            // Ambil semua employee
            function fetchemployee() {
                axios.get('/api/employee')
                    .then(response => {
                        let employees = response.data;
                        let employeeTableBody = $('#employeeTableBody');
                        employeeTableBody.empty();
                        employees.forEach((employee, index) => {
                            employeeTableBody.append(`
                                <tr>
                                    <td><a href="#" class="employee-detail" data-id="${employee.id}">${employee.id}</a></td>
                                    <td>${index + 1}</td>
                                    <td>${employee.name}</td>
                                    <td>${employee.email}</td>
                                    <td>${employee.phone}</td>
                                    <td>${employee.address}</td>
                                    <td>${employee.position}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="editEmployee(${employee.id})">Edit</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteEmployee(${employee.id})">Delete</button>
                                    </td>
                                </tr>
                            `);
                        });
                    })
                    .catch(error => {
                        toastr.error('Failed to fetch employee data');
                        console.log(error);
                    });
            }

            // Buat employee baru
            $('#createEmployeeForm').submit(function (event) {
                event.preventDefault();
                let formData = $(this).serialize();
                axios.post('/api/employee', formData)
                    .then(response => {
                        toastr.success(response.data.message);
                        fetchemployee();
                        $('#createEmployeeForm')[0].reset();
                    })
                    .catch(error => {
                        toastr.error('Failed to create employee');
                        console.log(error);
                    });
            });

            // Edit employee
            window.editEmployee = function (id) {
                axios.get(`/api/employee/${id}`)
                    .then(response => {
                        let employee = response.data;
                        $('#update_id').val(employee.id);
                        $('#update_name').val(employee.name);
                        $('#update_email').val(employee.email);
                        $('#update_phone').val(employee.phone);
                        $('#update_address').val(employee.address);
                        $('#update_position').val(employee.position);
                    })
                    .catch(error => {
                        toastr.error('Failed to fetch employee data');
                        console.log(error);
                    });
            };

            // Perbarui employee
            $('#updateEmployeeForm').submit(function (event) {
                event.preventDefault();
                let id = $('#update_id').val();
                let formData = $(this).serialize();
                axios.put(`/api/employee/${id}`, formData)
                    .then(response => {
                        toastr.success(response.data.message);
                        fetchemployee();
                        $('#updateEmployeeForm')[0].reset();
                    })
                    .catch(error => {
                        toastr.error('Failed to update employee');
                        console.log(error);
                    });
            });

            // Hapus employee
            window.deleteEmployee = function (id) {
                if (confirm('Apakah Anda yakin ingin menghapus employee ini?')) {
                    axios.delete(`/api/employee/${id}`)
                        .then(response => {
                            toastr.success(response.data.message);
                            fetchemployee();
                        })
                        .catch(error => {
                            toastr.error('Failed to delete employee');
                            console.log(error);
                        });
                }
            };

            // Handle click to view employee detail
            $(document).on('click', '.employee-detail', function (e) {
                e.preventDefault();
                var employeeId = $(this).data('id');
                window.location.href = '/api/employee/' + employeeId;
            });
        });
    </script>
</body>

</html>
@endsection
