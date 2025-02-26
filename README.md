<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Coach Appointment Scheduling System
This project is a back-end system for managing coach appointments. The goal is to develop an application that allows users to schedule appointments with coaches, each of whom has their own working schedule. Appointments must only be scheduled within the available times of the coach, and overlapping appointments are not allowed.

The system is built with Laravel as the framework and uses a MySQL database to store data about coaches, their schedules, and scheduled appointments. The application provides an API that allows users to view coaches, check available times, and schedule appointments. After a successful appointment creation, both the coach and the user will receive a confirmation email.

Purpose of the Application
The application provides a platform for managing coaches, their availability, and scheduling appointments by users. This is done via a RESTful API that supports the following features:

- [View a list of coaches]
- [View available times for a coach]
- [Schedule an appointment with a coach]
- [Receive a confirmation email after a successful appointment]
  Functionality
  The application supports the following key functionalities:

1. Retrieve List of Coaches
   Users can retrieve a list of coaches along with details of their availability.

2. Retrieve Available Times
   Users can retrieve the available times for a specific coach so they can select a suitable time.

3. Schedule an Appointment
   Users can schedule an appointment with a coach at an available time.

4. Confirmation Email
   After successfully scheduling an appointment, both the coach and the user will receive a confirmation email with the appointment details.



# Installation
Follow the steps below to set up the project locally on your machine:

## 1. Clone the repository:
```shell 
https://github.com/zakrio/CoachApp.git
```

## 2. Install the necessary dependencies:
```shell
composer install
npm install
```

## 3. Copy the example .env file:

```shell
cp .env.example .env
```

## 4. Generate the application key:
```shell
php artisan migrate:fresh --seed
```
## 5. Start the server:
```shell
php artisan serve
```

# API Endpoints
The API consists of the following endpoints:

## 1. /api/coaches
```text
GET|HEAD   api/coaches
GET|HEAD   api/coaches/{coach}
```

## 2. /api/appointments
```text
POST       api/appointments
GET|HEAD   api/appointments/{appointment}
```

After successfully creating an appointment, both the coach and the user will receive a confirmation email with details of the appointment.
The mail can be found in the logs!

# API Authentication (Sanctum)
The API uses Sanctum for authentication. Follow the steps below to generate a token for testing the API:

## use API token: (after the seed the token will be printed to the logs)

Add the following header to your API requests:

```text
Authorization: Bearer {your-token}
```
# Tooling and Testing
## Linting & Tests
This project uses the following tools:
- [Pint: PHP linting.]
- [Pest: Unit tests for the application.]
- [PHPStan: Static analysis for PHP code. (level max)]

Run the tests with the following command:

```shell
npm run test
```

Specific test commands:
```textmate
Linting: npm run test:lint
Refactoring: npm run test:refactor
Type-checking: npm run test:types
Unit testing: npm run test:unit
```

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the CoachApp community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
