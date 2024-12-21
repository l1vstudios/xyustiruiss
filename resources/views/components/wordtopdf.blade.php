<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Generator</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Dropzone CSS -->
    <link href="https://cdn.jsdelivr.net/npm/dropzone@5.7.0/dist/min/dropzone.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .dropzone {
            border: 2px dashed #007bff;
            border-radius: 8px;
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .dropzone:hover {
            background-color: #e9ecef;
            border-color: #0056b3;
        }

        .dz-message {
            font-size: 18px;
            color: #007bff;
        }

        .dz-message span {
            font-weight: bold;
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
                            <h4 class="box-title">WORD TO PDF CONVERTER</h4>
                        </div>

                        <div class="card-body">
                            <!-- Dropzone form for uploading Word file -->
                            <form action="{{ route('convert.word-to-pdf') }}" class="dropzone" id="cv-upload" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="dz-message">
                                    <span>Drag and drop your WORD file here or click to select a file</span>
                                </div>
                            </form>
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

    <!-- Dropzone JS -->
    <script src="https://cdn.jsdelivr.net/npm/dropzone@5.7.0/dist/min/dropzone.min.js"></script>

    <script>
        // Initialize Dropzone
        Dropzone.options.cvUpload = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 10, // Maximum file size in MB
            acceptedFiles: ".doc,.docx", // Only allow Word files
            dictDefaultMessage: "Drag and drop your Word file here or click to select a file",
            dictFallbackMessage: "Your browser does not support drag and drop file uploads.",
            dictInvalidFileType: "Only Word files are allowed.",
            dictFileTooBig: "File is too big. Maximum allowed size is 10 MB.",
            dictResponseError: "Error occurred during upload. Please try again.",

            success: function(file, response) {
                if (response.url) {
                    // Trigger the file download automatically
                    const link = document.createElement('a');
                    link.href = response.url;  // URL of the converted PDF
                    link.download = response.url.split('/').pop();  // Use the last part of the URL as the filename
                    document.body.appendChild(link);  // Add the link to the body
                    link.click();  // Programmatically click the link to download
                    document.body.removeChild(link);  // Remove the link after download
                } else {
                    alert('Error: No file URL returned');
                }
            },

            error: function(file, response) {
                // Log the error response to console for debugging
                console.log('Error Response:', response);

                // Handle different error formats
                if (typeof response === 'object') {
                    // If it's an object, convert to JSON string to display
                    alert('Error: ' + JSON.stringify(response));
                } else {
                    // If it's a simple error message, just display it
                    alert('Error: ' + response);
                }
            }
        };
    </script>
</body>
</html>
