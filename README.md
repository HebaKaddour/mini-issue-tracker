# Mini Issue Tracker (Laravel)

A small project for tracking tasks and issues using Laravel and Eloquent ORM.
It supports creating tasks, assigning them to different users, adding labels, and adding comments.

## overview
The goals of this project are to implement advanced Eloquent rules and models in Laravel, including:

- Relationships
- accessors and mutators
- Local scopes
- Custom casts
- Transactions

## Entities
The main entities in this project are:
projects, issues, users, labels, and comments.

##installation
1. Clone the repository:
   ```bash
   git clone https://github.com/HebaKaddour/mini-issue-tracker.git
   ```
2. Navigate to the project directory:
   ```bash
   cd mini-issue-tracker
   ```
3. Install the dependencies:
   ```bash
   composer install
   ```
4. Set up the environment file:
   ```bash
   cp .env.example .env
   ```
5. Generate the application key:
   ```bash
   php artisan key:generate
   ```
6. Run the migrations:
   ```bash
   php artisan migrate
   ```
  7. php artisan db:seed
  