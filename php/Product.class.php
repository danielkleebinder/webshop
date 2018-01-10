<?php

/**
 * Simple product model class.
 *
 * @author Daniel Kleebinder
 */
class Product {

    private $id;
    private $name;
    private $description;
    private $rating;
    private $imgpath;
    private $price;

    function __construct($name, $description, $rating, $imgpath, $price) {
        $this->name = $name;
        $this->description = $description;
        $this->rating = $rating;
        $this->imgpath = $imgpath;
        $this->price = $price;
    }

    function set_id($id) {
        $this->id = $id;
    }

    function get_id() {
        return $this->id;
    }

    function set_name($name) {
        $this->name = $name;
    }

    function get_name() {
        return $this->name;
    }

    function set_description($description) {
        $this->description = $description;
    }

    function get_description() {
        return $this->description;
    }

    function set_rating($rating) {
        $this->rating = $rating;
    }

    function get_rating() {
        return $this->rating;
    }

    function set_imgpath($imgpath) {
        $this->imgpath = $imgpath;
    }

    function get_imgpath() {
        return $this->imgpath;
    }

    function set_price($price) {
        $this->price = $price;
    }

    function get_price() {
        return $this->price;
    }

}
