<?php

namespace Xmf\Controller;

class Crud extends Base
{
    public function getRead()
    {
        echo "You should overload getRead()";
    }

    public function getUpdate($id)
    {
        echo "You should overload getUpdate()";
    }

    public function patchUpdate($id)
    {
        echo "You should overload patchUpdate()";
    }

    public function getCreate()
    {
        echo "You should overload getCreate()";
    }

    public function postCreate()
    {
        echo "You should overload postCreate()";
    }

    public function putCreate()
    {
        echo "You should overload putCreate()";
    }

//    public function create($item) {}
//    public function read($item) {}
//    public function update($item) {}
//    public function delete($item) {}
}