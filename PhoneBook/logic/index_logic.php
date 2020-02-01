<?php

    include "modules/SQL.php";

    // declaration of global variables
    $table = "contacts";

    $errors = array('name_add'=>'', 'number_add'=>'', 'name_edit'=>'', 'number_edit'=>'', 'edit'=>'',
                     'id_edit'=>'', 'name_search'=>'', 'number_search'=>'', 'search'=>'');
    $contacts = [];

    // handle control buttons
    if(isset($_POST['add_btn'])){
        $errors = add_contact($table, $errors);
        $contacts = show_contacts($table);
    }
    if(isset($_POST['show_all_btn'])){
        $contacts = show_contacts($table);
    }
    if(isset($_POST['delete_btn'])){
        delete_contact($table, $errors);
        $contacts = show_contacts($table);
    }
    if(isset($_POST['edit_btn'])){
        $errors = edit_contact($table, $errors);
        $contacts = show_contacts($table);
    }
    if(isset($_POST['search_btn'])){
        $results = search_contact($table, $errors);
        $errors = $results['errors'];
        $contacts = $results['contacts'];

    }

    // handle delete button next to a row
    if(isset($_GET['delete_btn'])){
        $errors = delete_contact_get($table, $errors);
        $contacts = show_contacts($table);
    }


// fuctions for buttons
// ************************************************************************** //
    function add_contact($table, $errors){

        $name = $number = "";

        if(empty($_POST['name'])){
            $errors['name_add'] = 'Name cant be empty';
        }
        else{
            $name = $_POST['name'];
            if(!preg_match('/^[a-zA-Z]*$/', $name)){
                $errors['name_add'] = 'Name must be letters only';
            }
        }

        if(empty($_POST['number'])){
            $errors['number_add'] = 'Number cant be empty';
        }
        else{
            $number = $_POST['number'];
            if(!preg_match('/^[0-9]*$/', $number)){
                $errors['number_add'] = 'Number must be numbers only';
            }
        }

        if(!array_filter($errors)){		
            $input = ["name" => "$name", "phone" => "$number"];
            insert_SQL($table, $input);
        }

        return $errors;
    }


// ************************************************************************** //
    function show_contacts($table){

        $contacts = select_SQL($table);
        return $contacts;
    }


// ************************************************************************** //
    function delete_contact($table){

        $id = ['id', $_POST['id']];
        delete_SQL($table, $id);

    }


// ************************************************************************** //
    function edit_contact($table, $errors){
        $id = $name = $number = "";
        $input = [];

        if(empty($_POST['name_edit']) and empty($_POST['number_edit'])){
            $errors['edit'] = "Name or number must be filled";
        }
        else{
            $name = $_POST['name_edit'];
            if(!preg_match('/^[a-zA-Z]*$/', $name)){
                $errors['name_edit'] = 'Name must be letters only';
            }
            $number = $_POST['number_edit'];
            if(!preg_match('/^[0-9]*$/', $number)){
                $errors['number_edit'] = 'Number must be numbers only';
            }
        }
    

        if(!array_filter($errors)){

            $id = ['id', $_POST['id']];

            if(!empty($_POST['name_edit'])){
                $name = $_POST['name_edit'];
                $input += ['name'=>$name];
            }
            if(!empty($_POST['number_edit'])){
                $number = $_POST['number_edit'];
                $input += ['phone'=>$number];
            }

            update_SQL($table, $id, $input);
        }

        return $errors;
    }


// ************************************************************************** //
    function search_contact($table, $errors){
        $name = $number = "";
        $contacts = [];
        $filter = [];

        $results = [];


        if(empty($_POST['name_search']) and empty($_POST['number_search'])){
            $errors['search'] = "Name or number must be filled";
        }
        else{
            $name = $_POST['name_search'];
            if(!preg_match('/^[a-zA-Z]*$/', $name)){
                $errors['name_search'] = 'Name must be letters only';
            }
            $number = $_POST['number_search'];
            if(!preg_match('/^[0-9]*$/', $number)){
                $errors['number_search'] = 'Number must be numbers only';
            }
        }

        if(!array_filter($errors)){

            if(!empty($_POST['name_search'])){
                $name = $_POST['name_search'];
                $filter += ['name'=>$name];
            }
            if(!empty($_POST['number_search'])){
                $number = $_POST['number_search'];
                $filter += ['phone'=>$number];
            }

            $contacts = select_SQL($table, $filter);

        }

        $results['errors'] = $errors;
        $results['contacts']= $contacts;

        return $results;
    }


// function for handling delete contact by button next to a row
    function delete_contact_get($table, $errors){

        $id = ['id',$_GET['delete_btn']];
        delete_SQL($table, $id);
    

        return $errors;
    }
?>