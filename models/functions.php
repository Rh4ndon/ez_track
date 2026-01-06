<?php
include 'dbconn.php';

function insertRecord($table, $data)
{
    global $conn;
    $columns = implode(", ", array_keys($data));
    // Escape each value
    $escapedValues = array_map(function ($value) use ($conn) {
        return mysqli_real_escape_string($conn, $value);
    }, array_values($data));
    $values = implode("', '", $escapedValues);
    $query = "INSERT INTO $table ($columns) VALUES ('$values')";
    return mysqli_query($conn, $query);
}
function editRecord($table, $data, $condition)
{
    global $conn;
    $updateData = [];
    foreach ($data as $column => $value) {
        $escapedValue = mysqli_real_escape_string($conn, $value);
        $updateData[] = "$column = '$escapedValue'";
    }
    $updateString = implode(", ", $updateData);
    $query = "UPDATE $table SET $updateString WHERE $condition";
    return mysqli_query($conn, $query);
}

/**
 * Safely delete a record from any table
 * 
 * @param string $table Table name
 * @param mixed $id Record ID (or array for multiple conditions)
 * @param string $idColumn Column name for ID (default: 'id')
 * @return bool True on success, false on failure
 */
function deleteRecord($table, $id, $idColumn = 'id')
{
    global $conn;

    // Validate inputs
    if (empty($table) || empty($id)) {
        error_log("deleteRecord: Empty table name or ID");
        return false;
    }

    // Sanitize table and column names (allow only alphanumeric and underscores)
    $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table);
    $idColumn = preg_replace('/[^a-zA-Z0-9_]/', '', $idColumn);

    // Build WHERE clause based on input type
    if (is_array($id)) {
        // Multiple conditions
        return deleteRecordWithConditions($table, $id);
    } else {
        // Single ID
        return deleteRecordById($table, $id, $idColumn);
    }
}

/**
 * Delete record by ID (for single ID deletion)
 */
function deleteRecordById($table, $id, $idColumn = 'id')
{
    global $conn;

    // Convert ID to integer if numeric
    if (is_numeric($id)) {
        $id = (int)$id;
        $type = "i"; // integer
    } else {
        $type = "s"; // string
    }

    // Create prepared statement
    $query = "DELETE FROM `$table` WHERE `$idColumn` = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        error_log("deleteRecordById prepare failed: " . mysqli_error($conn));
        return false;
    }

    // Bind parameter
    mysqli_stmt_bind_param($stmt, $type, $id);

    // Execute
    $result = mysqli_stmt_execute($stmt);

    // Check if any row was affected
    $affectedRows = mysqli_stmt_affected_rows($stmt);

    // Close statement
    mysqli_stmt_close($stmt);

    return $result && $affectedRows > 0;
}

/**
 * Delete records with multiple conditions
 * 
 * @param string $table Table name
 * @param array $conditions Associative array of conditions [column => value]
 * @param string $operator AND or OR (default: AND)
 * @return bool True on success, false on failure
 */
function deleteRecordWithConditions($table, $conditions, $operator = 'AND')
{
    global $conn;

    if (empty($conditions) || !is_array($conditions)) {
        error_log("deleteRecordWithConditions: Invalid conditions array");
        return false;
    }

    // Validate operator
    $operator = strtoupper($operator);
    if (!in_array($operator, ['AND', 'OR'])) {
        $operator = 'AND';
    }

    // Sanitize table name
    $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table);

    // Build WHERE clause and bind parameters
    $whereClauses = [];
    $types = '';
    $values = [];

    foreach ($conditions as $column => $value) {
        // Sanitize column name
        $safeColumn = preg_replace('/[^a-zA-Z0-9_]/', '', $column);
        $whereClauses[] = "`$safeColumn` = ?";

        // Determine parameter type
        if (is_int($value)) {
            $types .= 'i';
        } elseif (is_float($value)) {
            $types .= 'd';
        } else {
            $types .= 's';
        }

        $values[] = $value;
    }

    // Build query
    $query = "DELETE FROM `$table` WHERE " . implode(" $operator ", $whereClauses);
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        error_log("deleteRecordWithConditions prepare failed: " . mysqli_error($conn));
        return false;
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, $types, ...$values);

    // Execute
    $result = mysqli_stmt_execute($stmt);
    $affectedRows = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);

    return $result && $affectedRows > 0;
}
function getAllRecords($table, $condition = '')
{
    global $conn;
    // WARNING: $condition must be safe (e.g., "AND status = 'active'")
    // Do NOT pass raw user input here.
    $query = "SELECT * FROM $table $condition";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getRecord($table, $condition)
{
    global $conn;
    // Same warning: $condition must be pre-validated
    $query = "SELECT * FROM $table WHERE $condition";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function getRecordMultiTable($table1, $table2, $onCondition, $whereCondition)
{
    global $conn;
    // All parameters assumed safe (not user-controlled)
    $query = "SELECT * FROM $table1 LEFT JOIN $table2 ON $onCondition WHERE $whereCondition";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function countAllRecords($table, $whereCondition = '1')
{
    global $conn;
    // $whereCondition must be safe
    $query = "SELECT COUNT(*) as total FROM $table WHERE $whereCondition";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function updateRecord($table, $data, $condition)
{
    global $conn;
    $updates = [];
    foreach ($data as $key => $value) {
        if ($value === null || $value === 'NULL') {
            $updates[] = "$key = NULL";
        } else {
            $updates[] = "$key = '" . mysqli_real_escape_string($conn, $value) . "'";
        }
    }
    $sql = "UPDATE $table SET " . implode(', ', $updates) . " WHERE $condition";
    return mysqli_query($conn, $sql);
}

function startTransaction()
{
    global $conn;
    mysqli_autocommit($conn, false);
    mysqli_begin_transaction($conn);
}

function commitTransaction()
{
    global $conn;
    mysqli_commit($conn);
    mysqli_autocommit($conn, true);
}

function rollbackTransaction()
{
    global $conn;
    mysqli_rollback($conn);
    mysqli_autocommit($conn, true);
}
