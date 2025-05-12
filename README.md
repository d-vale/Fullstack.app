# Crisis Management Simulator

A web-based crisis management simulator where users make critical decisions during a cyberattack on national infrastructure. The application tracks key metrics like public trust, available resources, social impact, and crisis progression.

## Project Structure

This project is built with:

-   **Backend**: Laravel (API)
-   **Frontend**: Vue.js
-   **Database**: SQLite

## Features

-   Interactive crisis scenario with multiple chapters
-   Decision-based gameplay with real-time consequence tracking
-   Key metric monitoring (public trust, resources, social impact, and crisis level)
-   Multiple possible endings based on player decisions
-   Progress saving
-   Responsive design for mobile and desktop
-   User authentication

## Key Metrics

-   **Public Trust** (0-100%): Represents population's confidence in your leadership
-   **Available Resources** (0+): Represents remaining crisis management resources
-   **Social Impact** (0-100%): Represents the severity of societal disruption
-   **Crisis Progress** (0-100%): Represents how far the crisis has progressed (lower is better)

## API Endpoints

### Chapters

-   `GET /v1/chapters` - Get all chapters
-   `GET /v1/chapters/first` - Get the first chapter (entry point)
-   `GET /v1/chapters/endings` - Get all possible ending chapters
-   `GET /v1/chapters/{id}` - Get a specific chapter
-   `GET /v1/chapters/{chapterId}/choices` - Get all choices for a chapter

### Choices

-   `GET /v1/choices/{id}` - Get a specific choice
-   `GET /v1/choices/{choiceId}/impacts` - Get all impacts for a choice
-   `GET /v1/choices/{choiceId}/next-chapter` - Get the next chapter for a choice

### Progress (Authentication Required)

-   `GET /v1/progress` - Get the current user's progress
-   `POST /v1/progress/update` - Update progress based on a choice
-   `POST /v1/progress/reset` - Reset the user's progress

### Admin (Authentication and Admin Required)

-   `GET /v1/admin/users/{userId}/progress` - Get a specific user's progress

## Installation

### Prerequisites

-   PHP 8.1 or higher
-   Composer
-   Node.js and npm
-   SQLite

### Setup

1. Clone the repository:

    ```
    git clone https://github.com/d-vale/Fullstack.app.git
    cd Fullstack.app
    ```

2. Install PHP dependencies:

    ```
    composer install
    ```

3. Install JavaScript dependencies:

    ```
    npm install
    ```

4. Create a copy of the `.env.example` file:

    ```
    cp .env.example .env
    ```

5. Generate an application key:

    ```
    php artisan key:generate
    ```

6. Create the SQLite database:

    ```
    touch database/database.sqlite
    ```

7. Configure the `.env` file to use SQLite:

    ```
    DB_CONNECTION=sqlite
    # Comment out or remove the other DB_ variables
    ```

8. Run migrations and seeders:

    ```
    php artisan migrate --seed
    ```

9. Build frontend assets:

    ```
    npm run dev
    ```

10. Start the development server:

    ```
    composer run dev
    ```

11. Access the application at `http://localhost:8000`

## Test Accounts

Two test accounts are created by default when running the seeders:

### Admin Account:
- **Email**: admin@example.com
- **Password**: password

### Regular User Account:
- **Email**: user@example.com
- **Password**: password

Use these credentials to test the application without needing to register new accounts.

## License

This project is licensed under the MIT License.
