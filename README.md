# Wallet README

## Introduction

An application in which users can have multiple wallets with each wallet type having its own name, minimum balance and monthly interest rate. The wallets should be able to send and receive money from other wallets.

## Features

- Get all users in the system.
- Get all wallets in the system.
- Get a wallet's details including its owner, type and available balance.
- Send money from one wallet to another.

## Technologies Used

- **Framework:** Laravel 11
- **Database:** MySQL
- **API:** RESTful APIs
- **Version Control:** Git

## Installation

### Prerequisites

- PHP >= 8.1
- Composer
- MySQL

### Steps

1. **Clone the repository:**

   ```bash
   git clone https://github.com/mj-ad/Wallet.git
   cd Wallet
   ```

2. **Install dependencies:**

   ```bash
   composer install
   ```

3. **Copy .env file and configure your environment:**

   ```bash
   cp .env.example .env

4. **Generate application key:**

   ```bash
   php artisan key:generate
   ```

5. **Run migrations:**

   ```bash
   php artisan migrate
   ```

6. **Start the development server:**

   ```bash
   php artisan serve
   ```

## Configuration

Configure the `.env` file with your database details. Ensure the following environment variables are set:

```env
APP_NAME=Wallet
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wallet
DB_USERNAME=root
DB_PASSWORD=
```

## Project Structure

```bash
Wallet/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── vendor/
├── .env.example
├── artisan
├── composer.json
├── package.json
└── webpack.mix.js
```

## API Implementation

### Request Methods and URL

| Method | URL | Description|
| ---- | ---- | ---- |
| GET | /api/users | Get all Users. |
| GET | /api/users/{id} | Get user by id. |
| POST | /api/users | Create new user instance. |
| PUT | /api/users/{id} | Update user instance. |
| DELETE | /api/users/{id} | Delete user instance. |
| GET | /api/wallets | Get all wallets. |
| GET | /api/wallets/{id} | Get wallet by id. |
| POST | /api/wallets | Create new wallet instance. |
| PUT | /api/wallets/{id} | Update wallet instance. |
| DELETE | /api/wallets/{id} | Delete wallet instance. |
| GET | /api/wallet_types | Get all wallet types. |
| GET | /api/wallet_types/{id} | Get wallet type by id. |
| POST | /api/wallet_types | Create new wallet type instance. |
| PUT | /api/wallet_types/{id} | Update wallet type instance. |
| DELETE | /api/wallet_types/{id} | Delete wallet type instance. |
| GET | /api/transactions | Get all transactions. |
| POST | /api/transactions | Send money from one wallet to another. |

### HTTP Response Status Codes

| Code | Title | Description|
| ---- | ---- | ---- |
| 200 | OK | When a request was successful e.g when using GET. |
| 201 | CREATED | When a request is created or updated successfully. |
| 204 | No content | This occurs after an instance has been deleted. |
| 400 | Bad Request | When a request is incorrect or could not be understood. |
| 404 | Not found | This occurs when the user id inputed does not exist. |

### User Fields 

This is an example of the layout to be posted.
```
{
    "name": "MJ Ade",
    "email": "adeol@mailexample.com"
}
```

### Wallet Fields

This is an example of the layout to be posted.
```
{
    "user_id": "77ff30be-5ea4-4f67-840b-5305029a2548",
    "wallet_type_id": "00679a1f-3981-4291-910b-727e3d157691",
    "balance": 30000
}
```

### Wallet Type Fields

This is an example of the layout to be posted.
```
{
    "name": "Basic",
    "monthly_interest_rate": 2,
    "minimum_balance": 20000
}
```

### Transaction Fields

To send money from one wallet to another
```
{
    "from_wallet_id": "6c7bcad7-ef93-4fee-ac7b-b797acecfee4",
    "to_wallet_id": "12c6d23a-3baf-493d-aa70-4f55caca8f69",
    "amount": 20000
}
```
