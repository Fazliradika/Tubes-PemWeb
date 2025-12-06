# Favicon Setup Instructions

## Current Status
Placeholder favicon files have been created. For better quality, please generate proper favicon files.

## How to Generate Proper Favicon Files

### Option 1: Using RealFaviconGenerator (Recommended)
1. Visit: https://realfavicongenerator.net/
2. Upload your logo file: `public/images/logo-new.jpg`
3. Customize the icons for different platforms
4. Download the generated package
5. Replace these files in the `public/` directory:
   - `android-chrome-192x192.png`
   - `android-chrome-512x512.png`
   - `apple-touch-icon.png`
   - `favicon-16x16.png`
   - `favicon-32x32.png`
   - `favicon.ico`
   - `site.webmanifest` (if needed)

### Option 2: Using Favicon.io
1. Visit: https://favicon.io/favicon-converter/
2. Upload your logo file: `public/images/logo-new.jpg`
3. Download the generated files
4. Replace the files in the `public/` directory

### Option 3: Using ImageMagick (Command Line)
If you have ImageMagick installed:

```bash
# Create favicon.ico
convert public/images/logo-new.jpg -resize 256x256 public/favicon.ico

# Create PNG versions
convert public/images/logo-new.jpg -resize 16x16 public/favicon-16x16.png
convert public/images/logo-new.jpg -resize 32x32 public/favicon-32x32.png
convert public/images/logo-new.jpg -resize 180x180 public/apple-touch-icon.png
convert public/images/logo-new.jpg -resize 192x192 public/android-chrome-192x192.png
convert public/images/logo-new.jpg -resize 512x512 public/android-chrome-512x512.png
```

## Files Already Configured
✅ `site.webmanifest` - Created with app name and theme colors
✅ HTML head tags - Updated in `layouts/app.blade.php` and `layouts/guest.blade.php`
✅ Placeholder files - Created from existing favicon/logo

## After Generating Proper Files
Simply replace the placeholder files in the `public/` directory with the newly generated ones and commit the changes.
