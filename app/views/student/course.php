<?php
if (!isset($_SESSION['student_id'])) {
    header("Location: /student/login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course->title); ?> - Thoth LMS</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f7fa; }
        .header { background: #2c3e50; color: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 24px; font-weight: bold; color: #3498db; }
        .main { padding: 30px; max-width: 800px; margin: 0 auto; }
        .course-container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.1); }
        .btn { display: inline-block; padding: 12px 25px; background: #3498db; color: white; text-decoration: none; border-radius: 5px; margin-top: 20px; margin-right: 15px; }
        .btn:hover { background: #2980b9; }
        .btn-success { background: #2ecc71; }
        .btn-success:hover { background: #27ae60; }
        .btn-back { background: #95a5a6; }
        .btn-back:hover { background: #7f8c8d; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">Thoth LMS</div>
        <a href="/student/dashboard" style="color: white; text-decoration: none;">← Back to Dashboard</a>
    </div>

    <div class="main">
        <div class="course-container">
            <h1><?php echo htmlspecialchars($course->title); ?></h1>
            <p style="margin: 20px 0; line-height: 1.6;"><?php echo htmlspecialchars($course->description ?? 'No description available'); ?></p>
            
            <?php if ($isEnrolled): ?>
                <p style="color: green; font-weight: bold; margin: 20px 0;">✓ You are enrolled in this course</p>
                <a href="/student/dashboard" class="btn">Go to Dashboard</a>
            <?php else: ?>
                <a href="/student/enroll/<?php echo $course->id; ?>" class="btn btn-success">Enroll Now</a>
            <?php endif; ?>
            
            <a href="/student/dashboard" class="btn btn-back">Back to Courses</a>
        </div>
    </div>
</body>
</html>