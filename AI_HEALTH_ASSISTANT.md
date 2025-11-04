# 🤖 AI Health Assistant Feature

Fitur AI Health Assistant menggunakan Google Gemini AI untuk membantu pasien dengan pertanyaan seputar kesehatan.

---

## 📋 Features

- ✅ **Floating Button** - Button yang selalu terlihat di pojok kanan bawah
- ✅ **Sidebar Chat** - Chat interface yang slide dari kanan
- ✅ **Real-time Response** - AI memberikan response langsung
- ✅ **Indonesian Language** - AI menjawab dalam Bahasa Indonesia
- ✅ **Health Focus** - AI difokuskan untuk pertanyaan kesehatan
- ✅ **Safety Disclaimer** - Selalu mengingatkan untuk konsultasi dengan dokter
- ✅ **Typing Indicator** - Animasi loading saat AI berpikir
- ✅ **Responsive Design** - Works di mobile & desktop

---

## 🔧 Setup

### 1. Get Gemini API Key

1. Buka: https://makersuite.google.com/app/apikey
2. Login dengan Google Account
3. Click **"Get API Key"** atau **"Create API Key"**
4. Copy API Key yang digenerate

### 2. Add to .env

Tambahkan ke file `.env`:

```env
GEMINI_API_KEY=your_api_key_here
```

**Example:**
```env
GEMINI_API_KEY=AIzaSyBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
```

### 3. Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
```

---

## 🚀 Usage

### For Patients:

1. Login sebagai **Patient**
2. Go to **Dashboard**
3. Click **floating button** (ungu/pink) di pojok kanan bawah
4. Sidebar chat akan muncul dari kanan
5. Ketik pertanyaan kesehatan
6. Tekan **Enter** atau click **Send button**
7. AI akan merespons dalam beberapa detik

### Example Questions:

- "Apa gejala diabetes?"
- "Bagaimana cara menurunkan kolesterol?"
- "Makanan apa yang baik untuk jantung?"
- "Apa penyebab sakit kepala?"
- "Bagaimana cara mengatasi insomnia?"

---

## 📊 Technical Details

### Controller: `HealthAIController.php`

**Location:** `app/Http/Controllers/HealthAIController.php`

**Method:** `chat(Request $request)`

**Features:**
- Validates user input (max 1000 characters)
- Adds health-focused system prompt
- Calls Gemini API
- Handles errors gracefully
- Returns JSON response

### Route:

```php
Route::post('/health/ai/chat', [HealthAIController::class, 'chat'])
    ->name('health.ai.chat')
    ->middleware(['auth', 'role:patient']);
```

**Security:**
- ✅ Requires authentication
- ✅ Only accessible by patients
- ✅ CSRF protection
- ✅ Input validation
- ✅ Rate limiting (Laravel default)

### API Endpoint:

**URL:** `POST /health/ai/chat`

**Headers:**
```
Content-Type: application/json
X-CSRF-TOKEN: {csrf_token}
```

**Request Body:**
```json
{
  "message": "Apa gejala diabetes?"
}
```

**Response (Success):**
```json
{
  "success": true,
  "message": "Diabetes memiliki beberapa gejala umum seperti..."
}
```

**Response (Error):**
```json
{
  "success": false,
  "message": "Terjadi kesalahan saat menghubungi AI."
}
```

---

## 🎨 UI Components

### Floating Button

```html
<button id="aiChatToggle">
  <!-- Purple/Pink gradient -->
  <!-- Animated notification dot -->
  <!-- Chat icon -->
</button>
```

**Features:**
- Gradient background (purple to pink)
- Hover animation (scale up)
- Animated ping notification
- Fixed position (bottom-right)
- z-index: 40

### Sidebar Chat

**Sections:**
1. **Header** - Title, AI icon, close button
2. **Messages** - Scrollable chat area
3. **Input** - Textarea & send button

**Features:**
- Slide-in animation from right
- Full height
- Responsive width (100% mobile, 384px desktop)
- Custom scrollbar
- Message animations

### Message Bubbles

**User Messages:**
- Purple/pink gradient background
- White text
- Rounded corners (top-right flat)
- Right-aligned
- User icon

**AI Messages:**
- White background
- Gray text
- Rounded corners (top-left flat)
- Left-aligned
- AI icon

---

## 🔒 Security & Safety

### Input Validation

```php
$request->validate([
    'message' => 'required|string|max:1000',
]);
```

### Safety Settings

Gemini API configured with:
- `HARM_CATEGORY_HARASSMENT` - Block medium & above
- `HARM_CATEGORY_HATE_SPEECH` - Block medium & above
- `HARM_CATEGORY_SEXUALLY_EXPLICIT` - Block medium & above
- `HARM_CATEGORY_DANGEROUS_CONTENT` - Block medium & above

### System Prompt

AI diberikan instruksi:
- Menjawab dalam Bahasa Indonesia
- Fokus pada informasi kesehatan umum
- Selalu disclaimer: bukan pengganti dokter
- Memberikan saran pencegahan & gaya hidup sehat
- Tidak memberikan diagnosis atau resep

---

## 🐛 Troubleshooting

### Error: "Gemini API key not configured"

**Solution:**
```bash
# Add to .env
GEMINI_API_KEY=your_api_key_here

# Clear config
php artisan config:clear
```

### Error: "Terjadi kesalahan koneksi"

**Possible Causes:**
1. No internet connection
2. Gemini API down
3. Invalid API key
4. Rate limit exceeded

**Solution:**
- Check internet connection
- Verify API key is correct
- Check Laravel logs: `storage/logs/laravel.log`
- Try again after a few minutes

### Chat button not showing

**Solution:**
- Clear browser cache
- Check if user is logged in as **patient**
- Check JavaScript console for errors

### Sidebar not opening

**Solution:**
- Check JavaScript console
- Verify z-index not conflicting
- Test in different browser

---

## 📈 Future Enhancements

### Possible Improvements:

1. **Chat History**
   - Save conversation to database
   - Load previous chats
   - Export chat transcript

2. **Voice Input**
   - Speech-to-text
   - Text-to-speech for AI responses

3. **Image Analysis**
   - Upload medical images
   - Gemini Vision API for analysis

4. **Multi-language**
   - Support English, Indonesian, etc.
   - Auto-detect language

5. **Appointment Booking**
   - Direct booking from chat
   - If AI can't answer, suggest doctor

6. **Health Tips**
   - Daily health tips via AI
   - Personalized recommendations

7. **Symptom Checker**
   - Structured symptom input
   - Severity assessment
   - Doctor recommendation

---

## 💡 Best Practices

### For Users:

- ✅ Ask specific health questions
- ✅ Provide context (age, symptoms, duration)
- ✅ Follow up with clarifying questions
- ❌ Don't share sensitive personal info
- ❌ Don't rely solely on AI for diagnosis
- ✅ Always consult doctor for serious conditions

### For Developers:

- ✅ Monitor API usage & costs
- ✅ Implement rate limiting
- ✅ Log conversations for improvement
- ✅ Regularly update system prompts
- ✅ Test edge cases
- ✅ Handle API failures gracefully

---

## 📞 Support

### Gemini AI Resources:
- **API Docs**: https://ai.google.dev/docs
- **API Key**: https://makersuite.google.com/app/apikey
- **Pricing**: https://ai.google.dev/pricing
- **Community**: https://discuss.ai.google.dev/

### Laravel Resources:
- **HTTP Client**: https://laravel.com/docs/http-client
- **Validation**: https://laravel.com/docs/validation
- **Middleware**: https://laravel.com/docs/middleware

---

## ✅ Testing Checklist

- [ ] Gemini API key configured
- [ ] User logged in as patient
- [ ] Floating button visible
- [ ] Click button opens sidebar
- [ ] Can send message
- [ ] AI responds correctly
- [ ] Typing indicator shows
- [ ] Messages display properly
- [ ] Close button works
- [ ] Overlay click closes sidebar
- [ ] Mobile responsive
- [ ] Error handling works
- [ ] No console errors

---

<p align="center">
  <strong>🤖 AI Health Assistant Ready to Help! 🏥</strong>
</p>
