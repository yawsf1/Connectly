# Connectly

Connectly is a Laravel-based social networking application that enables users to connect with friends, share posts, send private messages, and receive notifications. Built with modern web technologies, it provides a seamless experience for social interactions.

## Features

- **User Authentication**: Secure registration and login system with Google OAuth integration.
- **User Profiles**: Unique codes for users, profile management.
- **Posting**: Create and share posts with other users.
- **Friend System**: Add and manage friends.
- **Messaging**: Send and receive private messages.
- **Notifications**: Real-time notifications for activities like new messages or friend requests.
- **Responsive Design**: Built with Blade templates and Vite for fast, responsive frontend.

## Technologies Used

- **Backend**: Laravel (PHP Framework)
- **Frontend**: Blade Templates, JavaScript, Vite
- **Database**: MySQL (via Laravel's Eloquent ORM)
- **Authentication**: Laravel Sanctum or built-in Auth
- **Styling**: CSS (with potential for Tailwind or Bootstrap)
- **Testing**: PHPUnit
- **Deployment**: Docker (docker-compose.yml available)

## Installation

### Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js and npm
- MySQL or another supported database
- Docker (optional, for containerized setup)

### Steps

1. **Clone the repository**:

    ```bash
    git clone <repository-url>
    cd Connectly
    ```

2. **Install PHP dependencies**:

    ```bash
    composer install
    ```

3. **Install Node.js dependencies**:

    ```bash
    npm install
    ```

4. **Environment Configuration**:
    - Copy `.env.example` to `.env`:
        ```bash
        cp .env.example .env
        ```
    - Update the `.env` file with your database credentials, app key, and other settings.
    - Generate application key:
        ```bash
        php artisan key:generate
        ```

5. **Database Setup**:
    - Create a database in MySQL.
    - Run migrations:
        ```bash
        php artisan migrate
        ```
    - (Optional) Seed the database:
        ```bash
        php artisan db:seed
        ```

6. **Build Assets**:

    ```bash
    npm run build
    ```

7. **Start the Application**:
    - For development:
        ```bash
        php artisan serve
        ```
        And in another terminal:
        ```bash
        npm run dev
        ```
    - Or use Docker:
        ```bash
        docker-compose up
        ```

8. **Access the Application**:
    - Open your browser and go to `http://localhost:8000` (or the configured port).

## Usage

- **Registration/Login**: Users can sign up or log in using email/password or Google OAuth.
- **Dashboard**: View home feed with posts from friends.
- **Friends**: Search and add friends.
- **Messages**: Send private messages to friends.
- **Posts**: Create new posts, view your posts on the "My Posts" page.
- **Notifications**: Check notifications for updates.

## Database Schema

The application uses the following main models:

- **User**: Stores user information, including Google fields and unique codes.
- **Post**: User posts.
- **Friend**: Friendship relationships.
- **Message**: Private messages between users.
- **Notification**: System notifications.

Run `php artisan migrate:status` to see migration status.

## Testing

Run the test suite with PHPUnit:

```bash
php artisan test
```

## Contributing

1. Fork the repository.
2. Create a feature branch: `git checkout -b feature-name`.
3. Commit your changes: `git commit -am 'Add feature'`.
4. Push to the branch: `git push origin feature-name`.
5. Submit a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Support

For support or questions, please open an issue on the GitHub repository.
