<?php
/**
 * Created by PhpStorm.
 * User: McCalister
 * Date: 20.11.2019
 * Time: 13:32
 */

ini_set('error_reporting', E_ALL);

interface iTag
{
    // Геттер имени:
    public function getName();

    // Геттер текста:
    public function getText();

    // Геттер всех атрибутов:
    public function getAttrs();

    // Геттер одного атрибута по имени:
    public function getAttr($name);

    // Открывающий тег, текст и закрывающий тег:
    public function show();

    // Открывающий тег:
    public function open();

    // Закрывающий тег:
    public function close();

    // Установка текста:
    public function setText($text);

    // Установка атрибута:
    public function setAttr($name, $value = true);

    // Установка атрибутов:
    public function setAttrs($attrs);

    // Удаление атрибута:
    public function removeAttr($name);

    // Установка класса:
    public function addClass($className);

    // Удаление класса:
    public function removeClass($className);
}

class Tag implements iTag
{
    private $name;
    private $attrs = [];
    private $text = '';

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getAttrs()
    {
        return $this->attrs;
    }

    public function getAttr($name)
    {
        if (isset($this->attrs[$name])) {
            return $this->attrs[$name];
        } else {
            return null;
        }
    }

    public function show()
    {
        return $this->open() . $this->text . $this->close();
    }

    public function open()
    {
        $name = $this->name;
        $attrsStr = $this->getAttrsStr($this->attrs);

        return "<$name$attrsStr>";
    }

    public function close()
    {
        $name = $this->name;
        return "</$name>";
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    public function setAttr($name, $value = true)
    {
        $this->attrs[$name] = $value;
        return $this;
    }

    public function setAttrs($attrs)
    {
        foreach ($attrs as $name => $value) {
            $this->setAttr($name, $value);
        }

        return $this;
    }

    public function removeAttr($name)
    {
        unset($this->attrs[$name]);
        return $this;
    }

    public function addClass($className)
    {
        if (isset($this->attrs['class'])) {
            $classNames = explode(' ', $this->attrs['class']);

            if (!in_array($className, $classNames)) {
                $classNames[] = $className;
                $this->attrs['class'] = implode(' ', $classNames);
            }
        } else {
            $this->attrs['class'] = $className;
        }

        return $this;
    }

    public function removeClass($className)
    {
        if (isset($this->attrs['class'])) {
            $classNames = explode(' ', $this->attrs['class']);

            if (in_array($className, $classNames)) {
                $classNames = $this->removeElem($className, $classNames);
                $this->attrs['class'] = implode(' ', $classNames);
            }
        }

        return $this;
    }

    private function getAttrsStr($attrs)
    {
        if (!empty($attrs)) {
            $result = '';

            foreach ($attrs as $name => $value) {
                if ($value === true) {
                    $result .= " $name";
                } else {
                    $result .= " $name=\"$value\"";
                }
            }

            return $result;
        } else {
            return '';
        }
    }

    private function removeElem($elem, $arr)
    {
        $key = array_search($elem, $arr);
        array_splice($arr, $key, 1);

        return $arr;
    }
}

class Image extends Tag
{
    private $attrs;
    public function __construct()
    {
        $this->setAttr('src', '');
        $this->setAttr('alt', '');
        parent::__construct('img');
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return parent::show();
    }
}

class ListItem extends Tag
{
    public function __construct()
    {
        parent::__construct('li');
    }

}

class HtmlList extends Tag
{
    public $lists = [];

    public function addItem($li)
    {
        $this->lists[] = $li;
        return $this;
    }


}

$ul = new HtmlList('ul');
echo $ul->addItem( (new ListItem())->setText("1") )->addItem( (new ListItem())->setText('2') )->show();

//$test = new Image();
//echo $test->setAttrs(['src'=>'images/1.jpg', 'width'=>'300px', 'height'=>'200px']);

