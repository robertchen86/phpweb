<?php
/////////////////////////////////////////////////////////////////////////////
//
// SpeedPHP - ���ٵ�����PHP���
//
// Copyright (c) 2008 - 2009 SpeedPHP.com All rights reserved.
//
// ���Э����鿴 http://www.speedphp.com/
//
/////////////////////////////////////////////////////////////////////////////

/**
 * db_pdo_mysql PDO MySQL����������
 */
class db_pdo_mysql extends db_pdo {
	/**
	 * ��ȡ���ݱ�ṹ
	 *
	 * @param tbl_name  ������
	 */
	public function getTable($tbl_name){
		return $this->getArray("DESCRIBE {$tbl_name}");
	}
}
/**
 * db_pdo_sqlite PDO Sqlite����������
 */
class db_pdo_sqlite extends db_pdo {
	/**
	 * ��ȡ���ݱ�ṹ
	 *
	 * @param tbl_name  ������
	 */
	public function getTable($tbl_name){
		$tmptable = $this->conn->query("SELECT sql FROM SQLITE_MASTER type = table AND name = '{$tbl_name}'");
		$tmp = explode('[',$tmptable['sql']);
		foreach( $tmp as $value ){
			$towarr = explode(']', $value);
			if( isset($towarr[1]) )$columns[]['Field'] = $towarr[0];
		}
		array_shift($columns);
		return $columns;
	}
}

/**
 * db_pdo PDO������ 
 */
class db_pdo {
	/**
	 * ���ݿ����Ӿ��
	 */
	public $conn;
	/**
	 * ִ�е�SQL����¼
	 */
	public $arrSql;
	/**
	 * execִ��Ӱ������
	 */
	private $num_rows;

	/**
	 * ��SQL����ȡ��¼�������������
	 * 
	 * @param sql  ִ�е�SQL���
	 */
	public function getArray($sql)
	{
		$this->arrSql[] = $sql;
		$rows = array();
		while($rows[] = $this->conn->query($sql)){}
		return $rows;
	}
	
	/**
	 * ���ص�ǰ�����¼������ID
	 */
	public function newinsertid()
	{
		return $this->conn->lastInsertId();
	}
	
	/**
	 * ��ʽ����limit��SQL���
	 */
	public function setlimit($sql, $limit)
	{
		return $sql. " LIMIT {$limit}";
	}

	/**
	 * ִ��һ��SQL���
	 * 
	 * @param sql ��Ҫִ�е�SQL���
	 */
	public function exec($sql)
	{
		$this->arrSql[] = $sql;
		$result = $this->conn->exec($sql);
		if( FALSE !== $result ){
			$this->num_rows = $result;
			return $result;
		}else{
			spError("{$sql}<br />ִ�д���: " .$this->conn->errorInfo());
		}
	}
	
	/**
	 * ����Ӱ������
	 */
	public function affected_rows()
	{
		return $this->num_rows;
	}

	/**
	 * ��ȡ���ݱ�ṹ
	 *
	 * @param tbl_name  ������
	 */
	public function getTable($tbl_name){}

	/**
	 * ���캯��
	 *
	 * @param dbConfig  ���ݿ�����
	 */
	public function __construct($dbConfig)
	{
		if(!class_exists("PDO"))spError('PHP����δ��װPDO�����⣡');
		try {
		    $this->conn = new PDO($dbConfig['host'], $dbConfig['login'], $dbConfig['password']); 
		} catch (PDOException $e) {
		    echo '���ݿ����Ӵ���/�޷��ҵ����ݿ� :  ' . $e->getMessage();
		}
	}
	/**
	 * �������ַ����й���
	 *
	 * @param value  ֵ
	 */
	public function __val_escape($value) {
		if(is_null($value))return null;
		if(is_bool($value))return $value ? 1 : 0;
		if(is_int($value))return (int)$value;
		if(is_float($value))return (float)$value;
		if(@get_magic_quotes_gpc())$value = stripslashes($value);
		return $this->conn->quote($value);
	}

	/**
	 * ��������
	 */
	public function __destruct(){
		$this->conn = null;
	}
	
	/**
	 * getConn ȡ��PDO����
	 */
	public function getConn()
	{
		return $this->conn;
	}
}

