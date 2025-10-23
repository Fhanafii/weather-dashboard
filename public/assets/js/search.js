// public/assets/js/search.js

/**
 * 🔍 Search functionality for location search
 * Handles search input and updates the page with new location data
 */

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[placeholder="Cari Lokasi"]');
    const searchIcon = document.querySelector('.relative img[alt="Search Icon"]');

    if (!searchInput || !searchIcon) {
        console.error('Search elements not found');
        return;
    }

    // Function to perform search
    function performSearch() {
        const query = searchInput.value.trim();
        if (query) {
            // Redirect to the same page with city parameter
            window.location.href = `?city=${encodeURIComponent(query)}`;
        }
    }

    // Handle Enter key press
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });

    // Handle search icon click
    searchIcon.addEventListener('click', function() {
        performSearch();
    });

    // Optional: Add autocomplete suggestions (basic implementation)
    let suggestionsContainer = null;

    searchInput.addEventListener('input', function() {
        const query = this.value.trim();

        // Remove existing suggestions
        if (suggestionsContainer) {
            suggestionsContainer.remove();
            suggestionsContainer = null;
        }

        if (query.length < 2) return;

        // Create suggestions container
        suggestionsContainer = document.createElement('div');
        suggestionsContainer.className = 'absolute top-full left-0 right-0 bg-white border border-gray-200 rounded-b-lg shadow-lg z-50 max-h-48 overflow-y-auto';

        // Common cities for suggestions (you can expand this)
        const commonCities = [
            // Java
            'Jakarta', 'Bandung', 'Bekasi', 'Depok', 'Bogor', 'Tangerang', 'South Tangerang',
            'Semarang', 'Surabaya', 'Malang', 'Yogyakarta', 'Solo', 'Cirebon', 'Purwokerto',

            // Sumatra
            'Medan', 'Padang', 'Pekanbaru', 'Palembang', 'Jambi', 'Bengkulu',
            'Bandar Lampung', 'Lhokseumawe', 'Tanjung Pinang', 'Batam',

            // Kalimantan
            'Pontianak', 'Banjarmasin', 'Samarinda', 'Balikpapan', 'Palangkaraya',

            // Sulawesi
            'Makassar', 'Manado', 'Palu', 'Kendari', 'Gorontalo', 'Parepare',

            // Bali & Nusa Tenggara
            'Denpasar', 'Mataram', 'Kupang',

            // Papua & Maluku
            'Jayapura', 'Ambon', 'Ternate', 'Sorong', 'Manokwari',

            // Other notable/regional cities
            'Cilegon', 'Tasikmalaya', 'Sukabumi', 'Probolinggo', 'Jember',
            'Kediri', 'Blitar', 'Salatiga', 'Magelang', 'Banyuwangi',
            'Palopo', 'Bitung', 'Tarakan', 'Tebing Tinggi', 'Pematangsiantar'
        ];


        const filteredCities = commonCities.filter(city =>
            city.toLowerCase().includes(query.toLowerCase())
        );

        if (filteredCities.length > 0) {
            filteredCities.forEach(city => {
                const suggestion = document.createElement('div');
                suggestion.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer text-black text-left';
                suggestion.textContent = city;
                suggestion.addEventListener('click', function() {
                    searchInput.value = city;
                    suggestionsContainer.remove();
                    suggestionsContainer = null;
                    performSearch();
                });
                suggestionsContainer.appendChild(suggestion);
            });

            // Insert suggestions after the search input container
            const searchContainer = searchInput.closest('.relative');
            searchContainer.appendChild(suggestionsContainer);
        }
    });

    // Close suggestions when clicking outside
    document.addEventListener('click', function(e) {
        if (suggestionsContainer && !searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
            suggestionsContainer.remove();
            suggestionsContainer = null;
        }
    });
});
