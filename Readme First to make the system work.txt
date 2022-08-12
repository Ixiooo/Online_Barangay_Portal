
1. Extract this folder

2. Google search XAMPP and install it to be able to use PhpMyAdmin as the database of the system since it is still not hosted online

3. Copy this folder "Online-Barangay-Portal" to the htdocs folder of XAMPP

4. Access the localhost through your browser by typing localhost in the search bar and click the phpmyadmin tab

5. Create a new database named "online-barangay-portal"

6. Click the created database named "online-barangay-portal" and it should contain no data

7. Import the online-barangay-portal.sql file included in this folder "Online-Barangay-Portal" to the created database in phpmyadmin using the import option


Optional Step. (Skip the following steps if you didn't set a new username and password in XAMPP)
If your xampp is configured with new username and password, open the "dbConfig.php" file using notepad 

Optional Step.  (Skip the following steps if you didn't set a new username and password in XAMPP)
Replace the public $db_username = "root"; line to public $db_username = "Enter Your Xampp Username here";

Optional Step.  (Skip the following steps if you didn't set a new username and password in XAMPP)
Replace the public $db_password = ""; line to public $db_password = "Enter Your Xampp Password here"; 

8. After doing these process, search xampp control panel on windows and open it 

9. Start apache and mysql service

10. Access the web app by typing localhost/Online-Barangay-Portal/ on the url bar of your web browser

There, a login option is provided to access the system

A pre set values of credentials are set, this will be used to initially login to the system

For Administrator login (Barangay Official Login)

Username: admin1
Password: admin1

For User login (Barangay Resident Login)

Username: user1
Password: user1

After logging in, features and functionalities of the system is offered and if you are done, click the log out button

Here is a youtube video that demonstrates the system 

https://youtu.be/uropPLkvvL0

Use HD resolution for better viewing