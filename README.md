# PHP User Activity Monitoring System

The PHP User Activity Monitoring System is a lightweight and efficient solution designed to track and manage active users within a web application. It has been specifically engineered to operate without the need for traditional databases or file-based storage. Instead, this system leverages the power of shared memory to facilitate seamless communication and synchronization between application threads.

## Project Overview

In many web applications, it's crucial to monitor user activity to gain insights into user behavior, perform real-time analytics, or manage session lifetimes. The PHP User Activity Monitoring System accomplishes these tasks without introducing the overhead of database queries or file I/O operations.

### Key Features

- **Shared Memory Usage:** The system generates unique keys for shared memory segments, allowing multiple parts of the application to efficiently communicate and share data without the need for intermediary files or databases.
- **Session Key Generation:** A session key is generated based on a user's session ID, providing a unique identifier for each user's session. This session key simplifies tracking and synchronization.
- **Real-time Activity Tracking:** The system updates and maintains a list of active users and their last activity timestamps in shared memory. This ensures real-time tracking of user activity without relying on traditional file or database storage.
- **Efficient User Count Calculation:** The system can efficiently calculate the count of active users within a specified timeout period. This enables the identification of users currently engaged with the application without resorting to file or database interactions.

## Usage

To integrate this monitoring system into your PHP web application, simply follow the provided code examples for functions like `updateActiveUsers` and `getActiveUsersCount`. These functions demonstrate how to efficiently manage and track active users within your application using shared memory.

By adopting this solution, you can seamlessly monitor and analyze user activity in your web application while maintaining optimal performance and scalability without the complexity of database or file storage.

```php
// Include the monitoring system code or functions

// Start a session (if not already started)
session_start();

// Call the updateActiveUsers function to update the user's last activity time
updateActiveUsers();

// The user's last activity time has been updated in shared memory
// This can be used for real-time tracking and monitoring

```


```php

// Call the `getActiveUsersCount` function to get the count of active users within a specified timeout
$timeoutSeconds = 300; // You can customize the timeout as needed
$activeUsersCount = getActiveUsersCount($timeoutSeconds);

// $activeUsersCount now holds the count of users actively engaged with the application
// You can use this information for analytics, reporting, or other purposes


```
