# DIU CIS Club Portal - Installation & Setup Guide

## 🎯 Quick Start Guide

### Step-by-Step Installation

#### 1. Install XAMPP

1. Download XAMPP from: https://www.apachefriends.org/
2. Install XAMPP (default location: `C:\xampp`)
3. Run XAMPP Control Panel as Administrator

#### 2. Setup Project Files

1. Copy the entire `CISCLUB` folder to: `C:\xampp\htdocs\`
2. Your path should be: `C:\xampp\htdocs\CISCLUB`

#### 3. Start Services

1. Open XAMPP Control Panel
2. Start **Apache** module
3. Start **MySQL** module
4. Both should show green indicators

#### 4. Create Database

1. Open browser and go to: `http://localhost/phpmyadmin`
2. Click "New" in left sidebar
3. Database name: `cisclub_portal`
4. Collation: `utf8_general_ci`
5. Click "Create"

#### 5. Import Database

1. Click on `cisclub_portal` database
2. Click "Import" tab at the top
3. Click "Choose File"
4. Select: `C:\xampp\htdocs\CISCLUB\database\cisclub.sql`
5. Click "Go" at bottom
6. Wait for "Import has been successfully finished" message

#### 6. Configure Application

The application is pre-configured for localhost. No changes needed!

Default configuration in `config/database.php`:
```php
DB_HOST: localhost
DB_USER: root
DB_PASS: (empty)
DB_NAME: cisclub_portal
```

#### 7. Create Uploads Folder

1. Navigate to: `C:\xampp\htdocs\CISCLUB`
2. Create new folder named: `uploads`
3. Inside `uploads`, create subfolders:
   - `events`
   - `sponsors`
   - `committee`
   - `news`

#### 8. Access the Application

**User/Student Portal:**
```
http://localhost/CISCLUB
```

**Admin Panel:**
```
http://localhost/CISCLUB/admin
```

**Admin Credentials:**
- Username: `admin`
- Password: `admin123`

## 🔧 Troubleshooting

### Problem: Apache won't start

**Solution:**
1. Check if port 80 is being used by another program
2. Open XAMPP Control Panel → Click "Config" for Apache
3. Change `Listen 80` to `Listen 8080` in httpd.conf
4. Access site via: `http://localhost:8080/CISCLUB`

### Problem: MySQL won't start

**Solution:**
1. Port 3306 might be in use
2. Stop any other MySQL services
3. Or change port in XAMPP Config

### Problem: Database connection error

**Solution:**
1. Verify MySQL is running in XAMPP
2. Check database name is exactly: `cisclub_portal`
3. Check config/database.php settings
4. Ensure database was imported successfully

### Problem: Can't upload images

**Solution:**
1. Check `uploads` folder exists
2. Check folder permissions (should be writable)
3. Check PHP settings:
   - Open `C:\xampp\php\php.ini`
   - Find: `upload_max_filesize`
   - Set to: `10M` or higher
   - Find: `post_max_size`
   - Set to: `10M` or higher
   - Restart Apache

### Problem: Blank/white page

**Solution:**
1. Enable error reporting:
   - Open `C:\xampp\php\php.ini`
   - Find: `display_errors`
   - Set to: `On`
   - Restart Apache
2. Check PHP error logs in `C:\xampp\php\logs`

## 📝 Testing the Application

### Test User Panel:

1. **Homepage:** `http://localhost/CISCLUB`
   - Should see hero section, events, news

2. **Register:**
   - Click "Register" in navbar
   - Fill form and submit
   - Login with created credentials

3. **Browse Events:**
   - Click "Events" in navbar
   - View event details
   - Register for an event (requires login)

4. **View Dashboard:**
   - Login and access "My Account" → "Dashboard"
   - See your bookings

### Test Admin Panel:

1. **Login:**
   - Go to: `http://localhost/CISCLUB/admin`
   - Username: `admin`
   - Password: `admin123`

2. **Dashboard:**
   - Should see statistics
   - Recent bookings list

3. **Add Category:**
   - Click "Categories" in sidebar
   - Click "Add Category"
   - Fill form: Name="Workshop", Status="Active"
   - Submit

4. **Add Event:**
   - Click "Events" in sidebar
   - Click "Add Event"
   - Fill all required fields
   - Upload image (optional)
   - Submit

5. **Manage Bookings:**
   - Click "Bookings" in sidebar
   - Confirm/Cancel user registrations

## 🎨 Customization Guide

### Change Site Name:

Edit `config/config.php`:
```php
define('SITE_NAME', 'Your Club Name Here');
```

### Change Colors:

Edit `assets/css/style.css`:
```css
:root {
    --primary-color: #your-color;
    --secondary-color: #your-color;
}
```

### Change Logo/Hero Image:

Replace files in `assets/images/` folder

### Update Footer Information:

Edit `includes/footer.php` - Update contact info and social links

### Update Admin Credentials:

1. Go to phpMyAdmin
2. Open `cisclub_portal` database
3. Open `admin_users` table
4. Click "Edit" on admin row
5. For password: use this PHP code to generate hash:
```php
<?php echo password_hash('your_new_password', PASSWORD_DEFAULT); ?>
```
6. Update password field with the hash

## 📊 Default Database Content

The system includes sample data:

**Categories:**
- Workshop
- Competition
- Seminar
- Social Event
- Career Fair

**Admin User:**
- Username: admin
- Password: admin123

**Sample News:**
- Welcome message
- Programming contest announcement

## 🚀 Deployment to Live Server

### For Live Hosting:

1. **Upload Files:**
   - Upload all files via FTP/cPanel File Manager

2. **Create Database:**
   - Create MySQL database in cPanel
   - Import `database/cisclub.sql`

3. **Update Configuration:**
   - Edit `config/config.php`:
   ```php
   define('SITE_URL', 'http://yourdomain.com');
   ```
   - Edit `config/database.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'your_db_user');
   define('DB_PASS', 'your_db_password');
   define('DB_NAME', 'your_db_name');
   ```

4. **Set Permissions:**
   - Set `uploads/` folder to 755 or 777

5. **Test:**
   - Visit your domain
   - Test all functionalities

## 📱 Mobile Testing

Test on mobile devices:
1. Find your computer's local IP (ipconfig on Windows)
2. Access from phone: `http://YOUR_IP/CISCLUB`
3. Ensure phone is on same WiFi network

## 🔐 Security Recommendations

### For Production:

1. **Change Default Admin Password**
2. **Remove or secure phpMyAdmin**
3. **Enable HTTPS/SSL**
4. **Set strong database password**
5. **Regular backups**
6. **Keep PHP/MySQL updated**
7. **Disable error display in production:**
   ```php
   ini_set('display_errors', 0);
   error_reporting(0);
   ```

## 📞 Support

If you encounter issues:

1. Check this guide first
2. Review error messages
3. Check PHP error logs
4. Verify all steps were completed

## ✅ Checklist

Before reporting issues, verify:
- [ ] XAMPP Apache is running
- [ ] XAMPP MySQL is running
- [ ] Database `cisclub_portal` exists
- [ ] Database tables imported successfully
- [ ] `uploads` folder exists with write permissions
- [ ] Correct URL being used
- [ ] Browser cache cleared

---

**Need Help?**

Check these files for configuration:
- `config/config.php` - General settings
- `config/database.php` - Database settings
- `README.md` - Full documentation

**Good luck with your DIU CIS Club Portal! 🎉**
