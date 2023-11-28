# Laravel Framework

**Description:** The Laravel Framework is a powerful PHP framework for web artisans. It provides an elegant syntax, a robust set of tools, and a vibrant developer community.

## Installation

Make sure you have [Composer](https://getcomposer.org/) installed. Then run the following command:

```bash
composer create-project --prefer-dist laravel/laravel my-laravel-app
```

## Project Structure

The project follows the standard Laravel directory structure:

- `app/`: Contains the application's core code.
- `database/`: Houses database migrations and seeders.
- `public/`: The web server's document root.
- `resources/`: Contains views, language files, and assets.
- `routes/`: Defines the application's routes.
- `tests/`: Contains automated tests.

## Dependencies

- **PHP:** Requires PHP version 8.0 or higher.
- **laravel/framework:** The core Laravel framework.
- **laravel/sanctum:** Provides a lightweight authentication system.
- **laravel/tinker:** Interactive REPL for Laravel.
- **laravel/ui:** Frontend scaffolding for Bootstrap, Vue, or React.
- **maatwebsite/excel:** A package for reading and writing Excel files.
- **spatie/laravel-permission:** Handles user permissions and roles.
- **guzzlehttp/guzzle:** HTTP client for sending HTTP requests.
- **fruitcake/laravel-cors:** Adds CORS (Cross-Origin Resource Sharing) support.
- **realrashid/sweet-alert:** A beautiful replacement for JavaScript's alert.
- **psr/simple-cache:** PSR-16 simple cache implementation.

## Development Dependencies

- **fakerphp/faker:** A library for generating fake data.
- **laravel/sail:** Docker development environment for Laravel.
- **nunomaduro/collision:** Better error reporting.
- **phpunit/phpunit:** Unit testing framework.
- **spatie/laravel-ignition:** Laravel error page for better debugging.

## Autoloading

The project follows the PSR-4 autoloading standard for classes.

## Scripts

- `post-autoload-dump`: Runs various tasks after the autoloader is dumped.
- `post-update-cmd`: Publishes assets after updating the project.
- `post-root-package-install`: Copies the `.env.example` file to `.env` upon package installation.
- `post-create-project-cmd`: Generates an application key after creating a new project.

## Configuration

- `optimize-autoloader`: Optimizes the autoloader for better performance.
- `preferred-install`: Installs packages from "dist" by default.
- `sort-packages`: Sorts packages by name when updating.

## Stability

- **Minimum Stability:** Development.
- **Prefer Stable:** Enabled.

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct and the process for submitting pull requests to us.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
