<?php

    include('config/db_connection.php');


// fuctions for SQL queries
// ************************************************************************** //
    function insert_SQL($table, $input=[]){

        global $pdo;

        // create a query
        $sql = "INSERT INTO $table(";
        $i = 0;
        foreach($input as $key=>$value){
            if($i==0){
                $sql = $sql . "$key";
                $i ++;
            }else{
                $sql = $sql . ", $key";
            }
        }
        $sql = $sql . ") VALUES (";
        $i = 0;
        foreach($input as $key=>$value){
            if($i==0){
                $sql = $sql . "'$value'";
                $i++;
            }else{
                $sql = $sql . ", '$value'";
            }
        }       
        $sql = $sql . ")";

        // run the query        
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute();
    }

// ************************************************************************** //
    function select_SQL($table, $filter=[]){
        global $pdo;
        $sql = "SELECT * FROM $table";

        // if there is no filter, return whole table
        if(empty($filter)){
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        // if there is a filter 
        else{
            $i = 0;
            foreach($filter as $key=>$value){
                // for first filter put WHERE and 
                if($i==0){
                    $sql = $sql . " WHERE $key = '$value'";
                    $i ++;
                }
                // for other filters put AND
                else{
                    $sql = $sql . " AND $key = '$value'";
                }
            }

            // run the query
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            // put results in variable
            $result = $stmt->fetchAll();
            return $result;
        }
    }


// ************************************************************************** //
    function delete_SQL($table, $id){
        global $pdo;

        // create a query
        $sql = "DELETE FROM $table WHERE $id[0] = '$id[1]'";

        // run the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }


// ************************************************************************** //
    function update_SQL($table, $id, $input){
        global $pdo;

        // create a query
        $sql = "UPDATE $table SET ";
        $i = 0;
        foreach($input as $key=>$value){
            if($i == 0){
                $sql = $sql . "$key = '$value'";
                $i++;
            }
            else{
                $sql = $sql . ", $key = '$value'";
            }
        }
        $sql = $sql . " WHERE $id[0] = $id[1]";

        // run the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

?>