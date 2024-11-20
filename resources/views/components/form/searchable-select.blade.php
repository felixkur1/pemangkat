<div class="relative" id="searchable-select-{{ $id }}">
    <!-- Search Input -->
    <input type="text" placeholder="Cari pegawai..." class="block w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-opacity-50"
           onfocus="openDropdown_{{ $id }}()" oninput="filterEmployees_{{ $id }}(event)" id="employee-search-{{ $id }}" />

    <!-- Dropdown Options -->
    <ul id="employee-list-{{ $id }}" class="absolute top-full left-0 w-full mt-1 bg-white border border-gray-300 rounded-lg hidden max-h-48 overflow-y-auto z-10">
        @foreach ($employees as $employee)
            <li class="p-2 hover:bg-blue-100 cursor-pointer" onclick="selectEmployee_{{ $id }}('{{ $employee->id }}', '{{ $employee->full_name }}')">
                {{ $employee->full_name }}
            </li>
        @endforeach
    </ul>

    <!-- Hidden Input for Selected Employee ID -->
    <input type="hidden" name="{{ $name }}" id="selected-employee-id-{{ $id }}">
</div>

<script>
    function filterEmployees_{{ $id }}(event) {
        const search = event.target.value.toLowerCase();
        const items = document.querySelectorAll('#employee-list-{{ $id }} li');
        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(search) ? '' : 'none';
        });
    }

    function openDropdown_{{ $id }}() {
        const dropdown = document.getElementById('employee-list-{{ $id }}');
        dropdown.classList.remove('hidden');
    }

    function selectEmployee_{{ $id }}(id, name) {
        document.getElementById('selected-employee-id-{{ $id }}').value = id;
        document.getElementById('employee-search-{{ $id }}').value = name;
        closeDropdown_{{ $id }}();
    }

    function closeDropdown_{{ $id }}() {
        const dropdown = document.getElementById('employee-list-{{ $id }}');
        dropdown.classList.add('hidden');
    }

    // Event listener to close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const container = document.getElementById('searchable-select-{{ $id }}');
        
        if (!container.contains(event.target)) {
            closeDropdown_{{ $id }}();
        }
    });
</script>
