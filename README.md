## SHared-memory User Activity Monitoring in PHP Utility (SHAMPU)

"Shampoo" for your PHP User Activity 

The SHAMPU is a specialized tool designed to track and analyze active user sessions in web applications. This system is unique in its approach as it utilizes shared memory for data storage, bypassing the need for conventional database or file-based storage methods. This approach efficiently monitors user activities in real-time, making it an ideal solution for web applications where performance and scalability matter.

## Project Overview

In modern web applications, understanding user behavior is essential. Knowing how users interact with your application is invaluable, whether for analytics, session management, or providing personalized experiences. 
This PHP User Activity Monitoring System offers a streamlined way to achieve this, using shared memory for storing and accessing user activity data.


### Key Features

* **Shared Memory Implementation:** Utilizes shared memory for storing session data, allowing fast and efficient access without the overhead of disk I/O or database queries.
* **Unique Session Key Generation:** Employs a hashing mechanism to generate unique keys from user session IDs, ensuring each user's activity is tracked individually.
* **Real-time User Activity Monitoring:** Continuously updates and maintains active user data, enabling real-time monitoring of user sessions.
* **Efficient Active User Counting:** Offers a rapid method to calculate the number of active users within a specified timeout period, enhancing the ability to monitor user engagement.

## Usage

This monitoring system can be easily integrated into any PHP web application. The main functions, `updateActiveUsers` and `getActiveUsersCount`, are central to its operation. Here's how to use them:

```php
// Ensure a session is started
session_start();

// Update the user's last activity time in shared memory
updateActiveUsers();

```



```php
// Define a timeout period
$timeoutSeconds = 300; // Adjust as needed

// Retrieve the count of active users
$activeUsersCount = getActiveUsersCount($timeoutSeconds);

```



## Considerations

### Pros

* **Performance:** By avoiding disk I/O and database interactions, the system offers high performance, especially suitable for applications with frequent read/write operations.
* **Scalability:** Shared memory is inherently faster and more scalable than file-based or database systems for read-heavy scenarios.
* **Simplicity:** Eliminates the complexity of database setup and maintenance, providing a straightforward implementation.

### Cons

* **Persistence:** Data stored in shared memory is volatile and will be lost on system reboot or service restart, unlike database storage.
* **Limited Storage:** Shared memory has a size limit, which might not be suitable for applications with many concurrent sessions.
* **Environment Specific:** Shared memory might not be supported in all hosting environments (shared hosting setups).

### Scalability Issues

* While shared memory provides fast access for read operations, it might become a bottleneck in write-heavy scenarios, especially with many concurrent user sessions.
* The management of shared memory segments can become complex as the user base grows, requiring more sophisticated synchronization mechanisms.
