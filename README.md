# PayPal Integration with Laravel

This guide will help you integrate PayPal into your Laravel project using the PayPal REST API SDK.

## Steps to Integrate PayPal

### 1. Create a PayPal Developer Account

Before integrating PayPal into your Laravel project, you need to create a PayPal Developer account and get your credentials (Client ID and Secret).

1. Go to the [PayPal Developer Site](https://developer.paypal.com/).
2. Sign up for a PayPal Developer account if you don’t already have one.
3. After logging in, navigate to **My Apps & Credentials**.
4. Under **REST API apps**, click on **Create App**.
5. Fill in the necessary information for your app (name, etc.), and PayPal will generate your **Client ID** and **Secret** for you.
6. Use these credentials in your Laravel project for authentication and making API calls.

### 2. Install the PayPal SDK

Run the following command in your terminal to install the PayPal REST API SDK via Composer:

```bash
composer require paypal/rest-api-sdk-php

```
3. Create PayPal Controller
In this step, you'll create a controller that will handle PayPal payment processing.

Generate Controller:

Run the following command in your terminal to generate a new controller for PayPal:

bash
Copy
php artisan make:controller PayPalController
