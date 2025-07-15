<?php
/**
 * Test file to debug null coalescing operator
 */

// Test 1: Basic null coalescing
$test1 = null;
echo 'Test 1: ' . ( $test1 ?? 'default' ) . "\n";

// Test 2: Empty string
$test2 = '';
echo 'Test 2: ' . ( $test2 ?? 'default' ) . "\n";

// Test 3: Zero
$test3 = 0;
echo 'Test 3: ' . ( $test3 ?? 'default' ) . "\n";

// Test 4: String zero
$test4 = '0';
echo 'Test 4: ' . ( $test4 ?? 'default' ) . "\n";

// Test 5: Undefined variable
echo 'Test 5: ' . ( $undefined_var ?? 'default' ) . "\n";

// Test 6: Compare with ternary
echo 'Test 6 (ternary): ' . ( $test1 ? $test1 : 'default' ) . "\n";
echo 'Test 6 (null coalescing): ' . ( $test1 ?? 'default' ) . "\n";

// Test 7: PHP version
echo 'PHP Version: ' . PHP_VERSION . "\n";
