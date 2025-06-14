# 🎮 Dynamic Sidebar Navigation (PHP + MySQL)

A simple dynamic sidebar-based navigation system for a social gaming dashboard built using PHP, MySQL, HTML, and CSS. This project includes login, registration, and dashboard functionalities with a session-based access system.

---

## 🧱 Files Overview

### 1. 🔐 `login.php`
- Allows existing users to log in with session-based authentication.
- Validates credentials using data stored in the MySQL database.
- Redirects authenticated users to the `dash.php` page.

### 2. 📝 `reg.php`
- Registration form for new users.
- Takes username, password, and other required fields.
- Stores user data securely in the database.
- Prevents duplicate user creation.

### 3. 🧭 `dash.php`
- The main dashboard after login.
- Loads a dynamic **sidebar** with links:
  - Home
  - Settings
  - Friends
  - Messages
  - Logout
- Includes `session_start()` to ensure only logged-in users access it.

---

## 🗂️ Folder Structure
