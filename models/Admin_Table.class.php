<?php

include_once "models/Table.class.php";

class Admin_Table extends Table {
    public function create ( $email, $password ) {
        $this->checkEmail( $email );
        $sql = "INSERT INTO admin ( email, password )
                VALUES ( ?, MD5(?) )";
        $data = array( $email, $password );
        $this->makeStatement( $sql, $data );
    }

    private function checkEmail( $email ) {
        $sql = "SELECT email FROM admin WHERE email = ?";
        $data = array( $email );
        $this->makeStatement( $sql, $data );
        $statement = $this->makeStatement( $sql, $data );
        if ( $statement->rowCount() === 1 ) {
            $e = new Exception("Error: '$email' already used!");
            throw $e;
        }
    }

    public function checkCredentials ( $email, $password ) {
        $sql = "SELECT email FROM admin WHERE email = ? AND password = MD5(?)";
        $sql2 = "SELECT email FROM admin WHERE email = ?";
        $data = array( $email, $password );
        $statement = $this->makeStatement( $sql, $data );
        $data2 = array( $email );
        $statement2 = $this->makeStatement( $sql2, $data2 );
        if ($statement->rowCount() === 1 ) {
            $out = true;
        } elseif ( $statement2->rowCount() === 1 ) {
            $loginProblem = new Exception( "Wrong password, please try again!" );
            throw $loginProblem;
        } else {
            $loginProblem = new Exception( "The supplied e-mail does not match any record in the system, 
                                                    please try again" );
            throw $loginProblem;
        }
        return $out;
    }

    /*public function checkCredentials ( $email, $password ) {
        $sql = "SELECT email FROM admin WHERE email = ? AND password = MD5(?)";
        $data = array( $email, $password );
        $statement = $this->makeStatement( $sql, $data );
        if ($statement->rowCount() === 1 ) {
            $out = true;
        } else {
            $loginProblem = new Exception( "WTF! Login failed!" );
            throw $loginProblem;
        }
        return $out;
    }*/
}