<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Student Dashboard</h1>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Welcome, <?php echo $student['name']; ?></span>
                <a href="/logout" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-300">
                    Logout
                </a>
            </div>
        </div>
    </nav>
    
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">My Profile</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600"><strong>Name:</strong> <?php echo $student['name']; ?></p>
                    <p class="text-gray-600"><strong>Email:</strong> <?php echo $student['email']; ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">My Courses</h2>
            
            <?php if (empty($enrollments)): ?>
                <p class="text-gray-600">You are not enrolled in any courses yet.</p>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($enrollments as $course): ?>
                        <div class="bg-gray-50 rounded-lg p-4 shadow-sm border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2"><?php echo $course['name']; ?></h3>
                            <p class="text-gray-600 text-sm mb-2"><?php echo $course['description']; ?></p>
                            <p class="text-blue-500 font-medium"><?php echo $course['code']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>