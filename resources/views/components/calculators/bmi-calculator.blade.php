<!-- BMI Calculator Component -->
<div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-800 rounded-xl shadow-lg p-6 mb-8">
    <div class="flex items-center mb-4">
        <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-4">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
        </div>
        <div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Kalkulator BMI</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Hitung Body Mass Index Anda</p>
        </div>
    </div>

    <div class="space-y-4">
        <!-- Gender Selection -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jenis Kelamin</label>
            <div class="flex gap-4">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="bmi_gender" value="male" class="mr-2 text-blue-600" checked>
                    <span class="text-gray-700 dark:text-gray-300">Laki-laki</span>
                </label>
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="bmi_gender" value="female" class="mr-2 text-blue-600">
                    <span class="text-gray-700 dark:text-gray-300">Perempuan</span>
                </label>
            </div>
        </div>

        <!-- Age Input -->
        <div>
            <label for="bmi_age" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Usia (tahun)</label>
            <input type="number" id="bmi_age" min="1" max="120" value="25" 
                   class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Height Input -->
        <div>
            <label for="bmi_height" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tinggi Badan (cm)</label>
            <input type="number" id="bmi_height" min="50" max="250" value="170" 
                   class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Weight Input -->
        <div>
            <label for="bmi_weight" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Berat Badan (kg)</label>
            <input type="number" id="bmi_weight" min="20" max="300" value="60" 
                   class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Calculate Button -->
        <button onclick="calculateBMI()" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200">
            Hitung BMI
        </button>

        <!-- Result Display -->
        <div id="bmi_result" class="hidden mt-4 p-4 rounded-lg">
            <div class="text-center mb-3">
                <div class="text-4xl font-bold mb-1" id="bmi_value"></div>
                <div class="text-lg font-semibold" id="bmi_category"></div>
            </div>
            <div class="text-sm" id="bmi_description"></div>
        </div>
    </div>
</div>

<script>
function calculateBMI() {
    const height = parseFloat(document.getElementById('bmi_height').value);
    const weight = parseFloat(document.getElementById('bmi_weight').value);
    
    if (!height || !weight || height <= 0 || weight <= 0) {
        alert('Mohon isi tinggi dan berat badan yang valid');
        return;
    }
    
    // Calculate BMI
    const heightInMeters = height / 100;
    const bmi = (weight / (heightInMeters * heightInMeters)).toFixed(1);
    
    // Determine category and color
    let category, description, colorClass;
    
    if (bmi < 18.5) {
        category = 'Berat Badan Kurang';
        description = 'BMI Anda menunjukkan berat badan kurang. Konsultasikan dengan dokter atau ahli gizi untuk program peningkatan berat badan yang sehat.';
        colorClass = 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300';
    } else if (bmi >= 18.5 && bmi < 25) {
        category = 'Berat Badan Normal';
        description = 'Selamat! BMI Anda berada dalam kategori normal. Pertahankan pola makan sehat dan olahraga teratur.';
        colorClass = 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300';
    } else if (bmi >= 25 && bmi < 30) {
        category = 'Berat Badan Berlebih';
        description = 'BMI Anda menunjukkan berat badan berlebih. Pertimbangkan untuk mengatur pola makan dan meningkatkan aktivitas fisik.';
        colorClass = 'bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-300';
    } else {
        category = 'Obesitas';
        description = 'BMI Anda menunjukkan obesitas. Sangat disarankan untuk berkonsultasi dengan dokter untuk program penurunan berat badan yang aman.';
        colorClass = 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300';
    }
    
    // Display result
    const resultDiv = document.getElementById('bmi_result');
    resultDiv.className = colorClass + ' mt-4 p-4 rounded-lg';
    resultDiv.classList.remove('hidden');
    
    document.getElementById('bmi_value').textContent = bmi;
    document.getElementById('bmi_category').textContent = category;
    document.getElementById('bmi_description').textContent = description;
    
    // Smooth scroll to result
    resultDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}
</script>
