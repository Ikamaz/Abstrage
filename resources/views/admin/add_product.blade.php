<!DOCTYPE html>
<html>

<head>
    @include('admin.css')

    <style type="text/css">

        h1 {
            color: white;
            text-align: center;
            margin-bottom: 40px;
        }

        .form-container {
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }

        label {
            color: white;
            display: block;
            font-size: 18px;
            margin-bottom: 8px;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #bdc3c7;
            font-size: 16px;
        }

        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            display: inline-block;
            padding: 12px;
            cursor: pointer;
            background-color: #2980b9;
            color: white;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }

        .custom-file-upload:hover {
            background-color: #3498db;
        }

        .image-preview {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .image-preview img {
            max-width: 100px;
            height: auto;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-success {
            width: 100%;
            padding: 15px;
            font-size: 18px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-success:hover {
            background-color: #2ecc71;
        }

        @media screen and (max-width: 768px) {
            h1{
                font-size: 26px;
            }
            .form-container {
                padding: 15px;
            }
            label {
                font-size: 16px;
            }

            input[type="text"],
            textarea {
                font-size: 14px;
            }

            .btn-success {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1>დაამატე პროდუქცია</h1>

                <div class="form-container">
                    <form action="{{url('upload_product')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="input_deg">
                            <label>კოდი</label>
                            <input type="text" name="code" required>
                        </div>

                        <div class="input_deg">
                            <label>სახელი</label>
                            <input type="text" name="title" required>
                        </div>

                        <div class="input_deg">
                            <label>აღწერა</label>
                            <textarea name="description" required></textarea>
                        </div>

                        <div class="input_deg">
                            <label>ფასი</label>
                            <input type="text" name="price">
                        </div>

                        <div class="input_deg">
                            <label>კატეგორია</label>
                            <select name="category" id="category" required>
                                <option>აირჩიეთ კატეგორია</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_name }}"
                                        @if(old('category') === $category->category_name) selected @endif>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input_deg">
                            <label>რაოდენობა</label>
                            @php
                                $selectedCategory = old('category');
                            @endphp

                            @if($selectedCategory === 'ნახატი')
                                <input type="hidden" name="qty" value="1">
                                <p>Quantity is set to 1 for "ნახატი" category.</p>
                            @else
                                <input type="number" name="qty" value="{{ old('qty', 1) }}" min="1">
                            @endif
                        </div>


                        <div class="input_deg">
                            <label>ფოტო</label>
                            <label for="imageUpload" class="custom-file-upload">აირჩიეთ ფოტო</label>
                            <input id="imageUpload" type="file" name="images[]" multiple onchange="previewImages(event)">
                            <div class="image-preview" id="imagePreview"></div>
                        </div>

                        <div class="input_deg">
                            <input class="btn btn-success" type="submit" value="დაამატე პროდუქცია">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <script>
        function previewImages(event) {
            var preview = document.getElementById('imagePreview');
            preview.innerHTML = '';
            Array.from(event.target.files).forEach(file => {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    preview.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }
    </script>

    @include('admin.js')
</body>

</html>
