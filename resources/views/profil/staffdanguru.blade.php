<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>MTs Abadiyah - Staff dan Guru</title>
</head>
<body class="font-inter bg-gray-50">

    @include('partials.header')

    <section class="bg-sky-100 mx-4 md:mx-20 my-6 p-4 rounded-lg shadow-sm">
        <div class="flex items-center text-sm text-slate-500 space-x-1">
            <a href="/" class="hover:text-emerald-600 font-medium transition-colors duration-200">Home</a>
            <span>&gt;</span>
            <span class="text-emerald-700 font-semibold">Staff dan Guru</span>
        </div>
    </section>

    <section class="mx-4 md:mx-20 mb-10">
        <h2 class="mb-6 text-4xl font-extrabold text-gray-800 text-center md:text-left">Daftar Staff dan Guru</h2>

        <div class="mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="w-full md:w-auto">
                <label for="positionFilter" class="block text-gray-700 text-sm font-bold mb-2">Filter Berdasarkan Jabatan:</label>
                <div class="relative">
                    <select id="positionFilter" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-emerald-500 shadow-sm">
                        <option value="all">Semua Jabatan</option>
                        </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div id="staffCardsContainer" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            </div>

        <div id="paginationContainer" class="flex justify-center items-center space-x-2 mt-10">
            <button id="prevPage" class="px-4 py-2 bg-emerald-600 text-white rounded-lg shadow-md hover:bg-emerald-700 transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed">Previous</button>
            <div id="pageNumbers" class="flex space-x-1">
                </div>
            <button id="nextPage" class="px-4 py-2 bg-emerald-600 text-white rounded-lg shadow-md hover:bg-emerald-700 transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed">Next</button>
        </div>
    </section>

    @include('partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Staff Data ---
            const staffData = [
                { name: "Ahmad Syafii", gender: "Laki-laki", position: "Guru Bahasa Arab", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Ahmad" },
                { name: "Siti Aminah", gender: "Perempuan", position: "Wakil Kepala Sekolah", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Siti" },
                { name: "Fadli Rahman", gender: "Laki-laki", position: "Guru Matematika", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Fadli" },
                { name: "Nur Aini", gender: "Perempuan", position: "Staff Administrasi", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Nur" },
                { name: "Budi Santoso", gender: "Laki-laki", position: "Guru IPA", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Budi" },
                { name: "Dewi Lestari", gender: "Perempuan", position: "Guru IPS", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Dewi" },
                { name: "Cahyo Nugroho", gender: "Laki-laki", position: "Guru Penjaskes", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Cahyo" },
                { name: "Rina Wati", gender: "Perempuan", position: "Guru Bahasa Indonesia", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Rina" },
                { name: "Joko Susilo", gender: "Laki-laki", position: "Guru Agama", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Joko" },
                { name: "Lina Marlina", gender: "Perempuan", position: "Guru Seni Budaya", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Lina" },
                { name: "Eko Prasetyo", gender: "Laki-laki", position: "Guru TIK", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Eko" },
                { name: "Fitriani", gender: "Perempuan", position: "Guru PKN", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Fitri" },
                { name: "Gatot Subroto", gender: "Laki-laki", position: "Kepala Sekolah", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Gatot" },
                { name: "Hana Lestari", gender: "Perempuan", position: "Guru BK", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Hana" },
                { name: "Irfan Hakim", gender: "Laki-laki", position: "Guru Sejarah", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Irfan" },
                { name: "Kartika Sari", gender: "Perempuan", position: "Staff Perpustakaan", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Kartika" },
                { name: "M. Ramadhan", gender: "Laki-laki", position: "Guru Bahasa Inggris", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Ramadhan" },
                { name: "Nia Kurnia", gender: "Perempuan", position: "Guru Fisika", image: "https://placehold.co/160x160/E0F2F1/004D40?text=Nia" },
            ];

            const itemsPerPage = 8;
            let currentPage = 1;
            let currentFilter = 'all';

            const staffCardsContainer = document.getElementById('staffCardsContainer');
            const paginationContainer = document.getElementById('paginationContainer');
            const prevPageBtn = document.getElementById('prevPage');
            const nextPageBtn = document.getElementById('nextPage');
            const pageNumbersDiv = document.getElementById('pageNumbers');
            const positionFilterSelect = document.getElementById('positionFilter');

            // --- Populate Filter Options ---
            function populateFilterOptions() {
                const uniquePositions = [...new Set(staffData.map(staff => staff.position))].sort();
                uniquePositions.forEach(position => {
                    const option = document.createElement('option');
                    option.value = position;
                    option.textContent = position;
                    positionFilterSelect.appendChild(option);
                });
            }

            // --- Function to Display Staff Cards ---
            function displayStaff(page, filter) {
                const filteredStaff = staffData.filter(staff => {
                    return filter === 'all' || staff.position === filter;
                });

                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const staffToDisplay = filteredStaff.slice(startIndex, endIndex);

                staffCardsContainer.innerHTML = '';

                if (staffToDisplay.length === 0) {
                    staffCardsContainer.innerHTML = '<p class="col-span-full text-center text-gray-600 text-lg py-10">Tidak ada data staff atau guru yang ditemukan untuk filter ini.</p>';
                } else {
                    staffToDisplay.forEach(staff => {
                        const cardHtml = `
                            <div class="flex bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition-transform duration-200 ease-in-out">
                                <img src="${staff.image}" alt="Foto ${staff.name}" class="w-40 h-40 object-cover flex-shrink-0">
                                <div class="p-4 flex flex-col justify-center">
                                    <h3 class="text-xl font-bold text-gray-800 mb-1">${staff.name}</h3>
                                    <p class="text-sm text-gray-700 leading-tight">
                                        <span class="font-semibold text-emerald-700">Jabatan:</span> ${staff.position}<br>
                                        <span class="font-semibold text-emerald-700">Jenis Kelamin:</span> ${staff.gender}
                                    </p>
                                </div>
                            </div>
                        `;
                        staffCardsContainer.innerHTML += cardHtml;
                    });
                }
                setupPagination(filteredStaff);
            }

            // --- Function to Setup Pagination Controls ---
            function setupPagination(filteredData) {
                const totalPages = Math.ceil(filteredData.length / itemsPerPage);
                pageNumbersDiv.innerHTML = '';

                for (let i = 1; i <= totalPages; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.textContent = i;
                    pageButton.classList.add('px-3', 'py-1', 'rounded-lg', 'font-semibold', 'transition-colors', 'duration-200');
                    if (i === currentPage) {
                        pageButton.classList.add('bg-emerald-700', 'text-white');
                    } else {
                        pageButton.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
                    }
                    pageButton.addEventListener('click', () => {
                        currentPage = i;
                        displayStaff(currentPage, currentFilter);
                    });
                    pageNumbersDiv.appendChild(pageButton);
                }

                prevPageBtn.disabled = currentPage === 1;
                nextPageBtn.disabled = currentPage === totalPages || totalPages === 0;
            }

            // --- Event Listeners ---
            prevPageBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    displayStaff(currentPage, currentFilter);
                }
            });

            nextPageBtn.addEventListener('click', () => {
                const filteredStaff = staffData.filter(staff => {
                    return currentFilter === 'all' || staff.position === currentFilter;
                });
                const totalPages = Math.ceil(filteredStaff.length / itemsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    displayStaff(currentPage, currentFilter);
                }
            });

            positionFilterSelect.addEventListener('change', (event) => {
                currentFilter = event.target.value;
                currentPage = 1;
                displayStaff(currentPage, currentFilter);
            });

            // --- Initial Load ---
            populateFilterOptions();
            displayStaff(currentPage, currentFilter);
        });
    </script>
</body>
</html>