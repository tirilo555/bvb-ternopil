<?php

class Blog_Model_Blog extends Zend_Db_Table_Abstract
{
  protected $_name = 'blog';
	     
	    // Метод для отримання постів за id
	    public function getBlog($id){
	        // Получаем id как параметр
	        $id = (int)$id;
	 
	        // Используем метод fetchRow для получения записи из базы.
	        // В скобках указываем условие выборки (привычное для вас where)
	        $row = $this->fetchRow('id = ' . $id);
	 
	        // Если результат пустой, выкидываем исключение
	        if(!$row) {
	            throw new Exception("Нет записи с id - $id");
	        }
	        // Возвращаем результат, упакованный в массив
	        return $row->toArray();	        
	    }

}

