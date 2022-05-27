<?php

/**
 * (describing requirements with my own words, as i remember them - but this is what was required)
 * 
 * A category tree is an array with elements, each element in the tree is unique.
 * An element can be a root(no parent) or can have a parent
 * 
 * TODO:
 * -when adding a category, if it already exists, throw an InvalidArgumentException with a message
 * -when adding a category, if the parent doesn't exist, throw an InvalidArgumentException with a message
 * -implement the addCategory() and getChildren() methods
 */

class CategoryTree
{
    public $tree = []; // multidimensional array - our category tree

    public function addCategory(string $category, string $parent=null) //: void
    {        
        if($this->categoryExists($category, $this->tree)) {            
            throw new InvalidArgumentException('Category already exists.');
        }

        if($parent != null && !$this->categoryExists($parent, $this->tree)) {
            throw new InvalidArgumentException('The specified parent does not exist.');
        }

        if($parent === null) {
            $this->tree[$category] = [];
        } else {
            $this->addElemByParent($category, $parent, $this->tree);
        }
    }

    public function getChildren(string $parent) : array
    {
        return $this->getChildrenByParent($parent, $this->tree);
    }

    private function categoryExists(string $cat, array $arr) : bool
    {
        foreach($arr as $key => $val) {
            if($cat === $key) {
                return true;
            } else if(count($val)) {
               return $this->categoryExists($cat, $val);
            }
        }

        return false;
    }

    private function addElemByParent(string $cat, string $parent, array &$arr) : array
    {
        foreach($arr as $key => &$val) { // http://docs.php.net/manual/en/control-structures.foreach.php
            if($parent === $key) {
                $arr[$key][$cat] = [];                 
                return $arr;
            } else if(count($val)) {
                 return $this->addElemByParent($cat, $parent, $val);                
                //  $this->addElemByParent($cat, $parent, $arr[$key]); // or you can use it like this BUT you must drop the reference for $val
                    // https://stackoverflow.com/questions/1216552/php-pass-by-reference-in-recursive-function-not-working
            }
        }
        // unset($val); // ? not sure if needed, it works wo it // http://docs.php.net/manual/en/control-structures.foreach.php
    }

    private function getChildrenByParent(string $parent, array $arr) : array
    {
        foreach($arr as $key => $val) {
            if($parent === $key) {
                return array_keys($arr[$parent]);
            } else if(count($val)) {
                return $this->getChildren($parent, $arr[$key]);
            }

            return [];
        }
    }
}

$c = new CategoryTree;
$c->addCategory('A', null);
$c->addCategory('B', 'A');
$c->addCategory('C', 'A');
// $c->addCategory('B', null); // Fatal error: Uncaught InvalidArgumentException: Category already exists.
// $c->addCategory('B', 'A'); // Fatal error: Uncaught InvalidArgumentException: Category already exists.
// $c->addCategory('Y', 'X'); // Fatal error: Uncaught InvalidArgumentException: The specified parent does not exist.
$c->addCategory('D', 'B');

var_dump($c->tree);
echo implode(',', $c->getChildren('A'));