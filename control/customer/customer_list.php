<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>
    <link rel="stylesheet" href="customer.css"> <!-- Optional -->
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h2>Customer List</h2>
    <table id="customerTable">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Registered</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        async function loadCustomers() {
            try {
                const response = await fetch('../../api/get_customers.php');
                const result = await response.json();

                if (result.status === 'success') {
                    const tbody = document.querySelector('#customerTable tbody');
                    tbody.innerHTML = ''; // Clear previous rows

                    result.data.forEach(customer => {
                        const row = `
                            <tr>
                                <td>${customer.id}</td>
                                <td>${customer.name}</td>
                                <td>${customer.email}</td>
                                <td>${customer.phone}</td>
                                <td>${customer.created_at}</td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });
                } else {
                    alert('Failed to load data: ' + result.message);
                }
            } catch (error) {
                alert('Error fetching data.');
            }
        }

        window.onload = loadCustomers;
    </script>
</body>
</html>
