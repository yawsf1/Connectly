# Connectly

Connectly is a Laravel-based social networking platform that enables users to connect with friends, share posts, send private messages, and receive notifications.

Live Demo: https://connectly-production-c88...up.railway.app

---

## Features

- **User Authentication**: Secure registration and login with Google OAuth integration
- **User Profiles**: Unique codes for users and profile management
- **Posting**: Create and share posts with other users
- **Friend System**: Add and manage friends
- **Messaging**: Send and receive private messages
- **Notifications**: Real-time notifications for new messages and friend requests
- **Responsive Design**: Built with Blade templates and Vite for a fast, responsive frontend
- **Dockerized Deployment**: Production-ready Docker setup deployed on Railway

---

## Technologies Used

- **Backend**: Laravel (PHP Framework)
- **Frontend**: Blade Templates, JavaScript, Vite
- **Database**: MySQL via Laravel Eloquent ORM
- **Authentication**: Laravel Auth with Google OAuth
- **Deployment**: Docker, deployed on Railway

---

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL
- Docker (for containerized setup)

### Steps

#### 1. Clone the repository

```bash
git clone https://github.com/yawsf1/Connectly
cd Connectly
```

#### 2. Install PHP dependencies

```bash
composer install
```

#### 3. Install Node.js dependencies

```bash
npm install
```

#### 4. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials and Google OAuth keys:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=connectly
DB_USERNAME=root
DB_PASSWORD=

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

#### 5. Database Setup

```bash
php artisan migrate
```

#### 6. Build Assets

```bash
npm run build
```

#### 7. Start the Application

```bash
php artisan serve
```

In another terminal:

```bash
npm run dev
```

#### 8. Open your browser at `http://localhost:8000`

---

## Docker Setup

Build and run with Docker:

```bash
docker build -t connectly .
docker run -p 8080:8080 \
  -e APP_KEY=your-app-key \
  -e DB_HOST=host.docker.internal \
  -e DB_DATABASE=connectly \
  -e DB_USERNAME=root \
  -e DB_PASSWORD=your-password \
  --add-host=host.docker.internal:host-gateway \
  connectly
```

---

## Deployment

This app is deployed on Railway using Docker. The following environment variables must be set in Railway's Variables tab:

```env
APP_ENV=production
APP_KEY=
APP_URL=
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=
```

---

## Database Schema

Main models:

- **User**: User information including Google OAuth fields and unique codes
- **Post**: User posts
- **Friend**: Friendship relationships
- **Message**: Private messages between users
- **Notification**: System notifications

---

## License

This project is licensed under the MIT License.
