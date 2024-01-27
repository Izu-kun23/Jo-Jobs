<?php

namespace Controllers;
use functions\DatabaseTable;

class PageController
{
    private $table;
    private $primaryKey;

    public function __construct($table, $primaryKey)
    {
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    public function home(): array
    {
        $jobTable = new DatabaseTable('job', 'id');
            $criteria = [];
            $query = 'SELECT j.*, c.id AS catId 
                    FROM job j
                    LEFT JOIN category c 
                        ON c.id = j.categoryId';
            if (isset($_GET['location'])){
                $query.= 'WHERE j.location=:location AND j.archive IS NULL  ORDER BY j.closingDate ASC LIMIT 10';
                $criteria = ['location' => $_GET['location']];
            } else {
                $query.= ' WHERE j.archive IS NULL ORDER BY j.closingDate ASC LIMIT 10';
            }
            $jobs = $jobTable->customFind($query, $criteria);
            $values = 'SELECT DISTINCT location FROM job';
            $locations = $jobTable->customFind($values, []);

            //var_dump($jobs);

        return ['template' => '../templates/layout/index.html.php',
            'title' => 'Jo\'s Job - Home',
             'variables' => ["jobs"=>  $jobs, "locations" => $locations]
        ];



    }

    public function job(): array{
        return ['template' => 'admin/jobs.html.php',
            'title' => 'admin/jobs',
            'variables' => []
        ];
}
    public function about(): array
    {
        return ['template' => '../templates/layout/about.html.php',
            'title' => 'About',
            'variables' => []
        ];

    }

    public function categorylist(): array{
        $jobTable = new DatabaseTable('job', 'id');
        $categoryTable = new DatabaseTable('category','id');

        $stmt = 'SELECT * FROM job WHERE categoryId = :id AND closingDate > :date';
        $date = new \DateTime();

        $cr = ['date' => $date->format('Y-m-d'), 'id' => $_GET['categoryId']];
        $jobs = $jobTable->customFind($stmt, $cr);
        $categories = $categoryTable->findAll();
        $currentCategory = $categoryTable->find("id", $_GET['categoryId']);

        return ['template' => '../templates/layout/categorylist.html.php',
            'title' => 'categorylist',
            'variables' => [
                'currentCategory' => $currentCategory,
                'jobs' => $jobs,
                'category' => $categories
            ]
        ];
    }

    public function apply()
    {
        $applicantTable = new DatabaseTable('applicants', 'id');
        $jobTable = new DatabaseTable('job', 'id');
        if (isset($_POST['submit'])) {

            if ($_FILES['cv']['error'] == 0) {

                $parts = explode('.', $_FILES['cv']['name']);

                $extension = end($parts);

                $fileName = uniqid() . '.' . $extension;

                move_uploaded_file($_FILES['cv']['tmp_name'], 'cvs/' . $fileName);

                $criteria = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'details' => $_POST['details'],
                    'jobId' => $_POST['jobId'],
                    'cv' => $fileName
                ];
                $applicantTable->insert($criteria);
                header('location: ../layout/index');
            } else {
                echo 'There was an error uploading your CV';
            }
        }

                $job = $jobTable->find('id', $_GET['id']);
//                var_dump($job);

            return [
                'template' => '../templates/layout/apply.html.php',
                'title' => 'Apply',
                'variables' => ['job' => $job]];

    }




//        if (isset($_POST['submit'])) {
//            if ($_FILES['cv']['error'] == 0) {
//                $parts = explode('.', $_FILES['cv']['name']);
//
//                $extension = end($parts);
//
//                $fileName = uniqid() . '.' . $extension;
//
//                move_uploaded_file($_FILES['cv']['tmp_name'], 'cvs/' . $fileName);
//
//                $criteria = ['name' => $_POST['name'], 'email' => $_POST['email'], 'details' => $_POST['details'], 'jobId' => $_POST['jobId'], 'cv' => $fileName];
//
//                $job = $jobTable->insert($criteria);
//
//                echo 'Your application is complete. We will contact you after the closing date.';
//            } else {
//                echo 'There was an error uploading your CV';
//            }
//        }
//
//        $job = $jobTable->findAll('id', $_GET['id'])[0];
//        return ['template' => 'apply.html.php', 'title' => 'Apply', 'variables' => ['job' => $job]];


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
                        header("Location: clientIndex");
                        exit();
                    }
                    if ($user['userType'] === 'admin') {
                        header("Location: ../admin/adminIndex");
                        exit();
                    }

                    header("Location: ../admin/index");
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

    public function enquiries(): array
    {
        return ['template' => '../templates/admin/enquiries.html.php',
            'title' => 'admin/enquiries',
            'variables' => []
        ];
    }


    public function faqs(): array
    {
        return ['template' => '../templates/layout/faqs.html.php',
            'title' => '/templates/layout/faqs',
            'variables' => []
        ];
    }

}

