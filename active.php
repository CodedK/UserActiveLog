<?php

define('SESSION_KEYS_ARRAY', 999999);

/**
 * getShmKey
 *
 * Generates a system-wide unique key for shared memory.
 *
 * @return int The unique shared memory key.
 */
function getShmKey() {
    $pathToFile = __FILE__; // You can use any existing file path
    $proj       = 't'; // Project identifier - should be a single character

    // echo "Key: ".ftok($pathToFile, $proj)."<br>";
    // echo "Inode: ".fileinode($pathToFile)."<br>";
    $key = ftok($pathToFile, $proj);

    if($key == -1) {
        throw new Exception("Unable to generate key for shared memory");
    }

    return $key;
}

/**
 * getSessionKey
 *
 * Generates a session key based on the provided session ID.
 *
 * @param string $sessionId The session ID.
 * @return int The generated session key.
 */
function getSessionKey($sessionId) {
    return crc32($sessionId);
}

/**
 * updateActiveUsers
 *
 * Updates the list of active users and their last activity timestamps in shared memory.
 *
 * @throws Exception If unable to attach to shared memory segment.
 */
function updateActiveUsers() {
    $shmKey = getShmKey();
    $shmId  = shm_attach($shmKey, 1024, 0666);

    if($shmId === false) {
        throw new Exception("Unable to attach to shared memory segment");
    }

    session_start();
    $sessionId   = session_id();
    $sessionKey  = getSessionKey($sessionId);
    $currentTime = time();

    // Update the session's last activity time
    shm_put_var($shmId, $sessionKey, $currentTime);

    // Update the array of active session keys
    $activeSessions              = shm_has_var($shmId, SESSION_KEYS_ARRAY) ? shm_get_var($shmId, SESSION_KEYS_ARRAY) : [];
    $activeSessions[$sessionKey] = true;
    shm_put_var($shmId, SESSION_KEYS_ARRAY, $activeSessions);

    shm_detach($shmId);
}

/**
 * getActiveUsersCount
 *
 * Gets the count of active users within a specified timeout period.
 *
 * @param int $timeoutSeconds The time (in seconds) that determines if a user is considered active.
 * @return int The count of active users.
 *
 * @throws Exception If unable to attach to shared memory segment.
 */
function getActiveUsersCount($timeoutSeconds = 300) {
    $shmKey = getShmKey();
    $shmId  = shm_attach($shmKey, 1024, 0666);

    if($shmId === false) {
        throw new Exception("Unable to attach to shared memory segment");
    }

    $activeUsersCount = 0;

    if(shm_has_var($shmId, SESSION_KEYS_ARRAY)) {
        $activeSessions = shm_get_var($shmId, SESSION_KEYS_ARRAY);

        foreach($activeSessions as $key => $value) {
            if(shm_has_var($shmId, $key)) {
                $lastActivity = shm_get_var($shmId, $key);
                if($lastActivity + $timeoutSeconds >= time()) {
                    $activeUsersCount++;
                } else {
                    // Remove inactive session from the array
                    unset($activeSessions[$key]);
                    shm_remove_var($shmId, $key);
                }
            }
        }

        // Update the array of active sessions
        shm_put_var($shmId, SESSION_KEYS_ARRAY, $activeSessions);
    }

    shm_detach($shmId);

    return $activeUsersCount;
}

updateActiveUsers();

$activeUsers = getActiveUsersCount();
echo "Active users: $activeUsers";
