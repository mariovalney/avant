<?php

/* 
 * Db Example: just a page to show how to use 'avdb' class.
 * 
 * @package Avant
 */

global $avdb;

/*************************************
 *  
 * Just Examples to use "avdb" class.
 * 
 * You must create your own public methods in "avdb" class.
 * All "anythingExample" methods can be rewritten or deleted.
 * All "__anything" methods must not be altered.
 * 
 **************************************/

/** The Table **/
$table = 'tb_table';

/** Columns params like in SQL **/
$columnsParams = array (
    'ID INT(11) AUTO_INCREMENT PRIMARY KEY',
    'field_one VARCHAR(50) NOT NULL',
    'field_two VARCHAR(50) NOT NULL',
    'field_three VARCHAR(50) NOT NULL'
);

/** Creating table with columns $columnsParams **/
//$avdb->createTableExample($table, $columnsParams);

/** Arrays $fields VS $values **/
$fields = ['field_one', 'field_two', 'field_three'];
$values = ['value_one', 'value_two', 'value_three'];

/** Inserting $values in corresponding $fields **/
//$avdb->insertExample($table, $fields, $values);

/** Arrays of $newValues to update the corresponding $fields **/
$newValues = ['new_value_one', 'new_value_two', 'new_value_three'];
$whereField = 'ID';
$whereValue = '3';

/** Updating $values in corresponding $fields where $whereValue (from $whereField) **/
//$avdb->updateExample($table, $fields, $newValues, $whereField, $whereValue);

/** Arrays of $columns to be returned by SELECT and array of $where (WHERE key LIKE value) **/
//$columns = ['ID', 'field_two'];
//$where = ['field_one' => '1', 'field_two' => 'new_value_two'];

/** Selecting $columns from $table where $where with AND **/
//$result = $avdb->selectExample($table, $columns, $where);
//print_r($result);

/** Selecting $columns from $table where $where with OR **/
//$logical = 'OR';
//$result = $avdb->selectExample($table, $columns, $where, $logical);
//print_r($result);

/** Selecting $columns from $table **/
//$result = $avdb->selectExample($table, $columns);
//print_r($result);

/** Selecting * from $table **/
$result = $avdb->selectExample($table);
print_r($result);

/** Deleting where $where from $table with AND **/
//$result = $avdb->deleteExample($table, $where);
//print_r($result);

/** Deleting where $where from $table with OR **/
//$logical = 'OR';
//$result = $avdb->deleteExample($table, $where, $logical);
//print_r($result);

/** Deleting all from $table **/
//$result = $avdb->deleteExample($table);
//print_r($result);



