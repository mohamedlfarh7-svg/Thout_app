<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Thoth LMS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f0f2f5;
        }
        .topbar {
            background: #2c3e50;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .user {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .logout {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .main {
            padding: 30px;
        }
        .welcome {
            background: white;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 25px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .stats {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat {
            background: white;
            padding: 20px;
            border-radius: 8px;
            flex: 1;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #3498db;
        }
        .courses {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .course {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .course-header {
            background: #3498db;
            color: white;
            padding: 15px;
        }
        .course-body {
            padding: 15px;
        }
        .btn {
            display: inline-block;
            padding: 8px 15px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }
        .btn:hover {
            background: #2980b9;
        }
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .badge {
            background: #2ecc71;
            color: white;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 12px;
            float: right;
        }
        .enrolled {
            background: #3498db;
        }
    </style>
</head>
<body>
    <div class="topbar">
        <div class="logo">Thoth LMS</div>
        <div class="user">
            <span>Welcome, <?php echo htmlspecialchars($students['name'] ?? 'Student'); ?></span>
            <button onclick="window.location.href='/student/logout'" class="logout">Logout</button>
        </div>
    </div>

    <div class="main">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="message success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="message error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="welcome">
            <h1>Welcome to Your Dashboard</h1>
            <p>Email: <?php echo htmlspecialchars($students['email'] ?? ''); ?></p>
        </div>

        <div class="stats">
            <div class="stat">
                <div class="stat-number"><?php echo count($myCourses ?? []); ?></div>
                <div>My Courses</div>
            </div>
            <div class="stat">
                <div class="stat-number"><?php echo count($availableCourses ?? []); ?></div>
                <div>Available Courses</div>
            </div>
        </div>

        <h2>My Courses</h2>
        <div class="courses">
            <?php if (!empty($myCourses)): ?>
                <?php foreach ($myCourses as $course): ?>
                    <div class="course">
                        <div class="course-header">
                            <?php echo htmlspecialchars($course->title); ?>
                            <span class="badge enrolled">Enrolled</span>
                        </div>
                        <div class="course-body">
                            <p><?php echo htmlspecialchars(substr($course->description ?? 'No description', 0, 100)); ?>...</p>
                            <p><small>Enrolled: <?php echo date('M d, Y', strtotime($course->enrollment_date)); ?></small></p>
                            <a href="/student/course/<?php echo $course->id; ?>" class="btn">View Course</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No enrolled courses.</p>
            <?php endif; ?>
        </div>

        <h2 style="margin-top: 30px;">Available Courses</h2>
        <div class="courses">
            <?php if (!empty($availableCourses)): ?>
                <?php foreach ($availableCourses as $course): ?>
                    <div class="course">
                        <div class="course-header">
                            <?php echo htmlspecialchars($course->title); ?>
                            <?php if (isset($course->is_enrolled) && $course->is_enrolled): ?>
                                <span class="badge enrolled">Already Enrolled</span>
                            <?php endif; ?>
                        </div>
                        <div class="course-body">
                            <p><?php echo htmlspecialchars(substr($course->description ?? 'No description', 0, 100)); ?>...</p>
                            <div style="margin-top: 15px;">
                                <a href="/student/course/<?php echo $course->id; ?>" class="btn">View Details</a>
                                <?php if (!isset($course->is_enrolled) || !$course->is_enrolled): ?>
                                    <a href="/student/enroll/<?php echo $course->id; ?>" class="btn" style="background: #27ae60;">Enroll Now</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No courses available.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>