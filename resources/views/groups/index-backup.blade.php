@extends('layouts/app')
@section('title', 'Companies')
@section('content')
<h1>Cities and Countries Table</h1>
<div class="card shadow mb-4 col-lg-12">
    <table id="data-table">
        <thead>
            <tr>
                <th onclick="sortTable(0)">City</th>
                <th onclick="sortTable(1)">Country</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <!-- Data will be populated here -->
        </tbody>
    </table>
</div>
<script>
    let currentColumn = -1; // Variable to track the currently sorted column
    let sortDirection = 1; // 1 for ascending, -1 for descending

    function sortTable(columnIndex) {
        const table = document.getElementById('data-table');
        const rows = Array.from(table.getElementsByTagName('tr'));

        // Remove the table header row from sorting
        const header = rows.shift();

        // Toggle sort direction if the same column is clicked again
        if (currentColumn === columnIndex) {
            sortDirection *= -1;
        } else {
            sortDirection = 1;
        }

        rows.sort((a, b) => {
            const rowDataA = a.getElementsByTagName('td')[columnIndex].textContent.toLowerCase().trim();
            const rowDataB = b.getElementsByTagName('td')[columnIndex].textContent.toLowerCase().trim();

            return sortDirection * rowDataA.localeCompare(rowDataB);
        });

        // Rearrange the table rows based on sorting
        rows.unshift(header); // Add the header row back
        table.tBodies[0].innerHTML = ''; // Clear existing table body

        rows.forEach(row => table.tBodies[0].appendChild(row));

        currentColumn = columnIndex;
    }
</script>
@endsection
