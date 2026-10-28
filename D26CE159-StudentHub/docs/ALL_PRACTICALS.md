# StudentHub — All Practicals 1–14

This project is organized as one continuous StudentHub portal and maps the supplied practical syllabus into a single runnable project.

## Practical 1 — Project Initiation
Included:
- README
- Sitemap
- Wireframe
- Project folder structure
- Git/GitHub-ready organization

## Practical 2 — Semantic HTML5 Pages
Included:
- Home
- About
- Register
- Login
- Dashboard
- Events
- Profile
- Contact
- Admin
- FAQ
- Feedback
- Semantic structure and accessible labels/navigation

## Practical 3 — Responsive UI
Included:
- Responsive CSS
- CSS Grid
- Flexbox
- Media queries
- Mobile/tablet/desktop-friendly layouts
- Reusable cards, buttons, forms and tables

## Practical 4 — JavaScript DOM & Interactivity
Included:
- Hamburger navigation
- FAQ interaction
- Modal/UI interaction where available
- Theme preference/localStorage
- DOM event handling

## Practical 5 — Registration Validation
Included:
- HTML5 form controls
- Name/email/mobile validation
- Password and confirm-password validation
- Regex
- Error messages
- Terms acceptance
- Backend handoff

## Practical 6 — Fetch API + JSON
Included:
- JSON datasets
- Fetch API
- Dynamic rendering
- Search/filter
- Loading/error handling
- Array processing

## Practical 7 — PHP Form Processing
Included:
- POST processing
- Server-side validation
- Sanitization
- CSV/JSON/file-storage foundation where applicable
- Success/error responses

## Practical 8 — MySQL + PHP Connectivity
Included:
- Database schema
- Users, students, events and registration structures
- PHP database connection
- Prepared-statement-ready backend
- SQL seed data

## Practical 9 — Secure Registration
Included:
- Database insert
- Duplicate email checking
- password_hash()
- Frontend + backend validation
- Role field

## Practical 10 — Secure Login/Logout
Included:
- PHP sessions
- password_verify()
- Session ID regeneration
- Role-based redirection
- Session timeout
- Logout
- Admin/student access separation

## Practical 11 — Student CRUD
Included:
- Add
- View
- Search/filter
- Delete
- Database operations
- Confirmation before delete

## Practical 12 — Event CRUD + Poster Upload Foundation
Included:
- Add/view/update/delete event workflow
- Event category/status data
- Poster field/storage foundation
- Server-side validation structure

## Practical 13 — PHP JSON API
Included:
- JSON API endpoint
- GET/POST handling
- Fetch-ready frontend architecture
- JSON responses
- Database-backed data

## Practical 14 — Admin Dashboard
Included:
- Admin-only access
- Statistics
- Dynamic/admin navigation
- Student/event management
- Audit-log database foundation
- Role-based access control

## How to Run

### Frontend
Use VS Code Live Server or another local HTTP server.

### PHP + MySQL
1. Install XAMPP.
2. Copy the project into `htdocs`.
3. Start Apache and MySQL.
4. Open phpMyAdmin.
5. Import the SQL file from the `database` folder.
6. Open the project through `http://localhost/...`.

### Admin account
Register a normal account first. Then set its role to `admin` in MySQL using the email of that account.

## Important
The project is intended as a college practical project. Before public deployment, additional production security hardening, CSRF protection, upload-directory protection, authorization checks and configuration management should be added where required.
