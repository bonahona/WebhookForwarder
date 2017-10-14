<?php
class Home extends Controller
{

    public function Index()
    {
        return $this->HttpNotFound();
    }
}