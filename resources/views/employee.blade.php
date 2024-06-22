@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>

<head>
    <title>Employee Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .form-section {
            padding: 20px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-section h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .form-section .btn {
            font-size: 1rem;
        }
        .table th {
            background-color: #007bff;
            color: #fff;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-5">Employee Management</h1>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="form-section">
                    <h2>Create Employee</h2>
                    <form id="createEmployeeForm">
                        <div class="form-group">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="address" name="address" class="form-control" placeholder="Address" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="position" name="position" class="form-control" placeholder="Position" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Create</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="form-section">
                    <h2>Update Employee</h2>
                    <form id="updateEmployeeForm">
                        <input type="hidden" id="update_id" name="id">
                        <div class="form-group">
                            <input type="text" id="update_name" name="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="update_email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="update_phone" name="phone" class="form-control" placeholder="Phone" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="update_address" name="address" class="form-control" placeholder="Address" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="update_position" name="position" class="form-control" placeholder="Position" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </form>
                </div>
            </div>
        </div>

        <h2 class="mt-5">Employee List</h2>
        <table class="table table-hover">
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
                        Swal.fire('Error', 'Failed to fetch employee data', 'error');
                        console.log(error);
                    });
            }

            $('#createEmployeeForm').submit(function (event) {
                event.preventDefault();
                let formData = $(this).serialize();
                axios.post('/api/employee', formData)
                    .then(response => {
                        Swal.fire('Success', response.data.message, 'success');
                        fetchemployee();
                        $('#createEmployeeForm')[0].reset();
                    })
                    .catch(error => {
                        Swal.fire('Error', 'Failed to create employee', 'error');
                        console.log(error);
                    });
            });

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
                        Swal.fire('Error', 'Failed to fetch employee data', 'error');
                        console.log(error);
                    });
            };

            $('#updateEmployeeForm').submit(function (event) {
                event.preventDefault();
                let id = $('#update_id').val();
                let formData = $(this).serialize();
                axios.put(`/api/employee/${id}`, formData)
                    .then(response => {
                        Swal.fire('Success', response.data.message, 'success');
                        fetchemployee();
                        $('#updateEmployeeForm')[0].reset();
                    })
                    .catch(error => {
                        Swal.fire('Error', 'Failed to update employee', 'error');
                        console.log(error);
                    });
            });

            window.deleteEmployee = function (id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/api/employee/${id}`)
                            .then(response => {
                                Swal.fire('Deleted!', response.data.message, 'success');
                                fetchemployee();
                            })
                            .catch(error => {
                                Swal.fire('Error', 'Failed to delete employee', 'error');
                                console.log(error);
                            });
                    }
                });
            };
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
