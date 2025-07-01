

# 🔐 PHP Authentication System

A secure PHP authentication system with **registration**, **login**, **email verification**, and **password reset** functionality. Built using **PDO**, **PHPMailer**, and **password hashing**, this project is ideal for beginners learning user authentication in PHP with MySQL.

---

## ✨ Features

✅ **User Registration** with Input Validation  
✅ **Email Verification** via Token Link  
✅ **Secure Login** with Session Handling  
✅ **Forgot Password** & Reset Functionality  
✅ **Password Hashing** using `password_hash()`  
✅ **PDO Prepared Statements** to Prevent SQL Injection  
✅ **Clean Inline Styled HTML Forms**  
✅ **Session Management** (Login & Logout)  
✅ **Email Sending** with PHPMailer & Mailtrap SMTP  

---

## 🛠️ Tech Stack

- PHP 7+
- MySQL
- PHPMailer
- HTML + Inline CSS
- XAMPP / MAMP (Local Development)

---

## 📂 Folder Structure

```text
/php/
│
├── config.php               # DB connection & constants
├── registration.php         # User registration with validation & email verification
├── login.php                # User login with session
├── forgot-password.php      # Forgot password email request
├── reset-password.php       # Password reset with token
├── dashboard.php            # User dashboard after login
├── logout.php               # Session logout
├── vendor/                  # PHPMailer via Composer
├── header.php / footer.php  # Optional layout files

