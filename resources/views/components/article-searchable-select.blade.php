<div class="relative" id="searchable-select-{{ $id }}">
    <!-- Search Input -->
    <input type="text" placeholder="Cari artikel..." class="block w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-opacity-50"
           onfocus="openDropdownArticle_{{ $id }}()" oninput="filterarticles_{{ $id }}(event)" id="article-search-{{ $id }}" />

    <!-- Dropdown Options -->
    <ul id="article-list-{{ $id }}" class="absolute top-full left-0 w-full mt-1 bg-white border border-gray-300 rounded-lg hidden max-h-48 overflow-y-auto z-10">
        @foreach ($articles as $article)
            <li class="p-2 hover:bg-blue-100 cursor-pointer" onclick="selectarticle_{{ $id }}('{{ $article->id }}', '{{ $article->title }}')">
                {{ $article->title }}
            </li>
        @endforeach
    </ul>

    <!-- Hidden Input for Selected article ID -->
    <input type="hidden" name="{{ $name }}" id="selected-article-id-{{ $id }}">
</div>

<script>
    function filterarticles_{{ $id }}(event) {
        const search = event.target.value.toLowerCase();
        const items = document.querySelectorAll('#article-list-{{ $id }} li');
        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(search) ? '' : 'none';
        });
    }

    function openDropdownArticle_{{ $id }}() {
        const dropdown = document.getElementById('article-list-{{ $id }}');
        dropdown.classList.remove('hidden');
    }

    function selectarticle_{{ $id }}(id, name) {
        document.getElementById('selected-article-id-{{ $id }}').value = id;
        document.getElementById('article-search-{{ $id }}').value = name;
        closeDropdown_{{ $id }}();
    }

    function closeDropdown_{{ $id }}() {
        const dropdown = document.getElementById('article-list-{{ $id }}');
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
