<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Generator</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f4f6f9;
        }

        .cv-img {
            width: 180px;
            max-width: 180px;
            height: 250px;
            object-fit: cover;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .cv-template-item {
            text-align: center;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .cv-template-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }
        
        .cv-template-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1), 
                        0 1px 3px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            background-color: white;
            padding: 15px;
            width: 300px;
        }
        
        .cv-template-card:hover {
            box-shadow: 0 10px 20px rgba(0,0,0,0.15), 
                        0 6px 6px rgba(0,0,0,0.12);
            transform: translateY(-10px);
        }
        
        .cv-img:hover {
            transform: scale(1.05);
        }
        
        .cv-template-card p {
            font-weight: 500;
            color: #333;
            margin-top: 10px;
        }
        
        .box-title {
            color: #2c3e50;
            font-weight: 600;
        }
    </style>
</head>
<body>
    @include('baselayout.sidebar')
    
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title">CV Generator</h4>
                        </div>
                        
                        <div class="card-body">
                            <div class="cv-template-container">
                                @php
                                    $templates = [
                                        ['name' => 'CODEPENA CV-001', 'image' => 'cvtemp1.png'],
                                        ['name' => 'CODEPENA CV-002', 'image' => 'cvtemp2.png'],
                                        ['name' => 'CODEPENA CV-003', 'image' => 'cvtemp3.png'],
                                        ['name' => 'CODEPENA CV-004', 'image' => 'cvtemp4.png'],
                                        ['name' => 'CODEPENA CV-005', 'image' => 'cvtemp5.png'],
                                        ['name' => 'CODEPENA CV-006', 'image' => 'cvtemp6.png']
                                    ];
                                @endphp
                                
                                @foreach($templates as $template)
                                    <div class="cv-template-item">
                                        <div class="cv-template-card">
                                            <img 
                                                src="{{ asset('images/' . $template['image']) }}" 
                                                alt="{{ $template['name'] }} CV Template" 
                                                class="cv-img"
                                            >
                                            <p>{{ $template['name'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        @include('baselayout.footer')
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>