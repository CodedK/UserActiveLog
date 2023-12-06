# UserActiveLog
Monitor and manage active users in a PHP web application. Active users are those who are currently using the application. 


- **getShmKey Function:** This function generates a unique key for shared memory, which is used to store data that can be accessed by multiple parts of the application. It ensures that the data is unique across the system.

- **getSessionKey Function:** This function generates a session key based on a user's session ID. The session key is a unique identifier for each user's session.

- **updateActiveUsers Function:** This function updates a list of active users and their last activity timestamps in shared memory. It ensures that the application keeps track of when users were last active.

- **getActiveUsersCount Function:** This function calculates the count of active users within a specified timeout period. It helps identify users who are currently using the application and removes inactive users from the count.

- **Usage:** Finally, the code demonstrates how to use these functions. It updates the list of active users and calculates the count of active users, which can be used for various purposes, such as analytics or user engagement tracking.

