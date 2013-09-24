<?php

class Blog_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        //,b,mnbm,nbm,n
    }

    public function indexAction()
    {
       // action body
        $this->view->headTitle('Блог', PREPEND);
        // Создаём объект нашей модели
	    $blog = new Blog_Model_Blog();
            //print_r($blog->getBlog(1));//exit();
            $this->view->blog = $blog->fetchAll();
    }
    public function addAction(){
        // Создаём форму
        $form = new Application_Form_Blog();

        // Указываем текст для submit
        $form->submit->setLabel('Додати пост');

        // Передаём форму в view
        $this->view->form = $form;

        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                // Извлекаем название посту
                $title = $form->getValue('post_title');
                // Извлекаем пост
                $content = $form->getValue('post_content');

                // Создаём объект модели
                $blog = new Application_Model_DbTable_Blog();

                // Вызываем метод модели addMovie для вставки новой записи
                $blog->addBlog($title, $content);

                // Используем библиотечный helper для редиректа на action = index
                $this->_helper->redirector('index');
            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }
    }

    public function editAction(){
        // Создаём форму
        $form = new Application_Form_Blog();

        // Указываем текст для submit
        $form->submit->setLabel('Зберегти');
        $this->view->form = $form;
        $id = $this->getRequest()->getPost('id');
        if($this->getRequest()->getPost()){
            // Принимаем его
	        $formData = $this->getRequest()->getPost();
	         print_r($formData);
	        // Если форма заполнена верно
	        if ($form->isValid($formData)) {
	            // Извлекаем id
	            $id = (int)$form->getValue('id');
	             
	            // Извлекаем режиссёра
	            $title = $form->getValue('post_title');
	             
	            // Извлекаем название фильма
	            $content = $form->getValue('post_content');
	             
	            // Создаём объект модели
	            $blog = new Application_Model_DbTable_Blog();
	             
	            // Вызываем метод модели updateMovie для обновления новой записи
	            $blog->updateBlog($id, $title, $content);
	             
	            // Используем библиотечный helper для редиректа на action = index
	            $this->_helper->redirector('index');
                }
           
       }else{
            // Если мы выводим форму, то получаем id поста, который хотим обновить
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                // Создаём объект модели
                $blog = new Application_Model_DbTable_Blog();
               
                // Заполняем форму информацией при помощи метода populate
                $form->populate($blog->getBlog($id));
                
            }
       }   
        
    
    } 
    public function deleteAction(){
    // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем значение
            $del = $this->getRequest()->getPost('del');

            // Если пользователь подтвердил своё желание удалить запись
            if ($del == 'Да') {
                // Принимаем id записи, которую хотим удалить
                $id = $this->getRequest()->getPost('id');

                // Создаём объект модели
                $blog = new Application_Model_DbTable_Blog();

                // Вызываем метод модели deleteMovie для удаления записи
                $blog->deleteBlog($id);
             }

            // Используем библиотечный helper для редиректа на action = index
            $this->_helper->redirector('index');
        } else {
            // Если запрос не Post, выводим сообщение для подтверждения
            // Получаем id записи, которую хотим удалить
            $id = $this->_getParam('id');

            // Создаём объект модели
            $blog = new Application_Model_DbTable_Blog();

            // Достаём запись и передаём в view
            $this->view->blog = $blog->getBlog($id);
        }
    }
}

