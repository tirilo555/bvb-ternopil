<?php

class Application_Form_Blog extends Zend_Form
{
    // Метод init() вызовется по умолчанию
    public function init()
    {
        // Задаём имя форме
        $this->setName('form');

        // Создаём переменную, которая будет хранить сообщение валидации
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';

         // Создаём элемент hidden c именем = id
	        $id = new Zend_Form_Element_Hidden('id');
	        // Указываем, что данные в этом элементе фильтруются как число int
	        $id->addFilter('Int');
        
        // Создаём перший текстовой элемент формы и проделываем те же операции
        $title = new Zend_Form_Element_Text('post_title');
        $title->setLabel('Тема')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
        // Создаём другий текстовой элемент формы и проделываем те же операции
        $content = new Zend_Form_Element_Textarea('post_content');
        $content->setLabel('Повідомлення')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
        
        // Создаём элемент формы Submit c именем = submit
        $submit = new Zend_Form_Element_Submit('submit');
        // Создаём атрибут id = submitbutton
        $submit->setAttrib('id', 'submitbutton');

        // Добавляем все созданные элементы к форме.
        $this->addElements(array($id, $title, $content, $submit));
    }
}

