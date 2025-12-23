<!-- Water Intake Calculator Component -->
<div class="bg-gradient-to-br from-cyan-50 to-blue-50 dark:from-slate-700 dark:to-slate-800 rounded-xl shadow-lg p-6 mb-8">
    <div class="flex items-center mb-4">
        <div class="w-12 h-12 bg-cyan-500 rounded-full flex items-center justify-center mr-4">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
            </svg>
        </div>
        <div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Kalkulator Kebutuhan Air</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Hitung kebutuhan air minum harian Anda</p>
        </div>
    </div>

    <div class="space-y-4">
        <!-- Weight Input -->
        <div>
            <label for="water_weight" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Berat Badan (kg)</label>
            <input type="number" id="water_weight" min="20" max="300" value="60" 
                   class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-cyan-500 dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Activity Level -->
        <div>
            <label for="water_activity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tingkat Aktivitas</label>
            <select id="water_activity" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-cyan-500 dark:bg-slate-700 dark:text-white">
                <option value="0">Ringan (tidak olahraga)</option>
                <option value="0.5">Sedang (olahraga 30 menit)</option>
                <option value="1">Berat (olahraga 60+ menit)</option>
            </select>
        </div>

        <!-- Calculate Button -->
        <button onclick="calculateWater()" 
                class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-semibold py-3 rounded-lg transition duration-200">
            Hitung Kebutuhan Air
        </button>

        <!-- Result Display -->
        <div id="water_result" class="hidden mt-4 p-4 bg-cyan-100 dark:bg-cyan-900/30 rounded-lg">
            <div class="text-center mb-3">
                <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Kebutuhan Air Harian</div>
                <div class="text-4xl font-bold text-cyan-700 dark:text-cyan-300 mb-2" id="water_liters"></div>
                <div class="text-lg text-gray-700 dark:text-gray-300" id="water_glasses"></div>
            </div>
            <div class="mt-4 text-sm text-gray-700 dark:text-gray-300 space-y-2">
                <p class="flex items-start">
                    <svg class="w-5 h-5 text-cyan-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Minum air secara bertahap sepanjang hari
                </p>
                <p class="flex items-start">
                    <svg class="w-5 h-5 text-cyan-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Tingkatkan asupan saat cuaca panas atau berolahraga
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function calculateWater() {
    const weight = parseFloat(document.getElementById('water_weight').value);
    const activityBonus = parseFloat(document.getElementById('water_activity').value);
    
    if (!weight || weight <= 0) {
        alert('Mohon isi berat badan yang valid');
        return;
    }
    
    // Basic calculation: 30-35 ml per kg body weight
    const baseWater = weight * 0.033; // 33 ml per kg in liters
    const totalWater = (baseWater + activityBonus).toFixed(1);
    
    // Convert to glasses (assuming 250ml per glass)
    const glasses = Math.round(totalWater * 1000 / 250);
    
    // Display results
    document.getElementById('water_result').classList.remove('hidden');
    document.getElementById('water_liters').textContent = totalWater + ' Liter';
    document.getElementById('water_glasses').textContent = `≈ ${glasses} gelas (250ml)`;
    
    // Smooth scroll to result
    document.getElementById('water_result').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}
</script>
