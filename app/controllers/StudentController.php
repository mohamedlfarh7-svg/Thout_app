<?php
require_once '../core/Controller.php';
require_once '../models/Student.php';
require_once '../core/Auth.php';


class StudentController extends Controller {
    private Student $studentModel;
    
    public function __construct() {
        session_start();
        $this->studentModel = new Student();
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $student = $this->studentModel->findByEmail($email);
            
            if ($student && password_verify($password, $student['password'])) {
                Auth::login($student['id']);
                $this->redirect('dashboard');
            } else {
                $error = "Invalid credentials";
                $this->view('dashboard', ['error' => $error]);
            }
        } else {
            $this->view('student/login');
        }
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            $success = $this->studentModel->create($name, $email, $password);
            
            if ($success) {
                $this->redirect('/login');
            } else {
                $error = "Registration failed";
                $this->view('student/register', ['error' => $error]);
            }
        } else {
            $this->view('student/register');
        }
    }
    
    public function dashboard() {
        if (!Auth::check()) {
            $this->redirect('/login');
        }
        
        $studentId = Auth::user();
        $student = $this->studentModel->findById($studentId);
        $enrollments = $this->studentModel->getEnrollments($studentId);
        
        $this->view('student/dashboard', [
            'student' => $student,
            'enrollments' => $enrollments
        ]);
    }
    
    public function logout() {
        Auth::logout();
        $this->redirect('/login');
    }
}
?>