<?php

class Application_Model_DbTable_Blog extends Zend_Db_Table_Abstract{
    // Ім'я таблиці, з якою будемо працювати
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
	     
	   // Метод для добавление новой записи
	    public function addBlog($title, $content)
	    {
	        // Формируем массив вставляемых значений
	        $data = array(
	            'post_title' => $title,
                    'post_content'=>$content,
	        );
	         
	        // Используем метод insert для вставки записи в базу
	        $this->insert($data);
	    }
	     
	   // Метод для обновления записи
	    public  function updateBlog($id, $title, $content){
	        // Формируем массив значений
	        $data = array(
	            'post_title' =>$title,
                    'post_content'=>$content,
	        );
	         
	        // Используем метод update для обновления записи
	        // В скобках указываем условие обновления (привычное для вас where)
	        $this->update($data, 'id = ' . (int)$id);
	    }
	     
	   // Метод для удаления записи
	    public function deleteBlog($id)
	    {
	        // В скобках указываем условие удаления (привычное для вас where)
	        $this->delete('id = ' . (int)$id);
	    }
             


}

