<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - CompanyJob</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        
        .header-section {
            background: url('/images/hero-bg.jpg');
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
            color: #fff;
            padding: 80px 0;
            text-align: center;
            position: relative; 
        }
        .header-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #fff;
        }
        .header-section p {
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        .about-content {
            padding: 50px 0;
            background-color: #fff;
        }
        .about-content h2 {
            color: #0d6efd;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .about-content p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .mission-vision {
            padding: 40px 0;
            background-color: #f8f9fa;
        }
        .mission-vision h3 {
            color: #0d6efd;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .card {
            border: none;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Header Section -->
    <section class="header-section">
        <div class="container">
        </div>
    </section>

    <!-- Mission and Vision -->
    <section class="mission-vision">
        <div class="container">
            <h3>Our Mission & Vision</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="card p-4 mb-4">
                        <h4>Mission</h4>
                        <p>To empower individuals by providing access to diverse job opportunities and equipping employers with the tools to build exceptional teams, fostering growth and success for all.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-4 mb-4">
                        <h4>Vision</h4>
                        <p>To be the global leader in job placement, revolutionizing the way people connect with careers and businesses thrive through talent acquisition.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>