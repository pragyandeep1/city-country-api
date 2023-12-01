@extends('layouts/app')
@section('title', 'Companies')
@section('content')
<h1>Cities and Countries Table</h1>
<div class="card shadow mb-4 col-lg-12">
    <div>
    <h3>Cities</h3>
    <ul id="cities-list" class="sortable-list">
        <li draggable="true">City 1</li>
        <li draggable="true">City 2</li>
        <!-- Add more city items -->
    </ul>
</div>

<div>
    <h3>Countries</h3>
    <ul id="countries-list" class="sortable-list">
        <li draggable="true">Country A</li>
        <li draggable="true">Country B</li>
        <!-- Add more country items -->
    </ul>
</div>

<div>
    <h3>Group</h3>
    <ul id="group-list" class="sortable-list">
        <!-- Drag-and-drop cities/countries here to form the group -->
    </ul>
</div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const citiesList = document.getElementById('cities-list');
        const countriesList = document.getElementById('countries-list');
        const groupList = document.getElementById('group-list');

        new Sortable(citiesList, {
            group: 'shared',
            animation: 150
        });

        new Sortable(countriesList, {
            group: 'shared',
            animation: 150
        });

        new Sortable(groupList, {
            group: 'shared',
            animation: 150,
            onAdd: function(event) {
                // Logic to handle adding items to the group list
                console.log('Item added to the group:', event.item.textContent);
            },
            onRemove: function(event) {
                // Logic to handle removing items from the group list
                console.log('Item removed from the group:', event.item.textContent);
            }
        });
    });
</script>

@endsection
