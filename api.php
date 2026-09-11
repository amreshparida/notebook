<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '0');
error_reporting(E_ALL);

// ==========================================
// 1. Database Configuration
// ==========================================
$dbHost     = getenv('ORACLE_DB_HOST')     ?: 'ORACLE_HOST';
$dbPort     = getenv('ORACLE_DB_PORT')     ?: '1521';
$dbService  = getenv('ORACLE_DB_SERVICE')  ?: 'SERVICE_NAME';
$dbUser     = getenv('ORACLE_DB_USER')     ?: 'DB_USER';
$dbPass     = getenv('ORACLE_DB_PASS')     ?: 'DB_PASSWORD';

$connectionString = "{$dbHost}:{$dbPort}/{$dbService}";

$conn = @oci_connect($dbUser, $dbPass, $connectionString, 'AL32UTF8');

if (!$conn) {
    $e = oci_error();
    http_response_code(500);
    echo json_encode([
        'status'  => 'error',
        'message' => 'Database connection failed',
        'error'   => $e['message'] ?? 'Unknown error'
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}

// ==========================================
// 2. Request Parameters (Defaults to your query)
// ==========================================
$employeeId   = $_GET['employee_id']    ?? '';
$batchType    = $_GET['batch_type']     ?? 'EVENT';
$destSystemId = isset($_GET['dest_system_id']) ? (int)$_GET['dest_system_id'] : 8;

// ==========================================
// 3. Form Query with Bind Variables
// ==========================================
$sql = "SELECT * 
        FROM PUBLISHED_MSG_DEST_SYSTEM 
        WHERE MESSAGE_ID IN (
            SELECT MESSAGE_ID 
            FROM PUBLISH_MESSAGES 
            WHERE SRC_EMPLOYEE_ID = :emp_id 
              AND BATCH_TYPE = :batch_type
        ) 
        AND DEST_SYSTEM_ID = :dest_system_id
        ORDER BY PUB_MSG_DEST_SYSTM_ID DESC";

$stmt = oci_parse($conn, $sql);

if (!$stmt) {
    $e = oci_error($conn);
    http_response_code(500);
    echo json_encode(['status' => 'error', 'error' => $e['message']]);
    oci_close($conn);
    exit;
}

// Bind parameters safely
oci_bind_by_name($stmt, ':emp_id', $employeeId);
oci_bind_by_name($stmt, ':batch_type', $batchType);
oci_bind_by_name($stmt, ':dest_system_id', $destSystemId, -1, SQLT_INT);

// Execute statement
if (!@oci_execute($stmt)) {
    $e = oci_error($stmt);
    http_response_code(500);
    echo json_encode([
        'status'  => 'error',
        'message' => 'Query execution failed',
        'error'   => $e['message']
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    oci_free_statement($stmt);
    oci_close($conn);
    exit;
}

// ==========================================
// 4. Fetch All Records as JSON
// ==========================================
$rows = [];
while (($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) !== false) {
    $rows[] = $row;
}

oci_free_statement($stmt);
oci_close($conn);

// ==========================================
// 5. Send JSON Response
// ==========================================
http_response_code(200);
echo json_encode([
    'status' => 'success',
    'count'  => count($rows),
    'filter' => [
        'src_employee_id' => $employeeId,
        'batch_type'      => $batchType,
        'dest_system_id'  => $destSystemId
    ],
    'data'   => $rows
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
