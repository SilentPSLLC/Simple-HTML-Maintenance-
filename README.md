# Simple-HTML-Maintenance-


This repository provides several options for implementing a maintenance page. Depending on your technology stack, you can choose the appropriate solution:

1. **PHP-based Maintenance Page (`maintenance.php`)**
2. **HTML-only Maintenance Page (`no-countdown.html`)**
3. **React with Next.js Maintenance Page (`maintenance.js`)**

## 1. PHP-based Maintenance Page (`maintenance.php`)

The `maintenance.php` file provides a dynamic maintenance page with internationalization support and a countdown timer. It auto-refreshes the page once the countdown ends.

### **Setup Instructions:**

1. **Upload `maintenance.php`**: Place the `maintenance.php` file in the root directory of your PHP-enabled web server.

2. **Configuration**:
   - **`$time_to_wait`**: Set the countdown duration in seconds.
   - **`$site_title`**: Customize the site title.
   - **`$contact_link`**: Update the link to your contact page or Discord.

3. **Languages**: The script supports multiple languages (English, Arabic, French, German, Spanish, Chinese, and Portuguese). You can add or modify translations in the `$translations` array.

4. **Testing**: Access the page to ensure the countdown and auto-refresh functionality work as expected.

## 2. HTML-only Maintenance Page (`no-countdown.html`)

The `no-countdown.html` file is a static HTML page without a countdown timer. It includes basic styling and auto-refresh functionality.

### **Setup Instructions:**

1. **Upload `no-countdown.html`**: Place the `no-countdown.html` file in the root directory of your web server.

2. **Customization**:
   - Modify the `<title>`, heading, and text content directly in the HTML file.

3. **Testing**: Open the page in a browser to verify the layout and auto-refresh functionality. The page will refresh every 5 minutes.

## 3. React with Next.js Maintenance Page (`maintenance.js`)

The `maintenance.js` file is a React component for use with Next.js. It includes internationalization and a countdown timer that auto-refreshes the page when the countdown ends.

### **Setup Instructions:**

1. **Create a Next.js Project** (if you haven't already):
   ```bash
   npx create-next-app@latest my-next-app
   cd my-next-app
