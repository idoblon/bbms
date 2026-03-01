# Helper Files Usage Guide

## Overview
New helper files have been created to centralize common functionality and improve code maintainability.

## Helper Files

### 1. config.php - Database Configuration
Centralizes database connection settings.

**Usage:**
```php
<?php
require_once 'config.php';

// Get database connection
$mysqli = getDBConnection();

// Use the connection
$stmt = $mysqli->prepare("SELECT * FROM table WHERE id = ?");
// ... rest of your code

$mysqli->close();
```

**Benefits:**
- Single point of configuration
- Easy to change database credentials
- Consistent error handling

---

### 2. session.php - Session Management
Handles session operations and authentication checks.

**Functions:**

#### isLoggedIn()
Check if user is logged in.
```php
if (isLoggedIn()) {
    echo "User is logged in";
}
```

#### isAdmin()
Check if admin is logged in.
```php
if (isAdmin()) {
    echo "Admin is logged in";
}
```

#### requireLogin($redirectTo = 'index.php')
Redirect to login if not authenticated.
```php
require_once 'session.php';
requireLogin(); // Redirects to index.php if not logged in
requireLogin('login.php'); // Custom redirect
```

#### requireAdminLogin()
Redirect to admin login if not authenticated.
```php
require_once 'session.php';
requireAdminLogin(); // Redirects to adminlogin.php if not logged in
```

#### logout($redirectTo = 'index.php')
Logout user and redirect.
```php
require_once 'session.php';
logout('index.php?logout=true');
```

**Usage Example:**
```php
<?php
require_once 'session.php';
requireLogin(); // Protect page

$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
?>
```

---

### 3. csrf.php - CSRF Protection
Protects forms from Cross-Site Request Forgery attacks.

**Functions:**

#### generateCSRFToken()
Generate a CSRF token.
```php
$token = generateCSRFToken();
```

#### validateCSRFToken($token)
Validate a CSRF token.
```php
if (validateCSRFToken($_POST['csrf_token'])) {
    // Token is valid
}
```

#### getCSRFTokenField()
Get HTML input field with CSRF token.
```php
<form method="post">
    <?php echo getCSRFTokenField(); ?>
    <input type="text" name="username">
    <button type="submit">Submit</button>
</form>
```

#### checkCSRFToken()
Check CSRF token from POST request (dies if invalid).
```php
require_once 'csrf.php';
checkCSRFToken(); // Dies if token is invalid
// Process form...
```

**Complete Form Example:**
```php
<?php
require_once 'session.php';
require_once 'csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    checkCSRFToken();
    // Process form data
}
?>

<form method="post">
    <?php echo getCSRFTokenField(); ?>
    <input type="text" name="data">
    <button type="submit">Submit</button>
</form>
```

---

### 4. helpers.php - Input Sanitization & Validation
Provides functions for sanitizing and validating user input.

**Sanitization Functions:**

#### sanitizeString($input)
Sanitize string input (removes HTML/special chars).
```php
$name = sanitizeString($_POST['name']);
```

#### sanitizeEmail($email)
Sanitize email address.
```php
$email = sanitizeEmail($_POST['email']);
```

#### sanitizeInt($input)
Sanitize integer input.
```php
$age = sanitizeInt($_POST['age']);
```

**Validation Functions:**

#### validateEmail($email)
Validate email format.
```php
if (validateEmail($email)) {
    echo "Valid email";
}
```

#### validatePhone($phone)
Validate phone number (10 digits).
```php
if (validatePhone($phone)) {
    echo "Valid phone";
}
```

#### validateAge($age)
Validate age (18-120).
```php
if (validateAge($age)) {
    echo "Valid age";
}
```

#### validateBloodGroup($bloodgroup)
Validate blood group.
```php
if (validateBloodGroup($bloodgroup)) {
    echo "Valid blood group";
}
```

**Safe Input Retrieval:**

#### getPost($key, $default = '')
Get POST value safely.
```php
$name = getPost('name', 'Guest'); // Returns 'Guest' if not set
```

#### getGet($key, $default = '')
Get GET value safely.
```php
$id = getGet('id', 0);
```

**Complete Example:**
```php
<?php
require_once 'helpers.php';

// Get and sanitize input
$name = sanitizeString(getPost('name'));
$email = sanitizeEmail(getPost('email'));
$phone = getPost('phone');
$age = sanitizeInt(getPost('age'));

// Validate input
if (strlen($name) < 2) {
    echo "Name too short";
} elseif (!validateEmail($email)) {
    echo "Invalid email";
} elseif (!validatePhone($phone)) {
    echo "Invalid phone";
} elseif (!validateAge($age)) {
    echo "Invalid age";
} else {
    // Process valid data
}
```

---

## Complete File Template

Here's a complete template for a new PHP file using all helpers:

```php
<?php
// Include helper files
require_once 'config.php';
require_once 'session.php';
require_once 'csrf.php';
require_once 'helpers.php';

// Require authentication
requireLogin(); // or requireAdminLogin() for admin pages

// Get database connection
$mysqli = getDBConnection();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check CSRF token
    checkCSRFToken();
    
    // Get and sanitize input
    $name = sanitizeString(getPost('name'));
    $email = sanitizeEmail(getPost('email'));
    
    // Validate input
    if (strlen($name) < 2) {
        $error = "Name too short";
    } elseif (!validateEmail($email)) {
        $error = "Invalid email";
    } else {
        // Process data with prepared statement
        $stmt = $mysqli->prepare("INSERT INTO table (name, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $email);
        
        if ($stmt->execute()) {
            $success = "Data saved successfully";
        } else {
            $error = "Error saving data";
        }
        
        $stmt->close();
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if (isset($success)): ?>
        <div class="success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    
    <form method="post">
        <?php echo getCSRFTokenField(); ?>
        
        <input type="text" name="name" required>
        <input type="email" name="email" required>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>
```

---

## Migration Guide

### Step 1: Update Existing Files
Replace database connection code:

**Before:**
```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood-bank";
$mysqli = new mysqli($servername, $username, $password, $dbname);
```

**After:**
```php
require_once 'config.php';
$mysqli = getDBConnection();
```

### Step 2: Update Session Checks
Replace session checks:

**Before:**
```php
session_start();
if (isset($_SESSION['login'])) {
    // code
} else {
    header("location:index.php");
}
```

**After:**
```php
require_once 'session.php';
requireLogin();
// code
```

### Step 3: Add CSRF Protection
Add to forms:

**Before:**
```php
<form method="post">
    <input type="text" name="data">
    <button type="submit">Submit</button>
</form>
```

**After:**
```php
<?php require_once 'csrf.php'; ?>
<form method="post">
    <?php echo getCSRFTokenField(); ?>
    <input type="text" name="data">
    <button type="submit">Submit</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    checkCSRFToken();
    // process form
}
?>
```

### Step 4: Use Sanitization Helpers
Replace direct input access:

**Before:**
```php
$name = $_POST['name'];
$email = $_POST['email'];
```

**After:**
```php
require_once 'helpers.php';
$name = sanitizeString(getPost('name'));
$email = sanitizeEmail(getPost('email'));
```

---

## Benefits

1. **Code Reusability**: Write once, use everywhere
2. **Maintainability**: Update in one place, affects all files
3. **Security**: Consistent security practices
4. **Readability**: Cleaner, more readable code
5. **Testing**: Easier to test individual functions
6. **Consistency**: Same patterns across the application

---

## Files Already Updated

The following files have been updated to use the new helpers:
- ✅ checkadmin.php
- ✅ checkuser.php
- ✅ adduser.php
- ✅ logout.php
- ✅ adminlogout.php

## Files to Update

Remaining files that should be updated:
- [ ] adddonor.php
- [ ] searchbg.php
- [ ] searchcity.php
- [ ] deletea.php
- [ ] delusera.php
- [ ] updatea.php
- [ ] updateuser.php
- [ ] updateuserm.php
- [ ] adminstock.php
- [ ] updatestock.php
- [ ] updatestockm.php
- [ ] userstock.php
- [ ] requests.php
- [ ] makereq.php
- [ ] updaterequest.php
- [ ] deletereq.php
- [ ] adminhome.php
- [ ] userdashboard.php
- [ ] joinus.php

---

## Best Practices

1. **Always include helpers at the top of the file**
2. **Use requireLogin() or requireAdminLogin() for protected pages**
3. **Always use getCSRFTokenField() in forms**
4. **Always use checkCSRFToken() when processing forms**
5. **Use sanitization functions for all user input**
6. **Use validation functions before processing data**
7. **Close database connections when done**
8. **Use htmlspecialchars() when outputting user data**

---

## Troubleshooting

### Issue: "Call to undefined function"
**Solution**: Make sure you've included the correct helper file at the top.

### Issue: "CSRF token validation failed"
**Solution**: Ensure the form has the CSRF token field and session is started.

### Issue: "Headers already sent"
**Solution**: Make sure there's no output before header() calls. Use exit after redirects.

### Issue: Database connection fails
**Solution**: Check config.php has correct database credentials.

---

## Next Steps

1. Update remaining files to use helpers
2. Add CSRF protection to all forms
3. Test all functionality
4. Update documentation
5. Train team on new patterns
