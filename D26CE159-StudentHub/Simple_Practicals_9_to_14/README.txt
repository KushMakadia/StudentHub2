SIMPLE PRACTICALS 9 TO 14

These are shorter beginner-friendly versions of practicals 9-14. Original project files are also kept in the ZIP.

SETUP
1. Copy Simple_Practicals_9_to_14 into C:\xampp\htdocs\
2. Start Apache and MySQL in XAMPP.
3. Open phpMyAdmin and import database/studenthub.sql from the original project.
4. If needed, update Simple_Practicals_9_to_14/config.php with your MySQL username/password.
5. Open http://localhost/Simple_Practicals_9_to_14/Practical9/register.php to register.
6. To test admin features, register a user first, then run in phpMyAdmin:
   UPDATE students SET role='admin' WHERE email='your-email@example.com';
7. Login at Practical10/login.php. Admin users can access practicals 11, 12, and 14. Practical 13's GET list works without login; adding requires admin login in the same browser session.

PRACTICAL MAP
9 Registration + duplicate email check + password_hash
10 Login/logout + sessions + password_verify + role redirect
11 Student add/list/search/delete
12 Event add/list/delete + basic poster extension/size validation
13 JSON API + Fetch API to list/add events
14 Admin counts + latest users + admin links

NOTE: These are simplified classroom examples. Practical 11 and 12 focus on the basic CRUD flow; edit/update and advanced audit/timeout/remember-me features are omitted to keep code short. Use only for local practice, not production.
