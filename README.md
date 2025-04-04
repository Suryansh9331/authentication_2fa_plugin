﻿# authentication_2fa_plugin

📖 Introduction
The Simple 2FA Plugin adds an extra layer of security to your WordPress login process by requiring a one-time passcode (OTP) sent to the user’s email address after login. This ensures that even if the user’s password is compromised, unauthorized logins can be prevented.

✨ Features
✅ Adds email-based two-factor authentication to WordPress login
✅ Sends a one-time 6-digit code via email
✅ Configurable code expiration time (default: 5 minutes)
✅ Custom 2FA verification page using shortcode
✅ Simple and lightweight — no external dependencies
✅ Supports custom styling via CSS


🛠️ Installation
1. Manual Installation
  1. Download the plugin as a .zip file.
  2. Go to WordPress Admin → Plugins → Add New.
  3. Click Upload Plugin and select the .zip file.
  4. Click Install Now and then Activate.


2. Git Installation
    Alternatively, you can install the plugin using Git:
     cd wp-content/plugins/ 
     git clone https://github.com/your-username/simple-2fa.git

   🏗️ Setup
1. Create the 2FA Verification Page
    a. Go to Pages → Add New
    b. Create a new page titled 2FA Verification
    c. Add the following shortcode in the content area:
     [2fa_verification]
    d. Publish the page.

2. Enable 2FA for Users
 A.  After activation, 2FA will be automatically enabled for all WordPress users.
 B.  Upon successful login, the user will be redirected to the 2FA verification page to enter the code sent via email.


🚀 Usage
   The user logs in using their username and password.
   A 6-digit OTP is generated and sent to the user’s email.
   The user is redirected to the /2fa-verification/ page.
   The user enters the code and clicks Verify.
  ✅ Success → The user is logged in.
  ❌ Failure → An error message is displayed.



  🛡️ Troubleshooting
🔴 Email Not Sending
        Make sure your hosting server allows outgoing emails.
        Install an SMTP plugin like WP Mail SMTP to test and configure email settings.
🔴 Form Not Displaying
        Make sure the shortcode [2fa_verification] is added correctly to the 2FA Verification page.
        Ensure that the plugin is active under Plugins.
🔴 Invalid Code Error
        Ensure that the code is entered within the expiration period (default: 5 minutes).
        Try logging out and logging in again to generate a new code.



 🤝 Contributing
Contributions are welcome! To contribute:

  Fork the repository
  Create a new branch (git checkout -b feature/new-feature)
  Commit your changes (git commit -m "Add new feature")
  Push to the branch (git push origin feature/new-feature)
  Create a Pull Request


 ⭐ Show Your Support
If you find this plugin helpful, please consider ⭐️ starring the repository on GitHub!

ER.   SURYANSH MISHRA
