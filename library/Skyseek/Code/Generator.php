<?php
/** 
 * Skyseek License, Version 1.0
 * 
 * This file contains Original Code and/or Modifications of Original Code
 * as defined in and that are subject to the Skyseek License
 * Version 1.0 (the 'License'). You may not use this file except in
 * compliance with the License. Please obtain a copy of the License at
 * http://www.skyseek.com/License/Version1 and read it before using this
 * file.
 * 
 * The Original Code and all software distributed under the License are
 * distributed on an 'AS IS' basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND APPLE HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 * 
 * @package    Skyseek
 * @subpackage Development_Tools
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 */






/**
 * Generator
 *
 * @package    Skyseek
 * @subpackage Development_Tools
 * @copyright  Copyright (c) 2011, Skyseek Technologies.
 * @license    http://www.skyseek.com/License/Version1     Skyseek License, Version 1.0
 * @author     Sean Thayne <sean@skyseek.com
 */
class Skyseek_Code_Generator {
	
	public static function generateVOClassesFromObject($object, $as3ClassName, $phpClassName) {
		$array = array();
		
		foreach($object as $property=>$value)
			$array[$property] = $value;
		
		self::generateVOClasses($array, $as3ClassName, $phpClassName);
	}

	public static function generateVOClasses($row, $as3ClassName, $phpClassName) {
		echo "<h1>AS3 VO</h1>";
		echo "<pre>";
		echo "package com.skyseek.model.vo\n";
		echo "{\n";
		echo "\t[Bindable]\n";
		echo "\t[RemoteClass( alias=\"$phpClassName\" )]\n";
		echo "\tpublic class $as3ClassName {\n";

		foreach($row as $prop=>$value)
			echo "\t\tpublic var $prop:String;\n";

		echo "\t}\n";
		echo "}\n";
		echo "</pre>";
		echo "<h1>PHP VO</h1>";
		echo "<pre>";
		echo "class $phpClassName extends Skyseek_VO {\n";

		foreach($row as $prop=>$value)
			echo "\tpublic \$$prop;\n";
		
		echo "}\n";
		echo "</pre>";

	}
	
	public static function generateVOClassesFromDBTable($tableName, $as3ClassName, $phpClassName) {
		$table = new Skyseek_DB_Table('Music');
		$row = $table->fetchRow()->toArray();
		self::generateVOClasses($row, $as3ClassName, $phpClassName);
	}

	public static function createAS3ClassName($tableName) {
		$tableNameArray = explode('_', $tableName);

		for($i=0; $i<count($tableNameArray); $i++)
			$tableNameArray[$i]{0} = strtoupper($tableNameArray[$i]{0});

		return implode('', $tableNameArray) . "VO";

	}

	public static function createZendClassName($tableName, $package) {
		$tableNameArray = explode('_', $tableName);

		for($i=0; $i<count($tableNameArray); $i++)
			$tableNameArray[$i]{0} = strtoupper($tableNameArray[$i]{0});


		return $package . '_' . implode('_', $tableNameArray) . '_VO';
	}

	public static function createAS3VO($className, $alias, $package, $tableVOObject) {
		$vo  = "package $package\n";
		$vo .= "{\n";
		$vo .= "\t[Bindable]\n";
		$vo .= "\t[RemoteClass( alias=\"$alias\" )]\n";
		$vo .= "\tpublic class $className {\n";

		foreach($tableVOObject as $col=>$idk)
			$vo .= "\t\tpublic var $col:String;\n";

		$vo .= "\t}\n";
		$vo .= "}\n";

		return $vo;
	}

	public static function createZendVO($className, $tableVOObject) {
		$vo  = "class $className extends Skyseek_VO {\n";

		foreach($tableVOObject as $prop=>$value)
			$vo .= "\tpublic \$$prop;\n";

		$vo .= "}\n";

		return $vo;
	}

	public static function generateVOClassesFromAllDBTables($as3Package, $phpPackage) {
		$showTable = new Skyseek_DB_Table('');
		$showTable = $showTable->getDefaultAdapter();
		$tables    = $showTable->query("SHOW TABLES;");

		// create object
		$zip = new ZipArchive();
		$zipFileName = 'generatedVOs.zip';
		$zipFile = $zip->open($zipFileName, ZipArchive::CREATE);

		foreach($tables as $tableInfo) {
			$tableName = array_pop($tableInfo);
			$tableInfo = $showTable->query("DESCRIBE $tableName;");
			$tableVOObject = new stdClass();

			foreach($tableInfo as $column)
				$tableVOObject->$column['Field'] = true	;

			$as3ClassName = self::createAS3ClassName($tableName);
			$phpClassName = self::createZendClassName($tableName, $phpPackage);

			$as3VO = self::createAS3VO($as3ClassName, $phpClassName, $as3Package, $tableVOObject);
			$phpVO = self::createZendVO($phpClassName, $tableVOObject);

			$as3PathName = str_replace('.', '/', $as3Package) . '/' . $as3ClassName . '.as';
			$phpPathName = str_replace('_', '/', $phpClassName) . '.php';

			$zip->addFromString('as3/' . $as3PathName, $as3VO);
			$zip->addFromString('php/' . $phpPathName, "<?php\n" . $phpVO);
		}

		$zip->close();

		header('content-type: application/zip');
		header('content-disposition: attachment; filename=generatedVOs.zip');

		$zip = file_get_contents($zipFileName);
		echo $zip;
		unlink($zipFileName);

		exit;
	}
}
