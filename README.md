# DIU CIS Club Portal

A comprehensive web-based information and event management system for the Computing & Information System Club at Daffodil International University.

## 📋 Project Overview

The DIU CIS Club Portal is a dynamic web application built to solve the departmental problem of lacking a centralized platform for managing events, news, achievements, committee members, and student interactions.

### Features

**User Panel:**
- Browse upcoming events and news
- User registration and authentication
- Event booking system
- View committee members and sponsors
- Contact form
- Personal dashboard

**Admin Panel:**
- Dashboard with analytics
- Category management
- Event management (CRUD operations)
- Booking management
- News publishing
- Sponsor management
- Committee member management
- User management
- Message inbox

## 🛠️ Technologies Used

- **Frontend:** HTML5, CSS3, Bootstrap 5.3, JavaScript
- **Backend:** PHP (Core)
- **Database:** MySQL
- **Icons:** Font Awesome 6.4
- **Server:** Apache (XAMPP/WAMP/LAMP)

## 📦 Installation Guide

### Prerequisites

- XAMPP/WAMP/LAMP (PHP 7.4+ and MySQL 5.7+)
- Web browser (Chrome, Firefox, Edge)
- Text editor (optional, for modifications)

### Step 1: Download and Extract

1. Download the project files
2. Extract to your web server directory:
   - XAMPP: `C:\xampp\htdocs\CISCLUB`
   - WAMP: `C:\wamp\www\CISCLUB`
   - LAMP: `/var/www/html/CISCLUB`

### Step 2: Database Setup

1. Start Apache and MySQL from XAMPP/WAMP control panel
2. Open phpMyAdmin: `http://localhost/phpmyadmin`
3. Create a new database named `cisclub_portal`
4. Import the SQL file:
   - Click on the `cisclub_portal` database
   - Go to "Import" tab
   - Choose file: `database/cisclub.sql`
   - Click "Go"

### Step 3: Configuration

1. Open `config/database.php`
2. Update database credentials if needed:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');  // Your MySQL password
   define('DB_NAME', 'cisclub_portal');
   ```

3. Open `config/config.php`
4. Update `SITE_URL` if needed:
   ```php
   define('SITE_URL', 'http://localhost/CISCLUB');
   ```

### Step 4: Create Uploads Directory

1. Create an `uploads` folder in the project root
2. Set permissions (Linux/Mac):
   ```bash
   chmod 755 uploads
   ```

### Step 5: Access the Application

**User Panel:**
- URL: `http://localhost/CISCLUB`

**Admin Panel:**
- URL: `http://localhost/CISCLUB/admin`
- Default Credentials:
  - Username: `admin`
  - Password: `admin123`

## 📁 Project Structure

```
CISCLUB/
├── admin/
│   ├── includes/
│   │   ├── header.php
│   │   └── footer.php
│   ├── index.php
│   ├── login.php
│   ├── categories.php
│   ├── events.php
│   ├── bookings.php
│   ├── news.php
│   ├── sponsors.php
│   ├── committee.php
│   ├── users.php
│   └── messages.php
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── main.js
│   └── images/
├── auth/
│   ├── login.php
│   ├── register.php
│   └── logout.php
├── config/
│   ├── config.php
│   └── database.php
├── database/
│   └── cisclub.sql
├── includes/
│   ├── header.php
│   └── footer.php
├── pages/
│   ├── about.php
│   ├── events.php
│   ├── event-details.php
│   ├── news.php
│   ├── news-details.php
│   ├── committee.php
│   ├── contact.php
│   ├── dashboard.php
│   └── my-bookings.php
├── uploads/
├── index.php
└── README.md
```

## 🗄️ Database Schema

### Main Tables

- **users** - Student/member accounts
- **admin_users** - Administrator accounts
- **categories** - Event categories
- **events** - Event information
- **event_registrations** - Event bookings
- **news** - News and announcements
- **sponsors** - Sponsor information
- **committee_members** - Committee member profiles
- **contact_messages** - Contact form submissions

## 🔐 Security Features

- Password hashing using PHP `password_hash()`
- SQL injection prevention with `mysqli_real_escape_string()`
- XSS protection with `htmlspecialchars()`
- Session-based authentication
- Admin and user role separation

## 🚀 Usage Guide

### For Students/Users:

1. Register an account
2. Browse events and news
3. Register for events
4. View your bookings in the dashboard
5. Contact the club through the contact form

### For Administrators:

1. Login to admin panel
2. Manage categories for better event organization
3. Create and publish events
4. Approve/confirm event bookings
5. Publish news and announcements
6. Add sponsors and committee members
7. Monitor user activity

## 🎨 Customization

### Change Colors

Edit `assets/css/style.css`:
```css
:root {
    --primary-color: #0d6efd;
    --secondary-color: #6c757d;
}
```

### Update Site Information

Edit `config/config.php`:
```php
define('SITE_NAME', 'DIU CIS Club');
```

Edit `includes/footer.php` for footer content.

## 📱 Responsive Design

The portal is fully responsive and works on:
- Desktop computers
- Tablets
- Mobile phones

## 🐛 Troubleshooting

**Database Connection Error:**
- Check MySQL is running
- Verify database credentials in `config/database.php`
- Ensure database exists

**File Upload Issues:**
- Check `uploads/` directory exists
- Verify directory permissions
- Check `php.ini` for `upload_max_filesize`

**Can't Login:**
- Clear browser cache
- Check database has admin user
- Verify password is correct

## 👨‍💻 Developer

**Delower Hussain**
- B.Sc. in Computing & Information System
- Daffodil International University
- 7th Semester - Web Engineering Course

## 📄 License

This project is developed for academic purposes as part of the Web Engineering course at Daffodil International University.

## 🙏 Acknowledgments

- Daffodil International University
- CIS Department Faculty
- DIU CIS Club Members

## 📞 Support

For issues or questions:
- Email: cisclub@diu.edu.bd
- Visit: DIU Campus, Ashulia, Dhaka

---

**Version:** 1.0.0  
**Last Updated:** November 2025
