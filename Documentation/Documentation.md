## Application Interface Documentation

### Overview

This document provides a detailed explanation of the application interfaces for our Laravel-based application. The interfaces include user-facing routes, actions, and API endpoints for interacting with the system. Each interface is described in terms of its HTTP method, endpoint, parameters, expected responses, and any special considerations.

---

## Table of Contents

1. [Authentication Interfaces](#authentication-interfaces)
2. [Campaign Management Interfaces](#campaign-management-interfaces)
   - View Campaigns
   - Create Campaign
   - Edit Campaign
   - Donate to a Campaign
3. [Donation Interfaces](#donation-interfaces)
4. [Error Handling](#error-handling)

---

## Authentication Interfaces

### 1.1. **Login**
- **URL**: `/login`
- **Method**: `POST`
- **Description**: Authenticates a user by validating credentials.
- **Request Parameters**:
  - `email` (string, required): The user's email.
  - `password` (string, required): The user's password.
- **Response**:
  - `200 OK`: Success with user data and token.
  - `401 Unauthorized`: Incorrect credentials.
  - `400 Bad Request`: Missing required fields.
- **Example**:
  ```json
  POST /login
  {
    "email": "user@example.com",
    "password": "password123"
  }
  ```

### 1.2. **Register**
- **URL**: `/register`
- **Method**: `POST`
- **Description**: Registers a new user in the system.
- **Request Parameters**:
  - `name` (string, required): The user's full name.
  - `email` (string, required): The user's email.
  - `password` (string, required): The user's password.
  - `password_confirmation` (string, required): Confirmation of the password.
- **Response**:
  - `201 Created`: Success with user details.
  - `400 Bad Request`: Missing required fields or validation errors.
- **Example**:
  ```json
  POST /register
  {
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }
  ```

### 1.3. **Logout**
- **URL**: `/logout`
- **Method**: `POST`
- **Description**: Logs the user out by invalidating the session/token.
- **Request Parameters**: None
- **Response**:
  - `200 OK`: Success message.

---

## Campaign Management Interfaces

### 2.1. **View Campaigns**
- **URL**: `/campaigns`
- **Method**: `GET`
- **Description**: Fetches a list of all active campaigns.
- **Request Parameters**: None
- **Response**:
  - `200 OK`: Returns an array of campaign objects.
- **Response Example**:
  ```json
  [
    {
      "id": 1,
      "name": "Education for All",
      "target_amount": 10000,
      "collected_amount": 5000,
      "status": "open"
    },
    {
      "id": 2,
      "name": "Clean Water Initiative",
      "target_amount": 15000,
      "collected_amount": 12000,
      "status": "closed"
    }
  ]
  ```

### 2.2. **Create Campaign**
- **URL**: `/campaigns/create`
- **Method**: `POST`
- **Description**: Allows a logged-in user to create a new campaign.
- **Request Parameters**:
  - `name` (string, required): The campaign name.
  - `description` (string, required): Campaign description.
  - `target_amount` (float, required): The target amount to raise.
  - `start_date` (date, required): When the campaign starts.
  - `end_date` (date, required): When the campaign ends.
- **Response**:
  - `201 Created`: Success with the campaign details.
  - `400 Bad Request`: Validation errors.
  - `401 Unauthorized`: User not authenticated.
- **Example**:
  ```json
  POST /campaigns/create
  {
    "name": "Health Support",
    "description": "Raising funds for health initiatives.",
    "target_amount": 5000,
    "start_date": "2024-01-01",
    "end_date": "2024-03-01"
  }
  ```

### 2.3. **Edit Campaign**
- **URL**: `/campaigns/{id}/edit`
- **Method**: `PUT`
- **Description**: Allows the campaign owner to edit their campaign details.
- **Request Parameters**:
  - `id` (integer, required): The campaign ID.
  - `name` (string, optional): New campaign name.
  - `description` (string, optional): New campaign description.
  - `target_amount` (float, optional): New target amount.
  - `start_date` (date, optional): New start date.
  - `end_date` (date, optional): New end date.
- **Response**:
  - `200 OK`: Success with updated campaign details.
  - `400 Bad Request`: Validation errors.
  - `401 Unauthorized`: User not authenticated or not the owner.
- **Example**:
  ```json
  PUT /campaigns/1/edit
  {
    "name": "Updated Health Support",
    "target_amount": 7000
  }
  ```

### 2.4. **Donate to a Campaign**
- **URL**: `/campaigns/{id}/donate`
- **Method**: `POST`
- **Description**: Allows a user to donate to an active campaign.
- **Request Parameters**:
  - `id` (integer, required): Campaign ID.
  - `amount` (float, required): Amount to donate.
- **Response**:
  - `200 OK`: Donation successful, returns updated campaign data.
  - `400 Bad Request`: Validation errors or insufficient funds.
  - `401 Unauthorized`: User not logged in.
  - `403 Forbidden`: If the campaign is closed.
- **Example**:
  ```json
  POST /campaigns/1/donate
  {
    "amount": 100
  }
  ```

---

## Donation Interfaces

### 3.1. **View Donations**
- **URL**: `/donations`
- **Method**: `GET`
- **Description**: Fetches a list of all donations made by the authenticated user.
- **Request Parameters**: None
- **Response**:
  - `200 OK`: Returns an array of donation objects.
- **Response Example**:
  ```json
  [
    {
      "id": 1,
      "campaign_id": 1,
      "amount": 100,
      "date": "2024-01-15"
    },
    {
      "id": 2,
      "campaign_id": 2,
      "amount": 50,
      "date": "2024-02-05"
    }
  ]
  ```

### 3.2. **Donation History for Campaign**
- **URL**: `/campaigns/{id}/donations`
- **Method**: `GET`
- **Description**: Fetches a list of all donations for a specific campaign.
- **Request Parameters**:
  - `id` (integer, required): Campaign ID.
- **Response**:
  - `200 OK`: Returns an array of donation objects.
  - `404 Not Found`: If the campaign does not exist.
- **Response Example**:
  ```json
  [
    {
      "id": 1,
      "amount": 100,
      "user": "John Doe",
      "date": "2024-01-15"
    },
    {
      "id": 2,
      "amount": 200,
      "user": "Jane Smith",
      "date": "2024-01-16"
    }
  ]
  ```

---

## Error Handling

### 4.1. **Common HTTP Status Codes**
- `200 OK`: Request was successful, and the response contains the data.
- `201 Created`: A resource was successfully created.
- `400 Bad Request`: There was an error with the request parameters.
- `401 Unauthorized`: The user is not authenticated.
- `403 Forbidden`: The user is authenticated but does not have permission to perform this action.
- `404 Not Found`: The requested resource could not be found.
- `500 Internal Server Error`: A server-side error occurred.

### 4.2. **Error Response Structure**
In case of an error, the response typically contains an error message or validation error details.

```json
{
  "error": "The campaign is closed for donations."
}
```

---

### Conclusion

This documentation provides the key interfaces for interacting with the Laravel application. The routes handle user actions such as authentication, campaign management, and donations. Error handling and authentication are built into the responses, ensuring proper feedback for the end users.