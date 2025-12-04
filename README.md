# mjdawson.net
My Personal Website.

## Docker Setup

1.  **Build and Run**:
    ```bash
    docker-compose up -d --build
    ```

2.  **Access**:
    *   Website: `http://localhost:8080`
    *   Database: `localhost:3306` (User: `mjdawson_user`, Pass: `secret_password`)

## Development

*   **PHP**: `src/`
*   **Assets**: `src/app/assets/`
*   **Database**: `docker/db/init.sql` (Schema)
*   **Migrations**: `src/Migrations/` - Migrations run automatically on page load.

## Notes

*   The application uses a custom Router and Controller structure in `src/Core` and `src/Controllers`.
*   Autogate has been removed.
*   Contact form is currently disabled (shows alert).
*   Post API is available at `/api/posts`.
