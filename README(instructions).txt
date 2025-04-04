Event Reminder App
Project Overview
Event Reminder is a Laravel 10-based web application that allows users to create, manage, and receive reminders for upcoming events. Users can add events, invite others via email, import/export events using CSV, and even use the app offline (Progressive Web App support).

Features
Custom Authentication (Login/Register)


Create, Edit, Delete Events (CRUD)


View Upcoming and Completed Events


Email Invitations for Events


Offline Syncing using PWA


Import Events from CSV


Export Events to CSV


Dark-themed, responsive Bootstrap UI



 Project Structure

1.App has all necessary part for logical implementations like controller , models , mail classes etc
2.Database carrying all type of migrations what we need for this project 
3. Views under resources folder is carrying all front end design part which is used here on blade
4. Web.php is used here to create routes and app.php is using for syncing as app
5..env is using to setup project environment 
6. Test mysql db into the db folder 
6. I am using here mailtrap for smtp support. Mailtrap credential 
Email: tahmim0008@gmail.com
Password: Pass@2233223322




Technologies Used
Laravel 10


PHP 8.2+


MySQL


Bootstrap 5


JavaScript (Fetch API + Offline Sync)


Mailtrap for email testing


PWA for offline support



 How It Works
User Auth: Registers and logs into the system.


Event Creation: Adds new events with optional invite email.


Email: When added, an email is sent with event info.


Offline Mode: If the user is offline, events are stored in localStorage.


Sync: When back online, events are automatically synced via API.


Invite Button: Users can invite anyone to an event from the dashboard.


CSV: Upload events via CSV, and download events list as CSV.



Setup Instructions
Clone repo and install dependencies:

composer install
npm install && npm run dev
Set up .env file (DB, Mailtrap credentials).
Run migrations
Serve the app:php artisan serve
Optional: Install PWA support:
php artisan vendor:publish --tag=laravel-assets



It is free to use and free to test

Test User:
Email: test@test.com
password:12345678
