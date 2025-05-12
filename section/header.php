<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abdur Ltd - চাকরির প্রস্তুতি প্ল্যাটফর্ম</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4cc9f0;
            --primary-color: #2a5cb8;
            --secondary-color: #f8f9fa;
            --accent-color: #ff6b6b;
            --text-dark: #333;
            --text-medium: #555;
            --text-light: #777;
            --accent-color: #ff6b6b;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4bbf73;
            --warning: #f0ad4e;
            --danger: #d9534f;
            --gradient-primary: linear-gradient(135deg, #4361ee 0%, #3f37c9 100%);
            --gradient-accent: linear-gradient(135deg, #4cc9f0 0%, #4895ef 100%);
        }

        body {
            font-family: 'Poppins', 'SolaimanLipi', sans-serif;
            color: var(--dark);
            overflow-x: hidden;
            background-color: #f5f7ff;
        }
        
        /* Buttons */
        .btn {
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: rgba(255,255,255,0.2);
            transition: all 0.3s ease;
            z-index: -1;
        }

        .btn:hover:before {
            width: 100%;
        }

        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
        }

        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .btn-accent {
            background: var(--gradient-accent);
            border: none;
            color: white;
            box-shadow: 0 5px 15px rgba(76, 201, 240, 0.3);
        }

        .btn-accent:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(76, 201, 240, 0.4);
            color: white;
        }
        /* Sections */
        .section {
            padding: 100px 0;
            position: relative;
        }

        .section-title {
            font-weight: 700;
            color: var(--dark);
            position: relative;
            margin-bottom: 30px;
            text-align: center;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .section-subtitle {
            color: #666;
            margin-bottom: 60px;
            text-align: center;
            font-size: 1.1rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>