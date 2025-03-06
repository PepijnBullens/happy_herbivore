# Laravel + Inertia.js (React) Setup Guide

<br />

## Prerequisites

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL or another supported database
- Git (optional but recommended)

<br /><br />

## Installation Steps

1. **Clone the repository**  
   `git clone <repository-url> cd <repository-folder>`

2. **Install PHP dependencies**  
   `composer install`

3. **Create `.env` file**  
   `cp .env.example .env`

4. **Generate application key**  
   `php artisan key:generate`

5. **Configure database**  
   Open `.env` and update the database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<your-database>
DB_USERNAME=<your-username>
DB_PASSWORD=<your-password>
```

6. **Run migrations**  
   `php artisan migrate`

7. **Install JavaScript dependencies**  
   `npm install`

8. **Start the Laravel server**  
   `php artisan serve`

9. **Start the React server**
   `npm run dev`

10. **Visit your app**  
    Open `http://127.0.0.1:8000` in your browser.

<br /><br />

# Setting Up Startup System (Kiosk Mode)

Steps:

1. **Create a text file**  
   Open Notepad and add the following line: `start chrome --kiosk --start-fullscreen --app=https://happy-herbivore.pepijnbullens.nl/`

2. **Save the file as a batch script**

- Click `File` > `Save As`
- Set "Save as type" to "All Files"
- Name it `startup.bat`
- Click `Save`

3. **Upload the file to Windows startup folder**

- Press `Win + R`
- Type `shell:startup` and press Enter
- Move `startup.bat` into this folder

4. **Restart your PC**  
   Upon restart, Chrome will launch in kiosk mode with your website.

> [!IMPORTANT]  
> This requires Chrome to be installed.
