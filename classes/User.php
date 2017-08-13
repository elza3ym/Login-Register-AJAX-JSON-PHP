<?php
Class User {
    public $response = array();
    public function login($email, $password) {
        if (empty($email) || empty($password)) {
            if ($email == "") {
                $this->response["error"] = "Email Can't be empty";
                $this->response["status"] = 0;
            }
            if ($password == "") {
                $this->response["error"] = "Password Can't be empty";
                $this->response["status"] = 0;
            }
        } else {
            $user = DB::getInstance()->get('users', ['email', '=', $email]);
            if($user->error()){
                $this->response["error"] = "There's Something Wrong.";
                $this->response["status"] = 0;
            } else {
                if ($user->count() == 1) {
                    $out = $user->results()[0];
                    if (password_verify($password, $out['password'])) {
                        Session::start($out['id']);
                        $this->response["error"] = null;
                        $this->response["status"] = 1;
                    } else {
                        $this->response["error"] = "The password doesn't match this email";
                        $this->response["status"] = 0;
                    }
                } else {
                    $this->response["error"] = "The email doesn't exist in our database";
                    $this->response["status"] = 0;
                }
            }
        }
        if(!$this->response["status"] == 1) {
            header('Content-Type: application/json');
            die(json_encode($this->response));
        } else {
            header('Content-Type: application/json');
            print json_encode($this->response);
        }
    }
    public  function register($name, $email, $password, $confirm_password, $phone) {
        if ($password == $confirm_password) {
            $unique = DB::getInstance()->get('users', ['email', '=', $email]);
            if (!$unique->results()){
                $password = Hash::gen($password);
                DB::getInstance()->insert('users', [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'phone' => $phone
                ]);
                $this->response["error"] = null;
                $this->response["status"] = 1;
            } else {
                $this->response["error"] = "The email is already registered";
                $this->response["status"] = 0;
            }
        } else {
            $this->response["error"] = "Password and confirmation doesn't match";
            $this->response["status"] = 0;
        }
        if(!$this->response["status"] == 1) {
            header('Content-Type: application/json');
            die(json_encode($this->response));
        } else {
            header('Content-Type: application/json');
            print json_encode($this->response);
        }
    }
    public function display($id) {
        $user = DB::getInstance()->get('users', ['id', '=', $id]);
        if ($user->count() == 1) {
            $out = $user->results();
            $string = '<ul class="list-data">';
            $string .= '<li>Name : '.$out[0]['name'].'</li>';
            $string .= '<li>Email : '.$out[0]['email'].'</li>';
            $string .= '<li>Phone : '.$out[0]['phone'].'</li>';
            $string .= '</ul>';
            $string .= '<button id="logout" name="logout" class="btn-submit btn-primary">Logout</button>';
        } else {
            $string = "Something Went Wrong";
        }
        return $string;
    }
    public function logout() {
        if (Session::check()){
            session_destroy();
            $this->response["error"] = null;
            $this->response["status"] = 1;
        } else {
            $this->response["error"] = "Something went Wrong";
            $this->response["status"] = 0;
        }
        if(!$this->response["status"] == 1) {
            header('Content-Type: application/json');
            die(json_encode($this->response));
        } else {
            header('Content-Type: application/json');
            print json_encode($this->response);
        }
    }
}