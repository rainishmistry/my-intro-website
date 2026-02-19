# Professional Laravel Portfolio Website

A dynamic, full-featured personal portfolio website built with Laravel 11. Designed for professionals to showcase their work, skills, and experience with a robust Admin Panel for content management.

![Portfolio Home](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)

## 🚀 Key Features

### 🎨 **Dynamic Frontend**
*   **Hero Section:** Fully customizable title, description, and profile picture.
*   **About Section:** Dynamic statistics for *Years of Experience*, *Projects Completed*, and *Happy Clients*.
*   **Portfolio:** Showcase projects with categories, images, and links.
*   **Resume Download:** "My Resume" button links directly to your latest uploaded CV (PDF/DOC).
*   **Contact Form:** Functional contact form that saves inquiries to the database.

### 🛠️ **Admin Dashboard**
*   **Secure Authentication:** Protected admin routes.
*   **Settings Management:**
    *   Update Site Title, Hero Text, and About Content.
    *   **Image Uploads:** Change Profile Picture, About Image, and Hero Backgrounds.
    *   **Resume Upload:** Easily update your CV file (PDF support).
    *   **Statistics Control:** Manually update your professional stats (Exp, Projects, Clients).
*   **Project Management:** CRUD operations for portfolio items.
*   **Message Inbox:** View and reply to contact form submissions.

### ⚙️ **Technical Highlights**
*   **Laravel 11 Framework:** Utilizing the latest features of the PHP ecosystem.
*   **Optimized File Uploads:**
    *   Handles large files (configured for up to 128MB).
    *   Smart error handling for file size limits (no crashes!).
*   **Security:**
    *   CSRF Protection on all forms.
    *   Sanitized inputs and secure authentication.
*   **Responsive Design:** Fully responsive layout for Mobile, Tablet, and Desktop.

## 📦 Installation

1.  **Clone the repository**
    ```bash
    git clone https://github.com/yourusername/portfolio.git
    cd portfolio
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install && npm run build
    ```

3.  **Environment Setup**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *   Configure your database credentials in `.env`.

4.  **Database Migration**
    ```bash
    php artisan migrate
    ```

5.  **Run the Server**
    ```bash
    php artisan serve
    ```

## 📝 Configuration Tips

### File Upload Limits
If you encounter issues uploading large files (e.g., >2MB), ensure your `php.ini` is configured correctly:
```ini
upload_max_filesize = 128M
post_max_size = 128M
memory_limit = 256M
```
*Checked using `/check_limits.php` if available.*

## 📄 License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
