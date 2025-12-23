<!-- Calorie Calculator Component -->
<div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-slate-700 dark:to-slate-800 rounded-xl shadow-lg p-6 mb-8">
    <div class="flex items-center mb-4">
        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-4">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
        <div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Kalkulator Kebutuhan Kalori</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Hitung kebutuhan kalori harian Anda</p>
        </div>
    </div>

    <div class="space-y-4">
        <!-- Gender Selection -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jenis Kelamin</label>
            <div class="flex gap-4">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="calorie_gender" value="male" class="mr-2 text-green-600" checked>
                    <span class="text-gray-700 dark:text-gray-300">Laki-laki</span>
                </label>
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="calorie_gender" value="female" class="mr-2 text-green-600">
                    <span class="text-gray-700 dark:text-gray-300">Perempuan</span>
                </label>
            </div>
        </div>

        <!-- Age Input -->
        <div>
            <label for="calorie_age" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Usia (tahun)</label>
            <input type="number" id="calorie_age" min="1" max="120" value="25" 
                   class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-green-500 dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Height Input -->
        <div>
            <label for="calorie_height" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tinggi Badan (cm)</label>
            <input type="number" id="calorie_height" min="50" max="250" value="170" 
                   class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-green-500 dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Weight Input -->
        <div>
            <label for="calorie_weight" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Berat Badan (kg)</label>
            <input type="number" id="calorie_weight" min="20" max="300" value="60" 
                   class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-green-500 dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Activity Level -->
        <div>
            <label for="activity_level" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tingkat Aktivitas</label>
            <select id="activity_level" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-green-500 dark:bg-slate-700 dark:text-white">
                <option value="1.2">Sangat Ringan (tidak/jarang olahraga)</option>
                <option value="1.375">Ringan (olahraga 1-3 hari/minggu)</option>
                <option value="1.55" selected>Sedang (olahraga 3-5 hari/minggu)</option>
                <option value="1.725">Berat (olahraga 6-7 hari/minggu)</option>
                <option value="1.9">Sangat Berat (atlet/pekerjaan fisik berat)</option>
            </select>
        </div>

        <!-- Goal Selection -->
        <div>
            <label for="calorie_goal" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tujuan</label>
            <select id="calorie_goal" class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-green-500 dark:bg-slate-700 dark:text-white">
                <option value="-500">Menurunkan Berat Badan (defisit 500 kal)</option>
                <option value="0" selected>Mempertahankan Berat Badan</option>
                <option value="500">Menaikkan Berat Badan (surplus 500 kal)</option>
            </select>
        </div>

        <!-- Calculate Button -->
        <button onclick="calculateCalories()" 
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition duration-200">
            Hitung Kalori
        </button>

        <!-- Result Display -->
        <div id="calorie_result" class="hidden mt-4 p-4 bg-green-100 dark:bg-green-900/30 rounded-lg">
            <div class="text-center mb-3">
                <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">Kebutuhan Kalori Harian</div>
                <div class="text-4xl font-bold text-green-700 dark:text-green-300 mb-1" id="calorie_value"></div>
                <div class="text-sm text-gray-600 dark:text-gray-400" id="calorie_goal_text"></div>
            </div>
            <div class="mt-4 space-y-2 text-sm text-gray-700 dark:text-gray-300">
                <div class="flex justify-between p-2 bg-white dark:bg-slate-700 rounded">
                    <span>Karbohidrat (50%):</span>
                    <span class="font-semibold" id="carbs_value"></span>
                </div>
                <div class="flex justify-between p-2 bg-white dark:bg-slate-700 rounded">
                    <span>Protein (25%):</span>
                    <span class="font-semibold" id="protein_value"></span>
                </div>
                <div class="flex justify-between p-2 bg-white dark:bg-slate-700 rounded">
                    <span>Lemak (25%):</span>
                    <span class="font-semibold" id="fat_value"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calculateCalories() {
    const gender = document.querySelector('input[name="calorie_gender"]:checked').value;
    const age = parseFloat(document.getElementById('calorie_age').value);
    const height = parseFloat(document.getElementById('calorie_height').value);
    const weight = parseFloat(document.getElementById('calorie_weight').value);
    const activityLevel = parseFloat(document.getElementById('activity_level').value);
    const goal = parseInt(document.getElementById('calorie_goal').value);
    
    if (!age || !height || !weight) {
        alert('Mohon isi semua data yang diperlukan');
        return;
    }
    
    // Calculate BMR using Mifflin-St Jeor Equation
    let bmr;
    if (gender === 'male') {
        bmr = (10 * weight) + (6.25 * height) - (5 * age) + 5;
    } else {
        bmr = (10 * weight) + (6.25 * height) - (5 * age) - 161;
    }
    
    // Calculate TDEE (Total Daily Energy Expenditure)
    const tdee = Math.round(bmr * activityLevel);
    
    // Apply goal adjustment
    const targetCalories = tdee + goal;
    
    // Calculate macros
    const carbs = Math.round((targetCalories * 0.5) / 4); // 4 cal per gram
    const protein = Math.round((targetCalories * 0.25) / 4); // 4 cal per gram
    const fat = Math.round((targetCalories * 0.25) / 9); // 9 cal per gram
    
    // Get goal text
    let goalText;
    if (goal < 0) {
        goalText = 'Untuk menurunkan berat badan';
    } else if (goal > 0) {
        goalText = 'Untuk menaikkan berat badan';
    } else {
        goalText = 'Untuk mempertahankan berat badan';
    }
    
    // Display results
    document.getElementById('calorie_result').classList.remove('hidden');
    document.getElementById('calorie_value').textContent = targetCalories.toLocaleString('id-ID') + ' kkal';
    document.getElementById('calorie_goal_text').textContent = goalText;
    document.getElementById('carbs_value').textContent = carbs + ' gram';
    document.getElementById('protein_value').textContent = protein + ' gram';
    document.getElementById('fat_value').textContent = fat + ' gram';
    
    // Smooth scroll to result
    document.getElementById('calorie_result').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}
</script>
