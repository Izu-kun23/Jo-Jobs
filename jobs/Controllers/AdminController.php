<?php

//namespace Controllers;
//use \functions\DatabaseTable;

use functions\DatabaseTable;

class AdminController
{

    public function index(): array
    {
        return ['template' => 'admin/adminIndex.html.php',
            'title' => 'admin/adminIndex',
            'variables' => []
        ];
    }

    public function categories(): array
    {
        return ['template' => 'admin/categories.html.php',
            'title' => 'admin/categories',
            'variables' => []
        ];
    }

    public function jobs(): array
    {
        return ['template' => 'admin/jobs.html.php',
            'title' => 'admin/jobs',
            'variables' => []
        ];
    }

    public function addjob(): array
    {
        if ($_POST) {

            $criteria = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'salary' => $_POST['salary'],
                'location' => $_POST['location'],
                'categoryId' => $_POST['categoryId'],
                'closingDate' => $_POST['closingDate'],
            ];
            $jobTable = new \functions\DatabaseTable('job', 'id');
            $jobTable->insert($criteria);
            echo 'Job Added';
        }
        return ['template' => 'admin/addjob.html.php',
            'title' => 'admin/addjob',
            'variables' => []
        ];
    }

    public function editJob(): array
    {

        $jobTable = new \functions\DatabaseTable('job', 'id');
        if (isset($_POST['submit'])) {
            $criteria = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'salary' => $_POST['salary'],
                'location' => $_POST['location'],
                'categoryId' => $_POST['categoryId'],
                'closingDate' => $_POST['closingDate'],
                'id' => $_POST['id']
            ];
            $jobTable->update($criteria);
             $jobTable = new \functions\DatabaseTable('job', 'id');

            echo 'Job saved';
        }
        $catTable = new \functions\DatabaseTable('category', 'id');
        $cat = $catTable->findAll();
        $jobs = $jobTable->find('id', $_GET['id']);
        return ['template' => 'admin/editjob.html.php',
            'title' => 'admin/editjob',
            'variables' => ['jobs' => $jobs, 'stmt' => $cat]
        ];

    }



    public function addcategory(): array
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            if (isset($_POST['submit'])) {

                $criteria = [
                    'name' => $_POST['name'],
                ];

                $catTable = new \functions\DatabaseTable('category', 'id');
                $catTable->insert($criteria);
                echo 'Category added';
            }

        }
        return ['template' => 'admin/addcategory.html.php',
            'title' => 'addcategory',
            'variables' => []
        ];
    }

    public function editcategory(): array
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

            if (isset($_POST['submit'])) {

                $stmt = $pdo->prepare('UPDATE category SET name = :name WHERE id = :id ');

                $criteria = [
                    'name' => $_POST['name'],
                    'id' => $_POST['id']
                ];

                $stmt->execute($criteria);
                echo 'Category Saved';
            } else {
                $currentCategory = $pdo->query('SELECT * FROM category WHERE id = ' . $_GET['id'])->fetch();
            }
            return ['template' => 'admin/editcategory.html.php',
                'title' => 'admin/editcategory',
                'variables' => []
            ];
        }
    }

    public function archive(): void
    {

        $jobsTable = new DatabaseTable('job', 'id');
        $jobsTable->update(['id' => $_POST['id'], 'archive' => 1]);
        header("Location: ../admin/jobs");


    }
    public function postjob(): void
    {

        $jobsTable = new DatabaseTable('job', 'id');
        $jobsTable->update(['id' => $_POST['id'], 'archive' => 1]);
        header("Location: ../admin/jobs");

//
    }

    public function categoryarchive(): void
    {
        $catTable = new DatabaseTable('category', 'id');
        $catTable->update(['id' => $_POST['id'], 'archive' => 1]);
        header("Location: ../admin/categories");

    }


    public function repost(): void
    {
        $catTable = new DatabaseTable('category', 'id');
        $catTable->update(['id' => $_POST['id'], 'archive' => 1]);
        header("Location: ../admin/categories");

       }



    public function login(): array
    {
        $errMsgArray = [];
        $errorFlag = false;

        if ($_POST) {
            $userName = $_POST['username'];
            $password = $_POST['password'];

            if (empty($userName) == '' || empty($password) == '') {
                $errMsgArray[] = 'You must enter a valid credential';
                $errorFlag = true;
            }

            $userAdminTable = new DatabaseTable('users', 'id');
            $user = $userAdminTable->find('username', $userName);


            if ($user) {

                if (password_verify($password, $user['password'])) {
                    $_SESSION['loggedin'] = $user['id'];
                    $_SESSION['userDetails'] = $user;
                    $_SESSION['password_verified'] = true;

                    if ($user['userType'] === 'client') {
                        header("Location: user");
                    }
                    if ($user['userType'] === 'admin') {
                        header("Location: ../admin/index");
                    }

                } else {
                    $_SESSION['password_verified'] = false;
                    echo 'Credentials are wrong. Try again';
                    $errorFlag = false;
                }
            }

        }

        return ['template' => '../templates/admin/login.html.php',
            'title' => 'admin/login',
            'variables' => []
        ];
    }

    public function adduser(): array
    {
        if ($_POST) {

            $values = [
                'username' => $_POST['username'],
                'password' => $password = password_hash($_POST['password'], PASSWORD_DEFAULT),
                'fullName' => $_POST['name'],
                'userType' => $_POST['user_type']
            ];

            $userAdminTable = new \functions\DatabaseTable('users', 'id');
            $user = $userAdminTable->find('username', $values['username']);
           $user = $userAdminTable->insert($values);
            if ($user) {
                $message = "Username Exists";
            } else {
                $user = $userAdminTable->insert($values);
                $message = "User Added";
                header('location: ../admin/login');
                exit();
            }
        }
        return ['template' => 'admin/adduser.html.php',
            'title' => 'admin/adduser',
            'variables' => []
        ];
    }

    public function clientjobs():array{

        return ['template' => 'client/clientjobs.html.php',
            'title' => 'client/clientjobs',
            'variables' => []
        ];
    }

    public function logout(): array{
        //session_start();
        session_destroy();
        header("Location: ../admin/login");
        exit;
    }

    public function user(): array{
        return ['template' => '../templates/client/user.html.php',
            'title' => 'client/user',
            'variables' => []
        ];
    }



}


